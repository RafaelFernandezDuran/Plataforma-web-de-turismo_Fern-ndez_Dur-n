@php
    $isRoute = fn ($route) => request()->routeIs($route);
    $isPath = fn ($path) => request()->is(trim($path, '/'));
@endphp

<nav class="navbar" id="navbar">
    <div class="container nav-container">
        <a href="{{ url('/') }}" class="logo" aria-label="Chanchamayo Tours - Página principal">
            <i class="fas fa-leaf" aria-hidden="true"></i>
            Chanchamayo Tours
        </a>
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Inicio</a></li>
            <li><a href="{{ route('tours.index') }}" class="{{ request()->routeIs('tours.*') ? 'active' : '' }}">Tours</a></li>
            <li><a href="{{ route('accommodations.index') }}" class="{{ request()->routeIs('accommodations.*') ? 'active' : '' }}">Alojamientos</a></li>
            <li><a href="{{ url('/#categorias') }}">Categorías</a></li>
            <li><a href="{{ route('company.register') }}">Registrar Empresa</a></li>
            <li><a href="{{ url('/#contacto') }}">Contacto</a></li>
            @auth
                <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a></li>
            @else
                <li><a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Iniciar Sesión</a></li>
                <li><a href="{{ route('register') }}" class="btn-primary {{ request()->routeIs('register') ? 'active' : '' }}">Registrarse</a></li>
            @endauth
        </ul>
        <button class="nav-toggle" id="navToggle" aria-label="Abrir menú de navegación">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</nav>

@once
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var navToggle = document.getElementById('navToggle');
            var navLinks = document.getElementById('navLinks');
            var navbar = document.getElementById('navbar');

            if (navToggle && navLinks) {
                navToggle.addEventListener('click', function () {
                    navLinks.classList.toggle('active');
                    var icon = navToggle.querySelector('i');
                    if (icon) {
                        var isMenuOpen = navLinks.classList.contains('active');
                        icon.classList.toggle('fa-bars', !isMenuOpen);
                        icon.classList.toggle('fa-times', isMenuOpen);
                    }
                });
            }

            if (navbar) {
                var handleScroll = function () {
                    if (window.scrollY > 100) {
                        navbar.classList.add('scrolled');
                    } else {
                        navbar.classList.remove('scrolled');
                    }
                };

                handleScroll();
                window.addEventListener('scroll', handleScroll);
            }

            if (navLinks) {
                navLinks.querySelectorAll('a').forEach(function (link) {
                    link.addEventListener('click', function () {
                        if (navLinks.classList.contains('active')) {
                            navLinks.classList.remove('active');
                            if (navToggle) {
                                var toggleIcon = navToggle.querySelector('i');
                                if (toggleIcon) {
                                    toggleIcon.classList.add('fa-bars');
                                    toggleIcon.classList.remove('fa-times');
                                }
                            }
                        }
                    });
                });
            }
        });
    </script>
@endonce
