<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tours - Chanchamayo Tours</title>
    <link rel="stylesheet" href="{{ asset('css/chanchamayo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tours-fixed.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="description" content="Descubre los mejores tours y experiencias en Chanchamayo. Aventura, naturaleza y cultura te esperan.">
    <meta name="og:title" content="Tours - Chanchamayo Tours">
    <meta name="og:description" content="Explora la belleza natural y cultural de Chanchamayo con nuestros tours cuidadosamente seleccionados">
    <link rel="preload" as="font" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" crossorigin>
</head>
<body class="tours-page">
    <!-- Header Premium -->
    <header class="header-sticky" role="banner">
        <div class="container">
            <div class="nav-brand">
                <a href="/" class="logo" aria-label="Chanchamayo Tours - Inicio">
                    <i class="fas fa-mountain" aria-hidden="true"></i>
                    <span>Chanchamayo Tours</span>
                </a>
            </div>
            
            <!-- Mobile menu button -->
            <button class="mobile-menu-toggle" aria-controls="main-navigation" aria-expanded="false" aria-label="Abrir menú de navegación">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
            
            <nav class="nav" id="main-navigation" role="navigation">
                <ul class="nav-links">
                    <li><a href="/" class="nav-link"><span>Inicio</span></a></li>
                    <li><a href="{{ route('tours.index') }}" class="nav-link active" aria-current="page"><span>Tours</span></a></li>
                    <li><a href="#categorias" class="nav-link"><span>Categorías</span></a></li>
                    <li><a href="{{ route('company.register') }}" class="nav-link"><span>Registrar Empresa</span></a></li>
                    <li><a href="#contacto" class="nav-link"><span>Contacto</span></a></li>
                    @auth
                        <li><a href="/dashboard" class="nav-link"><span>Dashboard</span></a></li>
                        <li><a href="{{ route('bookings.index') }}" class="nav-link"><span>Mis Reservas</span></a></li>
                    @else
                        <li><a href="/login" class="nav-link"><span>Iniciar Sesión</span></a></li>
                        <li>
                            <a href="/register" class="btn btn-primary">
                                <i class="fas fa-user-plus" aria-hidden="true"></i>
                                <span>Registrarse</span>
                            </a>
                        </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="tours-hero" role="banner">
        <div class="hero-background"></div>
        <div class="container">
            <div class="tours-hero-content">
                <h1 class="hero-title">Descubre Tours Increíbles</h1>
                <p class="hero-subtitle">Explora la belleza natural y cultural de Chanchamayo con nuestros tours cuidadosamente seleccionados</p>
                
                <!-- Search Bar -->
                <form class="search-form" method="GET" role="search">
                    <div class="search-input-wrapper">
                        <label for="search-tours" class="sr-only">Buscar tours</label>
                        <i class="fas fa-search search-icon" aria-hidden="true"></i>
                        <input 
                            type="text" 
                            id="search-tours"
                            name="search" 
                            class="search-input" 
                            placeholder="Buscar tours, destinos o actividades..." 
                            value="{{ request('search') }}"
                            aria-describedby="search-hint"
                        >
                    </div>
                    <button type="submit" class="search-btn">
                        <span>Buscar</span>
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>
                <div class="search-suggestion">
                    <span class="search-hint-text">Ej: cataratas, café, rafting</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="filters-section" role="region" aria-label="Filtros de búsqueda">
        <div class="container">
            <div class="filters-toolbar">
                <!-- Mobile filter toggle -->
                <button class="filter-toggle mobile-only" aria-controls="filters-form" aria-expanded="false">
                    <i class="fas fa-filter" aria-hidden="true"></i>
                    <span>Filtros</span>
                    <span class="filter-count" id="active-filters-count"></span>
                </button>
                
                <!-- Active filters chips -->
                @if(request()->hasAny(['category', 'price_min', 'price_max', 'duration', 'difficulty', 'search']))
                <div class="active-filters" aria-live="polite">
                    @if(request('search'))
                        <span class="filter-chip">
                            <i class="fas fa-search"></i>
                            "{{ request('search') }}"
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="filter-chip-remove" aria-label="Quitar búsqueda">
                                <i class="fas fa-times" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('category'))
                        <span class="filter-chip">
                            <i class="fas fa-tag"></i>
                            {{ $categories->where('slug', request('category'))->first()->name ?? request('category') }}
                            <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" class="filter-chip-remove" aria-label="Quitar filtro de categoría">
                                <i class="fas fa-times" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('price_min') || request('price_max'))
                        <span class="filter-chip">
                            <i class="fas fa-dollar-sign"></i>
                            S/{{ request('price_min', '0') }} - S/{{ request('price_max', '500+') }}
                            <a href="{{ request()->fullUrlWithQuery(['price_min' => null, 'price_max' => null]) }}" class="filter-chip-remove" aria-label="Quitar filtro de precio">
                                <i class="fas fa-times" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('duration'))
                        <span class="filter-chip">
                            <i class="fas fa-clock"></i>
                            {{ request('duration') }} día{{ request('duration') > 1 ? 's' : '' }}
                            <a href="{{ request()->fullUrlWithQuery(['duration' => null]) }}" class="filter-chip-remove" aria-label="Quitar filtro de duración">
                                <i class="fas fa-times" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    @if(request('difficulty'))
                        <span class="filter-chip">
                            <i class="fas fa-signal"></i>
                            {{ ucfirst(request('difficulty')) }}
                            <a href="{{ request()->fullUrlWithQuery(['difficulty' => null]) }}" class="filter-chip-remove" aria-label="Quitar filtro de dificultad">
                                <i class="fas fa-times" aria-hidden="true"></i>
                            </a>
                        </span>
                    @endif
                    <button class="clear-all-filters" onclick="window.location.href='{{ route('tours.index') }}'">
                        <i class="fas fa-times-circle"></i>
                        Limpiar todo
                    </button>
                </div>
                @endif
                
                <form method="GET" class="filters-form" id="filters-form">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    
                    <div class="filter-grid">
                        <div class="filter-group">
                            <label for="category-select" class="filter-label">Categoría</label>
                            <select name="category" id="category-select" class="filter-select">
                                <option value="">Todas las categorías</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" 
                                            {{ request('category') === $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Precio (S/)</label>
                            <div class="price-slider-container">
                                <input type="range" name="price_range" 
                                       min="0" max="500" step="10"
                                       value="{{ request('price_max', 250) }}" 
                                       class="price-range-slider"
                                       id="priceSlider"
                                       aria-label="Seleccionar precio máximo">
                                <div class="price-labels">
                                    <span>S/ 0</span>
                                    <span>S/ 500+</span>
                                </div>
                                <div class="price-current">
                                    Hasta: <span id="priceValue">S/ {{ request('price_max', 250) }}</span>
                                </div>
                                <input type="hidden" name="price_max" id="priceMaxInput" value="{{ request('price_max') }}">
                            </div>
                        </div>

                        <div class="filter-group">
                            <label for="duration-select" class="filter-label">Duración</label>
                            <select name="duration" id="duration-select" class="filter-select">
                                <option value="">Cualquier duración</option>
                                <option value="1" {{ request('duration') === '1' ? 'selected' : '' }}>1 día</option>
                                <option value="2" {{ request('duration') === '2' ? 'selected' : '' }}>2 días</option>
                                <option value="3" {{ request('duration') === '3' ? 'selected' : '' }}>3 días</option>
                                <option value="4" {{ request('duration') >= '4' ? 'selected' : '' }}>4+ días</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="difficulty-select" class="filter-label">Dificultad</label>
                            <select name="difficulty" id="difficulty-select" class="filter-select">
                                <option value="">Cualquier nivel</option>
                                <option value="easy" {{ request('difficulty') === 'easy' ? 'selected' : '' }}>Fácil</option>
                                <option value="moderate" {{ request('difficulty') === 'moderate' ? 'selected' : '' }}>Moderado</option>
                                <option value="hard" {{ request('difficulty') === 'hard' ? 'selected' : '' }}>Difícil</option>
                                <option value="expert" {{ request('difficulty') === 'expert' ? 'selected' : '' }}>Experto</option>
                            </select>
                        </div>
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check" aria-hidden="true"></i>
                            <span>Aplicar Filtros</span>
                            <span class="results-count">({{ $tours->total() }})</span>
                        </button>
                        <a href="{{ route('tours.index') }}" class="btn btn-ghost">
                            <i class="fas fa-times" aria-hidden="true"></i>
                            <span>Limpiar</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Tours Grid -->
    <section class="tours-grid-section" role="main" aria-label="Lista de tours disponibles">
        <div class="container">
            <!-- Header movido arriba de las tarjetas -->
            <div class="section-header">
                <div class="results-info">
                    <h2 class="results-title">
                        @if(request('search'))
                            Resultados para "<em>{{ request('search') }}</em>"
                        @else
                            Tours Disponibles
                        @endif
                    </h2>
                    <span class="results-count" aria-live="polite">{{ $tours->total() }} tour{{ $tours->total() !== 1 ? 's' : '' }} encontrado{{ $tours->total() !== 1 ? 's' : '' }}</span>
                </div>
                
                <div class="sort-wrapper">
                    <label for="sort-select" class="sort-label">Ordenar por:</label>
                    <select name="sort" id="sort-select" class="sort-select" onchange="location.href='{{ request()->fullUrl() }}&sort=' + this.value">
                        <option value="featured" {{ request('sort') === 'featured' ? 'selected' : '' }}>Destacados</option>
                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                        <option value="duration_asc" {{ request('sort') === 'duration_asc' ? 'selected' : '' }}>Duración: Corta a Larga</option>
                        <option value="duration_desc" {{ request('sort') === 'duration_desc' ? 'selected' : '' }}>Duración: Larga a Corta</option>
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Más Recientes</option>
                    </select>
                </div>
            </div>

            @if($tours->count() > 0)
                <!-- Contenedor centrado para las tarjetas -->
                <div class="tours-grid-wrapper">
                <div class="tours-grid" role="list" data-tours-count="{{ $tours->count() }}">
                    @foreach($tours as $tour)
                        <article class="tour-card" role="listitem">
                            <div class="tour-image-container">
                                @if($tour->optimized_image)
                                    <img src="{{ $tour->optimized_image }}" 
                                         alt="{{ $tour->title }}" 
                                         class="tour-image"
                                         loading="lazy"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="tour-image-placeholder {{ $tour->placeholder_class }}" style="display: none;">
                                        <i class="fas {{ $tour->icon_class }}" aria-hidden="true"></i>
                                        <span class="sr-only">{{ $tour->category->name ?? 'Tour' }} - Imagen no disponible</span>
                                    </div>
                                @else
                                    <div class="tour-image-placeholder">
                                        <i class="placeholder-icon fas {{ $tour->category->icon ?? 'fa-mountain' }}" aria-hidden="true"></i>
                                        <div class="placeholder-text">{{ $tour->category->name ?? 'Aventura' }}</div>
                                    </div>
                                @endif
                                
                                <!-- Tour badges -->
                                <div class="tour-badges" aria-label="Características destacadas">
                                    @if($tour->is_featured)
                                        <span class="badge badge-featured" aria-label="Tour destacado">
                                            <i class="fas fa-star" aria-hidden="true"></i>
                                            Destacado
                                        </span>
                                    @endif
                                    @if($tour->discount_percentage)
                                        <span class="badge badge-discount" aria-label="Descuento del {{ $tour->discount_percentage }}%">
                                            <i class="fas fa-tag" aria-hidden="true"></i>
                                            -{{ $tour->discount_percentage }}%
                                        </span>
                                    @endif
                                    <span class="badge badge-difficulty badge-{{ $tour->difficulty_level }}" 
                                          aria-label="Dificultad {{ ucfirst($tour->difficulty_level) }}">
                                        <i class="fas fa-signal" aria-hidden="true"></i>
                                        {{ strtoupper($tour->difficulty_level) }}
                                    </span>
                                </div>

                                <!-- Quick actions -->
                                <div class="tour-actions">
                                    <button class="action-btn favorite-btn" 
                                            aria-label="Agregar {{ $tour->title }} a favoritos"
                                            data-tour-id="{{ $tour->id }}">
                                        <i class="far fa-heart" aria-hidden="true"></i>
                                    </button>
                                    <button class="action-btn share-btn" 
                                            aria-label="Compartir {{ $tour->title }}"
                                            data-tour-id="{{ $tour->id }}">
                                        <i class="fas fa-share-alt" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="tour-content">
                                <div class="tour-category">
                                    <i class="fas fa-tag" aria-hidden="true"></i>
                                    <span>{{ $tour->category->name }}</span>
                                </div>
                                
                                <div class="tour-rating">
                                    <div class="stars" aria-label="Calificación {{ rand(35, 50) / 10 }} de 5 estrellas">
                                        @php
                                            $rating = rand(35, 50) / 10; // Rating entre 3.5 y 5.0
                                            $fullStars = floor($rating);
                                            $hasHalfStar = ($rating - $fullStars) >= 0.5;
                                        @endphp
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $fullStars)
                                                <i class="fas fa-star star" aria-hidden="true"></i>
                                            @elseif($i == $fullStars + 1 && $hasHalfStar)
                                                <i class="fas fa-star-half-alt star" aria-hidden="true"></i>
                                            @else
                                                <i class="fas fa-star star empty" aria-hidden="true"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="rating-info">
                                        <span class="rating-score">{{ number_format($rating, 1) }}</span>
                                        <span class="rating-count">{{ rand(12, 89) }} reseñas</span>
                                    </div>
                                </div>

                                <h3 class="tour-title">
                                    <a href="{{ route('tours.show', $tour->slug) }}" class="tour-link">{{ $tour->title }}</a>
                                </h3>

                                <p class="tour-description">{{ Str::limit($tour->description, 120) }}</p>

                                <div class="tour-details">
                                    <div class="detail-item">
                                        <i class="fas fa-clock" aria-hidden="true"></i>
                                        <span>{{ $tour->duration_days }}d {{ $tour->duration_hours }}h</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-users" aria-hidden="true"></i>
                                        <span>{{ $tour->min_participants }}-{{ $tour->max_participants }} personas</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-building" aria-hidden="true"></i>
                                        <span>{{ $tour->company->name }}</span>
                                    </div>
                                </div>

                                <footer class="tour-footer">
                                    <div class="tour-price">
                                        <span class="price-label">Desde</span>
                                        <span class="price-amount">S/ {{ number_format($tour->price, 0) }}</span>
                                        <span class="price-unit">por persona</span>
                                    </div>

                                    <div class="tour-cta">
                                        <button class="btn-heart" data-tour-id="{{ $tour->id }}" aria-label="Agregar a favoritos">
                                            <i class="far fa-heart" aria-hidden="true"></i>
                                        </button>
                                        <a href="{{ route('tours.show', $tour->slug) }}" class="btn btn-primary tour-details-btn">
                                            <span>Ver Detalles</span>
                                            <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </footer>
                            </div>
                        </article>
                    @endforeach
                </div>
                </div>

                <!-- Pagination -->
                <nav class="pagination-wrapper" aria-label="Paginación de tours" role="navigation">
                    {{ $tours->appends(request()->query())->links() }}
                </nav>
            @else
                <div class="no-results" role="status">
                    <div class="no-results-content">
                        <div class="no-results-icon">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </div>
                        <h3 class="no-results-title">No se encontraron tours</h3>
                        <p class="no-results-description">
                            @if(request()->hasAny(['search', 'category', 'price_min', 'price_max', 'duration', 'difficulty']))
                                Intenta ajustar tus filtros de búsqueda para encontrar más opciones.
                            @else
                                Actualmente no hay tours disponibles. ¡Vuelve pronto para nuevas aventuras!
                            @endif
                        </p>
                        <div class="no-results-actions">
                            <a href="{{ route('tours.index') }}" class="btn btn-primary">
                                <i class="fas fa-refresh" aria-hidden="true"></i>
                                <span>Ver Todos los Tours</span>
                            </a>
                            @if(request()->hasAny(['search', 'category', 'price_min', 'price_max', 'duration', 'difficulty']))
                                <button type="button" class="btn btn-ghost" onclick="history.back();">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                                    <span>Volver</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section" id="categorias" role="region" aria-label="Categorías de tours">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Explora por Categorías</h2>
                <p class="section-subtitle">Encuentra tu aventura perfecta según tus intereses</p>
            </div>
            
            <div class="categories-grid" role="list">
                @foreach($categories as $category)
                    <a href="{{ route('tours.index', ['category' => $category->slug]) }}" 
                       class="category-card" 
                       role="listitem"
                       aria-label="Ver tours de {{ $category->name }}">
                        <div class="category-image">
                            <div class="category-icon" style="color: {{ $category->color ?? '#10b981' }}">
                                <i class="fas fa-{{ $category->icon ?? 'mountain' }}" aria-hidden="true"></i>
                            </div>
                            <div class="category-overlay"></div>
                        </div>
                        
                        <div class="category-content">
                            <h3 class="category-title">{{ $category->name }}</h3>
                            <p class="category-description">{{ $category->description ?? 'Descubre increíbles experiencias.' }}</p>
                            
                            <div class="category-meta">
                                <span class="category-count">
                                    <i class="fas fa-map-marked-alt" aria-hidden="true"></i>
                                    {{ $category->tours_count ?? 0 }} tour{{ ($category->tours_count ?? 0) !== 1 ? 's' : '' }}
                                </span>
                                <span class="category-arrow">
                                    <i class="fas fa-arrow-right" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3>Chanchamayo Tours</h3>
                    <p>Descubre la magia de Chanchamayo con nosotros</p>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Tours</h4>
                        <ul>
                            <li><a href="{{ route('tours.index') }}">Todos los Tours</a></li>
                            <li><a href="{{ route('tours.index', ['category' => 'aventura']) }}">Aventura</a></li>
                            <li><a href="{{ route('tours.index', ['category' => 'ecoturismo']) }}">Ecoturismo</a></li>
                            <li><a href="{{ route('tours.index', ['category' => 'gastronomico']) }}">Gastronómico</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Empresa</h4>
                        <ul>
                            <li><a href="#nosotros">Nosotros</a></li>
                            <li><a href="{{ route('company.register') }}">Registrar Empresa</a></li>
                            <li><a href="#contacto">Contacto</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="social-links">
                    <h4>Síguenos</h4>
                    <div class="social-icons">
                        <a href="#" class="social-icon" aria-label="Facebook de Chanchamayo Tours">
                            <i class="fab fa-facebook-f" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="social-icon" aria-label="Instagram de Chanchamayo Tours">
                            <i class="fab fa-instagram" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="social-icon" aria-label="WhatsApp de Chanchamayo Tours">
                            <i class="fab fa-whatsapp" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Chanchamayo Tours. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Price slider functionality
            const priceSlider = document.getElementById('priceSlider');
            const priceValue = document.getElementById('priceValue');
            const priceMaxInput = document.getElementById('priceMaxInput');
            
            if (priceSlider && priceValue && priceMaxInput) {
                priceSlider.addEventListener('input', function() {
                    const value = this.value;
                    priceValue.textContent = value >= 500 ? 'S/ 500+' : `S/ ${value}`;
                    priceMaxInput.value = value >= 500 ? '' : value;
                    
                    // Update slider background
                    const percentage = (value / this.max) * 100;
                    this.style.background = `linear-gradient(to right, var(--color-primary) 0%, var(--color-primary) ${percentage}%, #e5e7eb ${percentage}%, #e5e7eb 100%)`;
                });
                
                // Initialize slider background
                const initialPercentage = (priceSlider.value / priceSlider.max) * 100;
                priceSlider.style.background = `linear-gradient(to right, var(--color-primary) 0%, var(--color-primary) ${initialPercentage}%, #e5e7eb ${initialPercentage}%, #e5e7eb 100%)`;
            }

            // Mobile menu toggle mejorado
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const navMenu = document.getElementById('main-navigation');
            
            if (mobileMenuToggle && navMenu) {
                mobileMenuToggle.addEventListener('click', function() {
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';
                    this.setAttribute('aria-expanded', !isExpanded);
                    navMenu.classList.toggle('active');
                    document.body.classList.toggle('menu-open');
                });
                
                // Cerrar menú al hacer click en un enlace
                navMenu.querySelectorAll('.nav-link').forEach(link => {
                    link.addEventListener('click', () => {
                        navMenu.classList.remove('active');
                        mobileMenuToggle.setAttribute('aria-expanded', 'false');
                        document.body.classList.remove('menu-open');
                    });
                });
                
                // Cerrar menú al hacer click fuera
                document.addEventListener('click', (e) => {
                    if (!mobileMenuToggle.contains(e.target) && !navMenu.contains(e.target)) {
                        navMenu.classList.remove('active');
                        mobileMenuToggle.setAttribute('aria-expanded', 'false');
                        document.body.classList.remove('menu-open');
                    }
                });
            }
            
            // Header scroll effect
            let lastScrollTop = 0;
            const header = document.querySelector('.header-sticky');
            
            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > 100) {
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
                
                lastScrollTop = scrollTop;
            }, { passive: true });

            // Mobile filters toggle
            const filterToggle = document.querySelector('.filter-toggle');
            const filtersForm = document.getElementById('filters-form');
            
            if (filterToggle && filtersForm) {
                filterToggle.addEventListener('click', function() {
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';
                    this.setAttribute('aria-expanded', !isExpanded);
                    filtersForm.classList.toggle('active');
                });
            }

            // Update active filters count
            function updateActiveFiltersCount() {
                const activeFilters = document.querySelectorAll('.filter-chip').length;
                const countElement = document.getElementById('active-filters-count');
                if (countElement) {
                    countElement.textContent = activeFilters > 0 ? activeFilters : '';
                    countElement.style.display = activeFilters > 0 ? 'inline' : 'none';
                }
            }
            updateActiveFiltersCount();

            // Enhanced search input functionality
            const searchInput = document.getElementById('search-input');
            const searchHints = document.getElementById('search-hints');
            const searchForm = document.querySelector('.search-form');
            
            if (searchInput && searchHints) {
                searchInput.addEventListener('focus', () => {
                    searchHints.style.display = 'block';
                    searchForm.classList.add('focused');
                });
                
                searchInput.addEventListener('blur', () => {
                    setTimeout(() => {
                        searchHints.style.display = 'none';
                        searchForm.classList.remove('focused');
                    }, 200);
                });
                
                // Search hints interaction
                const hintItems = searchHints.querySelectorAll('.search-hint');
                hintItems.forEach(hint => {
                    hint.addEventListener('click', () => {
                        searchInput.value = hint.textContent;
                        searchHints.style.display = 'none';
                        searchInput.focus();
                    });
                });
            }
            
            // Enhanced hover effects for cards
            const tourCards = document.querySelectorAll('.tour-card');
            tourCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.zIndex = '10';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.zIndex = 'auto';
                });
            });

            // Favorites functionality with animation
            document.querySelectorAll('.favorite-btn, .btn-heart').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const icon = this.querySelector('i');
                    const isActive = icon.classList.contains('fas');
                    
                    // Add animation class
                    this.classList.add('animate-heart');
                    
                    if (!isActive) {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                        this.classList.add('active');
                        
                        // Show feedback
                        showToast('Agregado a favoritos', 'success');
                    } else {
                        icon.classList.remove('fas');
                        icon.classList.add('far');
                        this.classList.remove('active');
                        
                        // Show feedback
                        showToast('Eliminado de favoritos', 'info');
                    }
                    
                    // Remove animation class
                    setTimeout(() => {
                        this.classList.remove('animate-heart');
                    }, 300);
                });
            });

            // Share functionality
            document.querySelectorAll('.share-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tourId = this.dataset.tourId;
                    const tourTitle = this.closest('.tour-card').querySelector('.tour-title a, .tour-link').textContent;
                    
                    if (navigator.share) {
                        navigator.share({
                            title: tourTitle,
                            url: window.location.origin + '/tours/' + tourId
                        });
                    } else {
                        // Fallback: copy to clipboard
                        const url = window.location.origin + '/tours/' + tourId;
                        navigator.clipboard.writeText(url).then(() => {
                            showToast('Enlace copiado al portapapeles', 'success');
                        });
                    }
                });
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Toast notification system
            function showToast(message, type = 'info') {
                const toast = document.createElement('div');
                toast.className = `toast toast-${type}`;
                toast.innerHTML = `
                    <i class="fas fa-${type === 'success' ? 'check' : 'info-circle'}" aria-hidden="true"></i>
                    <span>${message}</span>
                `;
                
                document.body.appendChild(toast);
                
                // Show toast
                setTimeout(() => toast.classList.add('show'), 100);
                
                // Hide and remove toast
                setTimeout(() => {
                    toast.classList.remove('show');
                    setTimeout(() => document.body.removeChild(toast), 300);
                }, 3000);
            }

            // Lazy loading for images
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            observer.unobserve(img);
                        }
                    });
                });

                document.querySelectorAll('img[data-src]').forEach(img => {
                    imageObserver.observe(img);
                });
            }

            // Scroll-based header behavior
            let lastScrollTop = 0;
            const header = document.querySelector('.header');
            
            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > lastScrollTop && scrollTop > 100) {
                    // Scrolling down
                    header.classList.add('header-hidden');
                } else {
                    // Scrolling up
                    header.classList.remove('header-hidden');
                }
                
                lastScrollTop = scrollTop;
            }, { passive: true });
        });
    </script>
</body>
</html>