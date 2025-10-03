<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva #{{ $booking->booking_number }} - Chanchamayo Tours</title>
    <link rel="stylesheet" href="{{ asset('css/chanchamayo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tours-index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="description" content="Detalles de tu reserva #{{ $booking->booking_number }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .booking-detail-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
        }

        .booking-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
        }

        .booking-number {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .booking-status {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .status-badge, .payment-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .badge-pending { background: #fbbf24; color: #92400e; }
        .badge-confirmed { background: #10b981; color: white; }
        .badge-cancelled { background: #ef4444; color: white; }
        .badge-completed { background: #3b82f6; color: white; }
        .badge-warning { background: #f59e0b; color: white; }
        .badge-success { background: #059669; color: white; }
        .badge-danger { background: #dc2626; color: white; }
        .badge-info { background: #0ea5e9; color: white; }

        .booking-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .booking-main {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .booking-sidebar {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .section {
            padding: 2rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .section:last-child {
            border-bottom: none;
        }

        .section h3 {
            color: #1f2937;
            margin-bottom: 1.5rem;
            font-size: 1.3rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tour-info {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
        }

        .tour-image {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            object-fit: cover;
        }

        .tour-details h4 {
            margin: 0 0 0.5rem 0;
            color: #1f2937;
            font-size: 1.2rem;
        }

        .tour-meta {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .tour-date {
            background: #f0f9ff;
            color: #0369a1;
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 600;
            display: inline-block;
        }

        .participant-grid {
            display: grid;
            gap: 1rem;
        }

        .participant-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
        }

        .participant-name {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.25rem;
        }

        .participant-details {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .price-breakdown {
            background: #f0f9ff;
            border: 2px solid #0ea5e9;
            border-radius: 12px;
            padding: 1.5rem;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            padding-bottom: 0.5rem;
        }

        .price-total {
            border-top: 2px solid #1f2937;
            padding-top: 1rem;
            font-weight: 700;
            font-size: 1.3rem;
            color: #1f2937;
        }

        .action-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1.5rem;
        }

        .btn-action {
            display: block;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            margin-bottom: 0.5rem;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
        }

        .btn-edit {
            background: #10b981;
            color: white;
        }

        .btn-cancel {
            background: #ef4444;
            color: white;
        }

        .btn-confirm {
            background: #3b82f6;
            color: white;
        }

        .btn-back {
            background: #6b7280;
            color: white;
        }

        .special-requests {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .timeline {
            border-left: 3px solid #e5e7eb;
            padding-left: 1rem;
        }

        .timeline-item {
            margin-bottom: 1rem;
            position: relative;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -1.25rem;
            top: 0.25rem;
            width: 8px;
            height: 8px;
            background: #3b82f6;
            border-radius: 50%;
        }

        .timeline-date {
            font-size: 0.8rem;
            color: #6b7280;
        }

        .timeline-content {
            font-weight: 500;
            color: #1f2937;
        }

        @media (max-width: 768px) {
            .booking-content {
                grid-template-columns: 1fr;
            }
            
            .tour-info {
                flex-direction: column;
                text-align: center;
            }
            
            .booking-detail-container {
                padding: 1rem;
            }
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: #d1fae5;
            border: 1px solid #10b981;
            color: #047857;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #ef4444;
            color: #dc2626;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="main-header">
        <nav class="nav-container">
            <div class="nav-left">
                <a href="/" class="logo">
                    <i class="fas fa-mountain"></i>
                    <span>Chanchamayo Tours</span>
                </a>
            </div>
            <div class="nav-center">
                <ul class="nav-menu">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="/tours">Tours</a></li>
                    <li><a href="/bookings" class="active">Mis Reservas</a></li>
                    <li><a href="/contact">Contacto</a></li>
                </ul>
            </div>
            <div class="nav-right">
                @auth
                    <div class="user-menu">
                        <span>Hola, {{ Auth::user()->name }}</span>
                        <div class="dropdown">
                            <a href="{{ route('bookings.index') }}">Mis Reservas</a>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">Cerrar Sesión</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="auth-buttons">
                        <a href="{{ route('login') }}">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="btn-primary">Registrarse</a>
                    </div>
                @endauth
            </div>
        </nav>
    </header>
<div class="booking-detail-container">
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="booking-header">
        <div class="booking-number">Reserva #{{ $booking->booking_number }}</div>
        <p>Creada el {{ $booking->created_at->format('d/m/Y \a \l\a\s H:i') }}</p>
        
        <div class="booking-status">
            <span class="status-badge {{ $booking->getStatusBadgeClass() }}">
                {{ ucfirst($booking->status) }}
            </span>
            <span class="payment-badge {{ $booking->getPaymentStatusBadgeClass() }}">
                Pago: {{ ucfirst($booking->payment_status) }}
            </span>
        </div>
    </div>

    <div class="booking-content">
        <div class="booking-main">
            <!-- Tour Information -->
            <div class="section">
                <h3><i class="fas fa-mountain"></i> Información del Tour</h3>
                <div class="tour-info">
                    @if($booking->tour->main_image)
                        <img src="{{ Storage::url($booking->tour->main_image) }}" 
                             alt="{{ $booking->tour->title }}" 
                             class="tour-image">
                    @else
                        <div class="tour-image-placeholder" style="width: 100px; height: 100px;">
                            <i class="fas fa-mountain"></i>
                        </div>
                    @endif
                    
                    <div class="tour-details">
                        <h4>{{ $booking->tour->title }}</h4>
                        <div class="tour-meta">
                            <span><i class="fas fa-building"></i> {{ $booking->tour->company->name }}</span>
                        </div>
                        <div class="tour-meta">
                            <span><i class="fas fa-clock"></i> {{ $booking->tour->duration_days }} días</span>
                            <span><i class="fas fa-users"></i> {{ $booking->adult_participants + $booking->child_participants }} participantes</span>
                        </div>
                        <div class="tour-date">
                            <i class="fas fa-calendar"></i>
                            {{ $booking->tour_date->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Participants -->
            <div class="section">
                <h3><i class="fas fa-users"></i> Participantes</h3>
                <div class="participant-grid">
                    @if(is_array($booking->participant_details))
                        @foreach($booking->participant_details as $index => $participant)
                            <div class="participant-card">
                                <div class="participant-name">
                                    {{ $participant['name'] ?? 'Sin nombre' }}
                                    @if($index >= $booking->adult_participants)
                                        <span class="badge-info" style="font-size: 0.7rem; padding: 2px 6px; border-radius: 10px;">Niño</span>
                                    @endif
                                </div>
                                <div class="participant-details">
                                    <span><i class="fas fa-id-card"></i> {{ $participant['document'] ?? 'Sin documento' }}</span>
                                    <span><i class="fas fa-birthday-cake"></i> {{ $participant['age'] ?? 'Sin edad' }} años</span>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">No hay detalles de participantes disponibles.</p>
                    @endif
                </div>
            </div>

            <!-- Special Requests -->
            @if($booking->special_requests && count($booking->special_requests) > 0)
                <div class="section">
                    <h3><i class="fas fa-comment"></i> Solicitudes Especiales</h3>
                    <div class="special-requests">
                        @foreach($booking->special_requests as $request)
                            <p><i class="fas fa-info-circle"></i> {{ $request }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Booking Timeline -->
            <div class="section">
                <h3><i class="fas fa-history"></i> Historial</h3>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-date">{{ $booking->created_at->format('d/m/Y H:i') }}</div>
                        <div class="timeline-content">Reserva creada</div>
                    </div>
                    
                    @if($booking->confirmed_at)
                        <div class="timeline-item">
                            <div class="timeline-date">{{ $booking->confirmed_at->format('d/m/Y H:i') }}</div>
                            <div class="timeline-content">Reserva confirmada</div>
                        </div>
                    @endif
                    
                    @if($booking->cancelled_at)
                        <div class="timeline-item">
                            <div class="timeline-date">{{ $booking->cancelled_at->format('d/m/Y H:i') }}</div>
                            <div class="timeline-content">
                                Reserva cancelada
                                @if($booking->cancellation_reason)
                                    <br><small>Motivo: {{ $booking->cancellation_reason }}</small>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="booking-sidebar">
            <!-- Price Breakdown -->
            <div class="price-breakdown">
                <h3><i class="fas fa-calculator"></i> Resumen de Precios</h3>
                
                <div class="price-row">
                    <span>Adultos ({{ $booking->adult_participants }} x S/ {{ number_format($booking->adult_price, 0) }})</span>
                    <span>S/ {{ number_format($booking->adult_participants * $booking->adult_price, 0) }}</span>
                </div>
                
                @if($booking->child_participants > 0)
                    <div class="price-row">
                        <span>Niños ({{ $booking->child_participants }} x S/ {{ number_format($booking->child_price, 0) }})</span>
                        <span>S/ {{ number_format($booking->child_participants * $booking->child_price, 0) }}</span>
                    </div>
                @endif
                
                <div class="price-row">
                    <span>Subtotal</span>
                    <span>S/ {{ number_format($booking->subtotal, 0) }}</span>
                </div>
                
                <div class="price-row">
                    <span>Comisión (10%)</span>
                    <span>S/ {{ number_format($booking->commission, 0) }}</span>
                </div>
                
                <div class="price-row price-total">
                    <span>Total</span>
                    <span>S/ {{ number_format($booking->total_amount, 0) }}</span>
                </div>
            </div>

            <!-- Actions -->
            <div class="action-card">
                <h4><i class="fas fa-cogs"></i> Acciones</h4>
                
                @if($booking->status === 'pending')
                    <a href="{{ route('bookings.edit', $booking) }}" class="btn-action btn-edit">
                        <i class="fas fa-edit"></i> Editar Reserva
                    </a>
                    
                    <button onclick="showCancelModal()" class="btn-action btn-cancel">
                        <i class="fas fa-times"></i> Cancelar Reserva
                    </button>
                @endif

                @if(Auth::user()->role === 'company' && $booking->status === 'pending')
                    <form action="{{ route('bookings.confirm', $booking) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-action btn-confirm">
                            <i class="fas fa-check"></i> Confirmar Reserva
                        </button>
                    </form>
                @endif
                
                <a href="{{ route('bookings.index') }}" class="btn-action btn-back">
                    <i class="fas fa-arrow-left"></i> Mis Reservas
                </a>
            </div>

            <!-- Contact Info -->
            <div class="action-card">
                <h4><i class="fas fa-headset"></i> ¿Necesitas Ayuda?</h4>
                <p style="color: #6b7280; font-size: 0.9rem; margin-bottom: 1rem;">
                    Si tienes alguna pregunta sobre tu reserva, no dudes en contactarnos.
                </p>
                <div style="color: #374151; font-size: 0.9rem;">
                    <p><i class="fas fa-phone"></i> +51 999 888 777</p>
                    <p><i class="fas fa-envelope"></i> info@chanchamayotours.com</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Modal -->
<div id="cancelModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; border-radius: 12px; padding: 2rem; max-width: 500px; width: 90%;">
        <h3 style="margin-bottom: 1rem; color: #dc2626;">
            <i class="fas fa-exclamation-triangle"></i> Cancelar Reserva
        </h3>
        <p style="margin-bottom: 1.5rem; color: #6b7280;">
            ¿Estás seguro que deseas cancelar esta reserva? Esta acción no se puede deshacer.
        </p>
        
        <form action="{{ route('bookings.cancel', $booking) }}" method="POST">
            @csrf
            <div style="margin-bottom: 1rem;">
                <label for="cancellation_reason" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">
                    Motivo de cancelación *
                </label>
                <textarea id="cancellation_reason" 
                          name="cancellation_reason" 
                          required
                          style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; resize: vertical;"
                          rows="3"
                          placeholder="Explica brevemente el motivo de la cancelación..."></textarea>
            </div>
            
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <button type="button" onclick="hideCancelModal()" 
                        style="padding: 8px 16px; background: #6b7280; color: white; border: none; border-radius: 6px; cursor: pointer;">
                    Cancelar
                </button>
                <button type="submit" 
                        style="padding: 8px 16px; background: #dc2626; color: white; border: none; border-radius: 6px; cursor: pointer;">
                    Confirmar Cancelación
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showCancelModal() {
    document.getElementById('cancelModal').style.display = 'block';
}

function hideCancelModal() {
    document.getElementById('cancelModal').style.display = 'none';
}

// Cerrar modal al hacer clic fuera
document.getElementById('cancelModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideCancelModal();
    }
});
</script>

</body>
</html>