<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas - Chanchamayo Tours</title>
    <link rel="stylesheet" href="{{ asset('css/chanchamayo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tours-index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="description" content="Gestiona todas tus reservas de tours en Chanchamayo Tours">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .bookings-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .bookings-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-label {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .filters {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .filter-control {
            padding: 10px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
        }

        .filter-control:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn-filter {
            background: #667eea;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
        }

        .bookings-grid {
            display: grid;
            gap: 1.5rem;
        }

        .booking-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .booking-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
        }

        .booking-content {
            display: grid;
            grid-template-columns: 120px 1fr auto;
            gap: 1.5rem;
            padding: 1.5rem;
            align-items: center;
        }

        .booking-image {
            width: 120px;
            height: 120px;
            border-radius: 12px;
            object-fit: cover;
        }

        .booking-image-placeholder {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #9ca3af;
        }

        .booking-details h3 {
            margin: 0 0 0.5rem 0;
            color: #1f2937;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .booking-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
            color: #6b7280;
            font-size: 0.9rem;
        }

        .booking-meta span {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .booking-number {
            font-family: 'Courier New', monospace;
            background: #f3f4f6;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            color: #374151;
        }

        .booking-date {
            background: #f0f9ff;
            color: #0369a1;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .booking-actions {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            min-width: 150px;
        }

        .status-badges {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .status-badge, .payment-badge {
            padding: 6px 12px;
            border-radius: 16px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .badge-pending { background: #fbbf24; color: #92400e; }
        .badge-confirmed { background: #10b981; color: white; }
        .badge-cancelled { background: #ef4444; color: white; }
        .badge-completed { background: #3b82f6; color: white; }
        .badge-warning { background: #f59e0b; color: white; }
        .badge-success { background: #059669; color: white; }
        .badge-danger { background: #dc2626; color: white; }
        .badge-info { background: #0ea5e9; color: white; }

        .btn-action {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-view {
            background: #667eea;
            color: white;
        }

        .btn-view:hover {
            background: #5a67d8;
        }

        .btn-edit {
            background: #10b981;
            color: white;
        }

        .btn-edit:hover {
            background: #059669;
        }

        .btn-cancel {
            background: #ef4444;
            color: white;
        }

        .btn-cancel:hover {
            background: #dc2626;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #d1d5db;
        }

        .empty-state h3 {
            margin-bottom: 1rem;
            color: #374151;
        }

        .btn-browse {
            background: #667eea;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            margin-top: 1rem;
        }

        .pagination-wrapper {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .booking-content {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .booking-actions {
                min-width: auto;
            }
            
            .bookings-stats {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .filter-row {
                grid-template-columns: 1fr;
            }
            
            .bookings-container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body class="page-with-navbar">
    @include('partials.site-header')

    <div class="bookings-container">
    <div class="bookings-header">
        <h1><i class="fas fa-calendar-check"></i> Mis Reservas</h1>
        <p>Gestiona todas tus reservas de tours en un solo lugar</p>
    </div>

    <!-- Statistics -->
    <div class="bookings-stats">
        <div class="stat-card">
            <div class="stat-icon" style="color: #fbbf24;">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-number">{{ $bookings->where('status', 'pending')->count() }}</div>
            <div class="stat-label">Pendientes</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="color: #10b981;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number">{{ $bookings->where('status', 'confirmed')->count() }}</div>
            <div class="stat-label">Confirmadas</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="color: #3b82f6;">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-number">{{ $bookings->where('status', 'completed')->count() }}</div>
            <div class="stat-label">Completadas</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="color: #ef4444;">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-number">{{ $bookings->where('status', 'cancelled')->count() }}</div>
            <div class="stat-label">Canceladas</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters">
        <form method="GET" action="{{ route('bookings.index') }}">
            <div class="filter-row">
                <div class="filter-group">
                    <label for="status">Estado</label>
                    <select id="status" name="status" class="filter-control">
                        <option value="">Todos los estados</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmada</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completada</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="payment_status">Estado de Pago</label>
                    <select id="payment_status" name="payment_status" class="filter-control">
                        <option value="">Todos los pagos</option>
                        <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Pagado</option>
                        <option value="refunded" {{ request('payment_status') === 'refunded' ? 'selected' : '' }}>Reembolsado</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label for="date_from">Desde</label>
                    <input type="date" id="date_from" name="date_from" class="filter-control" value="{{ request('date_from') }}">
                </div>
                
                <div class="filter-group">
                    <label for="date_to">Hasta</label>
                    <input type="date" id="date_to" name="date_to" class="filter-control" value="{{ request('date_to') }}">
                </div>
                
                <div class="filter-group">
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-search"></i> Filtrar
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bookings List -->
    @if($bookings->count() > 0)
        <div class="bookings-grid">
            @foreach($bookings as $booking)
                <div class="booking-card">
                    <div class="booking-content">
                        <div class="booking-image-container">
                            @php
                                $tourImage = $booking->tour->image_url;
                            @endphp
                            @if($tourImage)
                                <img src="{{ $tourImage }}"
                                     alt="{{ $booking->tour->title }}"
                                     class="booking-image">
                            @else
                                <div class="booking-image-placeholder">
                                    <i class="fas fa-mountain"></i>
                                </div>
                            @endif
                        </div>

                        <div class="booking-details">
                            <h3>{{ $booking->tour->title }}</h3>
                            
                            <div class="booking-meta">
                                <span><i class="fas fa-hashtag"></i> <span class="booking-number">{{ $booking->booking_number }}</span></span>
                                <span><i class="fas fa-building"></i> {{ $booking->tour->company->name }}</span>
                                <span><i class="fas fa-users"></i> {{ $booking->adult_participants + $booking->child_participants }} personas</span>
                                <span><i class="fas fa-wallet"></i> S/ {{ number_format($booking->total_amount, 0) }}</span>
                            </div>

                            <div class="booking-date">
                                <i class="fas fa-calendar"></i>
                                {{ $booking->tour_date->format('d/m/Y') }}
                            </div>
                        </div>

                        <div class="booking-actions">
                            <div class="status-badges">
                                <span class="status-badge {{ $booking->getStatusBadgeClass() }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                <span class="payment-badge {{ $booking->getPaymentStatusBadgeClass() }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                            </div>

                            <a href="{{ route('bookings.show', $booking) }}" class="btn-action btn-view">
                                <i class="fas fa-eye"></i> Ver Detalles
                            </a>

                            @if($booking->status === 'pending')
                                <a href="{{ route('bookings.edit', $booking) }}" class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $bookings->links() }}
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-calendar-times"></i>
            <h3>No tienes reservas aún</h3>
            <p>¿Listo para tu próxima aventura? Explora nuestros increíbles tours y reserva ahora.</p>
            <a href="{{ route('tours.index') }}" class="btn-browse">
                <i class="fas fa-search"></i> Explorar Tours
            </a>
        </div>
    @endif
    </div>

</body>
</html>