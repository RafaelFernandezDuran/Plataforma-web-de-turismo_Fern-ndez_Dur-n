<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tour->title }} - Chanchamayo Tours</title>
    <link rel="stylesheet" href="{{ asset('css/chanchamayo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tour-detail.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="description" content="{{ Str::limit($tour->description, 160) }}">
</head>
<body class="page-with-navbar">
    @include('partials.site-header')

    <!-- Tour Hero -->
    <section class="tour-hero">
        <div class="tour-hero-image">
            <img src="{{ $tour->image_url ?? asset('images/kimiri.jpg') }}" alt="{{ $tour->title }}">
            
            <div class="tour-hero-overlay">
                <div class="container">
                    <div class="tour-hero-content">
                        <nav class="breadcrumb">
                            <a href="/">Inicio</a>
                            <i class="fas fa-chevron-right"></i>
                            <a href="{{ route('tours.index') }}">Tours</a>
                            <i class="fas fa-chevron-right"></i>
                            <span>Aventura en Puente Colgante Kimiri</span>
                        </nav>
                        
                        <div class="tour-badges">
                            <span class="tour-badge featured">DESTACADO</span>
                            <span class="tour-badge category">AVENTURA Y DEPORTES EXTREMOS</span>
                            <span class="tour-badge difficulty hard">HARD</span>
                        </div>
                        
                        <h1 class="tour-title">{{ $tour->title }}</h1>
                        
                        <div class="tour-meta">
                            <div class="tour-rating">
                                @if($tour->rating > 0)
                                    <div class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $tour->rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="rating-text">
                                        {{ number_format($tour->rating, 1) }} ({{ $tour->total_reviews }} reseñas)
                                    </span>
                                @else
                                    <span class="no-rating">Sin reseñas aún</span>
                                @endif
                            </div>
                            
                            <div class="tour-company">
                                <i class="fas fa-building"></i>
                                <span>{{ $tour->company->name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tour Content -->
    <section class="tour-content">
        <div class="container">
            <div class="tour-layout">
                <!-- Main Content -->
                <div class="tour-main">
                    <!-- Quick Info -->
                    <div class="tour-quick-info">
                        <div class="quick-info-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <strong>Duración</strong>
                                <span>{{ $tour->duration_days }} días, {{ $tour->duration_hours }} horas</span>
                            </div>
                        </div>
                        <div class="quick-info-item">
                            <i class="fas fa-users"></i>
                            <div>
                                <strong>Grupo</strong>
                                <span>{{ $tour->min_participants }} - {{ $tour->max_participants }} personas</span>
                            </div>
                        </div>
                        <div class="quick-info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <strong>Ubicación</strong>
                                <span>Chanchamayo, Perú</span>
                            </div>
                        </div>
                        @if($tour->child_price)
                            <div class="quick-info-item">
                                <i class="fas fa-child"></i>
                                <div>
                                    <strong>Para niños</strong>
                                    <span>S/ {{ number_format($tour->child_price, 0) }}</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="tour-section">
                        <h2>Descripción del Tour</h2>
                        <div class="tour-description">
                            {!! nl2br(e($tour->description)) !!}
                        </div>
                    </div>

                    <!-- Itinerary -->
                    @if($tour->itinerary)
                        <div class="tour-section">
                            <h2>Itinerario</h2>
                            <div class="itinerary">
                                @if(is_array($tour->itinerary) && count($tour->itinerary) > 0)
                                    @foreach($tour->itinerary as $index => $item)
                                        <div class="itinerary-item">
                                            <div class="itinerary-step">{{ $index + 1 }}</div>
                                            <div class="itinerary-content">
                                                @if(is_array($item))
                                                    <h4>{{ $item['title'] ?? 'Actividad ' . ($index + 1) }}</h4>
                                                    <p>{{ $item['description'] ?? $item['content'] ?? '' }}</p>
                                                    @if(isset($item['time']))
                                                        <span class="itinerary-time">
                                                            <i class="fas fa-clock"></i> {{ $item['time'] }}
                                                        </span>
                                                    @endif
                                                @else
                                                    <p>{{ $item }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @elseif(is_string($tour->itinerary))
                                    <div class="itinerary-text">
                                        {!! nl2br(e($tour->itinerary)) !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Included Services -->
                    <div class="tour-section">
                        <h2>Incluye</h2>
                        <div class="services-grid included">
                            <div class="service-item">
                                <i class="fas fa-check"></i>
                                <span>Transporte ida y vuelta</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check"></i>
                                <span>Guía profesional</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check"></i>
                                <span>Almuerzo típico</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check"></i>
                                <span>Entrada a aguas termales</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check"></i>
                                <span>Botella de agua</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-check"></i>
                                <span>Seguro de accidentes</span>
                            </div>
                        </div>
                    </div>

                    <!-- Excluded Services -->
                    <div class="tour-section">
                        <h2>No Incluye</h2>
                        <div class="services-grid excluded">
                            <div class="service-item">
                                <i class="fas fa-times"></i>
                                <span>Gastos personales</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-times"></i>
                                <span>Propinas</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-times"></i>
                                <span>Bebidas extras</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-times"></i>
                                <span>Souvenirs</span>
                            </div>
                            <div class="service-item">
                                <i class="fas fa-times"></i>
                                <span>Actividades opcionales</span>
                            </div>
                        </div>
                    </div>

                    <!-- Requirements -->
                    <div class="tour-section">
                        <h2>Requisitos</h2>
                        <div class="requirements-grid">
                            <div class="req-item">
                                <i class="fas fa-id-card"></i>
                                <span>Documento de identidad vigente</span>
                            </div>
                            <div class="req-item">
                                <i class="fas fa-heartbeat"></i>
                                <span>Buen estado de salud física</span>
                            </div>
                            <div class="req-item">
                                <i class="fas fa-shoe-prints"></i>
                                <span>Calzado cómodo para caminar</span>
                            </div>
                            <div class="req-item">
                                <i class="fas fa-sun"></i>
                                <span>Protector solar y repelente</span>
                            </div>
                            <div class="req-item">
                                <i class="fas fa-tshirt"></i>
                                <span>Ropa ligera y cómoda</span>
                            </div>
                            <div class="req-item">
                                <i class="fas fa-camera"></i>
                                <span>Cámara para capturar momentos únicos</span>
                            </div>
                        </div>
                    </div>

                    <!-- Recommendations -->
                    <div class="tour-section">
                        <h2>Recomendaciones</h2>
                        <div class="recommendations-grid">
                            <div class="rec-item">
                                <i class="fas fa-clock"></i>
                                <div>
                                    <h4>Llegada Puntual</h4>
                                    <p>Llegar 15 minutos antes de la hora de salida</p>
                                </div>
                            </div>
                            <div class="rec-item">
                                <i class="fas fa-mobile-alt"></i>
                                <div>
                                    <h4>Mantente Comunicado</h4>
                                    <p>Comparte tu ubicación con familiares durante el tour</p>
                                </div>
                            </div>
                            <div class="rec-item">
                                <i class="fas fa-tint"></i>
                                <div>
                                    <h4>Hidratación</h4>
                                    <p>Mantente hidratado durante toda la actividad</p>
                                </div>
                            </div>
                            <div class="rec-item">
                                <i class="fas fa-leaf"></i>
                                <div>
                                    <h4>Respeta la Naturaleza</h4>
                                    <p>No dejes basura y cuida el medio ambiente</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery -->
                    <div class="tour-section">
                        <h2>Galería</h2>
                        <div class="tour-gallery">
                            @php
                                $galleryImages = $tour->gallery_urls;
                            @endphp
                            @if(count($galleryImages) > 0)
                                @foreach($galleryImages as $imageUrl)
                                    <div class="gallery-item">
                                        <img src="{{ $imageUrl }}"
                                             alt="Galería - {{ $tour->title }}"
                                             loading="lazy"
                                             onclick="openLightbox(this.src)">
                                        <div class="gallery-overlay">
                                            <i class="fas fa-expand-alt"></i>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="gallery-item">
                                    <img src="{{ $tour->image_url ?? asset('images/kimiri.jpg') }}"
                                         alt="Galería - {{ $tour->title }}"
                                         loading="lazy"
                                         onclick="openLightbox(this.src)">
                                    <div class="gallery-overlay">
                                        <i class="fas fa-expand-alt"></i>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Cancellation Policy -->
                    <div class="tour-section">
                        <h2>Política de Cancelación</h2>
                        <div class="cancellation-policy">
                            <div class="policy-item">
                                <i class="fas fa-clock text-success"></i>
                                <div>
                                    <h4>Cancelación Gratuita</h4>
                                    <p>Hasta 24 horas antes del tour - reembolso del 100%</p>
                                </div>
                            </div>
                            <div class="policy-item">
                                <i class="fas fa-exclamation-triangle text-warning"></i>
                                <div>
                                    <h4>Cancelación Tardía</h4>
                                    <p>Entre 12-24 horas antes - reembolso del 50%</p>
                                </div>
                            </div>
                            <div class="policy-item">
                                <i class="fas fa-times-circle text-danger"></i>
                                <div>
                                    <h4>Sin Reembolso</h4>
                                    <p>Menos de 12 horas antes del tour</p>
                                </div>
                            </div>
                            <div class="policy-note">
                                <i class="fas fa-info-circle"></i>
                                <p>En caso de condiciones climáticas adversas, ofrecemos reprogramación sin costo adicional.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="tour-sidebar">
                    <!-- Booking Card -->
                    <div class="booking-card">
                        <div class="booking-price">
                            <span class="price-from">Desde</span>
                            <span class="price-amount">S/ {{ number_format($tour->price, 0) }}</span>
                            <span class="price-per">por persona</span>
                        </div>

                        @auth
                            <a href="{{ route('bookings.create', $tour) }}" class="btn-book-now">
                                <i class="fas fa-calendar-check"></i>
                                Reservar Ahora
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-book-now">
                                <i class="fas fa-sign-in-alt"></i>
                                Inicia Sesión para Reservar
                            </a>
                        @endauth

                        <div class="booking-actions">
                            <button class="btn-favorite" data-tour-id="{{ $tour->id }}">
                                <i class="far fa-heart"></i>
                                Agregar a Favoritos
                            </button>
                            <button class="btn-share" onclick="shareModal()">
                                <i class="fas fa-share-alt"></i>
                                Compartir
                            </button>
                        </div>

                        <div class="booking-note">
                            <i class="fas fa-info-circle"></i>
                            <span>Confirmación inmediata. Pago seguro.</span>
                        </div>
                    </div>

                    <!-- Company Info -->
                    <div class="company-card">
                        <h3>Operador del Tour</h3>
                        <div class="company-info">
                            <div class="company-name">{{ $tour->company->name }}</div>
                            @if($tour->company->description)
                                <p class="company-description">
                                    {{ Str::limit($tour->company->description, 100) }}
                                </p>
                            @endif
                            <div class="company-stats">
                                <span class="stat">
                                    <i class="fas fa-star"></i>
                                    {{ number_format($tour->company->average_rating ?? 0, 1) }}
                                </span>
                                <span class="stat">
                                    <i class="fas fa-route"></i>
                                    {{ $tour->company->tours_count ?? 0 }} tours
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="contact-card">
                        <h3>¿Necesitas Ayuda?</h3>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>+51 999 888 777</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@chanchamayotours.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <span>Lun - Dom: 8:00 AM - 6:00 PM</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Tours -->
    @if($relatedTours->count() > 0)
        <section class="related-tours">
            <div class="container">
                <h2>Tours Relacionados</h2>
                <div class="tours-grid">
                    @foreach($relatedTours as $relatedTour)
                        <article class="tour-card">
                            <div class="tour-image">
                                @php
                                    $relatedImage = $relatedTour->image_url;
                                @endphp
                                @if($relatedImage)
                                    <img src="{{ $relatedImage }}"
                                         alt="{{ $relatedTour->title }}"
                                         loading="lazy">
                                @else
                                    <div class="tour-image-placeholder">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                                
                                <div class="tour-price-overlay">
                                    S/ {{ number_format($relatedTour->price, 0) }}
                                </div>
                            </div>
                            
                            <div class="tour-content">
                                <h3>
                                    <a href="{{ route('tours.show', $relatedTour->slug) }}">
                                        {{ $relatedTour->title }}
                                    </a>
                                </h3>
                                <p>{{ Str::limit($relatedTour->description, 100) }}</p>
                                
                                <div class="tour-meta">
                                    <span><i class="fas fa-clock"></i> {{ $relatedTour->duration_days }}d</span>
                                    <span><i class="fas fa-users"></i> {{ $relatedTour->max_participants }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <h3>Chanchamayo Tours</h3>
                    <p>Descubre la magia de Chanchamayo con nosotros</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Chanchamayo Tours. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <div class="lightbox-content">
            <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
            <img id="lightbox-image" src="" alt="">
        </div>
    </div>

    <script>
        // Lightbox functionality
        function openLightbox(imageSrc) {
            document.getElementById('lightbox').style.display = 'flex';
            document.getElementById('lightbox-image').src = imageSrc;
        }

        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }

        // Favorite functionality
        document.querySelector('.btn-favorite')?.addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.classList.add('active');
                this.innerHTML = '<i class="fas fa-heart"></i> Agregado a Favoritos';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.classList.remove('active');
                this.innerHTML = '<i class="far fa-heart"></i> Agregar a Favoritos';
            }
        });

        // Share functionality
        function shareModal() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $tour->title }}',
                    text: '{{ Str::limit($tour->description, 100) }}',
                    url: window.location.href
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Enlace copiado al portapapeles');
                });
            }
        }

        // Booking modal (placeholder)
        function showBookingModal() {
            alert('Funcionalidad de reserva en desarrollo. ¡Pronto estará disponible!');
        }

        // Lightbox functionality
        function openLightbox(imageSrc) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = imageSrc;
            lightbox.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close lightbox with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="lightbox" onclick="closeLightbox()">
        <div class="lightbox-content" onclick="event.stopPropagation()">
            <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
            <img id="lightbox-img" src="" alt="Imagen ampliada">
        </div>
    </div>
</body>
</html>