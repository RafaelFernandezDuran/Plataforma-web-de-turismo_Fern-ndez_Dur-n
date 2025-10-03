<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tours - {{ $company->name }} - Chanchamayo Tours</title>
    <link rel="stylesheet" href="{{ asset('css/chanchamayo.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                    <span class="company-name">{{ $company->name }}</span>
                    <span class="company-status status-{{ $company->status }}">
                        {{ ucfirst($company->status) }}
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
                        <li class="active">
                            <a href="{{ route('company.tours.index') }}">
                                <i class="fas fa-route"></i>
                                Mis Tours
                                <span class="badge">{{ $tours->total() }}</span>
                            </a>
                        </li>
                        <li>
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
                        <h1>Mis Tours</h1>
                        <p>Gestiona todos tus tours desde aquí</p>
                    </div>
                    <div class="page-actions">
                        <a href="{{ route('company.tours.create') }}" class="btn-primary">
                            <i class="fas fa-plus"></i>
                            Crear Nuevo Tour
                        </a>
                    </div>
                </div>

                <!-- Filters and Search -->
                <div class="table-controls">
                    <div class="search-controls">
                        <form method="GET" class="search-form">
                            <div class="search-input">
                                <i class="fas fa-search"></i>
                                <input type="text" name="search" placeholder="Buscar tours..." 
                                       value="{{ request('search') }}">
                            </div>
                            <select name="status">
                                <option value="">Todos los estados</option>
                                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Borrador</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Activo</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            <button type="submit" class="btn-secondary">Filtrar</button>
                        </form>
                    </div>
                    
                    <div class="view-controls">
                        <button class="view-btn active" data-view="grid">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button class="view-btn" data-view="list">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>

                <!-- Tours Grid/List -->
                @if($tours->count() > 0)
                    <div class="tours-container" id="tours-grid">
                        @foreach($tours as $tour)
                            <div class="tour-card-admin">
                                <div class="tour-image">
                                    @if($tour->main_image)
                                        <img src="{{ Storage::url($tour->main_image) }}" 
                                             alt="{{ $tour->title }}" 
                                             loading="lazy">
                                    @else
                                        <div class="tour-image-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                    
                                    <div class="tour-badges">
                                        <span class="status-badge status-{{ $tour->status }}">
                                            {{ ucfirst($tour->status) }}
                                        </span>
                                        @if($tour->is_featured)
                                            <span class="featured-badge">Destacado</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="tour-content">
                                    <div class="tour-header">
                                        <h3 class="tour-title">{{ $tour->title }}</h3>
                                        <div class="tour-category">{{ $tour->category->name }}</div>
                                    </div>

                                    <div class="tour-stats">
                                        <div class="stat">
                                            <i class="fas fa-eye"></i>
                                            <span>{{ $tour->views_count ?? 0 }} vistas</span>
                                        </div>
                                        <div class="stat">
                                            <i class="fas fa-calendar-check"></i>
                                            <span>{{ $tour->bookings_count ?? 0 }} reservas</span>
                                        </div>
                                        <div class="stat">
                                            <i class="fas fa-star"></i>
                                            <span>{{ number_format($tour->rating ?? 0, 1) }}</span>
                                        </div>
                                    </div>

                                    <div class="tour-meta">
                                        <span class="price">S/ {{ number_format($tour->price, 0) }}</span>
                                        <span class="duration">{{ $tour->duration_days }}d {{ $tour->duration_hours }}h</span>
                                        <span class="difficulty difficulty-{{ $tour->difficulty_level }}">
                                            {{ ucfirst($tour->difficulty_level) }}
                                        </span>
                                    </div>

                                    <div class="tour-description">
                                        {{ Str::limit($tour->description, 100) }}
                                    </div>

                                    <div class="tour-actions">
                                        <a href="{{ route('tours.show', $tour->slug) }}" 
                                           class="btn-action view" target="_blank" title="Ver en sitio público">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('company.tours.edit', $tour) }}" 
                                           class="btn-action edit" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn-action toggle-status" 
                                                data-tour-id="{{ $tour->id }}" 
                                                data-current-status="{{ $tour->status }}"
                                                title="{{ $tour->status === 'active' ? 'Desactivar' : 'Activar' }}">
                                            @if($tour->status === 'active')
                                                <i class="fas fa-pause"></i>
                                            @else
                                                <i class="fas fa-play"></i>
                                            @endif
                                        </button>
                                        <button class="btn-action toggle-featured" 
                                                data-tour-id="{{ $tour->id }}" 
                                                data-featured="{{ $tour->is_featured ? 'true' : 'false' }}"
                                                title="{{ $tour->is_featured ? 'Quitar destacado' : 'Marcar como destacado' }}">
                                            @if($tour->is_featured)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        </button>
                                        <button class="btn-action delete" 
                                                data-tour-id="{{ $tour->id }}" 
                                                data-tour-title="{{ $tour->title }}"
                                                title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <div class="tour-footer">
                                        <span class="creation-date">
                                            Creado {{ $tour->created_at->diffForHumans() }}
                                        </span>
                                        <span class="last-updated">
                                            Actualizado {{ $tour->updated_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $tours->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-route"></i>
                        </div>
                        <h3>No tienes tours aún</h3>
                        <p>Crea tu primer tour para empezar a recibir reservas de clientes.</p>
                        <a href="{{ route('company.tours.create') }}" class="btn-primary">
                            <i class="fas fa-plus"></i>
                            Crear mi primer tour
                        </a>
                    </div>
                @endif
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirmar Eliminación</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar el tour <strong id="deleteTourTitle"></strong>?</p>
                <p class="warning">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button class="btn-secondary" onclick="closeDeleteModal()">Cancelar</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">Eliminar Tour</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // View toggle functionality
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const view = this.dataset.view;
                const container = document.getElementById('tours-grid');
                container.className = view === 'list' ? 'tours-list' : 'tours-container';
            });
        });

        // Toggle status functionality
        document.querySelectorAll('.toggle-status').forEach(btn => {
            btn.addEventListener('click', function() {
                const tourId = this.dataset.tourId;
                const currentStatus = this.dataset.currentStatus;
                const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
                
                if (confirm(`¿${newStatus === 'active' ? 'Activar' : 'Desactivar'} este tour?`)) {
                    // Make AJAX request to toggle status
                    fetch(`/company/tours/${tourId}/toggle-status`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        }
                    })
                    .catch(() => {
                        alert('Error al cambiar el estado del tour');
                    });
                }
            });
        });

        // Toggle featured functionality
        document.querySelectorAll('.toggle-featured').forEach(btn => {
            btn.addEventListener('click', function() {
                const tourId = this.dataset.tourId;
                const isFeatured = this.dataset.featured === 'true';
                
                if (confirm(`¿${isFeatured ? 'Quitar' : 'Marcar'} como destacado?`)) {
                    fetch(`/company/tours/${tourId}/toggle-featured`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        }
                    })
                    .catch(() => {
                        alert('Error al cambiar el estado destacado');
                    });
                }
            });
        });

        // Delete functionality
        document.querySelectorAll('.delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const tourId = this.dataset.tourId;
                const tourTitle = this.dataset.tourTitle;
                
                document.getElementById('deleteTourTitle').textContent = tourTitle;
                document.getElementById('deleteForm').action = `/company/tours/${tourId}`;
                document.getElementById('deleteModal').style.display = 'flex';
            });
        });

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Dropdown functionality
        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdown = this.parentElement;
                dropdown.classList.toggle('active');
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown').forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
            }
        });
    </script>

    <!-- Add CSRF token for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</body>
</html>