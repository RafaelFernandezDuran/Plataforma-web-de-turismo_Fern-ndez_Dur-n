<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva #{{ $booking->booking_number }} - Chanchamayo Tours</title>
    <link rel="stylesheet" href="{{ asset('css/chanchamayo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tours-index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="description" content="Edita los detalles de tu reserva #{{ $booking->booking_number }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .edit-booking-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        .edit-header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
        }

        .booking-number {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .tour-summary {
            display: flex;
            gap: 1rem;
            align-items: center;
            margin-top: 1rem;
        }

        .tour-image-small {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }

        .edit-form {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .form-section h3 {
            color: #2d3748;
            margin-bottom: 1rem;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }

        .participant-card {
            background: #fef3c7;
            border: 2px solid #f59e0b;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .participant-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .participant-number {
            background: #f59e0b;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .price-summary {
            background: #f0f9ff;
            border: 2px solid #0ea5e9;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .price-total {
            border-top: 2px solid #e5e7eb;
            padding-top: 1rem;
            font-weight: 700;
            font-size: 1.2rem;
            color: #1f2937;
        }

        .btn-update {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: transform 0.2s ease;
        }

        .btn-update:hover {
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #6b7280;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            display: inline-block;
            margin-right: 1rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .alert-warning {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            color: #92400e;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .tour-summary {
                flex-direction: column;
                text-align: center;
            }
            
            .edit-booking-container {
                padding: 1rem;
            }
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
<div class="edit-booking-container">
    <div class="edit-header">
        <div class="booking-number">Editar Reserva #{{ $booking->booking_number }}</div>
        <p>Puedes modificar los detalles de tu reserva mientras esté en estado pendiente</p>
        
        <div class="tour-summary">
            @if($booking->tour->main_image)
                <img src="{{ Storage::url($booking->tour->main_image) }}" 
                     alt="{{ $booking->tour->title }}" 
                     class="tour-image-small">
            @endif
            
            <div class="tour-info">
                <h4>{{ $booking->tour->title }}</h4>
                <span>{{ $booking->tour->company->name }}</span>
            </div>
        </div>
    </div>

    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i>
        <strong>Importante:</strong> Solo puedes editar reservas en estado pendiente. Los cambios en el número de participantes pueden afectar el precio total.
    </div>

    <form action="{{ route('bookings.update', $booking) }}" method="POST" class="edit-form" id="editBookingForm">
        @csrf
        @method('PUT')

        <!-- Fecha del Tour -->
        <div class="form-section">
            <h3><i class="fas fa-calendar"></i> Fecha del Tour</h3>
            <div class="form-group">
                <label for="tour_date">Selecciona la fecha *</label>
                <input type="date" 
                       id="tour_date" 
                       name="tour_date" 
                       class="form-control" 
                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                       value="{{ old('tour_date', $booking->tour_date->format('Y-m-d')) }}" 
                       required>
                @error('tour_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Participantes -->
        <div class="form-section">
            <h3><i class="fas fa-users"></i> Número de Participantes</h3>
            <div class="form-row">
                <div class="form-group">
                    <label for="adult_participants">Adultos *</label>
                    <input type="number" 
                           id="adult_participants" 
                           name="adult_participants" 
                           class="form-control" 
                           min="1" 
                           max="{{ $booking->tour->max_participants }}"
                           value="{{ old('adult_participants', $booking->adult_participants) }}" 
                           required>
                    @error('adult_participants')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="child_participants">Niños (opcional)</label>
                    <input type="number" 
                           id="child_participants" 
                           name="child_participants" 
                           class="form-control" 
                           min="0" 
                           max="10"
                           value="{{ old('child_participants', $booking->child_participants) }}">
                    @error('child_participants')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Detalles de Participantes -->
        <div class="form-section">
            <h3><i class="fas fa-id-card"></i> Detalles de los Participantes</h3>
            <div id="participants-container">
                <!-- Los participantes se cargarán aquí dinámicamente -->
            </div>
        </div>

        <!-- Solicitudes Especiales -->
        <div class="form-section">
            <h3><i class="fas fa-comment"></i> Solicitudes Especiales</h3>
            <div class="form-group">
                <label for="special_requests">¿Tienes alguna solicitud especial? (opcional)</label>
                <textarea id="special_requests" 
                          name="special_requests" 
                          class="form-control" 
                          rows="4" 
                          placeholder="Ejemplo: Vegetariano, alergias alimentarias, necesidades de accesibilidad, etc.">{{ old('special_requests', is_array($booking->special_requests) ? implode(', ', $booking->special_requests) : '') }}</textarea>
                @error('special_requests')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Resumen de Precios -->
        <div class="price-summary">
            <h3><i class="fas fa-calculator"></i> Nuevo Resumen de Precios</h3>
            <div class="price-row" id="adult-price-row">
                <span>Adultos (<span id="adult-count">{{ $booking->adult_participants }}</span> x S/ {{ number_format($booking->tour->price, 0) }})</span>
                <span id="adult-total">S/ {{ number_format($booking->adult_participants * $booking->tour->price, 0) }}</span>
            </div>
            <div class="price-row" id="child-price-row" style="{{ $booking->child_participants > 0 ? '' : 'display: none;' }}">
                <span>Niños (<span id="child-count">{{ $booking->child_participants }}</span> x S/ {{ number_format($booking->tour->child_price ?? $booking->tour->price * 0.7, 0) }})</span>
                <span id="child-total">S/ {{ number_format($booking->child_participants * ($booking->tour->child_price ?? $booking->tour->price * 0.7), 0) }}</span>
            </div>
            <div class="price-row">
                <span>Comisión de plataforma (10%)</span>
                <span id="commission">S/ {{ number_format(($booking->adult_participants * $booking->tour->price + $booking->child_participants * ($booking->tour->child_price ?? $booking->tour->price * 0.7)) * 0.1, 0) }}</span>
            </div>
            <div class="price-row price-total">
                <span>Nuevo Total</span>
                <span id="total-price">S/ {{ number_format($booking->total_amount, 0) }}</span>
            </div>
        </div>

        <!-- Botones -->
        <div class="form-actions">
            <a href="{{ route('bookings.show', $booking) }}" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
            <button type="submit" class="btn-update">
                <i class="fas fa-save"></i> Actualizar Reserva
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const adultInput = document.getElementById('adult_participants');
    const childInput = document.getElementById('child_participants');
    const participantsContainer = document.getElementById('participants-container');
    
    const adultPrice = {{ $booking->tour->price }};
    const childPrice = {{ $booking->tour->child_price ?? $booking->tour->price * 0.7 }};
    
    // Datos existentes de participantes
    const existingParticipants = @json($booking->participant_details ?? []);
    
    function updateParticipants() {
        const adults = parseInt(adultInput.value) || 1;
        const children = parseInt(childInput.value) || 0;
        const total = adults + children;
        
        // Limpiar contenedor
        participantsContainer.innerHTML = '';
        
        // Crear campos para cada participante
        for (let i = 0; i < total; i++) {
            const isChild = i >= adults;
            const existingData = existingParticipants[i] || {};
            
            const participantDiv = document.createElement('div');
            participantDiv.className = 'participant-card';
            participantDiv.innerHTML = `
                <div class="participant-header">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div class="participant-number">${i + 1}</div>
                        <h4>Participante ${i + 1} ${isChild ? '(Niño)' : '(Adulto)'}</h4>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Nombre Completo *</label>
                        <input type="text" 
                               name="participant_details[${i}][name]" 
                               class="form-control" 
                               value="${existingData.name || ''}"
                               required>
                    </div>
                    <div class="form-group">
                        <label>Documento de Identidad *</label>
                        <input type="text" 
                               name="participant_details[${i}][document]" 
                               class="form-control" 
                               value="${existingData.document || ''}"
                               required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Edad *</label>
                        <input type="number" 
                               name="participant_details[${i}][age]" 
                               class="form-control" 
                               min="1" 
                               max="100"
                               value="${existingData.age || (isChild ? '10' : '25')}"
                               required>
                    </div>
                    <div class="form-group">
                        <label>Tipo</label>
                        <input type="text" 
                               class="form-control" 
                               value="${isChild ? 'Niño' : 'Adulto'}" 
                               readonly>
                    </div>
                </div>
            `;
            participantsContainer.appendChild(participantDiv);
        }
        
        // Actualizar precios
        updatePricing();
    }
    
    function updatePricing() {
        const adults = parseInt(adultInput.value) || 1;
        const children = parseInt(childInput.value) || 0;
        
        const adultTotal = adults * adultPrice;
        const childTotal = children * childPrice;
        const subtotal = adultTotal + childTotal;
        const commission = subtotal * 0.1;
        const total = subtotal + commission;
        
        // Actualizar elementos del DOM
        document.getElementById('adult-count').textContent = adults;
        document.getElementById('adult-total').textContent = `S/ ${adultTotal.toLocaleString()}`;
        
        const childRow = document.getElementById('child-price-row');
        if (children > 0) {
            childRow.style.display = 'flex';
            document.getElementById('child-count').textContent = children;
            document.getElementById('child-total').textContent = `S/ ${childTotal.toLocaleString()}`;
        } else {
            childRow.style.display = 'none';
        }
        
        document.getElementById('commission').textContent = `S/ ${commission.toLocaleString()}`;
        document.getElementById('total-price').textContent = `S/ ${total.toLocaleString()}`;
    }
    
    // Event listeners
    adultInput.addEventListener('change', updateParticipants);
    childInput.addEventListener('change', updateParticipants);
    
    // Inicializar
    updateParticipants();
});
</script>

</body>
</html>