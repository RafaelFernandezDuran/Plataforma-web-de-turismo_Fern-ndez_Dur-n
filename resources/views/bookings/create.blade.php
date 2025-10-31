<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Tour - {{ $tour->title }} - Chanchamayo Tours</title>
    <link rel="stylesheet" href="{{ asset('css/chanchamayo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tours-index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="description" content="Reserva tu tour {{ $tour->title }} en Chanchamayo Tours">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .booking-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        .booking-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 2rem;
            border-radius: 16px;
            margin-bottom: 2rem;
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
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .participant-card {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .participant-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .participant-number {
            background: #667eea;
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

        .remove-participant {
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            cursor: pointer;
            font-size: 0.8rem;
        }

        .add-participant {
            background: #10b981;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
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

        .btn-book {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

        .btn-book:hover {
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

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .tour-summary {
                flex-direction: column;
                text-align: center;
            }
            
            .booking-container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body class="page-with-navbar booking-create-page">
    @include('partials.site-header')

    <div class="booking-container">
        <div class="booking-header">
        <div class="tour-summary">
            @php
                $tourImage = $tour->image_url;
            @endphp
            @if($tourImage)
                <img src="{{ $tourImage }}"
                     alt="{{ $tour->title }}"
                     class="tour-image-small">
            @else
                <div class="tour-image-placeholder" style="width: 80px; height: 80px;">
                    <i class="fas fa-mountain"></i>
                </div>
            @endif
            
            <div class="tour-info">
                <h1>{{ $tour->title }}</h1>
                <div class="tour-details">
                    <span><i class="fas fa-clock"></i> {{ $tour->duration_days }} días</span>
                    <span><i class="fas fa-users"></i> {{ $tour->min_participants }} - {{ $tour->max_participants }} personas</span>
                </div>
                <div class="tour-price">
                    Desde S/ {{ number_format($tour->price, 0) }} por persona
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('bookings.store') }}" method="POST" class="booking-form" id="bookingForm">
        @csrf
        <input type="hidden" name="tour_id" value="{{ $tour->id }}">

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
                       value="{{ old('tour_date') }}" 
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
                           max="{{ $tour->max_participants }}"
                           value="{{ old('adult_participants', 1) }}" 
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
                           value="{{ old('child_participants', 0) }}">
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
                <!-- Los participantes se agregarán aquí dinámicamente -->
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
                          placeholder="Ejemplo: Vegetariano, alergias alimentarias, necesidades de accesibilidad, etc.">{{ old('special_requests') }}</textarea>
                @error('special_requests')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Resumen de Precios -->
        <div class="price-summary">
            <h3><i class="fas fa-calculator"></i> Resumen de Precios</h3>
            <div class="price-row" id="adult-price-row">
                <span>Adultos (<span id="adult-count">1</span> x S/ {{ number_format($tour->price, 0) }})</span>
                <span id="adult-total">S/ {{ number_format($tour->price, 0) }}</span>
            </div>
            <div class="price-row" id="child-price-row" style="display: none;">
                <span>Niños (<span id="child-count">0</span> x S/ {{ number_format($tour->child_price ?? $tour->price * 0.7, 0) }})</span>
                <span id="child-total">S/ 0</span>
            </div>
            <div class="price-row">
                <span>Comisión de plataforma (10%)</span>
                <span id="commission">S/ {{ number_format($tour->price * 0.1, 0) }}</span>
            </div>
            <div class="price-row price-total">
                <span>Total a Pagar</span>
                <span id="total-price">S/ {{ number_format($tour->price * 1.1, 0) }}</span>
            </div>
        </div>

        <!-- Botones -->
        <div class="form-actions">
            <a href="{{ route('tours.show', $tour) }}" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver al Tour
            </a>
            <button type="submit" class="btn-book">
                <i class="fas fa-credit-card"></i> Confirmar Reserva
            </button>
        </div>
    </form>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const adultInput = document.getElementById('adult_participants');
    const childInput = document.getElementById('child_participants');
    const participantsContainer = document.getElementById('participants-container');
    
    const adultPrice = {{ $tour->price }};
    const childPrice = {{ $tour->child_price ?? $tour->price * 0.7 }};
    
    function updateParticipants() {
        const adults = parseInt(adultInput.value) || 1;
        const children = parseInt(childInput.value) || 0;
        const total = adults + children;
        
        // Limpiar contenedor
        participantsContainer.innerHTML = '';
        
        // Crear campos para cada participante
        for (let i = 0; i < total; i++) {
            const isChild = i >= adults;
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
                               required>
                    </div>
                    <div class="form-group">
                        <label>Documento de Identidad *</label>
                        <input type="text" 
                               name="participant_details[${i}][document]" 
                               class="form-control" 
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
                               value="${isChild ? '10' : '25'}"
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