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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
</head>
<body>
    {{-- Animated Background --}}
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-5" data-animate>
                <div class="text-center mb-5">
                    <div class="logo-hero-wrapper mb-4">
                        <div class="logo-hero-inner" style="width: 120px; height: 120px;">
                            <img src="{{ asset('img/logo.png') }}" alt="NPIA Logo">
                        </div>
                    </div>
                    <h2 class="hero-title" style="font-size: 2.2rem;">NPIA <span class="text-gradient">Drink Store</span></h2>
                    <p class="hero-sub">{{ __('Fresh beverages, fast delivery') }}</p>
                </div>

                <div class="glass p-1 rounded-5 overflow-hidden">
                    <div class="p-4 p-lg-5">
                        @yield('content')
                    </div>
                </div>

                <p class="text-center mt-5 text-muted small">&copy; {{ date('Y') }} NPIA Drink Store. {{ __('All Rights Reserved.') }}</p>
            </div>
        </div>
    </div>

    <script>
        // Sync theme with store
        const theme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', theme);

        // Simple scroll reveal for the card
        document.addEventListener('DOMContentLoaded', () => {
            const card = document.querySelector('[data-animate]');
            if (card) card.classList.add('anim-active');
        });
    </script>
</body>
</html>