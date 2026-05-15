<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Authentication – NPIA Drink Store</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
</head>
<body class="auth-body-luxury">
    {{-- Background Orbs --}}
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-5">
            <div class="col-md-6 col-lg-5 col-xl-4" data-animate>
                <div class="text-center mb-5">
                    <div class="logo-hero-ultra glass mx-auto mb-4">
                        <img src="{{ asset('img/logo.png') }}" alt="NPIA" class="logo-img-main">
                    </div>
                    <h1 class="hero-title-luxury fs-2 mb-2">NPIA <span class="text-gradient">Premium</span></h1>
                    <p class="text-muted small ls-1 text-uppercase">{{ __('Elite access to artisanal beverages') }}</p>
                </div>

                <div class="glass p-1 rounded-5 overflow-hidden shadow-2xl">
                    <div class="p-4 p-md-5">
                        @yield('content')
                    </div>
                </div>

                <div class="text-center mt-5">
                    <p class="text-muted small mb-0">&copy; {{ date('Y') }} NPIA Drink Store. {{ __('All Rights Reserved.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sync theme with store
        const theme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', theme);

        document.addEventListener('DOMContentLoaded', () => {
            const card = document.querySelector('[data-animate]');
            if (card) card.classList.add('anim-active');
        });
    </script>
</body>
</html>