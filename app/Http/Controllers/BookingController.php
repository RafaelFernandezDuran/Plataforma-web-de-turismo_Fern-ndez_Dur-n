<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['tour', 'user'])
            ->when(Auth::user()->role === 'user', function($query) {
                return $query->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Tour $tour)
    {
        return view('bookings.create', compact('tour'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'tour_date' => 'required|date|after:today',
            'adult_participants' => 'required|integer|min:1|max:20',
            'child_participants' => 'nullable|integer|min:0|max:20',
            'participant_details' => 'required|array|min:1',
            'participant_details.*.name' => 'required|string|max:255',
            'participant_details.*.document' => 'required|string|max:20',
            'participant_details.*.age' => 'required|integer|min:1|max:100',
            'special_requests' => 'nullable|string|max:1000',
        ], [
            'tour_date.after' => 'La fecha del tour debe ser posterior a hoy.',
            'adult_participants.min' => 'Debe haber al menos 1 participante adulto.',
            'adult_participants.max' => 'Máximo 20 participantes por reserva.',
            'participant_details.required' => 'Los detalles de los participantes son obligatorios.',
            'participant_details.*.name.required' => 'El nombre de cada participante es obligatorio.',
            'participant_details.*.document.required' => 'El documento de cada participante es obligatorio.',
            'participant_details.*.age.required' => 'La edad de cada participante es obligatoria.',
        ]);

        $tour = Tour::findOrFail($request->tour_id);
        
        // Calcular precios
        $adultPrice = $tour->price;
        $childPrice = $tour->child_price ?? ($tour->price * 0.7); // 70% del precio adulto si no hay precio específico
        
        $subtotal = ($request->adult_participants * $adultPrice) + 
                   (($request->child_participants ?? 0) * $childPrice);
        
        $commission = $subtotal * 0.10; // 10% de comisión
        $totalAmount = $subtotal + $commission;

        // Crear reserva
        $booking = Booking::create([
            'booking_number' => 'CHT-' . strtoupper(Str::random(6)) . '-' . date('Ymd'),
            'user_id' => Auth::id(),
            'tour_id' => $tour->id,
            'company_id' => $tour->company_id,
            'tour_date' => $request->tour_date,
            'adult_participants' => $request->adult_participants,
            'child_participants' => $request->child_participants ?? 0,
            'adult_price' => $adultPrice,
            'child_price' => $childPrice,
            'subtotal' => $subtotal,
            'commission' => $commission,
            'total_amount' => $totalAmount,
            'participant_details' => $request->participant_details,
            'special_requests' => $request->special_requests ? [$request->special_requests] : null,
            'status' => 'pending',
            'payment_status' => 'pending'
        ]);

        return redirect()
            ->route('bookings.show', $booking)
            ->with('success', '¡Reserva creada exitosamente! Número de reserva: ' . $booking->booking_number);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        // Verificar permisos
        if (Auth::user()->role === 'user' && $booking->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta reserva.');
        }

        $booking->load(['tour.company', 'user']);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Generate a PDF receipt for the specified booking.
     */
    public function downloadPdf(Booking $booking)
    {
        if (Auth::user()->role === 'user' && $booking->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para descargar esta reserva.');
        }

        $booking->load(['tour.company', 'user']);

        $pdf = Pdf::loadView('bookings.pdf', [
            'booking' => $booking,
        ]);

        $pdf->setPaper('a4');
        $pdf->setOption('isRemoteEnabled', true);

        $fileName = 'reserva-' . $booking->booking_number . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        // Solo permitir editar reservas pendientes
        if ($booking->status !== 'pending') {
            return redirect()
                ->route('bookings.show', $booking)
                ->with('error', 'Solo se pueden editar reservas pendientes.');
        }

        // Verificar permisos
        if (Auth::user()->role === 'user' && $booking->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta reserva.');
        }

        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        // Solo permitir actualizar reservas pendientes
        if ($booking->status !== 'pending') {
            return redirect()
                ->route('bookings.show', $booking)
                ->with('error', 'Solo se pueden editar reservas pendientes.');
        }

        $request->validate([
            'tour_date' => 'required|date|after:today',
            'adult_participants' => 'required|integer|min:1|max:20',
            'child_participants' => 'nullable|integer|min:0|max:20',
            'participant_details' => 'required|array|min:1',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        // Recalcular precios
        $tour = $booking->tour;
        $adultPrice = $tour->price;
        $childPrice = $tour->child_price ?? ($tour->price * 0.7);
        
        $subtotal = ($request->adult_participants * $adultPrice) + 
                   (($request->child_participants ?? 0) * $childPrice);
        
        $commission = $subtotal * 0.10;
        $totalAmount = $subtotal + $commission;

        $booking->update([
            'tour_date' => $request->tour_date,
            'adult_participants' => $request->adult_participants,
            'child_participants' => $request->child_participants ?? 0,
            'subtotal' => $subtotal,
            'commission' => $commission,
            'total_amount' => $totalAmount,
            'participant_details' => $request->participant_details,
            'special_requests' => $request->special_requests ? [$request->special_requests] : null,
        ]);

        return redirect()
            ->route('bookings.show', $booking)
            ->with('success', 'Reserva actualizada exitosamente.');
    }

    /**
     * Cancel a booking
     */
    public function cancel(Request $request, Booking $booking)
    {
        if ($booking->status === 'cancelled') {
            return redirect()
                ->route('bookings.show', $booking)
                ->with('error', 'Esta reserva ya está cancelada.');
        }

        $request->validate([
            'cancellation_reason' => 'required|string|max:500'
        ]);

        $booking->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancellation_reason' => $request->cancellation_reason
        ]);

        return redirect()
            ->route('bookings.show', $booking)
            ->with('success', 'Reserva cancelada exitosamente.');
    }

    /**
     * Confirm a booking (for companies)
     */
    public function confirm(Booking $booking)
    {
        if (Auth::user()->role !== 'company') {
            abort(403, 'Solo las empresas pueden confirmar reservas.');
        }

        $booking->update([
            'status' => 'confirmed',
            'confirmed_at' => now()
        ]);

        return redirect()
            ->route('bookings.show', $booking)
            ->with('success', 'Reserva confirmada exitosamente.');
    }
}
