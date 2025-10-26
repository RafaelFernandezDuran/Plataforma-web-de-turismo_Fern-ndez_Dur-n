<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alojamientos en Chanchamayo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/chanchamayo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/accommodations.css') }}">
</head>
<body>
    <header class="accommodations-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <span class="hero-badge">Hospédate en la selva central</span>
            <h1>Encuentra el alojamiento perfecto en Chanchamayo</h1>
            <p>Selecciona entre hoteles boutique, eco-lodges y refugios con encanto, con servicios diseñados para explorar la Amazonía peruana.</p>
            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hero-stat-value">{{ number_format($stats['total']) }}+</span>
                    <span class="hero-stat-label">Alojamientos verificados</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-value">{{ $stats['cities'] }}</span>
                    <span class="hero-stat-label">Ciudades para explorar</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-value">{{ number_format($stats['average_rating'], 1) }}</span>
                    <span class="hero-stat-label">Valoración promedio</span>
                </div>
                @if($stats['average_price'])
                    <div class="hero-stat">
                        <span class="hero-stat-value">S/ {{ number_format($stats['average_price'], 0) }}</span>
                        <span class="hero-stat-label">Tarifa promedio</span>
                    </div>
                @endif
            </div>
            <form class="filters" method="GET" action="{{ route('accommodations.index') }}">
                <div class="filter-group">
                    <label for="city">Ciudad</label>
                    <select id="city" name="city">
                        <option value="">Todas</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ ($filters['city'] ?? '') === $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label for="type">Tipo</label>
                    <select id="type" name="type">
                        <option value="">Todos</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ ($filters['type'] ?? '') === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label for="price_min">Precio desde</label>
                    <input id="price_min" type="number" name="price_min" min="0" step="10" value="{{ $filters['price_min'] ?? '' }}">
                </div>
                <div class="filter-group">
                    <label for="price_max">Precio hasta</label>
                    <input id="price_max" type="number" name="price_max" min="0" step="10" value="{{ $filters['price_max'] ?? '' }}">
                </div>
                <div class="filter-actions">
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Buscar
                    </button>
                    @if(!empty(array_filter($filters)))
                        <a href="{{ route('accommodations.index') }}" class="btn-link">
                            <i class="fa-solid fa-rotate-left"></i>
                            Limpiar filtros
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </header>

    <main class="container accommodations-content">
        <div class="results-header">
            <div class="results-heading">
                <h2>Resultados</h2>
                <p class="results-subtitle">Alojamientos curados para tu próxima travesía</p>
            </div>
            <span>{{ $accommodations->total() }} alojamientos disponibles</span>
        </div>

        <section class="accommodations-grid">
            @forelse($accommodations as $accommodation)
                @php
                    $cardImage = $accommodation->main_image
                        ? (\Illuminate\Support\Str::startsWith($accommodation->main_image, ['http://', 'https://'])
                            ? $accommodation->main_image
                            : asset('storage/' . ltrim($accommodation->main_image, '/')))
                        : 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=900&q=80';
                @endphp
                <article class="accommodation-card">
                    <div class="card-image" style="background-image: url('{{ $cardImage }}')">
                        <div class="card-image-overlay"></div>
                        <div class="card-chip">
                            <i class="fa-solid fa-star"></i>
                            {{ number_format($accommodation->rating, 1) }}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-header">
                            <span class="tag">{{ ucfirst($accommodation->type) }}</span>
                            <span class="rating">
                                <i class="fa-solid fa-user-check"></i>
                                {{ $accommodation->total_reviews ?? 0 }} reseñas
                            </span>
                        </div>
                        <h3><a href="{{ route('accommodations.show', $accommodation) }}">{{ $accommodation->name }}</a></h3>
                        <p class="location"><i class="fa-solid fa-location-dot"></i> {{ trim($accommodation->city . ', ' . $accommodation->region, ', ') }}</p>
                        <p class="description">{{ \Illuminate\Support\Str::limit($accommodation->description, 140) }}</p>
                        @if($accommodation->amenities)
                            <ul class="amenities">
                                @foreach(array_slice($accommodation->amenities, 0, 3) as $amenity)
                                    <li>{{ $amenity }}</li>
                                @endforeach
                                @if(count($accommodation->amenities) > 3)
                                    <li>+{{ count($accommodation->amenities) - 3 }}</li>
                                @endif
                            </ul>
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="price-block">
                            @if($accommodation->price_per_night)
                                <span class="price">S/ {{ number_format($accommodation->price_per_night, 2) }}</span>
                                <span class="price-caption">por noche</span>
                            @else
                                <span class="price-caption">Consulta tarifas</span>
                            @endif
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('accommodations.show', $accommodation) }}" class="btn-secondary">
                                Ver detalles
                            </a>
                            <a href="{{ route('accommodations.show', $accommodation) }}#reserva" class="btn-ghost">
                                Solicitar
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <h3>No encontramos alojamientos con esos filtros</h3>
                    <p>Prueba con otra ciudad o ajusta el rango de precios para descubrir más opciones.</p>
                    <a href="{{ route('accommodations.index') }}" class="btn-primary">Limpiar filtros</a>
                </div>
            @endforelse
        </section>

        <div class="pagination">
            {{ $accommodations->links() }}
        </div>
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div>
                <h4>Chanchamayo Tours</h4>
                <p>Promovemos experiencias sostenibles e inmersivas en la selva central peruana.</p>
            </div>
            <div>
                <h5>Explora</h5>
                <ul>
                    <li><a href="{{ route('tours.index') }}">Tours</a></li>
                    <li><a href="{{ route('accommodations.index') }}">Alojamientos</a></li>
                    <li><a href="{{ url('/') }}#contacto">Contacto</a></li>
                </ul>
            </div>
            <div>
                <h5>Contáctanos</h5>
                <ul>
                    <li>info@chanchamayotours.com</li>
                    <li>+51 987 654 321</li>
                    <li>La Merced, Chanchamayo</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">© {{ date('Y') }} Chanchamayo Tours. Todos los derechos reservados.</div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" defer></script>
</body>
</html>
