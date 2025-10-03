<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chanchamayo Tours - Descubre la Selva Central del Perú</title>
    
    <!-- Preload critical font -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&display=swap" as="style" crossorigin>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/chanchamayo.css') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])



            .navbar.scrolled {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(30px);
                -webkit-backdrop-filter: blur(30px);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }

            .nav-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 2rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .logo {
                font-family: 'Poppins', sans-serif;
                font-size: 1.8rem;
                font-weight: 700;
                color: var(--verde-selva);
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .logo i {
                font-size: 2rem;
                background: linear-gradient(135deg, var(--verde-selva), var(--verde-claro));
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .nav-links {
                display: flex;
                list-style: none;
                gap: 2rem;
                align-items: center;
            }

            .nav-links a {
                text-decoration: none;
                color: var(--gris-oscuro);
                font-weight: 500;
                transition: all 0.3s ease;
                position: relative;
                padding: 0.5rem 1rem;
                border-radius: 25px;
            }

            .nav-links a:hover {
                color: var(--verde-selva);
                background: rgba(5, 150, 105, 0.1);
                transform: translateY(-2px);
            }

            .nav-links a::after {
                content: '';
                position: absolute;
                bottom: -5px;
                left: 50%;
                width: 0;
                height: 2px;
                background: var(--verde-selva);
                transition: all 0.3s ease;
                transform: translateX(-50%);
            }

            .nav-links a:hover::after {
                width: 80%;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--verde-selva), var(--verde-claro));
                color: white;
                padding: 0.8rem 2rem;
                border: none;
                border-radius: 50px;
                font-weight: 600;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.3s ease;
                box-shadow: 0 4px 15px rgba(5, 150, 105, 0.3);
            }

            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px rgba(5, 150, 105, 0.4);
            }

            /* Video Hero Section */
            .hero {
                position: relative;
                height: 100vh;
                min-height: 600px;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                color: white;
                overflow: hidden;
                /* Fallback background image */
                background: url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=1920&h=1080&fit=crop&crop=center') center/cover no-repeat;
            }

            .hero-video {
                position: absolute;
                top: 50%;
                left: 50%;
                min-width: 100%;
                min-height: 100%;
                width: auto;
                height: auto;
                transform: translateX(-50%) translateY(-50%);
                z-index: 1;
                object-fit: cover;
                opacity: 1;
                transition: opacity 1s ease-in-out;
                background: transparent;
            }

            /* Hide ALL video controls completely - All browsers */
            .hero-video::-webkit-media-controls {
                display: none !important;
                -webkit-appearance: none !important;
            }
            
            .hero-video::-webkit-media-controls-panel {
                display: none !important;
            }
            
            .hero-video::-webkit-media-controls-play-button {
                display: none !important;
            }
            
            .hero-video::-webkit-media-controls-start-playback-button {
                display: none !important;
            }

            .hero-video::-webkit-media-controls-enclosure {
                display: none !important;
            }

            .hero-video::-webkit-media-controls-timeline {
                display: none !important;
            }

            .hero-video::-webkit-media-controls-current-time-display {
                display: none !important;
            }

            .hero-video::-webkit-media-controls-time-remaining-display {
                display: none !important;
            }

            .hero-video::-webkit-media-controls-mute-button {
                display: none !important;
            }

            .hero-video::-webkit-media-controls-toggle-closed-captions-button {
                display: none !important;
            }

            .hero-video::-webkit-media-controls-volume-slider {
                display: none !important;
            }

            .hero-video::-webkit-media-controls-fullscreen-button {
                display: none !important;
            }

            .hero-video::-webkit-media-controls-rewind-button {
                display: none !important;
            }

            .hero-video::-webkit-media-controls-return-to-realtime-button {
                display: none !important;
            }

            .hero-video::-webkit-media-controls-seek-back-button {
                display: none !important;
            }

            .hero-video::-webkit-media-controls-seek-forward-button {
                display: none !important;
            }

            /* Firefox */
            .hero-video::-moz-media-controls {
                display: none !important;
            }

            /* IE/Edge */
            .hero-video::-ms-media-controls {
                display: none !important;
            }

            /* Video loaded state */
            .hero-video.loaded {
                opacity: 1;
            }

            /* Hide video if it fails to load */
            .hero-video:not([src]) {
                display: none;
            }

            /* Ensure video covers entire hero section */
            .hero-video {
                min-width: 100vw;
                min-height: 100vh;
            }

            /* Additional anti-control measures */
            .hero-video {
                outline: none;
                border: none;
                user-select: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
            }

            .hero-video:focus {
                outline: none;
            }

            /* Prevent video from showing controls on mobile */
            @media (max-width: 768px) {
                .hero-video::-webkit-media-controls {
                    display: none !important;
                }
                
                .hero-video {
                    pointer-events: none !important;
                }
            }

            .hero-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, 
                    rgba(5, 150, 105, 0.8) 0%, 
                    rgba(16, 185, 129, 0.7) 30%,
                    rgba(234, 88, 12, 0.75) 70%,
                    rgba(217, 119, 6, 0.85) 100%);
                z-index: 2;
                pointer-events: none;
            }

            /* Add subtle pattern overlay for texture */
            .hero-overlay::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0);
                background-size: 40px 40px;
                opacity: 0.4;
                z-index: 1;
                pointer-events: none;
            }

            /* Add additional overlay for better text readability */
            .hero-overlay::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: radial-gradient(ellipse at center, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.4) 100%);
                z-index: 2;
                pointer-events: none;
            }

            .hero-content {
                max-width: 900px;
                z-index: 100;
                animation: heroFadeIn 2.5s ease-out;
                padding: 2rem;
                position: relative;
            }

            .hero-content::before {
                content: '';
                position: absolute;
                top: -2rem;
                left: -2rem;
                right: -2rem;
                bottom: -2rem;
                background: radial-gradient(ellipse at center, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.2) 50%, transparent 80%);
                border-radius: 40px;
                z-index: -1;
                backdrop-filter: blur(2px);
                -webkit-backdrop-filter: blur(2px);
            }

            .hero h1 {
                font-family: 'Poppins', sans-serif;
                font-size: clamp(2.5rem, 8vw, 4.5rem);
                font-weight: 800;
                margin-bottom: 1.5rem;
                text-shadow: 
                    3px 3px 6px rgba(0, 0, 0, 0.8),
                    0px 0px 20px rgba(0, 0, 0, 0.5),
                    0px 0px 40px rgba(0, 0, 0, 0.3);
                color: white;
                line-height: 1.2;
                letter-spacing: -0.02em;
                position: relative;
                z-index: 10;
            }

            .hero h1 span {
                background: linear-gradient(135deg, var(--amarillo-dorado), #FCD34D, #F59E0B);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                text-shadow: none;
                display: inline-block;
                animation: glow 3s ease-in-out infinite alternate;
                position: relative;
            }

            /* Add stroke effect to the golden text for better visibility */
            .hero h1 span::before {
                content: attr(data-text);
                position: absolute;
                top: 0;
                left: 0;
                z-index: -1;
                -webkit-text-stroke: 2px rgba(0, 0, 0, 0.5);
                -webkit-text-fill-color: transparent;
            }

            .hero p {
                font-size: clamp(1.1rem, 3vw, 1.4rem);
                margin-bottom: 2.5rem;
                opacity: 1;
                text-shadow: 
                    2px 2px 4px rgba(0, 0, 0, 0.8),
                    0px 0px 15px rgba(0, 0, 0, 0.6);
                line-height: 1.6;
                max-width: 700px;
                margin-left: auto;
                margin-right: auto;
                color: rgba(255, 255, 255, 0.95);
                font-weight: 400;
                position: relative;
                z-index: 10;
            }

            .hero-buttons {
                display: flex;
                gap: 1rem;
                justify-content: center;
                flex-wrap: wrap;
                margin-bottom: 3rem;
                position: relative;
                z-index: 50;
            }

            .btn-hero {
                padding: 1.2rem 2.8rem;
                border-radius: 50px;
                font-weight: 600;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 0.8rem;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                font-size: 1.1rem;
                position: relative;
                overflow: hidden;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .btn-hero::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
                transition: left 0.6s ease;
            }

            .btn-hero:hover::before {
                left: 100%;
            }

            .btn-hero.primary {
                background: rgba(255, 255, 255, 0.25);
                color: white;
                border: 2px solid rgba(255, 255, 255, 0.4);
                backdrop-filter: blur(15px);
                -webkit-backdrop-filter: blur(15px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            }

            .btn-hero.primary:hover {
                background: rgba(255, 255, 255, 0.95);
                color: var(--verde-selva);
                transform: translateY(-4px) scale(1.02);
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
                border-color: rgba(255, 255, 255, 0.8);
            }

            .btn-hero.secondary {
                background: linear-gradient(135deg, rgba(234, 88, 12, 0.9), rgba(217, 119, 6, 0.9));
                color: white;
                border: 2px solid rgba(234, 88, 12, 0.5);
                box-shadow: 0 8px 25px rgba(234, 88, 12, 0.3);
            }

            .btn-hero.secondary:hover {
                background: linear-gradient(135deg, var(--naranja-atardecer), var(--amarillo-dorado));
                transform: translateY(-4px) scale(1.02);
                box-shadow: 0 15px 40px rgba(234, 88, 12, 0.4);
                border-color: rgba(234, 88, 12, 0.8);
            }

            /* Search Bar Hero */
            .hero-search {
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(25px);
                -webkit-backdrop-filter: blur(25px);
                border: 2px solid rgba(255, 255, 255, 0.3);
                border-radius: 60px;
                padding: 1.2rem 2.5rem;
                display: flex;
                align-items: center;
                gap: 1.2rem;
                max-width: 550px;
                margin: 0 auto;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                position: relative;
                z-index: 40;
            }

            .hero-search:hover {
                background: rgba(255, 255, 255, 0.25);
                transform: translateY(-3px);
                box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
                border-color: rgba(255, 255, 255, 0.5);
            }

            .hero-search:focus-within {
                background: rgba(255, 255, 255, 0.3);
                border-color: rgba(255, 255, 255, 0.6);
                transform: translateY(-3px) scale(1.02);
            }

            .hero-search input {
                background: none;
                border: none;
                color: white;
                font-size: 1.1rem;
                flex: 1;
                outline: none;
            }

            .hero-search input::placeholder {
                color: rgba(255, 255, 255, 0.7);
            }

            .hero-search button {
                background: var(--naranja-atardecer);
                border: none;
                color: white;
                padding: 0.8rem 1.5rem;
                border-radius: 40px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .hero-search button:hover {
                background: #DC2626;
                transform: scale(1.05);
            }

            /* Stats */
            .hero-stats {
                display: flex;
                justify-content: center;
                gap: 3rem;
                margin-top: 3rem;
                position: relative;
                z-index: 30;
            }

            .stat-item {
                text-align: center;
                background: rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(15px);
                -webkit-backdrop-filter: blur(15px);
                padding: 2rem 1.5rem;
                border-radius: 25px;
                border: 2px solid rgba(255, 255, 255, 0.25);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                position: relative;
                overflow: hidden;
            }

            .stat-item::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, var(--verde-claro), var(--amarillo-dorado), var(--naranja-atardecer));
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .stat-item:hover {
                transform: translateY(-8px) scale(1.03);
                background: rgba(255, 255, 255, 0.25);
                box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
                border-color: rgba(255, 255, 255, 0.4);
            }

            .stat-item:hover::before {
                opacity: 1;
            }

            .stat-number {
                font-family: 'Poppins', sans-serif;
                font-size: 2.5rem;
                font-weight: 800;
                color: white;
                margin-bottom: 0.5rem;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            }

            .stat-label {
                font-size: 0.9rem;
                opacity: 0.9;
                font-weight: 500;
            }

            /* Scroll Indicator */
            .scroll-indicator {
                position: absolute;
                bottom: 2rem;
                left: 50%;
                transform: translateX(-50%);
                color: white;
                text-align: center;
                animation: bounce 2s infinite;
                z-index: 20;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            }

            .scroll-indicator i {
                font-size: 2rem;
                opacity: 0.8;
            }

            /* Keyframes */
            @keyframes heroFadeIn {
                0% {
                    opacity: 0;
                    transform: translateY(30px);
                }
                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes bounce {
                0%, 20%, 50%, 80%, 100% {
                    transform: translateX(-50%) translateY(0);
                }
                40% {
                    transform: translateX(-50%) translateY(-10px);
                }
                60% {
                    transform: translateX(-50%) translateY(-5px);
                }
            }

            @keyframes float {
                0%, 100% {
                    transform: translateY(0px);
                }
                50% {
                    transform: translateY(-20px);
                }
            }

            /* Mobile Responsiveness */
            @media (max-width: 768px) {
                .nav-links {
                    display: none;
                }
                
                .hero {
                    min-height: 100vh;
                    padding: 0 1rem;
                }
                
                .hero-content {
                    padding: 1rem;
                    max-width: 100%;
                }
                
                .hero h1 {
                    font-size: clamp(2rem, 8vw, 3rem);
                    margin-bottom: 1rem;
                }
                
                .hero p {
                    font-size: clamp(1rem, 4vw, 1.2rem);
                    margin-bottom: 2rem;
                }
                
                .hero-buttons {
                    flex-direction: column;
                    align-items: center;
                    gap: 1rem;
                }
                
                .btn-hero {
                    padding: 1rem 2rem;
                    font-size: 1rem;
                    width: 100%;
                    max-width: 280px;
                    justify-content: center;
                }
                
                .hero-search {
                    max-width: 90%;
                    padding: 1rem 1.5rem;
                }
                
                .hero-stats {
                    flex-direction: column;
                    gap: 1rem;
                    margin-top: 2rem;
                }
                
                .stat-item {
                    margin: 0 auto;
                    max-width: 250px;
                    width: 100%;
                    padding: 1.5rem;
                }
                
                .scroll-indicator {
                    bottom: 1rem;
                }
            }

            @media (min-width: 769px) and (max-width: 1024px) {
                .hero h1 {
                    font-size: 3.5rem;
                }
                
                .hero-content {
                    max-width: 800px;
                }
                
                .btn-hero {
                    padding: 1.1rem 2.4rem;
                }
            }

            /* Loading Animation */
            .loading {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, var(--verde-selva), var(--verde-claro));
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
                transition: opacity 0.5s ease;
            }

            .loading.fade-out {
                opacity: 0;
                pointer-events: none;
            }

            .loading-spinner {
                width: 50px;
                height: 50px;
                border: 3px solid rgba(255, 255, 255, 0.3);
                border-top: 3px solid white;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            /* Category Cards */
            .category-card {
                background: white;
                padding: 2rem;
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .category-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
                transition: left 0.5s ease;
            }

            .category-card:hover::before {
                left: 100%;
            }

            .category-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            }

            .category-icon {
                width: 80px;
                height: 80px;
                margin: 0 auto 1.5rem;
                background: linear-gradient(135deg, var(--verde-selva), var(--verde-claro));
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 2rem;
                transition: all 0.3s ease;
            }

            .category-card:hover .category-icon {
                transform: scale(1.1) rotate(5deg);
            }

            .category-card h3 {
                font-family: 'Poppins', sans-serif;
                font-size: 1.5rem;
                font-weight: 600;
                color: var(--verde-selva);
                margin-bottom: 1rem;
            }

            .category-card p {
                color: var(--gris-medio);
                margin-bottom: 1.5rem;
                line-height: 1.6;
            }

            .category-stats {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 1rem;
            }

            .category-stats span:first-child {
                color: var(--gris-medio);
                font-size: 0.9rem;
            }

            .trending, .popular, .eco, .cultural, .heritage, .wellness {
                padding: 0.3rem 0.8rem;
                border-radius: 15px;
                font-size: 0.8rem;
                font-weight: 600;
            }

            .trending { background: linear-gradient(135deg, #FF6B6B, #FF8E53); color: white; }
            .popular { background: linear-gradient(135deg, #4ECDC4, #44A08D); color: white; }
            .eco { background: linear-gradient(135deg, #A8E6CF, #88D8C0); color: var(--verde-oscuro); }
            .cultural { background: linear-gradient(135deg, #FFD93D, #FF6B6B); color: white; }
            .heritage { background: linear-gradient(135deg, #6C5CE7, #A29BFE); color: white; }
            .wellness { background: linear-gradient(135deg, #FD79A8, #E17055); color: white; }

            /* Tour Cards */
            .tour-card {
                background: white;
                border-radius: 25px;
                overflow: hidden;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
                position: relative;
            }

            .tour-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            }

            .tour-image {
                position: relative;
                height: 250px;
                overflow: hidden;
            }

            .tour-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .tour-card:hover .tour-image img {
                transform: scale(1.1);
            }

            .tour-badge {
                position: absolute;
                top: 1rem;
                left: 1rem;
                padding: 0.5rem 1rem;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .tour-badge.flash {
                background: linear-gradient(135deg, #FF3B30, #FF9500);
                color: white;
                animation: pulse 2s infinite;
            }

            .tour-badge.popular {
                background: linear-gradient(135deg, #34C759, #30D158);
                color: white;
            }

            .tour-badge.new {
                background: linear-gradient(135deg, #007AFF, #5856D6);
                color: white;
            }

            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }

            .tour-rating {
                position: absolute;
                top: 1rem;
                right: 1rem;
                background: rgba(0, 0, 0, 0.7);
                color: white;
                padding: 0.5rem 0.8rem;
                border-radius: 20px;
                font-size: 0.8rem;
                backdrop-filter: blur(10px);
            }

            .tour-content {
                padding: 1.5rem;
            }

            .tour-header {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                margin-bottom: 1rem;
            }

            .tour-header h3 {
                font-family: 'Poppins', sans-serif;
                font-size: 1.3rem;
                font-weight: 600;
                color: var(--verde-selva);
                flex: 1;
                margin-right: 1rem;
            }

            .difficulty-badge {
                padding: 0.3rem 0.8rem;
                border-radius: 15px;
                font-size: 0.7rem;
                font-weight: 600;
                text-transform: uppercase;
            }

            .difficulty-badge.easy { background: #D1FAE5; color: #065F46; }
            .difficulty-badge.moderate { background: #FEF3C7; color: #92400E; }
            .difficulty-badge.expert { background: #FEE2E2; color: #991B1B; }

            .tour-features {
                display: flex;
                gap: 1rem;
                margin: 1rem 0;
                flex-wrap: wrap;
            }

            .tour-features span {
                display: flex;
                align-items: center;
                gap: 0.3rem;
                color: var(--gris-medio);
                font-size: 0.9rem;
            }

            .tour-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 1.5rem;
            }

            .price {
                display: flex;
                flex-direction: column;
            }

            .price .original {
                text-decoration: line-through;
                color: var(--gris-medio);
                font-size: 0.9rem;
            }

            .price .current {
                font-family: 'Poppins', sans-serif;
                font-size: 1.8rem;
                font-weight: 700;
                color: var(--verde-selva);
            }

            .price .currency {
                font-size: 0.8rem;
                color: var(--gris-medio);
            }

            .tour-actions {
                display: flex;
                gap: 0.5rem;
                align-items: center;
            }

            .btn-tour {
                border: none;
                border-radius: 25px;
                padding: 0.8rem 1.5rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .btn-tour.wishlist {
                background: var(--gris-claro);
                color: var(--gris-medio);
                padding: 0.8rem;
            }

            .btn-tour.wishlist:hover {
                background: #FEE2E2;
                color: #DC2626;
            }

            .btn-tour.book {
                background: linear-gradient(135deg, var(--verde-selva), var(--verde-claro));
                color: white;
            }

            .btn-tour.book:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(5, 150, 105, 0.3);
            }

            .tour-urgency, .tour-popularity, .tour-new {
                margin-top: 1rem;
                padding: 0.8rem;
                border-radius: 10px;
                font-size: 0.9rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .tour-urgency {
                background: #FEF2F2;
                color: #B91C1C;
                border: 1px solid #FECACA;
            }

            .tour-popularity {
                background: #FEF3C7;
                color: #92400E;
                border: 1px solid #FDE68A;
            }

            .tour-new {
                background: #EFF6FF;
                color: #1D4ED8;
                border: 1px solid #DBEAFE;
            }

            /* CTA Buttons */
            .btn-cta, .btn-cta-large {
                display: inline-flex;
                align-items: center;
                gap: 1rem;
                padding: 1.2rem 2.5rem;
                background: linear-gradient(135deg, var(--verde-selva), var(--verde-claro));
                color: white;
                text-decoration: none;
                border-radius: 50px;
                font-weight: 600;
                font-size: 1.1rem;
                transition: all 0.3s ease;
                box-shadow: 0 8px 25px rgba(5, 150, 105, 0.3);
                position: relative;
                overflow: hidden;
            }

            .btn-cta-large {
                padding: 1.5rem 3rem;
                font-size: 1.2rem;
            }

            .btn-cta-large.secondary {
                background: rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(10px);
                border: 2px solid rgba(255, 255, 255, 0.3);
            }

            .btn-cta:hover, .btn-cta-large:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 35px rgba(5, 150, 105, 0.4);
            }

            .btn-arrow {
                transition: transform 0.3s ease;
            }

            .btn-cta:hover .btn-arrow {
                transform: translateX(5px);
            }

            /* Achievement Badges */
            .achievement-badge {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 20px;
                padding: 2rem;
                text-align: center;
                transition: all 0.3s ease;
                max-width: 200px;
            }

            .achievement-badge:hover {
                transform: translateY(-5px);
                background: rgba(255, 255, 255, 0.2);
            }

            .badge-icon {
                width: 80px;
                height: 80px;
                margin: 0 auto 1rem;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 2rem;
                transition: all 0.3s ease;
            }

            .badge-icon.unlocked {
                background: linear-gradient(135deg, var(--amarillo-dorado), #FCD34D);
                box-shadow: 0 0 20px rgba(217, 119, 6, 0.5);
                animation: glow 2s ease-in-out infinite alternate;
            }

            .badge-icon.locked {
                background: rgba(255, 255, 255, 0.1);
                color: rgba(255, 255, 255, 0.5);
            }

            @keyframes glow {
                from { box-shadow: 0 0 20px rgba(217, 119, 6, 0.5); }
                to { box-shadow: 0 0 30px rgba(217, 119, 6, 0.8); }
            }

            .achievement-badge h4 {
                color: white;
                font-weight: 600;
                margin-bottom: 0.5rem;
            }

            .achievement-badge p {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
                margin-bottom: 1rem;
            }

            .progress-bar {
                background: rgba(255, 255, 255, 0.2);
                height: 8px;
                border-radius: 4px;
                overflow: hidden;
                margin-bottom: 0.5rem;
            }

            .progress {
                background: linear-gradient(135deg, var(--amarillo-dorado), #FCD34D);
                height: 100%;
                border-radius: 4px;
                transition: width 0.3s ease;
            }

            .progress-text {
                color: rgba(255, 255, 255, 0.9);
                font-size: 0.8rem;
                font-weight: 600;
            }

            /* Testimonials */
            .testimonials-slider {
                position: relative;
                max-width: 800px;
                margin: 0 auto;
            }

            .testimonial {
                display: none;
                opacity: 0;
                transition: opacity 0.5s ease;
            }

            .testimonial.active {
                display: block;
                opacity: 1;
            }

            .testimonial-content {
                background: var(--gris-claro);
                padding: 3rem;
                border-radius: 25px;
                text-align: center;
                position: relative;
            }

            .testimonial-content::before {
                content: '"';
                position: absolute;
                top: -10px;
                left: 30px;
                font-size: 4rem;
                color: var(--verde-selva);
                font-family: serif;
                opacity: 0.3;
            }

            .stars {
                font-size: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .testimonial p {
                font-size: 1.2rem;
                line-height: 1.8;
                color: var(--gris-oscuro);
                margin-bottom: 2rem;
                font-style: italic;
            }

            .testimonial-author {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 1rem;
            }

            .testimonial-author img {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                object-fit: cover;
                border: 3px solid var(--verde-selva);
            }

            .testimonial-author h4 {
                color: var(--verde-selva);
                font-weight: 600;
                margin-bottom: 0.3rem;
            }

            .testimonial-author span {
                color: var(--gris-medio);
                font-size: 0.9rem;
            }

            .verified {
                color: var(--verde-claro);
                font-size: 0.8rem;
                font-weight: 600;
                margin-top: 0.3rem;
            }

            .testimonial-navigation {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 2rem;
                margin-top: 2rem;
            }

            .nav-btn {
                background: var(--verde-selva);
                color: white;
                border: none;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                font-size: 1.5rem;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .nav-btn:hover {
                transform: scale(1.1);
                background: var(--verde-claro);
            }

            .testimonial-dots {
                display: flex;
                gap: 1rem;
            }

            .dot {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                background: var(--gris-medio);
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .dot.active {
                background: var(--verde-selva);
                transform: scale(1.3);
            }

            /* Floating Elements */
            .floating-elements {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
            }

            .float-icon {
                position: absolute;
                font-size: 2rem;
                opacity: 0.3;
                animation: float 6s ease-in-out infinite;
            }

            /* Countdown Timer */
            #countdown {
                font-family: 'Poppins', sans-serif;
                font-size: 1.2rem;
                font-weight: 700;
            }

            /* Container utility */
            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 2rem;
            }

            /* Mobile Responsiveness for new sections */
            @media (max-width: 768px) {
                .category-card, .tour-card {
                    margin: 0 auto;
                    max-width: 400px;
                }
                
                .hero-stats, .hero-buttons {
                    flex-direction: column;
                    align-items: center;
                    gap: 1rem;
                }
                
                .tour-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 1rem;
                }
                
                .tour-footer {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 1rem;
                }
                
                .testimonial-author {
                    flex-direction: column;
                    text-align: center;
                }
                
                .btn-cta-large {
                    padding: 1.2rem 2rem;
                    font-size: 1rem;
                }
            }
        </style>
    @endif
</head>
<body>
    <!-- Loading Screen -->
    <div class="loading" id="loading">
        <div class="loading-spinner"></div>
    </div>

    <!-- Glassmorphism Navigation -->
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <a href="/" class="logo">
                <i class="fas fa-leaf"></i>
                Chanchamayo Tours
            </a>
            <ul class="nav-links">
                <li><a href="/">Inicio</a></li>
                <li><a href="/tours">Tours</a></li>
                <li><a href="#categorias">Categorías</a></li>
                <li><a href="#empresas">Empresas</a></li>
                <li><a href="#contacto">Contacto</a></li>
                @auth
                    <li><a href="/dashboard">Dashboard</a></li>
                @else
                    <li><a href="/login">Iniciar Sesión</a></li>
                    <li><a href="/register" class="btn-primary">Registrarse</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Video Hero Section -->
    <section class="hero">
        <video class="hero-video" 
               autoplay 
               muted 
               loop 
               playsinline 
               id="heroVideo" 
               preload="metadata"
               disablePictureInPicture
               webkit-playsinline
               x5-playsinline
               controls="false"
               controlsList="nodownload nofullscreen noremoteplaybook noplaybackrate"
               style="pointer-events: none;">
            <!-- Tu video local de Chanchamayo -->
            <source src="/videos/hero-background.mp4" type="video/mp4">
            <!-- Fallback para navegadores que no soporten video -->
            <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=1920&h=1080&fit=crop&crop=center" alt="Chanchamayo Waterfall" style="width: 100%; height: 100%; object-fit: cover;">
        </video>
        <div class="hero-overlay"></div>
        
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1500">
            <h1>Descubre la Magia de <br><span data-text="Chanchamayo">Chanchamayo</span></h1>
            <p>La selva central del Perú te espera con aventuras únicas, naturaleza exuberante y experiencias que cambiarán tu vida para siempre.</p>
            
            <div class="hero-buttons">
                <a href="/tours" class="btn-hero primary">
                    <i class="fas fa-compass"></i>
                    Explorar Tours
                </a>
                <a href="#video-tour" class="btn-hero secondary">
                    <i class="fas fa-play"></i>
                    Ver Video Tour
                </a>
            </div>

            <div class="hero-search" data-aos="fade-up" data-aos-delay="300">
                <i class="fas fa-search" style="color: rgba(255,255,255,0.7);"></i>
                <input type="text" placeholder="¿Qué aventura buscas? Ej: Rafting, Cascadas, Café...">
                <button type="submit">
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>

            <div class="hero-stats" data-aos="fade-up" data-aos-delay="600">
                <div class="stat-item">
                    <div class="stat-number counter" data-target="500">0</div>
                    <div class="stat-label">Tours Realizados</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number counter" data-target="1200">0</div>
                    <div class="stat-label">Clientes Felices</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number counter" data-target="25">0</div>
                    <div class="stat-label">Empresas Locales</div>
                </div>
            </div>
        </div>

        <div class="scroll-indicator" data-aos="fade-up" data-aos-delay="1000">
            <i class="fas fa-chevron-down"></i>
            <p style="margin-top: 0.5rem; font-size: 0.9rem;">Desliza para descubrir más</p>
        </div>
    </section>

    <!-- Categorías de Tours -->
    <section id="categorias" style="padding: 100px 0; background: var(--gris-claro);">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <div style="text-align: center; margin-bottom: 4rem;" data-aos="fade-up">
                <h2 style="font-family: 'Poppins', sans-serif; font-size: 3rem; font-weight: 700; color: var(--verde-selva); margin-bottom: 1rem;">
                    Aventuras para Todos los Gustos
                </h2>
                <p style="font-size: 1.2rem; color: var(--gris-medio); max-width: 600px; margin: 0 auto;">
                    Desde emocionantes deportes de aventura hasta relajantes tours culturales
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
                <div class="category-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="category-icon">
                        <i class="fas fa-water"></i>
                    </div>
                    <h3>Deportes Acuáticos</h3>
                    <p>Rafting, kayak y pesca en los ríos más cristalinos de la selva</p>
                    <div class="category-stats">
                        <span><i class="fas fa-fire"></i> 12 Tours Disponibles</span>
                        <span class="trending">¡TRENDING! 🔥</span>
                    </div>
                </div>

                <div class="category-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="category-icon">
                        <i class="fas fa-mountain"></i>
                    </div>
                    <h3>Aventura Extrema</h3>
                    <p>Canopy, escalada y trekking para los más aventureros</p>
                    <div class="category-stats">
                        <span><i class="fas fa-fire"></i> 8 Tours Disponibles</span>
                        <span class="popular">MÁS POPULAR ⭐</span>
                    </div>
                </div>

                <div class="category-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="category-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3>Naturaleza & Fauna</h3>
                    <p>Observación de aves, caminatas ecológicas y fotografía</p>
                    <div class="category-stats">
                        <span><i class="fas fa-fire"></i> 15 Tours Disponibles</span>
                        <span class="eco">ECO-FRIENDLY 🌱</span>
                    </div>
                </div>

                <div class="category-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="category-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>Turismo Rural</h3>
                    <p>Granjas de café, vivencias campestres y gastronomía local</p>
                    <div class="category-stats">
                        <span><i class="fas fa-fire"></i> 10 Tours Disponibles</span>
                        <span class="cultural">AUTÉNTICO 🏘️</span>
                    </div>
                </div>

                <div class="category-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="category-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <h3>Turismo Cultural</h3>
                    <p>Historia, tradiciones y artesanías de los pueblos locales</p>
                    <div class="category-stats">
                        <span><i class="fas fa-fire"></i> 7 Tours Disponibles</span>
                        <span class="heritage">PATRIMONIO 🏛️</span>
                    </div>
                </div>

                <div class="category-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="category-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h3>Relax & Bienestar</h3>
                    <p>Aguas termales, spas naturales y meditación en la selva</p>
                    <div class="category-stats">
                        <span><i class="fas fa-fire"></i> 6 Tours Disponibles</span>
                        <span class="wellness">BIENESTAR 🧘</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tours Destacados con Gamificación -->
    <section style="padding: 100px 0; background: white;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <div style="text-align: center; margin-bottom: 4rem;" data-aos="fade-up">
                <div style="display: inline-flex; align-items: center; gap: 1rem; background: linear-gradient(135deg, var(--naranja-atardecer), var(--amarillo-dorado)); color: white; padding: 1rem 2rem; border-radius: 50px; margin-bottom: 2rem;">
                    <i class="fas fa-fire" style="animation: float 2s ease-in-out infinite;"></i>
                    <span style="font-weight: 600;">¡OFERTAS FLASH!</span>
                    <div id="countdown" style="font-family: monospace; font-weight: 700;"></div>
                </div>
                <h2 style="font-family: 'Poppins', sans-serif; font-size: 3rem; font-weight: 700; color: var(--verde-selva); margin-bottom: 1rem;">
                    Tours Destacados de la Semana
                </h2>
                <p style="font-size: 1.2rem; color: var(--gris-medio);">
                    Las experiencias más populares seleccionadas por nuestros aventureros
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 2rem;">
                <div class="tour-card featured" data-aos="fade-up" data-aos-delay="100">
                    <div class="tour-image">
                        <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=400" alt="Rafting Chanchamayo">
                        <div class="tour-badge flash">FLASH SALE -30%</div>
                        <div class="tour-rating">
                            <i class="fas fa-star"></i> 4.9 (127 reviews)
                        </div>
                    </div>
                    <div class="tour-content">
                        <div class="tour-header">
                            <h3>Rafting Extremo en Río Perené</h3>
                            <div class="difficulty-badge expert">EXPERTO</div>
                        </div>
                        <p>Desciende los rápidos más emocionantes de la selva central con guías certificados</p>
                        <div class="tour-features">
                            <span><i class="fas fa-clock"></i> 6 horas</span>
                            <span><i class="fas fa-users"></i> Max 8 personas</span>
                            <span><i class="fas fa-shield-alt"></i> Seguro incluido</span>
                        </div>
                        <div class="tour-footer">
                            <div class="price">
                                <span class="original">S/ 280</span>
                                <span class="current">S/ 196</span>
                                <span class="currency">por persona</span>
                            </div>
                            <div class="tour-actions">
                                <button class="btn-tour wishlist"><i class="far fa-heart"></i></button>
                                <button class="btn-tour book">Reservar Ahora</button>
                            </div>
                        </div>
                        <div class="tour-urgency">
                            <i class="fas fa-exclamation-circle"></i>
                            Solo quedan 3 cupos disponibles
                        </div>
                    </div>
                </div>

                <div class="tour-card popular" data-aos="fade-up" data-aos-delay="200">
                    <div class="tour-image">
                        <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=400" alt="Catarata El Tirol">
                        <div class="tour-badge popular">MÁS POPULAR</div>
                        <div class="tour-rating">
                            <i class="fas fa-star"></i> 5.0 (89 reviews)
                        </div>
                    </div>
                    <div class="tour-content">
                        <div class="tour-header">
                            <h3>Catarata El Tirol & Aguas Termales</h3>
                            <div class="difficulty-badge moderate">MODERADO</div>
                        </div>
                        <p>Combina aventura y relajación en este tour completo por la naturaleza</p>
                        <div class="tour-features">
                            <span><i class="fas fa-clock"></i> 8 horas</span>
                            <span><i class="fas fa-users"></i> Max 12 personas</span>
                            <span><i class="fas fa-utensils"></i> Almuerzo incluido</span>
                        </div>
                        <div class="tour-footer">
                            <div class="price">
                                <span class="current">S/ 150</span>
                                <span class="currency">por persona</span>
                            </div>
                            <div class="tour-actions">
                                <button class="btn-tour wishlist"><i class="far fa-heart"></i></button>
                                <button class="btn-tour book">Reservar Ahora</button>
                            </div>
                        </div>
                        <div class="tour-popularity">
                            <i class="fas fa-fire"></i>
                            Reservado 23 veces esta semana
                        </div>
                    </div>
                </div>

                <div class="tour-card new" data-aos="fade-up" data-aos-delay="300">
                    <div class="tour-image">
                        <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400" alt="Tour del Café">
                        <div class="tour-badge new">¡NUEVO!</div>
                        <div class="tour-rating">
                            <i class="fas fa-star"></i> 4.8 (34 reviews)
                        </div>
                    </div>
                    <div class="tour-content">
                        <div class="tour-header">
                            <h3>Ruta del Café Gourmet</h3>
                            <div class="difficulty-badge easy">FÁCIL</div>
                        </div>
                        <p>Descubre el proceso del café desde el grano hasta la taza en fincas locales</p>
                        <div class="tour-features">
                            <span><i class="fas fa-clock"></i> 5 horas</span>
                            <span><i class="fas fa-users"></i> Max 15 personas</span>
                            <span><i class="fas fa-coffee"></i> Degustación incluida</span>
                        </div>
                        <div class="tour-footer">
                            <div class="price">
                                <span class="current">S/ 120</span>
                                <span class="currency">por persona</span>
                            </div>
                            <div class="tour-actions">
                                <button class="btn-tour wishlist"><i class="far fa-heart"></i></button>
                                <button class="btn-tour book">Reservar Ahora</button>
                            </div>
                        </div>
                        <div class="tour-new">
                            <i class="fas fa-sparkles"></i>
                            ¡Obtén 20% de descuento en tu primera reserva!
                        </div>
                    </div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 3rem;">
                <a href="/tours" class="btn-cta" data-aos="fade-up">
                    <i class="fas fa-compass"></i>
                    Ver Todos los Tours
                    <span class="btn-arrow">→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Gamificación - Sistema de Logros -->
    <section style="padding: 80px 0; background: linear-gradient(135deg, var(--verde-selva), var(--verde-claro));">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 2rem; text-align: center;">
            <h2 style="font-family: 'Poppins', sans-serif; font-size: 2.5rem; font-weight: 700; color: white; margin-bottom: 2rem;" data-aos="fade-up">
                🏆 Sistema de Logros Aventureros
            </h2>
            <p style="color: rgba(255,255,255,0.9); font-size: 1.1rem; margin-bottom: 3rem;" data-aos="fade-up" data-aos-delay="100">
                Completa tours, escribe reseñas y desbloquea insignias exclusivas
            </p>

            <div style="display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap;">
                <div class="achievement-badge" data-aos="zoom-in" data-aos-delay="200">
                    <div class="badge-icon unlocked">🌊</div>
                    <h4>Explorador Acuático</h4>
                    <p>Completa 3 tours acuáticos</p>
                    <div class="progress-bar">
                        <div class="progress" style="width: 66%;"></div>
                    </div>
                    <span class="progress-text">2/3 tours</span>
                </div>

                <div class="achievement-badge" data-aos="zoom-in" data-aos-delay="300">
                    <div class="badge-icon unlocked">⭐</div>
                    <h4>Crítico Experto</h4>
                    <p>Escribe 10 reseñas detalladas</p>
                    <div class="progress-bar">
                        <div class="progress" style="width: 100%;"></div>
                    </div>
                    <span class="progress-text">¡COMPLETADO!</span>
                </div>

                <div class="achievement-badge" data-aos="zoom-in" data-aos-delay="400">
                    <div class="badge-icon locked">🏔️</div>
                    <h4>Conquistador de Cimas</h4>
                    <p>Completa 5 tours de montaña</p>
                    <div class="progress-bar">
                        <div class="progress" style="width: 20%;"></div>
                    </div>
                    <span class="progress-text">1/5 tours</span>
                </div>

                <div class="achievement-badge" data-aos="zoom-in" data-aos-delay="500">
                    <div class="badge-icon locked">☕</div>
                    <h4>Maestro Cafetero</h4>
                    <p>Completa todos los tours de café</p>
                    <div class="progress-bar">
                        <div class="progress" style="width: 0%;"></div>
                    </div>
                    <span class="progress-text">0/4 tours</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios Interactivos -->
    <section style="padding: 100px 0; background: white;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
            <div style="text-align: center; margin-bottom: 4rem;" data-aos="fade-up">
                <h2 style="font-family: 'Poppins', sans-serif; font-size: 3rem; font-weight: 700; color: var(--verde-selva); margin-bottom: 1rem;">
                    Historias de Aventureros Reales
                </h2>
                <p style="font-size: 1.2rem; color: var(--gris-medio);">
                    Más de 1,200 viajeros han vivido experiencias únicas en Chanchamayo
                </p>
            </div>

            <div class="testimonials-slider" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial active">
                    <div class="testimonial-content">
                        <div class="stars">⭐⭐⭐⭐⭐</div>
                        <p>"¡Increíble experiencia de rafting! Los guías súper profesionales y la naturaleza espectacular. Definitivamente volveré por más aventuras."</p>
                        <div class="testimonial-author">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=60&h=60&fit=crop&crop=face" alt="María González">
                            <div>
                                <h4>María González</h4>
                                <span>Aventurera desde Lima</span>
                                <div class="verified">✓ Viajero Verificado</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial">
                    <div class="testimonial-content">
                        <div class="stars">⭐⭐⭐⭐⭐</div>
                        <p>"El tour del café cambió mi perspectiva sobre esta bebida. Aprendí tanto y la experiencia fue auténtica y educativa."</p>
                        <div class="testimonial-author">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=60&h=60&fit=crop&crop=face" alt="Carlos Mendoza">
                            <div>
                                <h4>Carlos Mendoza</h4>
                                <span>Fotógrafo de Arequipa</span>
                                <div class="verified">✓ Viajero Verificado</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial">
                    <div class="testimonial-content">
                        <div class="stars">⭐⭐⭐⭐⭐</div>
                        <p>"Las cataratas son impresionantes y el equipo local hace que te sientas como en familia. Una experiencia que recomiendo 100%."</p>
                        <div class="testimonial-author">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=60&h=60&fit=crop&crop=face" alt="Ana Lucía Torres">
                            <div>
                                <h4>Ana Lucía Torres</h4>
                                <span>Bloguera de Viajes</span>
                                <div class="verified">✓ Viajero Verificado</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-navigation">
                <button class="nav-btn prev" onclick="changeTestimonial(-1)">‹</button>
                <div class="testimonial-dots">
                    <span class="dot active" onclick="currentTestimonial(1)"></span>
                    <span class="dot" onclick="currentTestimonial(2)"></span>
                    <span class="dot" onclick="currentTestimonial(3)"></span>
                </div>
                <button class="nav-btn next" onclick="changeTestimonial(1)">›</button>
            </div>
        </div>
    </section>

    <!-- CTA Final con Urgencia -->
    <section style="padding: 100px 0; background: linear-gradient(135deg, var(--naranja-atardecer), var(--amarillo-dorado)); color: white; text-align: center; position: relative; overflow: hidden;">
        <div class="floating-elements">
            <div class="float-icon" style="top: 10%; left: 10%; animation-delay: 0s;">🌿</div>
            <div class="float-icon" style="top: 20%; right: 15%; animation-delay: 1s;">🦋</div>
            <div class="float-icon" style="bottom: 15%; left: 20%; animation-delay: 2s;">🏔️</div>
            <div class="float-icon" style="bottom: 25%; right: 10%; animation-delay: 3s;">💧</div>
        </div>
        
        <div class="container" style="max-width: 800px; margin: 0 auto; padding: 0 2rem; position: relative; z-index: 2;">
            <div data-aos="zoom-in">
                <h2 style="font-family: 'Poppins', sans-serif; font-size: 3.5rem; font-weight: 800; margin-bottom: 1.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                    ¿Listo para tu Próxima Aventura?
                </h2>
                <p style="font-size: 1.3rem; margin-bottom: 2rem; opacity: 0.95;">
                    Únete a miles de aventureros que ya descubrieron la magia de Chanchamayo
                </p>
                
                <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 20px; padding: 2rem; margin: 2rem 0; border: 1px solid rgba(255,255,255,0.2);">
                    <h3 style="font-size: 1.5rem; margin-bottom: 1rem;">🎁 Oferta Especial de Bienvenida</h3>
                    <p style="font-size: 1.1rem; margin-bottom: 1.5rem;">Regístrate hoy y recibe:</p>
                    <div style="display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap; margin-bottom: 2rem;">
                        <div style="text-align: center;">
                            <div style="font-size: 2rem; margin-bottom: 0.5rem;">💰</div>
                            <span>20% OFF en tu primer tour</span>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 2rem; margin-bottom: 0.5rem;">📱</div>
                            <span>Acceso a la app móvil</span>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 2rem; margin-bottom: 0.5rem;">🎯</div>
                            <span>Recomendaciones personalizadas</span>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="/register" class="btn-cta-large primary">
                        <i class="fas fa-rocket"></i>
                        Comenzar Aventura
                    </a>
                    <a href="/tours" class="btn-cta-large secondary">
                        <i class="fas fa-binoculars"></i>
                        Explorar Tours
                    </a>
                </div>

                <p style="font-size: 0.9rem; margin-top: 2rem; opacity: 0.8;">
                    ⏰ Oferta válida por tiempo limitado • 🔒 Registro 100% seguro • 🚫 Sin compromisos
                </p>
            </div>
        </div>
    </section>

    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Loading Screen
        window.addEventListener('load', function() {
            const loading = document.getElementById('loading');
            setTimeout(() => {
                loading.classList.add('fade-out');
            }, 1500);
        });

        // ENHANCED VIDEO HANDLING - AUTOPLAY GUARANTEED
        const heroVideo = document.getElementById('heroVideo');
        const hero = document.querySelector('.hero');
        
        if (heroVideo) {
            let videoLoaded = false;
            let playAttempts = 0;
            const maxPlayAttempts = 10;
            
            // Aggressively remove all controls and interactions
            heroVideo.removeAttribute('controls');
            heroVideo.setAttribute('disablePictureInPicture', '');
            heroVideo.setAttribute('controlsList', 'nodownload nofullscreen noremoteplaybook noplaybackrate');
            heroVideo.setAttribute('webkit-playsinline', '');
            heroVideo.setAttribute('x5-playsinline', '');
            
            // Disable ALL interactions with video
            heroVideo.addEventListener('contextmenu', function(e) {
                e.preventDefault();
                return false;
            });

            heroVideo.addEventListener('click', function(e) {
                e.preventDefault();
                return false;
            });

            heroVideo.addEventListener('dblclick', function(e) {
                e.preventDefault();
                return false;
            });

            // Aggressive autoplay function
            function forcePlay() {
                if (playAttempts < maxPlayAttempts) {
                    playAttempts++;
                    heroVideo.play().then(() => {
                        console.log(`✅ Video playing successfully (attempt ${playAttempts})`);
                        videoLoaded = true;
                        heroVideo.style.opacity = '1';
                        heroVideo.classList.add('loaded');
                    }).catch(error => {
                        console.log(`🔄 Play attempt ${playAttempts} failed:`, error.message);
                        // Try again after a short delay
                        setTimeout(forcePlay, 500);
                    });
                } else {
                    console.log('❌ Max play attempts reached, using fallback image');
                    heroVideo.style.display = 'none';
                    hero.style.backgroundImage = "url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=1920&h=1080&fit=crop&crop=center')";
                }
            }

            // Start playing as soon as possible
            heroVideo.addEventListener('loadstart', function() {
                console.log('🔄 Video loading started...');
            });

            heroVideo.addEventListener('loadedmetadata', function() {
                console.log('📊 Video metadata loaded');
                forcePlay();
            });

            heroVideo.addEventListener('loadeddata', function() {
                console.log('📹 Video data loaded');
                if (!videoLoaded) {
                    forcePlay();
                }
            });

            heroVideo.addEventListener('canplay', function() {
                console.log('🎬 Video can start playing');
                if (!videoLoaded) {
                    forcePlay();
                }
            });

            heroVideo.addEventListener('canplaythrough', function() {
                console.log('🚀 Video can play through without buffering');
                if (!videoLoaded) {
                    forcePlay();
                }
            });

            // Handle play/pause events
            heroVideo.addEventListener('play', function() {
                console.log('▶️ Video started playing');
                videoLoaded = true;
            });

            heroVideo.addEventListener('pause', function() {
                console.log('⏸️ Video paused, attempting to resume...');
                setTimeout(() => {
                    if (!heroVideo.ended) {
                        forcePlay();
                    }
                }, 100);
            });

            // Ensure continuous loop
            heroVideo.addEventListener('ended', function() {
                console.log('🔄 Video ended, restarting...');
                heroVideo.currentTime = 0;
                forcePlay();
            });

            // Handle errors
            heroVideo.addEventListener('error', function(e) {
                console.log('❌ Video error:', e);
                heroVideo.style.display = 'none';
                hero.style.backgroundImage = "url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=1920&h=1080&fit=crop&crop=center')";
            });

            // Force play on user interaction (fallback for strict autoplay policies)
            document.addEventListener('click', function() {
                if (!videoLoaded) {
                    forcePlay();
                }
            }, { once: true });

            document.addEventListener('touchstart', function() {
                if (!videoLoaded) {
                    forcePlay();
                }
            }, { once: true });

            // Force play when page becomes visible
            document.addEventListener('visibilitychange', function() {
                if (!document.hidden && videoLoaded) {
                    forcePlay();
                }
            });

            // Force play when window gains focus
            window.addEventListener('focus', function() {
                if (videoLoaded && heroVideo.paused) {
                    forcePlay();
                }
            });

            // Initial play attempt after short delay
            setTimeout(() => {
                if (!videoLoaded) {
                    console.log('🎬 Initial autoplay attempt...');
                    forcePlay();
                }
            }, 500);

            // Fallback timeout - if nothing works after 5 seconds, use image
            setTimeout(() => {
                if (!videoLoaded) {
                    console.log('⏰ Timeout reached, using background image fallback');
                    heroVideo.style.display = 'none';
                    hero.style.backgroundImage = "url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=1920&h=1080&fit=crop&crop=center')";
                }
            }, 5000);
        }

        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Counter Animation
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const increment = target / 100;
                let current = 0;

                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.ceil(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };

                updateCounter();
            });
        }

        // Trigger counter animation when hero is visible
        const heroObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(animateCounters, 1000);
                    heroObserver.unobserve(entry.target);
                }
            });
        });

        heroObserver.observe(document.querySelector('.hero'));

        // Smooth Scrolling
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

        // Add ripple effect to buttons
        document.querySelectorAll('.btn-primary, .btn-hero').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add CSS for ripple effect
        const style = document.createElement('style');
        style.textContent = `
            .btn-primary, .btn-hero {
                position: relative;
                overflow: hidden;
            }
            
            .ripple {
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.3);
                transform: scale(0);
                animation: ripple-animation 0.6s linear;
                pointer-events: none;
            }
            
            @keyframes ripple-animation {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Testimonials Slider
        let currentTestimonialIndex = 0;
        const testimonials = document.querySelectorAll('.testimonial');
        const dots = document.querySelectorAll('.dot');

        function showTestimonial(index) {
            testimonials.forEach((testimonial, i) => {
                testimonial.classList.remove('active');
                dots[i].classList.remove('active');
            });
            
            testimonials[index].classList.add('active');
            dots[index].classList.add('active');
        }

        function changeTestimonial(direction) {
            currentTestimonialIndex += direction;
            
            if (currentTestimonialIndex >= testimonials.length) {
                currentTestimonialIndex = 0;
            } else if (currentTestimonialIndex < 0) {
                currentTestimonialIndex = testimonials.length - 1;
            }
            
            showTestimonial(currentTestimonialIndex);
        }

        function currentTestimonial(index) {
            currentTestimonialIndex = index - 1;
            showTestimonial(currentTestimonialIndex);
        }

        // Auto-rotate testimonials
        setInterval(() => {
            changeTestimonial(1);
        }, 5000);

        // Countdown Timer for Flash Sale
        function updateCountdown() {
            const now = new Date().getTime();
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            tomorrow.setHours(0, 0, 0, 0);
            const distance = tomorrow.getTime() - now;

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const countdownElement = document.getElementById('countdown');
            if (countdownElement) {
                countdownElement.innerHTML = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }

            if (distance < 0) {
                countdownElement.innerHTML = "¡OFERTA RENOVADA!";
            }
        }

        // Update countdown every second
        updateCountdown();
        setInterval(updateCountdown, 1000);

        // Wishlist functionality
        document.querySelectorAll('.btn-tour.wishlist').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const icon = this.querySelector('i');
                
                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    this.style.background = '#FEE2E2';
                    this.style.color = '#DC2626';
                    
                    // Show notification
                    showNotification('❤️ Agregado a favoritos');
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    this.style.background = '#F8FAFC';
                    this.style.color = '#64748B';
                    
                    showNotification('💔 Removido de favoritos');
                }
            });
        });

        // Notification system
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: linear-gradient(135deg, var(--verde-selva), var(--verde-claro));
                color: white;
                padding: 1rem 2rem;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                z-index: 10000;
                font-weight: 600;
                transform: translateX(400px);
                transition: transform 0.3s ease;
            `;
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
            }, 3000);
        }

        // Search functionality
        const searchInput = document.querySelector('.hero-search input');
        const searchButton = document.querySelector('.hero-search button');

        if (searchInput && searchButton) {
            searchButton.addEventListener('click', function(e) {
                e.preventDefault();
                const query = searchInput.value.trim();
                
                if (query) {
                    showNotification(`🔍 Buscando "${query}"...`);
                    setTimeout(() => {
                        window.location.href = `/tours?search=${encodeURIComponent(query)}`;
                    }, 1000);
                }
            });

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchButton.click();
                }
            });
        }

        // Achievement hover effects
        document.querySelectorAll('.achievement-badge').forEach(badge => {
            badge.addEventListener('mouseenter', function() {
                const icon = this.querySelector('.badge-icon');
                if (icon.classList.contains('unlocked')) {
                    icon.style.animation = 'glow 0.5s ease-in-out, bounce 0.5s ease-in-out';
                }
            });
            
            badge.addEventListener('mouseleave', function() {
                const icon = this.querySelector('.badge-icon');
                if (icon.classList.contains('unlocked')) {
                    icon.style.animation = 'glow 2s ease-in-out infinite alternate';
                }
            });
        });

        // Parallax effect for floating elements
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.float-icon');
            
            parallaxElements.forEach((element, index) => {
                const speed = (index + 1) * 0.1;
                element.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

        // Book tour functionality
        document.querySelectorAll('.btn-tour.book').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const tourCard = this.closest('.tour-card');
                const tourTitle = tourCard.querySelector('h3').textContent;
                
                showNotification(`🎯 Redirigiendo a reserva: ${tourTitle}`);
                
                setTimeout(() => {
                    window.location.href = '/tours'; // Redirect to tours page or specific booking
                }, 1500);
            });
        });

        // Add entrance animations to cards when they come into view
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeInUp 0.6s ease-out forwards';
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.category-card, .tour-card, .achievement-badge').forEach(card => {
            cardObserver.observe(card);
        });

        // Add fadeInUp animation
        const animationStyle = document.createElement('style');
        animationStyle.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(animationStyle);

        // Global variables for testimonial functions
        window.changeTestimonial = changeTestimonial;
        window.currentTestimonial = currentTestimonial;
    </script>
</body>
</html>
