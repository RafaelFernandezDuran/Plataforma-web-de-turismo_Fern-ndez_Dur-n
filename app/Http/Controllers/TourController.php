<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourCategory;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TourController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of tours (public view or company dashboard)
     */
    public function index(Request $request)
    {
        // Si es una ruta de empresa, mostrar dashboard de tours
        if ($request->route()->getPrefix() === 'company') {
            return $this->companyToursIndex($request);
        }

        // Vista pública de tours
        $query = Tour::with(['company', 'category'])
            ->where('status', 'active')
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc');

        // Aplicar filtros
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('company', function($companyQuery) use ($searchTerm) {
                      $companyQuery->where('name', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('duration')) {
            $query->where('duration_days', $request->duration);
        }

        if ($request->filled('difficulty')) {
            $query->where('difficulty_level', $request->difficulty);
        }

        $tours = $query->paginate(12);
        $categories = TourCategory::where('is_active', true)
                                 ->orderBy('sort_order')
                                 ->get();

        return view('tours.index', compact('tours', 'categories'));
    }

    /**
     * Display company's tours (dashboard view)
     */
    private function companyToursIndex(Request $request)
    {
        $this->authorize('viewAny', Tour::class);

        $company = Auth::user()->company;
        
        $query = $company->tours()->with(['category'])
            ->orderBy('created_at', 'desc');

        // Aplicar filtros del dashboard
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tours = $query->paginate(12);

        return view('company.tours.index', compact('tours', 'company'));
    }

    /**
     * Show a specific tour (public view)
     */
    public function show(Tour $tour)
    {
        if ($tour->status !== 'active') {
            abort(404);
        }

        $tour->load(['company', 'category', 'reviews.user']);
        
        // Incrementar visualizaciones
        $tour->increment('views_count');

        // Tours relacionados
        $relatedTours = Tour::with(['company', 'category'])
            ->where('status', 'active')
            ->where('id', '!=', $tour->id)
            ->where('tour_category_id', $tour->tour_category_id)
            ->limit(3)
            ->get();

        return view('tours.show', compact('tour', 'relatedTours'));
    }

    /**
     * Show the form for creating a new tour (company dashboard)
     */
    public function create()
    {
        $this->authorize('create', Tour::class);
        
        $categories = TourCategory::where('is_active', true)
                                 ->orderBy('name')
                                 ->get();
        
        return view('tours.create', compact('categories'));
    }

    /**
     * Store a newly created tour
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tour::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tour_category_id' => 'required|exists:tour_categories,id',
            'price' => 'required|numeric|min:0',
            'child_price' => 'nullable|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'duration_hours' => 'required|integer|min:1',
            'min_participants' => 'required|integer|min:1',
            'max_participants' => 'required|integer|min:1|gte:min_participants',
            'difficulty_level' => 'required|in:easy,moderate,hard,expert',
            'included_services' => 'required|array|min:1',
            'excluded_services' => 'nullable|array',
            'itinerary' => 'required|array|min:1',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'meeting_points' => 'nullable|array',
            'pickup_locations' => 'nullable|array',
            'available_dates' => 'nullable|array',
            'tags' => 'nullable|array',
            'requirements' => 'nullable|string',
            'recommendations' => 'nullable|string',
            'cancellation_policy' => 'nullable|string'
        ]);

        // Generar slug único
        $validated['slug'] = $this->generateUniqueSlug($validated['title']);
        
        // Asignar empresa del usuario autenticado
        $validated['company_id'] = Auth::user()->company->id;
        
        // Procesar imagen principal
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')
                ->store('tours/main-images', 'public');
        }

        // Procesar galería
        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('tours/gallery', 'public');
            }
        }
        $validated['gallery'] = $gallery;

        // Convertir arrays a JSON
        $validated['included_services'] = json_encode($validated['included_services']);
        $validated['excluded_services'] = json_encode($validated['excluded_services'] ?? []);
        $validated['itinerary'] = json_encode($validated['itinerary']);
        $validated['meeting_points'] = json_encode($validated['meeting_points'] ?? []);
        $validated['pickup_locations'] = json_encode($validated['pickup_locations'] ?? []);
        $validated['available_dates'] = json_encode($validated['available_dates'] ?? []);
        $validated['tags'] = json_encode($validated['tags'] ?? []);

        // Estado inicial
        $validated['status'] = 'draft';

        $tour = Tour::create($validated);

        return redirect()
            ->route('company.tours.show', $tour)
            ->with('success', 'Tour creado exitosamente. Puedes editarlo y publicarlo cuando esté listo.');
    }

    /**
     * Show the form for editing a tour
     */
    public function edit(Tour $tour)
    {
        $this->authorize('update', $tour);

        $categories = TourCategory::where('is_active', true)
                                 ->orderBy('name')
                                 ->get();

        return view('tours.edit', compact('tour', 'categories'));
    }

    /**
     * Update the specified tour
     */
    public function update(Request $request, Tour $tour)
    {
        $this->authorize('update', $tour);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tour_category_id' => 'required|exists:tour_categories,id',
            'price' => 'required|numeric|min:0',
            'child_price' => 'nullable|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'duration_hours' => 'required|integer|min:1',
            'min_participants' => 'required|integer|min:1',
            'max_participants' => 'required|integer|min:1|gte:min_participants',
            'difficulty_level' => 'required|in:easy,moderate,hard,expert',
            'included_services' => 'required|array|min:1',
            'excluded_services' => 'nullable|array',
            'itinerary' => 'required|array|min:1',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'meeting_points' => 'nullable|array',
            'pickup_locations' => 'nullable|array',
            'available_dates' => 'nullable|array',
            'tags' => 'nullable|array',
            'requirements' => 'nullable|string',
            'recommendations' => 'nullable|string',
            'cancellation_policy' => 'nullable|string',
            'status' => 'sometimes|in:draft,active,inactive'
        ]);

        // Actualizar slug si el título cambió
        if ($validated['title'] !== $tour->title) {
            $validated['slug'] = $this->generateUniqueSlug($validated['title'], $tour->id);
        }

        // Procesar nueva imagen principal si se subió
        if ($request->hasFile('main_image')) {
            // Eliminar imagen anterior
            if ($tour->main_image) {
                Storage::disk('public')->delete($tour->main_image);
            }
            $validated['main_image'] = $request->file('main_image')
                ->store('tours/main-images', 'public');
        }

        // Procesar nueva galería si se subió
        if ($request->hasFile('gallery')) {
            // Eliminar galería anterior
            if ($tour->gallery && is_array($tour->gallery)) {
                foreach ($tour->gallery as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
            
            $gallery = [];
            foreach ($request->file('gallery') as $file) {
                $gallery[] = $file->store('tours/gallery', 'public');
            }
            $validated['gallery'] = $gallery;
        }

        // Convertir arrays a JSON
        $validated['included_services'] = json_encode($validated['included_services']);
        $validated['excluded_services'] = json_encode($validated['excluded_services'] ?? []);
        $validated['itinerary'] = json_encode($validated['itinerary']);
        $validated['meeting_points'] = json_encode($validated['meeting_points'] ?? []);
        $validated['pickup_locations'] = json_encode($validated['pickup_locations'] ?? []);
        $validated['available_dates'] = json_encode($validated['available_dates'] ?? []);
        $validated['tags'] = json_encode($validated['tags'] ?? []);

        $tour->update($validated);

        return redirect()
            ->route('company.tours.show', $tour)
            ->with('success', 'Tour actualizado exitosamente.');
    }

    /**
     * Remove the specified tour
     */
    public function destroy(Tour $tour)
    {
        $this->authorize('delete', $tour);

        // Eliminar imágenes del almacenamiento
        if ($tour->main_image) {
            Storage::disk('public')->delete($tour->main_image);
        }

        if ($tour->gallery && is_array($tour->gallery)) {
            foreach ($tour->gallery as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $tour->delete();

        return redirect()
            ->route('company.tours.index')
            ->with('success', 'Tour eliminado exitosamente.');
    }

    /**
     * Generate a unique slug for the tour
     */
    private function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (true) {
            $query = Tour::where('slug', $slug);
            
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            if (!$query->exists()) {
                break;
            }

            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Change tour status (activate/deactivate)
     */
    public function toggleStatus(Tour $tour)
    {
        $this->authorize('update', $tour);

        $newStatus = $tour->status === 'active' ? 'inactive' : 'active';
        $tour->update(['status' => $newStatus]);

        $message = $newStatus === 'active' 
            ? 'Tour activado exitosamente.' 
            : 'Tour desactivado exitosamente.';

        return response()->json(['success' => true, 'message' => $message]);
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Tour $tour)
    {
        $this->authorize('update', $tour);

        $tour->update(['is_featured' => !$tour->is_featured]);

        $message = $tour->is_featured 
            ? 'Tour marcado como destacado.' 
            : 'Tour removido de destacados.';

        return response()->json(['success' => true, 'message' => $message]);
    }
}
