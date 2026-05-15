<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <script>
            (function() {
                const savedTheme = localStorage.getItem('theme') || 'light';
                document.documentElement.setAttribute('data-theme', savedTheme);
            })();
        </script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Admin – NPIA Drink')</title>
        <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            :root {
                --clr-bg: #f8fafc;
                --clr-surface: rgba(255, 255, 255, 0.9);
                --clr-text: #1e293b;
                --clr-text-muted: #64748b;
                --clr-border: rgba(0, 0, 0, 0.08);
                --clr-primary: #0ea5e9;
                --clr-accent: #8b5cf6;
                --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            }

            [data-theme="dark"] {
                --clr-bg: #030712;
                --clr-surface: rgba(15, 23, 42, 0.7);
                --clr-text: #f1f5f9;
                --clr-text-muted: rgba(255, 255, 255, 0.5);
                --clr-border: rgba(255, 255, 255, 0.08);
            }

            * { font-family: 'Plus Jakarta Sans', 'Kantumruy Pro', sans-serif; transition: background-color 0.3s ease, color 0.3s ease; }
            body { background-color: var(--clr-bg); color: var(--clr-text); min-height: 100vh; }
            .bg-canvas { position: fixed; inset: 0; z-index: -1; background: radial-gradient(circle at 50% 50%, var(--clr-surface) 0%, var(--clr-bg) 100%); overflow: hidden; }
            .luxury-orb { position: absolute; border-radius: 50%; filter: blur(120px); pointer-events: none; opacity: 0.3; animation: moveOrb 25s infinite alternate ease-in-out; }
            .orb-1 { width: 600px; height: 600px; background: var(--clr-primary); top: -200px; left: -100px; }
            .orb-2 { width: 400px; height: 400px; background: var(--clr-accent); bottom: -100px; right: -50px; }
            @keyframes moveOrb { from { transform: translate(0,0) scale(1); } to { transform: translate(50px, 50px) scale(1.1); } }
            
            .navbar { background: var(--clr-surface) !important; backdrop-filter: blur(20px); border-bottom: 1px solid var(--clr-border); }
            .nav-link { color: var(--clr-text) !important; font-weight: 600; }
            .nav-tool { width: 40px; height: 40px; border-radius: 10px; background: rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--clr-text); border: 1px solid var(--clr-border); }
            [data-theme="dark"] .nav-tool { background: rgba(255,255,255,0.05); }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="bg-canvas">
            <div class="luxury-orb orb-1"></div>
            <div class="luxury-orb orb-2"></div>
        </div>

        <div class="min-h-screen">
            @include('layouts.navigation')

            <main class="container py-4">
                {{ $slot }}
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            
            function updateThemeIcon(theme) {
                if (!themeIcon) return;
                if (theme === 'dark') {
                    themeIcon.classList.remove('bi-moon-stars');
                    themeIcon.classList.add('bi-sun-fill');
                } else {
                    themeIcon.classList.remove('bi-sun-fill');
                    themeIcon.classList.add('bi-moon-stars');
                }
            }

            updateThemeIcon(document.documentElement.getAttribute('data-theme'));

            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    const currentTheme = document.documentElement.getAttribute('data-theme');
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    document.documentElement.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                    updateThemeIcon(newTheme);
                });
            }
        </script>
    </body>
</html>