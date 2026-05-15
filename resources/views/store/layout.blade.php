<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <script>
        (function () {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="NPIA Drink Store – Premium beverages delivered to your room">
    <title>@yield('title', 'NPIA Drink Store')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
    @yield('styles')
</head>
<body>
    {{-- Premium Animated Background --}}
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>

    <div class="page-wrapper">
        {{-- ── Navbar ── --}}
        <nav class="navbar navbar-expand-lg" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="NPIA" class="logo-premium" style="width:42px;height:42px;">
                    <span>NPIA <span class="text-gradient">Drink</span></span>
                </a>

                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <i class="bi bi-list fs-2 text-primary"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto ms-lg-4 gap-1">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active-page' : '' }}" href="{{ route('home') }}">
                                <i class="bi bi-house-door me-1"></i>{{ __('Home') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('shop') ? 'active-page' : '' }}" href="{{ route('shop') }}">
                                <i class="bi bi-bag me-1"></i>{{ __('Shop') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('categories') ? 'active-page' : '' }}" href="{{ route('categories') }}">
                                <i class="bi bi-grid me-1"></i>{{ __('Categories') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('about') ? 'active-page' : '' }}" href="{{ route('about') }}">
                                <i class="bi bi-info-circle me-1"></i>{{ __('About') }}
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav gap-2 align-items-center">
                        {{-- Language --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle glass rounded-pill px-3" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-translate"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item {{ app()->getLocale()=='en' ? 'active' : '' }}" href="{{ route('lang.switch','en') }}">🇬🇧 English</a></li>
                                <li><a class="dropdown-item {{ app()->getLocale()=='km' ? 'active' : '' }}" href="{{ route('lang.switch','km') }}">🇰🇭 ខ្មែរ</a></li>
                            </ul>
                        </li>

                        {{-- Theme Toggle --}}
                        <li class="nav-item">
                            <button id="themeToggle" class="nav-link glass rounded-pill border-0 px-3" title="{{ __('Toggle Theme') }}">
                                <i class="bi bi-moon-stars" id="themeIcon"></i>
                            </button>
                        </li>

                        {{-- Cart --}}
                        <li class="nav-item">
                            <a class="nav-link glass rounded-pill position-relative px-3" href="{{ route('cart') }}" id="cartNavLink">
                                <i class="bi bi-bag-heart fs-5"></i>
                                <span class="cart-count"></span>
                            </a>
                        </li>

                        {{-- User --}}
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 glass rounded-pill py-1 pe-3" href="#" role="button" data-bs-toggle="dropdown">
                                <span style="width:32px;height:32px;background:linear-gradient(135deg,var(--clr-primary),var(--clr-accent));border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:0.82rem;font-weight:800;color:#fff;flex-shrink:0;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                                <span class="d-none d-lg-inline" style="font-size:0.9rem;font-weight:600;color:var(--clr-text);">{{ explode(' ', Auth::user()->name)[0] }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('orders') }}"><i class="bi bi-bag-check me-2"></i>{{ __('My Orders') }}</a></li>
                                @if(Auth::user()->isAdmin())
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>{{ __('Admin Panel') }}</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>{{ __('Logout') }}</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i>{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn-luxury btn-luxury-primary btn-sm px-4 py-2" href="{{ route('register') }}" style="font-size:0.85rem; border-radius: 50px;">{{ __('Sign Up') }}</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Flash Alerts --}}
        <div class="container mt-4">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-3 glass p-4">
                <div class="icon-circle bg-success text-white" style="width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="bi bi-check-lg fs-4"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold">Success!</h6>
                    <span class="small">{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close ms-auto shadow-none" data-bs-dismiss="alert"></button>
            </div>
            @endif
        </div>

        {{-- Main Content --}}
        <main class="main-content">
            <div class="container">
                @yield('content')
            </div>
        </main>

        {{-- Footer --}}
        <footer>
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-4">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <img src="{{ asset('img/logo.png') }}" alt="NPIA" class="logo-premium" style="height:42px;width:42px;">
                            <span class="fs-4 fw-800 text-gradient">NPIA Drink</span>
                        </div>
                        <p class="text-muted mb-4">{{ __('Premium beverages and gourmet snacks delivered with speed and elegance to your room.') }}</p>
                        <div class="d-flex gap-3">
                            <a href="#" class="footer-link" title="Facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="footer-link" title="Instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="footer-link" title="TikTok"><i class="bi bi-tiktok"></i></a>
                            <a href="#" class="footer-link" title="Telegram"><i class="bi bi-telegram"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <h6 class="fw-bold mb-4">{{ __('Quick Links') }}</h6>
                        <ul class="list-unstyled d-grid gap-2">
                            <li><a href="{{ route('home') }}" class="text-muted text-decoration-none small hover-primary">{{ __('Home') }}</a></li>
                            <li><a href="{{ route('shop') }}" class="text-muted text-decoration-none small hover-primary">{{ __('Shop') }}</a></li>
                            <li><a href="{{ route('categories') }}" class="text-muted text-decoration-none small hover-primary">{{ __('Categories') }}</a></li>
                            <li><a href="{{ route('about') }}" class="text-muted text-decoration-none small hover-primary">{{ __('About Us') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <h6 class="fw-bold mb-4">{{ __('Contact Us') }}</h6>
                        <ul class="list-unstyled d-grid gap-3">
                            <li class="d-flex gap-3 align-items-start">
                                <i class="bi bi-geo-alt text-primary mt-1"></i>
                                <span class="text-muted small">Phnom Penh, Cambodia</span>
                            </li>
                            <li class="d-flex gap-3 align-items-start">
                                <i class="bi bi-telephone text-primary mt-1"></i>
                                <span class="text-muted small">+855 12 345 678</span>
                            </li>
                            <li class="d-flex gap-3 align-items-start">
                                <i class="bi bi-envelope text-primary mt-1"></i>
                                <span class="text-muted small">support@npiadrink.com</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <h6 class="fw-bold mb-4">{{ __('Newsletter') }}</h6>
                        <p class="text-muted small mb-4">{{ __('Subscribe for exclusive offers and updates.') }}</p>
                        <div class="glass p-1 rounded-pill d-flex">
                            <input type="email" class="form-control border-0 bg-transparent shadow-none small" placeholder="Email address">
                            <button class="btn-luxury btn-luxury-primary btn-sm rounded-pill py-2 px-3">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <hr class="my-5 opacity-10">
                <div class="text-center">
                    <p class="small text-muted">&copy; {{ date('Y') }} NPIA Drink Store. {{ __('All rights reserved.') }}</p>
                </div>
            </div>
        </footer>
    </div>


    {{-- FAB --}}
    <a href="https://t.me/npiadrink" class="fab-support" title="Contact Support" target="_blank">
        <i class="bi bi-chat-dots-fill"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // ── Theme Toggle ──
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon   = document.getElementById('themeIcon');

        function setTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
            if (themeIcon) {
                themeIcon.className = theme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-stars';
            }
        }
        setTheme(document.documentElement.getAttribute('data-theme'));

        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const cur = document.documentElement.getAttribute('data-theme');
                setTheme(cur === 'dark' ? 'light' : 'dark');
            });
        }

        // ── Sticky Navbar ──
        const nav = document.getElementById('mainNav');
        const onScroll = () => { if (nav) nav.classList.toggle('scrolled', window.scrollY > 55); };
        window.addEventListener('scroll', onScroll, { passive: true });

        // ── Form Interceptor (AJAX) ──
        document.addEventListener('submit', function (e) {
            const form = e.target;
            const skipAjax = form.getAttribute('data-no-ajax') || form.action.includes('login') || form.action.includes('logout');
            
            if (skipAjax) return;
            
            e.preventDefault();
            const submitBtn = form.querySelector('[type="submit"]');
            const originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';
            
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>' + (submitBtn.innerText || '...');
            }

            const formData = new FormData(form);
            fetch(form.action, {
                method: form.method,
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(r => r.json().catch(() => ({ success: r.ok })))
            .then(data => {
                if (data.success || data.message || data.redirect) {
                    showToast(data.message || 'Action completed successfully!', 'success');
                    if (form.action.includes('add-to-cart') || form.action.includes('update-cart') || form.action.includes('remove-from-cart')) {
                        updateCartCount();
                        if (window.location.pathname.includes('/cart')) setTimeout(() => location.reload(), 800);
                    }
                } else {
                    showToast(data.message || 'Something went wrong.', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                showToast('Network error occurred.', 'error');
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnHtml;
                }
            });
        });

        function updateCartCount() {
            fetch('/cart/count')
                .then(r => r.json())
                .then(data => {
                    document.querySelectorAll('.cart-count').forEach(el => {
                        if (data.count > 0) {
                            el.innerHTML = `<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style="background:linear-gradient(135deg,#ec4899,#8b5cf6);font-size:9px;min-width:18px;">${data.count}</span>`;
                        } else {
                            el.innerHTML = '';
                        }
                    });
                });
        }

        function showToast(msg, type = 'success') {
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-4';
                toastContainer.style.zIndex = '9999';
                document.body.appendChild(toastContainer);
            }

            const id = 'toast-' + Date.now();
            const icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
            const color = type === 'success' ? 'var(--clr-primary)' : '#ef4444';
            
            const toastHtml = `
                <div id="${id}" class="toast show glass border-0 rounded-4 mb-3" role="alert" style="background: var(--clr-surface); backdrop-filter: blur(20px);">
                    <div class="toast-body d-flex align-items-center gap-3 p-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;background:${color}20;color:${color};flex-shrink:0;">
                            <i class="bi ${icon} fs-5"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold small" style="color:var(--clr-text);">${type.toUpperCase()}</div>
                            <div class="small text-muted">${msg}</div>
                        </div>
                    </div>
                </div>
            `;
            
            toastContainer.insertAdjacentHTML('beforeend', toastHtml);
            setTimeout(() => {
                const el = document.getElementById(id);
                if (el) { el.classList.add('fade'); setTimeout(() => el.remove(), 500); }
            }, 4000);
        }

        // Initial Cart Count
        updateCartCount();

        // ── Scroll Reveal ──
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('anim-active');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });
        document.querySelectorAll('[data-animate]').forEach(el => observer.observe(el));

        // ── Alert auto-dismiss ──
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(a => {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(a);
                if (bsAlert) bsAlert.close();
            });
        }, 6000);
    });
    </script>
    @yield('scripts')
</body>
</html>