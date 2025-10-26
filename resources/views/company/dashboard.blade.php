<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ $company->name }} - Chanchamayo Tours</title>
    <link rel="stylesheet" href="{{ asset('css/chanchamayo.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard-layout company-dashboard">
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
                        <li class="active">
                            <a href="{{ route('company.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('company.tours.index') }}">
                                <i class="fas fa-route"></i>
                                Mis Tours
                                <span class="badge">{{ $stats['tours_count'] }}</span>
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
                                @if($stats['pending_bookings'] > 0)
                                    <span class="badge badge-warning">{{ $stats['pending_bookings'] }}</span>
                                @endif
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
                    <div class="page-header-meta">
                        <span class="page-badge">Panel empresarial</span>
                        <h1>Dashboard</h1>
                        <p>Bienvenido de vuelta, gestiona tu empresa turística desde aquí</p>
                    </div>
                    <a href="{{ route('company.tours.create') }}" class="page-header-cta">
                        <i class="fas fa-feather"></i>
                        Crear tour destacado
                    </a>
                </div>

                <!-- Company Status Alert -->
                @if($company->status !== 'approved')
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            <strong>Estado de tu empresa: {{ ucfirst($company->status) }}</strong>
                            @if($company->status === 'pending')
                                <p>Tu empresa está en proceso de revisión. Te notificaremos cuando sea aprobada.</p>
                            @elseif($company->status === 'rejected')
                                <p>Tu empresa ha sido rechazada. Por favor, revisa los comentarios y realiza las correcciones necesarias.</p>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon tours">
                            <i class="fas fa-route"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $stats['tours_count'] }}</h3>
                            <p>Tours Totales</p>
                            <span class="stat-note">{{ $stats['active_tours'] }} activos</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bookings">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $stats['total_bookings'] }}</h3>
                            <p>Reservas Totales</p>
                            <span class="stat-note">{{ $stats['pending_bookings'] }} pendientes</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon revenue">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-content">
                            <h3>S/ {{ number_format($stats['monthly_revenue'], 0) }}</h3>
                            <p>Ingresos del Mes</p>
                            <span class="stat-note">{{ now()->format('F Y') }}</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon rating">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ number_format($company->average_rating ?? 0, 1) }}</h3>
                            <p>Calificación Promedio</p>
                            <span class="stat-note">{{ $company->total_reviews ?? 0 }} reseñas</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <h2>Acciones Rápidas</h2>
                    <div class="actions-grid">
                        <a href="{{ route('company.tours.create') }}" class="action-card">
                            <div class="action-icon">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="action-content">
                                <h3>Crear Nuevo Tour</h3>
                                <p>Añade una nueva experiencia para tus clientes</p>
                            </div>
                        </a>

                        <a href="{{ route('company.tours.index') }}" class="action-card">
                            <div class="action-icon">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="action-content">
                                <h3>Gestionar Tours</h3>
                                <p>Edita, activa o desactiva tus tours existentes</p>
                            </div>
                        </a>

                        <a href="#bookings" class="action-card">
                            <div class="action-icon">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="action-content">
                                <h3>Ver Reservas</h3>
                                <p>Gestiona las reservas de tus clientes</p>
                            </div>
                        </a>

                        <a href="#analytics" class="action-card">
                            <div class="action-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="action-content">
                                <h3>Ver Estadísticas</h3>
                                <p>Analiza el rendimiento de tu empresa</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Recent Bookings -->
                @if($recent_bookings->count() > 0)
                    <div class="recent-activity">
                        <div class="section-header">
                            <h2>Reservas Recientes</h2>
                            <a href="#bookings" class="btn-link">Ver todas</a>
                        </div>
                        
                        <div class="bookings-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Tour</th>
                                        <th>Fecha</th>
                                        <th>Personas</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_bookings as $booking)
                                        <tr>
                                            <td>
                                                <div class="client-info">
                                                    <strong>{{ $booking->user->name }}</strong>
                                                    <span>{{ $booking->user->email }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tour-info">
                                                    <a href="{{ route('tours.show', $booking->tour->slug) }}" target="_blank">
                                                        {{ $booking->tour->title }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td>{{ $booking->booking_date->format('d/m/Y') }}</td>
                                            <td>{{ $booking->participants }}</td>
                                            <td>S/ {{ number_format($booking->total_amount, 0) }}</td>
                                            <td>
                                                <span class="status-badge status-{{ $booking->status }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <button class="btn-action" title="Ver detalles">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    @if($booking->status === 'pending')
                                                        <button class="btn-action confirm" title="Confirmar">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <h3>No hay reservas aún</h3>
                        <p>Cuando los clientes reserven tus tours, aparecerán aquí.</p>
                        <a href="{{ route('company.tours.create') }}" class="btn-primary">
                            Crear tu primer tour
                        </a>
                    </div>
                @endif

                <!-- Recent Activity Timeline -->
                <div class="activity-timeline">
                    <h2>Actividad Reciente</h2>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <div class="timeline-content">
                                <h4>Empresa registrada</h4>
                                <p>Tu empresa {{ $company->name }} fue registrada exitosamente</p>
                                <span class="timeline-date">{{ $company->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        @if($stats['tours_count'] > 0)
                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fas fa-route"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>Tours creados</h4>
                                    <p>Has creado {{ $stats['tours_count'] }} tour(s)</p>
                                    <span class="timeline-date">Últimos 30 días</span>
                                </div>
                            </div>
                        @endif

                        @if($stats['total_bookings'] > 0)
                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <h4>Reservas recibidas</h4>
                                    <p>Has recibido {{ $stats['total_bookings'] }} reserva(s)</p>
                                    <span class="timeline-date">Total acumulado</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
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

        // Confirmation for booking actions
        document.querySelectorAll('.btn-action.confirm').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('¿Confirmar esta reserva?')) {
                    // Handle booking confirmation
                    alert('Funcionalidad en desarrollo');
                }
            });
        });
    </script>
</body>
</html>