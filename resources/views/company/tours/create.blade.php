<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tour - {{ Auth::user()->company->name }} - Chanchamayo Tours</title>
    <link rel="stylesheet" href="{{ asset('css/chanchamayo.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="dashboard-layout">
    <!-- Header -->
    <header class="dashboard-header">
        <div class="container">
            <div class="header-left">
                <a href="/" class="logo">
                    <i class="fas fa-mountain"></i>
                    Chanchamayo Tours
                </a>
                <div class="company-info">
                    <span class="company-name">{{ Auth::user()->company->name }}</span>
                    <span class="company-status status-{{ Auth::user()->company->status }}">
                        {{ ucfirst(Auth::user()->company->status) }}
                    </span>
                </div>
            </div>
            
            <div class="header-right">
                <nav class="dashboard-nav">
                    <a href="{{ route('tours.index') }}" class="nav-link">
                        <i class="fas fa-eye"></i>
                        Ver sitio público
                    </a>
                    <div class="dropdown">
                        <button class="dropdown-toggle">
                            <i class="fas fa-user-circle"></i>
                            {{ Auth::user()->name }}
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('profile.edit') }}">
                                <i class="fas fa-user"></i>
                                Mi Perfil
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <div class="sidebar-content">
                <nav class="sidebar-nav">
                    <ul>
                        <li>
                            <a href="{{ route('company.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('company.tours.index') }}">
                                <i class="fas fa-route"></i>
                                Mis Tours
                            </a>
                        </li>
                        <li class="active">
                            <a href="{{ route('company.tours.create') }}">
                                <i class="fas fa-plus"></i>
                                Crear Tour
                            </a>
                        </li>
                        <li>
                            <a href="#bookings">
                                <i class="fas fa-calendar-check"></i>
                                Reservas
                            </a>
                        </li>
                        <li>
                            <a href="#reviews">
                                <i class="fas fa-star"></i>
                                Reseñas
                            </a>
                        </li>
                        <li>
                            <a href="#analytics">
                                <i class="fas fa-chart-bar"></i>
                                Análisis
                            </a>
                        </li>
                        <li>
                            <a href="#settings">
                                <i class="fas fa-cog"></i>
                                Configuración
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="dashboard-main">
            <div class="dashboard-content">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="page-title">
                        <h1>Crear Nuevo Tour</h1>
                        <p>Completa la información de tu nuevo tour</p>
                    </div>
                    <div class="page-actions">
                        <a href="{{ route('company.tours.index') }}" class="btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            Volver a Mis Tours
                        </a>
                    </div>
                </div>

                <!-- Tour Form -->
                <form action="{{ route('company.tours.store') }}" method="POST" enctype="multipart/form-data" class="tour-form">
                    @csrf
                    
                    <div class="form-sections">
                        <!-- Basic Information -->
                        <div class="form-section">
                            <h2>
                                <i class="fas fa-info-circle"></i>
                                Información Básica
                            </h2>
                            
                            <div class="form-grid">
                                <div class="form-group col-2">
                                    <label for="title">
                                        Título del Tour *
                                        <span class="help-text">Nombre atractivo que describa tu tour</span>
                                    </label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" required 
                                           placeholder="Ej: Catarata El Tirol y Aguas Termales">
                                    @error('title')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tour_category_id">
                                        Categoría *
                                        <span class="help-text">Selecciona la categoría más apropiada</span>
                                    </label>
                                    <select name="tour_category_id" id="tour_category_id" required>
                                        <option value="">Seleccionar categoría</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('tour_category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tour_category_id')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-2">
                                    <label for="description">
                                        Descripción *
                                        <span class="help-text">Describe detalladamente tu tour</span>
                                    </label>
                                    <textarea name="description" id="description" rows="5" required 
                                              placeholder="Describe qué incluye el tour, qué verán los visitantes, y qué hace especial esta experiencia...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Pricing & Duration -->
                        <div class="form-section">
                            <h2>
                                <i class="fas fa-money-bill-wave"></i>
                                Precios y Duración
                            </h2>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="price">
                                        Precio por Adulto (S/) *
                                        <span class="help-text">Precio base por persona adulta</span>
                                    </label>
                                    <input type="number" name="price" id="price" step="0.01" min="0" 
                                           value="{{ old('price') }}" required placeholder="150.00">
                                    @error('price')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="child_price">
                                        Precio para Niños (S/)
                                        <span class="help-text">Precio especial para menores (opcional)</span>
                                    </label>
                                    <input type="number" name="child_price" id="child_price" step="0.01" min="0" 
                                           value="{{ old('child_price') }}" placeholder="80.00">
                                    @error('child_price')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="duration_days">
                                        Duración en Días *
                                        <span class="help-text">Número de días del tour</span>
                                    </label>
                                    <input type="number" name="duration_days" id="duration_days" min="1" 
                                           value="{{ old('duration_days', 1) }}" required>
                                    @error('duration_days')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="duration_hours">
                                        Horas por Día *
                                        <span class="help-text">Horas de actividad por día</span>
                                    </label>
                                    <input type="number" name="duration_hours" id="duration_hours" min="1" max="24" 
                                           value="{{ old('duration_hours', 8) }}" required>
                                    @error('duration_hours')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Group & Difficulty -->
                        <div class="form-section">
                            <h2>
                                <i class="fas fa-users"></i>
                                Grupo y Dificultad
                            </h2>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="min_participants">
                                        Mínimo de Participantes *
                                        <span class="help-text">Número mínimo para realizar el tour</span>
                                    </label>
                                    <input type="number" name="min_participants" id="min_participants" min="1" 
                                           value="{{ old('min_participants', 1) }}" required>
                                    @error('min_participants')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="max_participants">
                                        Máximo de Participantes *
                                        <span class="help-text">Capacidad máxima del tour</span>
                                    </label>
                                    <input type="number" name="max_participants" id="max_participants" min="1" 
                                           value="{{ old('max_participants', 10) }}" required>
                                    @error('max_participants')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-2">
                                    <label for="difficulty_level">
                                        Nivel de Dificultad *
                                        <span class="help-text">Nivel físico requerido para el tour</span>
                                    </label>
                                    <select name="difficulty_level" id="difficulty_level" required>
                                        <option value="">Seleccionar dificultad</option>
                                        <option value="easy" {{ old('difficulty_level') === 'easy' ? 'selected' : '' }}>
                                            Fácil - Apto para todos
                                        </option>
                                        <option value="moderate" {{ old('difficulty_level') === 'moderate' ? 'selected' : '' }}>
                                            Moderado - Requiere condición física básica
                                        </option>
                                        <option value="hard" {{ old('difficulty_level') === 'hard' ? 'selected' : '' }}>
                                            Difícil - Requiere buena condición física
                                        </option>
                                        <option value="expert" {{ old('difficulty_level') === 'expert' ? 'selected' : '' }}>
                                            Experto - Solo para personas muy entrenadas
                                        </option>
                                    </select>
                                    @error('difficulty_level')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Services -->
                        <div class="form-section">
                            <h2>
                                <i class="fas fa-list-check"></i>
                                Servicios Incluidos y Excluidos
                            </h2>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="included_services">
                                        Servicios Incluidos *
                                        <span class="help-text">Servicios que están incluidos en el precio</span>
                                    </label>
                                    <div class="dynamic-list" id="included-services-list">
                                        <div class="list-item">
                                            <input type="text" name="included_services[]" placeholder="Ej: Transporte ida y vuelta" required>
                                            <button type="button" class="btn-remove-item" onclick="removeListItem(this)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-add-item" onclick="addIncludedService()">
                                        <i class="fas fa-plus"></i> Agregar Servicio Incluido
                                    </button>
                                    @error('included_services')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="excluded_services">
                                        Servicios No Incluidos
                                        <span class="help-text">Servicios que NO están incluidos en el precio</span>
                                    </label>
                                    <div class="dynamic-list" id="excluded-services-list">
                                        <div class="list-item">
                                            <input type="text" name="excluded_services[]" placeholder="Ej: Bebidas alcohólicas">
                                            <button type="button" class="btn-remove-item" onclick="removeListItem(this)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-add-item" onclick="addExcludedService()">
                                        <i class="fas fa-plus"></i> Agregar Servicio No Incluido
                                    </button>
                                    @error('excluded_services')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Itinerary -->
                        <div class="form-section">
                            <h2>
                                <i class="fas fa-route"></i>
                                Itinerario
                            </h2>
                            
                            <div class="form-group">
                                <label for="itinerary">
                                    Itinerario del Tour *
                                    <span class="help-text">Describe el itinerario completo del tour</span>
                                </label>
                                <div class="dynamic-list" id="itinerary-list">
                                    <div class="itinerary-item">
                                        <div class="itinerary-grid">
                                            <input type="text" name="itinerary[0][title]" placeholder="Título de la actividad" required>
                                            <input type="time" name="itinerary[0][time]" placeholder="Hora">
                                            <textarea name="itinerary[0][description]" placeholder="Descripción de la actividad" rows="2" required></textarea>
                                            <button type="button" class="btn-remove-item" onclick="removeItineraryItem(this)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn-add-item" onclick="addItineraryItem()">
                                    <i class="fas fa-plus"></i> Agregar Actividad al Itinerario
                                </button>
                                @error('itinerary')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Images -->
                        <div class="form-section">
                            <h2>
                                <i class="fas fa-images"></i>
                                Imágenes
                            </h2>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="main_image">
                                        Imagen Principal *
                                        <span class="help-text">Imagen que representará tu tour (máx. 2MB)</span>
                                    </label>
                                    <input type="file" name="main_image" id="main_image" accept="image/*" required>
                                    <div class="image-preview" id="main-image-preview"></div>
                                    @error('main_image')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gallery">
                                        Galería de Imágenes
                                        <span class="help-text">Imágenes adicionales del tour (máx. 2MB c/u)</span>
                                    </label>
                                    <input type="file" name="gallery[]" id="gallery" accept="image/*" multiple>
                                    <div class="gallery-preview" id="gallery-preview"></div>
                                    @error('gallery.*')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="form-section">
                            <h2>
                                <i class="fas fa-info"></i>
                                Información Adicional
                            </h2>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="meeting_points">
                                        Puntos de Encuentro
                                        <span class="help-text">Lugares donde se pueden encontrar con los clientes</span>
                                    </label>
                                    <div class="dynamic-list" id="meeting-points-list">
                                        <div class="list-item">
                                            <input type="text" name="meeting_points[]" placeholder="Ej: Plaza de Armas La Merced">
                                            <button type="button" class="btn-remove-item" onclick="removeListItem(this)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-add-item" onclick="addMeetingPoint()">
                                        <i class="fas fa-plus"></i> Agregar Punto de Encuentro
                                    </button>
                                </div>

                                <div class="form-group">
                                    <label for="tags">
                                        Etiquetas
                                        <span class="help-text">Palabras clave para facilitar la búsqueda</span>
                                    </label>
                                    <div class="dynamic-list" id="tags-list">
                                        <div class="list-item">
                                            <input type="text" name="tags[]" placeholder="Ej: aventura, naturaleza, catarata">
                                            <button type="button" class="btn-remove-item" onclick="removeListItem(this)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-add-item" onclick="addTag()">
                                        <i class="fas fa-plus"></i> Agregar Etiqueta
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" name="status" value="draft" class="btn-secondary">
                            <i class="fas fa-save"></i>
                            Guardar como Borrador
                        </button>
                        <button type="submit" name="status" value="active" class="btn-primary">
                            <i class="fas fa-rocket"></i>
                            Crear y Publicar Tour
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        let itineraryIndex = 1;

        // Image preview functionality
        document.getElementById('main_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('main-image-preview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('gallery').addEventListener('change', function(e) {
            const files = e.target.files;
            const preview = document.getElementById('gallery-preview');
            preview.innerHTML = '';
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });

        // Dynamic list functions
        function removeListItem(button) {
            const listItem = button.closest('.list-item, .itinerary-item');
            const list = listItem.parentNode;
            if (list.children.length > 1) {
                listItem.remove();
            }
        }

        function addIncludedService() {
            const list = document.getElementById('included-services-list');
            const newItem = document.createElement('div');
            newItem.className = 'list-item';
            newItem.innerHTML = `
                <input type="text" name="included_services[]" placeholder="Servicio incluido">
                <button type="button" class="btn-remove-item" onclick="removeListItem(this)">
                    <i class="fas fa-times"></i>
                </button>
            `;
            list.appendChild(newItem);
        }

        function addExcludedService() {
            const list = document.getElementById('excluded-services-list');
            const newItem = document.createElement('div');
            newItem.className = 'list-item';
            newItem.innerHTML = `
                <input type="text" name="excluded_services[]" placeholder="Servicio no incluido">
                <button type="button" class="btn-remove-item" onclick="removeListItem(this)">
                    <i class="fas fa-times"></i>
                </button>
            `;
            list.appendChild(newItem);
        }

        function addItineraryItem() {
            const list = document.getElementById('itinerary-list');
            const newItem = document.createElement('div');
            newItem.className = 'itinerary-item';
            newItem.innerHTML = `
                <div class="itinerary-grid">
                    <input type="text" name="itinerary[${itineraryIndex}][title]" placeholder="Título de la actividad" required>
                    <input type="time" name="itinerary[${itineraryIndex}][time]" placeholder="Hora">
                    <textarea name="itinerary[${itineraryIndex}][description]" placeholder="Descripción de la actividad" rows="2" required></textarea>
                    <button type="button" class="btn-remove-item" onclick="removeItineraryItem(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            list.appendChild(newItem);
            itineraryIndex++;
        }

        function removeItineraryItem(button) {
            const item = button.closest('.itinerary-item');
            const list = item.parentNode;
            if (list.children.length > 1) {
                item.remove();
            }
        }

        function addMeetingPoint() {
            const list = document.getElementById('meeting-points-list');
            const newItem = document.createElement('div');
            newItem.className = 'list-item';
            newItem.innerHTML = `
                <input type="text" name="meeting_points[]" placeholder="Punto de encuentro">
                <button type="button" class="btn-remove-item" onclick="removeListItem(this)">
                    <i class="fas fa-times"></i>
                </button>
            `;
            list.appendChild(newItem);
        }

        function addTag() {
            const list = document.getElementById('tags-list');
            const newItem = document.createElement('div');
            newItem.className = 'list-item';
            newItem.innerHTML = `
                <input type="text" name="tags[]" placeholder="Etiqueta">
                <button type="button" class="btn-remove-item" onclick="removeListItem(this)">
                    <i class="fas fa-times"></i>
                </button>
            `;
            list.appendChild(newItem);
        }

        // Dropdown functionality
        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdown = this.parentElement;
                dropdown.classList.toggle('active');
            });
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown').forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
            }
        });

        // Form validation
        document.querySelector('.tour-form').addEventListener('submit', function(e) {
            const minParticipants = parseInt(document.getElementById('min_participants').value);
            const maxParticipants = parseInt(document.getElementById('max_participants').value);
            
            if (maxParticipants < minParticipants) {
                e.preventDefault();
                alert('El máximo de participantes debe ser mayor o igual al mínimo.');
                return false;
            }
        });
    </script>
</body>
</html>