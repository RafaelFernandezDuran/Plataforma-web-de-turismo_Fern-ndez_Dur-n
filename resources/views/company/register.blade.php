<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Empresa Turística - Chanchamayo Tours</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/chanchamayo.css') }}">
    
    <style>
        .registration-wrapper {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--verde-selva) 0%, var(--verde-claro) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .registration-container {
            background: var(--blanco);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-lg);
            max-width: 800px;
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .registration-header {
            background: linear-gradient(135deg, var(--verde-selva), var(--verde-claro));
            color: var(--blanco);
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .registration-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
            opacity: 0.3;
        }

        .registration-body {
            padding: 2rem;
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .step {
            display: flex;
            align-items: center;
            position: relative;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gris-claro);
            color: var(--gris-medio);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .step.active .step-number {
            background: var(--verde-selva);
            color: var(--blanco);
            transform: scale(1.1);
        }

        .step.completed .step-number {
            background: var(--verde-claro);
            color: var(--blanco);
        }

        .step.completed .step-number::after {
            content: '✓';
            position: absolute;
            font-size: 0.8rem;
        }

        .step-connector {
            width: 60px;
            height: 2px;
            background: var(--gris-claro);
            transition: all 0.3s ease;
        }

        .step.completed + .step .step-connector,
        .step.active .step-connector {
            background: var(--verde-claro);
        }

        .step-content {
            display: none;
            animation: fadeInUp 0.5s ease-out;
        }

        .step-content.active {
            display: block;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            position: relative;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--gris-oscuro);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-label.required::after {
            content: ' *';
            color: #ef4444;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--blanco);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--verde-selva);
            background: #f8fffe;
        }

        .form-input.error {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .form-input.success {
            border-color: var(--verde-claro);
            background: #f0fdf4;
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-upload-input {
            position: absolute;
            left: -9999px;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            background: #f9fafb;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .file-upload-label:hover {
            border-color: var(--verde-selva);
            background: #f0fdf4;
        }

        .file-upload-label.has-file {
            border-color: var(--verde-claro);
            background: #f0fdf4;
            border-style: solid;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .checkbox-item:hover {
            border-color: var(--verde-selva);
            background: #f0fdf4;
        }

        .checkbox-item.checked {
            border-color: var(--verde-selva);
            background: var(--verde-selva);
            color: var(--blanco);
        }

        .checkbox-item input {
            width: 18px;
            height: 18px;
            display: inline-block;
            accent-color: var(--verde-selva);
        }

        .checkbox-item input:checked + span {
            color: var(--verde-selva);
            font-weight: 600;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .success-message {
            color: var(--verde-claro);
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #e2e8f0;
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--verde-selva), var(--verde-claro));
            color: var(--blanco);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(5, 150, 105, 0.3);
        }

        .btn-secondary {
            background: var(--gris-claro);
            color: var(--gris-oscuro);
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top: 2px solid var(--blanco);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .progress-bar {
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, var(--verde-selva), var(--verde-claro));
            border-radius: 3px;
            transition: width 0.5s ease;
        }

        .availability-check {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .availability-check.checking {
            color: var(--gris-medio);
        }

        .availability-check.available {
            color: var(--verde-claro);
        }

        .availability-check.unavailable {
            color: #ef4444;
        }

        @media (max-width: 768px) {
            .registration-wrapper {
                padding: 1rem;
            }

            .registration-container {
                margin: 0;
            }

            .registration-header,
            .registration-body {
                padding: 1.5rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .step-connector {
                width: 30px;
            }

            .form-actions {
                flex-direction: column;
                gap: 1rem;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        .gallery-preview {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .gallery-item {
            position: relative;
            aspect-ratio: 1;
            border-radius: 8px;
            overflow: hidden;
            background: #f3f4f6;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-item .remove-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            width: 24px;
            height: 24px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <div class="registration-wrapper">
        <div class="registration-container">
            <!-- Header -->
            <div class="registration-header">
                <div style="position: relative; z-index: 2;">
                    <h1 style="font-size: 2rem; font-weight: 800; margin-bottom: 0.5rem;">
                        Registro de Empresa Turística
                    </h1>
                    <p style="opacity: 0.9; font-size: 1.1rem;">
                        Únete a la red de turismo más importante de Chanchamayo
                    </p>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="progress-fill" id="progressBar" style="width: 33.33%;"></div>
            </div>

            <!-- Step Indicator -->
            <div class="step-indicator">
                <div class="step active" data-step="1">
                    <div class="step-number">1</div>
                </div>
                <div class="step-connector"></div>
                <div class="step" data-step="2">
                    <div class="step-number">2</div>
                </div>
                <div class="step-connector"></div>
                <div class="step" data-step="3">
                    <div class="step-number">3</div>
                </div>
            </div>

            <!-- Registration Form -->
            <form id="registrationForm" class="registration-body">
                @csrf
                
                <!-- Step 1: Información Básica -->
                <div class="step-content active" data-step="1">
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--verde-selva); margin-bottom: 1.5rem;">
                        Información Básica de la Empresa
                    </h3>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label required">Nombre Comercial</label>
                            <input type="text" name="name" class="form-input" placeholder="Ej: Aventuras Chanchamayo" required>
                            <div class="availability-check" id="nameCheck"></div>
                            <div class="error-message" id="nameError"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label required">RUC</label>
                            <input type="text" name="ruc" class="form-input" placeholder="12345678901" maxlength="11" required>
                            <div class="availability-check" id="rucCheck"></div>
                            <div class="error-message" id="rucError"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Email Corporativo</label>
                            <input type="email" name="email" class="form-input" placeholder="contacto@empresa.com" required>
                            <div class="availability-check" id="emailCheck"></div>
                            <div class="error-message" id="emailError"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Teléfono Principal</label>
                            <input type="tel" name="phone" class="form-input" placeholder="+51 987 654 321" required>
                            <div class="error-message" id="phoneError"></div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Ubicación y contacto básico -->
                <div class="step-content" data-step="2">
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--verde-selva); margin-bottom: 1.5rem;">
                        Ubicación y persona de contacto
                    </h3>
                    
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label class="form-label required">Dirección Completa</label>
                            <input type="text" name="address" class="form-input" placeholder="Av. Principal 123, La Merced" required>
                            <div class="error-message" id="addressError"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Ciudad</label>
                            <input type="text" name="city" class="form-input" placeholder="La Merced" required>
                            <div class="error-message" id="cityError"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Región</label>
                            <select name="region" class="form-input form-select" required>
                                <option value="">Seleccionar región</option>
                                <option value="Junín">Junín</option>
                                <option value="Lima">Lima</option>
                                <option value="Cusco">Cusco</option>
                                <option value="Arequipa">Arequipa</option>
                                <option value="Loreto">Loreto</option>
                                <option value="San Martín">San Martín</option>
                                <option value="Ucayali">Ucayali</option>
                            </select>
                            <div class="error-message" id="regionError"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Persona de Contacto</label>
                            <input type="text" name="contact_person" class="form-input" placeholder="Nombre y apellidos" required>
                            <div class="error-message" id="contact_personError"></div>
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label required">Descripción breve de la empresa</label>
                            <textarea name="description" class="form-input form-textarea" placeholder="Cuéntanos en pocas líneas qué ofrece tu empresa" required minlength="40"></textarea>
                            <div class="error-message" id="descriptionError"></div>
                            <div style="font-size: 0.85rem; color: var(--gris-medio); margin-top: 0.5rem;">
                                Mínimo 40 caracteres. Podrás ampliar esta información más adelante.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Step 3: Crear cuenta -->
                <div class="step-content" data-step="3">
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--verde-selva); margin-bottom: 1.5rem;">
                        Crear Cuenta de Usuario
                    </h3>
                    
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label required">Email para Login</label>
                            <input type="email" name="user_email" class="form-input" placeholder="usuario@empresa.com" required>
                            <div class="error-message" id="user_emailError"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label required">Contraseña</label>
                            <input type="password" name="user_password" class="form-input" placeholder="Mínimo 8 caracteres" required minlength="8">
                            <div class="error-message" id="user_passwordError"></div>
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label required">Confirmar Contraseña</label>
                            <input type="password" name="user_password_confirmation" class="form-input" placeholder="Repetir contraseña" required>
                            <div class="error-message" id="user_password_confirmationError"></div>
                        </div>

                        <div class="form-group full-width" style="margin-top: 2rem;">
                            <label class="checkbox-item">
                                <input type="checkbox" name="terms_accepted" required>
                                <span>Acepto los <a href="/terms" target="_blank" style="color: var(--verde-selva);">Términos y Condiciones</a></span>
                            </label>
                            <div class="error-message" id="terms_acceptedError"></div>
                        </div>

                        <div class="form-group full-width">
                            <label class="checkbox-item">
                                <input type="checkbox" name="privacy_accepted" required>
                                <span>Acepto la <a href="/privacy" target="_blank" style="color: var(--verde-selva);">Política de Privacidad</a></span>
                            </label>
                            <div class="error-message" id="privacy_acceptedError"></div>
                        </div>
                    </div>

                    <div style="background: #f0fdf4; border: 1px solid var(--verde-claro); border-radius: 12px; padding: 1.5rem; margin-top: 2rem;">
                        <h4 style="color: var(--verde-selva); margin-bottom: 1rem;">
                            <i class="fas fa-info-circle"></i> Proceso de Revisión
                        </h4>
                        <ul style="color: var(--gris-oscuro); line-height: 1.6;">
                            <li>Tu registro será revisado por nuestro equipo en un plazo máximo de 48 horas</li>
                            <li>Recibirás notificaciones por email sobre el estado de tu solicitud</li>
                            <li>Una vez aprobado, podrás acceder al panel de administración</li>
                            <li>Podrás comenzar a publicar tours y gestionar reservas</li>
                        </ul>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" id="prevBtn" onclick="changeStep(-1)" style="display: none;">
                        <i class="fas fa-arrow-left"></i>
                        Anterior
                    </button>
                    
                    <div style="font-size: 0.9rem; color: var(--gris-medio);" id="stepInfo">
                        Paso 1 de 3
                    </div>
                    
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">
                        Siguiente
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Variables globales
    let currentStep = 1;
    const totalSteps = 3;
        let stepData = {};

        // Configurar CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupAvailabilityChecks();
        });

        // Configurar verificación de disponibilidad
        function setupAvailabilityChecks() {
            const fields = ['name', 'ruc', 'email'];
            
            fields.forEach(field => {
                const input = document.querySelector(`input[name="${field}"]`);
                const check = document.getElementById(`${field}Check`);
                
                if (input && check) {
                    let timeout;
                    
                    input.addEventListener('input', function() {
                        clearTimeout(timeout);
                        const value = this.value.trim();
                        
                        if (value.length > 2) {
                            check.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                            check.className = 'availability-check checking';
                            
                            timeout = setTimeout(() => {
                                checkAvailability(field, value);
                            }, 500);
                        } else {
                            check.innerHTML = '';
                            check.className = 'availability-check';
                        }
                    });
                }
            });
        }

        // Verificar disponibilidad
        async function checkAvailability(field, value) {
            try {
                const response = await fetch('/company/register/check-availability', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ field, value })
                });
                
                const result = await response.json();
                const check = document.getElementById(`${field}Check`);
                
                if (result.available) {
                    check.innerHTML = '<i class="fas fa-check"></i>';
                    check.className = 'availability-check available';
                } else {
                    check.innerHTML = '<i class="fas fa-times"></i>';
                    check.className = 'availability-check unavailable';
                }
            } catch (error) {
                console.error('Error checking availability:', error);
            }
        }

        // Cambiar paso
        async function changeStep(direction) {
            const newStep = currentStep + direction;
            
            if (direction > 0) {
                // Validar paso actual antes de continuar
                const isValid = await validateCurrentStep();
                if (!isValid) return;
            }
            
            if (newStep >= 1 && newStep <= totalSteps) {
                // Ocultar paso actual
                document.querySelector(`.step-content[data-step="${currentStep}"]`).classList.remove('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('active');
                
                // Marcar como completado si vamos hacia adelante
                if (direction > 0) {
                    document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('completed');
                }
                
                // Mostrar nuevo paso
                currentStep = newStep;
                document.querySelector(`.step-content[data-step="${currentStep}"]`).classList.add('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('active');
                
                // Actualizar UI
                updateStepUI();
                updateProgressBar();
            }
        }

        // Actualizar UI del paso
        function updateStepUI() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const stepInfo = document.getElementById('stepInfo');
            
            // Botón anterior
            prevBtn.style.display = currentStep === 1 ? 'none' : 'inline-flex';
            
            // Botón siguiente/finalizar
            if (currentStep === totalSteps) {
                nextBtn.innerHTML = '<i class="fas fa-check"></i> Finalizar Registro';
                nextBtn.onclick = submitRegistration;
            } else {
                nextBtn.innerHTML = 'Siguiente <i class="fas fa-arrow-right"></i>';
                nextBtn.onclick = () => changeStep(1);
            }
            
            // Info del paso
            stepInfo.textContent = `Paso ${currentStep} de ${totalSteps}`;
        }

        // Actualizar barra de progreso
        function updateProgressBar() {
            const progress = (currentStep / totalSteps) * 100;
            document.getElementById('progressBar').style.width = `${progress}%`;
        }

        // Validar paso actual
        async function validateCurrentStep() {
            if (currentStep === totalSteps) {
                return true;
            }

            const formData = new FormData(document.getElementById('registrationForm'));
            formData.append('step', currentStep);
            
            // Limpiar errores previos
            clearErrors();
            
            try {
                const response = await fetch('/company/register', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    return true;
                } else {
                    showErrors(result.errors);
                    return false;
                }
            } catch (error) {
                console.error('Validation error:', error);
                showNotification('Error de conexión', 'error');
                return false;
            }
        }

        // Mostrar errores
        function showErrors(errors) {
            Object.keys(errors).forEach(field => {
                const errorDiv = document.getElementById(`${field}Error`);
                const input = document.querySelector(`[name="${field}"]`);
                
                if (errorDiv) {
                    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${errors[field][0]}`;
                }
                
                if (input) {
                    input.classList.add('error');
                }
            });
        }

        // Limpiar errores
        function clearErrors() {
            document.querySelectorAll('.error-message').forEach(div => {
                div.innerHTML = '';
            });
            
            document.querySelectorAll('.form-input.error').forEach(input => {
                input.classList.remove('error');
            });
        }

        // Finalizar registro
        async function submitRegistration() {
            const isValid = await validateCurrentStep();
            if (!isValid) return;
            
            const nextBtn = document.getElementById('nextBtn');
            const originalContent = nextBtn.innerHTML;
            
            // Mostrar loading
            nextBtn.disabled = true;
            nextBtn.innerHTML = '<div class="loading-spinner"></div> Procesando...';
            
            try {
                const formData = new FormData(document.getElementById('registrationForm'));
                formData.append('step', totalSteps);
                
                const response = await fetch('/company/register', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showNotification(result.message, 'success');
                    setTimeout(() => {
                        window.location.href = result.redirect;
                    }, 2000);
                } else {
                    showErrors(result.errors);
                    showNotification(result.message || 'Error en el registro', 'error');
                }
            } catch (error) {
                console.error('Registration error:', error);
                showNotification('Error de conexión', 'error');
            } finally {
                nextBtn.disabled = false;
                nextBtn.innerHTML = originalContent;
            }
        }

        // Mostrar notificación
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 1rem 2rem;
                border-radius: 8px;
                color: white;
                font-weight: 600;
                z-index: 10000;
                transform: translateX(400px);
                transition: transform 0.3s ease;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            `;
            
            const colors = {
                success: 'linear-gradient(135deg, var(--verde-selva), var(--verde-claro))',
                error: 'linear-gradient(135deg, #ef4444, #dc2626)',
                info: 'linear-gradient(135deg, var(--azul-cielo), #0284c7)'
            };
            
            notification.style.background = colors[type] || colors.info;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(400px)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 5000);
        }
    </script>
</body>
</html>