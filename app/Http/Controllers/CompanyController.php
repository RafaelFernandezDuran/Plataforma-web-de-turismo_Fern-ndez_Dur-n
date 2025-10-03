<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $company = $user->company;
        
        // Si no tiene empresa, redirigir para crear una
        if (!$company) {
            return redirect()->route('company.create')->with('message', 'Primero debes registrar tu empresa turística.');
        }
        
        // Estadísticas de la empresa
        $stats = [
            'tours_count' => $company->tours()->count(),
            'active_tours' => $company->tours()->where('status', 'active')->count(),
            'total_bookings' => $company->bookings()->count(),
            'pending_bookings' => $company->bookings()->where('status', 'pending')->count(),
            'monthly_revenue' => $company->bookings()
                ->where('status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->sum('total_amount'),
        ];
        
        // Últimas reservas
        $recent_bookings = $company->bookings()
            ->with(['user', 'tour'])
            ->latest()
            ->take(5)
            ->get();
        
        return view('company.dashboard', compact('company', 'stats', 'recent_bookings'));
    }

    public function index()
    {
        $companies = Company::active()->with('tours')->paginate(12);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
