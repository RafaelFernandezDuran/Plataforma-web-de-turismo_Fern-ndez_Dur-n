<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $accommodation->name }} - Alojamiento en Chanchamayo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/chanchamayo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/accommodations.css') }}">
</head>
@php
    $heroImage = $accommodation->image_url ?? asset('images/vista-a-la-piscina.jpg');
@endphp
<body class="page-with-navbar">
    @include('partials.site-header')

    <header class="accommodation-hero" style="background-image: url('{{ $heroImage }}')">
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <span class="hero-badge">{{ ucfirst($accommodation->type) }}</span>
            <h1>{{ $accommodation->name }}</h1>
            <p class="hero-location"><i class="fa-solid fa-location-dot"></i> {{ trim($accommodation->address . ', ' . $accommodation->city . ', ' . $accommodation->region, ', ') }}</p>
            <div class="hero-meta">
                <div class="hero-meta-item">
                    <i class="fa-solid fa-star"></i>
                    <span>{{ number_format($accommodation->rating, 1) }}</span>
                    <small>{{ $accommodation->total_reviews ?? 0 }} reseñas</small>
                </div>
                <div class="hero-meta-item">
                    <i class="fa-solid fa-leaf"></i>
                    <span>{{ ucfirst($accommodation->type) }}</span>
                    <small>Experiencia auténtica</small>
                </div>
                <div class="hero-meta-item">
                    <i class="fa-solid fa-wallet"></i>
                    <span>
                        @if($accommodation->price_per_night)
                            S/ {{ number_format($accommodation->price_per_night, 2) }}
                        @else
                            Consulta tarifas
                        @endif
                    </span>
                    <small>Tarifa por noche</small>
                </div>
            </div>
            <div class="hero-actions">
                <a href="#reserva" class="btn-primary">Solicitar reserva</a>
                <a href="{{ route('accommodations.index') }}" class="btn-outline">
                    <i class="fa-solid fa-arrow-left"></i>
                    Volver a alojamientos
                </a>
            </div>
        </div>
    </header>

    <main class="container accommodation-detail">
        @if(session('status'))
            <div class="alert success" role="status">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="alert error" role="alert">
                <i class="fa-solid fa-circle-exclamation"></i>
                Revisa los campos marcados e intenta nuevamente.
            </div>
        @endif

        <section class="detail-grid">
            <article class="detail-main">
                <h2>Descripción</h2>
                <p>{{ $accommodation->description }}</p>

                @if($accommodation->amenities)
                    <h3>Servicios destacados</h3>
                    <ul class="amenities-list">
                        @foreach($accommodation->amenities as $amenity)
                            <li><i class="fa-solid fa-circle-check"></i> {{ $amenity }}</li>
                        @endforeach
                    </ul>
                @endif

                @php
                    $galleryImages = $accommodation->gallery_urls;
                @endphp

                @if(count($galleryImages) > 0)
                    <h3>Galería</h3>
                    <div class="gallery-grid">
                        @foreach($galleryImages as $imageUrl)
                            <img src="{{ $imageUrl }}" alt="Foto de {{ $accommodation->name }}">
                        @endforeach
                    </div>
                @endif
            </article>

            <aside class="detail-sidebar" id="reserva">
                <div class="booking-card">
                    <h3>Reserva tu estadía</h3>
                    @if($accommodation->price_per_night)
                        <p class="price">S/ {{ number_format($accommodation->price_per_night, 2) }} <span>por noche</span></p>
                    @else
                        <p class="price">Tarifas personalizadas</p>
                    @endif
                    <p class="muted">Déjanos tus datos y un asesor te contactará para completar la reserva.</p>
                    <form class="booking-form" method="POST" action="{{ route('accommodations.request', $accommodation) }}">
                        @csrf
                        <div class="form-grid">
                            <div class="form-field">
                                <label for="name">Nombre completo</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Tu nombre" required>
                                @error('name')
                                    <small class="error-text">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-field">
                                <label for="email">Correo electrónico</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="tu@correo.com" required>
                                @error('email')
                                    <small class="error-text">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-field">
                                <label for="phone">Teléfono</label>
                                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" placeholder="Ej. +51 987 654 321">
                                @error('phone')
                                    <small class="error-text">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-field">
                                <label for="guests">Número de huéspedes</label>
                                <input id="guests" type="number" name="guests" min="1" max="12" value="{{ old('guests', 2) }}" required>
                                @error('guests')
                                    <small class="error-text">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-field">
                                <label for="check_in">Fecha de ingreso</label>
                                <input id="check_in" type="date" name="check_in" value="{{ old('check_in') }}" min="{{ now()->toDateString() }}">
                                @error('check_in')
                                    <small class="error-text">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-field">
                                <label for="check_out">Fecha de salida</label>
                                <input
                                    id="check_out"
                                    type="date"
                                    name="check_out"
                                    value="{{ old('check_out') }}"
                                    min="{{ old('check_in', now()->addDay()->toDateString()) }}"
                                >
                                @error('check_out')
                                    <small class="error-text">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-field form-field--full">
                                <label for="message">Mensaje adicional</label>
                                <textarea id="message" name="message" rows="3" placeholder="Cuéntanos si tienes alguna preferencia o pregunta">{{ old('message') }}</textarea>
                                @error('message')
                                    <small class="error-text">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn-primary btn-block">
                            <i class="fa-solid fa-paper-plane"></i>
                            Enviar solicitud
                        </button>
                        <p class="privacy-note">Protegemos tus datos y solo los compartimos con el anfitrión seleccionado.</p>
                    </form>
                    <p class="muted">También puedes escribirnos a <a href="mailto:info@chanchamayotours.com">info@chanchamayotours.com</a> o llamar al +51 987 654 321.</p>
                </div>

                <div class="info-card">
                    <h4>Ubicación</h4>
                    <p>{{ $accommodation->address }}<br>{{ $accommodation->city }}, {{ $accommodation->region }}</p>
                    <h4>Operado por</h4>
                    @if($accommodation->company)
                        <p>{{ $accommodation->company->name }}</p>
                    @else
                        <p>Operador independiente</p>
                    @endif
                </div>
            </aside>
        </section>

        @if($related->isNotEmpty())
            <section class="related-section">
                <div class="section-header">
                    <h2>Otros alojamientos recomendados</h2>
                    <a href="{{ route('accommodations.index') }}">Ver todos</a>
                </div>
                <div class="related-grid">
                    @foreach($related as $item)
                        @php
                            $relatedImage = $item->image_url ?? asset('images/getlstd-property-photo.jpg');
                        @endphp
                        <article class="related-card">
                            <div class="card-image" style="background-image: url('{{ $relatedImage }}')"></div>
                            <div class="card-body">
                                <span class="tag">{{ ucfirst($item->type) }}</span>
                                <h3><a href="{{ route('accommodations.show', $item) }}">{{ $item->name }}</a></h3>
                                <p><i class="fa-solid fa-location-dot"></i> {{ trim($item->city . ', ' . $item->region, ', ') }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
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
