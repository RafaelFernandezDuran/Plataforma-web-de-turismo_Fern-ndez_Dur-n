<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccommodationRequestStoreRequest;
use App\Models\Accommodation;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['city', 'type', 'price_min', 'price_max']);

        $accommodations = Accommodation::active()
            ->when($filters['city'] ?? null, function ($query, $city) {
                $query->where('city', $city);
            })
            ->when($filters['type'] ?? null, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($filters['price_min'] ?? null, function ($query, $price) {
                $query->where('price_per_night', '>=', $price);
            })
            ->when($filters['price_max'] ?? null, function ($query, $price) {
                $query->where('price_per_night', '<=', $price);
            })
            ->orderByDesc('rating')
            ->paginate(9)
            ->withQueryString();

        $cities = Accommodation::active()
            ->whereNotNull('city')
            ->distinct()
            ->orderBy('city')
            ->pluck('city');

        $types = Accommodation::active()
            ->distinct()
            ->orderBy('type')
            ->pluck('type');

        $stats = [
            'total' => Accommodation::active()->count(),
            'cities' => Accommodation::active()->whereNotNull('city')->distinct()->count('city'),
            'average_rating' => round((float) Accommodation::active()->avg('rating'), 1),
            'average_price' => Accommodation::active()->whereNotNull('price_per_night')->avg('price_per_night'),
        ];

        return view('accommodations.index', [
            'accommodations' => $accommodations,
            'filters' => $filters,
            'cities' => $cities,
            'types' => $types,
            'stats' => $stats,
        ]);
    }

    public function show(Accommodation $accommodation)
    {
        $related = Accommodation::active()
            ->where('id', '!=', $accommodation->id)
            ->where(function ($query) use ($accommodation) {
                $query->where('city', $accommodation->city)
                    ->orWhere('type', $accommodation->type);
            })
            ->orderByDesc('rating')
            ->limit(3)
            ->get();

        return view('accommodations.show', [
            'accommodation' => $accommodation,
            'related' => $related,
        ]);
    }

    public function submitRequest(AccommodationRequestStoreRequest $request, Accommodation $accommodation)
    {
        $payload = $request->validated();
        $payload['source'] = $payload['source'] ?? 'web';

        $accommodation->requests()->create($payload);

        return redirect()
            ->route('accommodations.show', $accommodation)
            ->with('status', 'Gracias por tu solicitud. Nuestro equipo se comunicará contigo en las próximas horas.');
    }
}
