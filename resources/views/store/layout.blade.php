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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#2563eb">
    <meta name="description" content="NPIA Drink Store – Premium beverages delivered to your room">
    <title>@yield('title', 'NPIA Drink Store')</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
    @yield('styles')
</head>
<body>
    <div class="page-wrapper">
        {{-- Background Orbs --}}
        <div class="bg-orb bg-orb-1"></div>
        <div class="bg-orb bg-orb-2"></div>
        <div class="bg-orb bg-orb-3"></div>

        {{-- Scroll Progress Bar --}}
        <div id="scrollProgress" class="scroll-progress"></div>

        {{-- Page Transition Overlay --}}
        <div id="pageTransition" class="page-transition"></div>

        {{-- ── Navbar ── --}}
        <nav class="navbar navbar-expand-lg fixed-top-mobile" id="mainNav">
            <div class="container">
                <a class="luxury-logo-wrapper" href="{{ route('home') }}">
                    <div class="logo-insignia-premium glass">
                        <img src="{{ asset('img/logo.png') }}" alt="NPIA">
                    </div>
                    <div class="logo-text-premium">
                        NPIA <span class="text-gradient">Drink</span>
                    </div>
                </a>

                <div class="d-flex align-items-center gap-2 d-lg-none">
                    {{-- Language Switcher (Mobile) --}}
                    <div class="dropdown">
                        <a class="nav-link glass rounded-pill px-3" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-translate"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg">
                            <li><a class="dropdown-item {{ app()->getLocale()=='en' ? 'active' : '' }}" href="{{ route('lang.switch','en') }}">🇬🇧 EN</a></li>
                            <li><a class="dropdown-item {{ app()->getLocale()=='km' ? 'active' : '' }}" href="{{ route('lang.switch','km') }}">🇰🇭 KM</a></li>
                        </ul>
                    </div>

                    {{-- Theme Toggle (Mobile) --}}
                    <button class="nav-link glass rounded-pill px-3 border-0 bg-transparent theme-toggle-mobile">
                        <i class="bi bi-moon-stars theme-icon-mobile"></i>
                    </button>

                    {{-- Cart (Mobile) --}}
                    <a class="nav-link glass rounded-pill position-relative px-3" href="{{ route('cart') }}">
                        <i class="bi bi-bag-heart"></i>
                        <span class="cart-count"></span>
                    </a>
                </div>

                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <div class="hamburger-icon"><span></span><span></span><span></span></div>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto ms-lg-5 gap-3">
                        <li class="nav-item">
                            <a class="nav-link-luxury {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                <i class="bi bi-house-door me-2"></i> {{ __('Home') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-luxury {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}">
                                <i class="bi bi-bag-heart me-2"></i> {{ __('Shop') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-luxury {{ request()->routeIs('categories') ? 'active' : '' }}" href="{{ route('categories') }}">
                                <i class="bi bi-grid me-2"></i> {{ __('Categories') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link-luxury {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                                <i class="bi bi-info-circle me-2"></i> {{ __('About') }}
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav gap-3 align-items-center">
                        {{-- Theme & Lang --}}
                        <div class="d-flex align-items-center gap-2">
                            <li class="nav-item dropdown">
                                <a class="btn-luxury-icon" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-translate"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end glass-dropdown border-0 shadow-lg">
                                    <li><a class="dropdown-item" href="{{ route('lang.switch','en') }}">🇬🇧 English</a></li>
                                    <li><a class="dropdown-item" href="{{ route('lang.switch','km') }}">🇰🇭 ខ្មែរ</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <button id="themeToggle" class="btn-luxury-icon border-0">
                                    <i class="bi bi-moon-stars" id="themeIcon"></i>
                                </button>
                            </li>
                        </div>

                        {{-- Cart --}}
                        <li class="nav-item d-none d-lg-block">
                            <a class="btn-luxury btn-luxury-ghost px-4" href="{{ route('cart') }}">
                                <i class="bi bi-bag-heart"></i>
                                <span class="cart-count"></span>
                            </a>
                        </li>

                        {{-- User Auth --}}
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle auth-trigger-luxury" href="#" role="button" data-bs-toggle="dropdown">
                                <div class="auth-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                                <span class="d-none d-lg-inline">{{ explode(' ', Auth::user()->name)[0] }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end glass-dropdown border-0 shadow-lg p-3">
                                <li><a class="dropdown-item rounded-3" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>{{ __('Profile') }}</a></li>
                                <li><a class="dropdown-item rounded-3" href="{{ route('orders') }}"><i class="bi bi-bag-check me-2"></i>{{ __('My Orders') }}</a></li>
                                @if(Auth::user()->isAdmin())
                                <li><hr class="dropdown-divider opacity-10"></li>
                                <li><a class="dropdown-item rounded-3 text-primary" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>{{ __('Admin Panel') }}</a></li>
                                @endif
                                <li><hr class="dropdown-divider opacity-10"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item rounded-3 text-danger"><i class="bi bi-box-arrow-right me-2"></i>{{ __('Log Out') }}</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @else
                        <div class="d-flex align-items-center gap-2">
                            <a class="btn-luxury btn-luxury-ghost btn-luxury-sm" href="{{ route('login') }}">{{ __('Login') }}</a>
                            <a class="btn-luxury btn-luxury-primary btn-luxury-sm" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                        </div>
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
        <main class="main-content" id="spaContent">
            <div class="container" id="pageContent">
                @yield('content')
            </div>
        </main>

        {{-- Footer --}}
        <footer class="footer-luxury py-5 py-lg-10 mt-5" data-animate>
            <div class="container">
                <div class="row g-5 g-lg-10">
                    <div class="col-lg-4">
                        <a class="luxury-logo-wrapper mb-5" href="{{ route('home') }}">
                            <div class="logo-insignia-premium glass">
                                <img src="{{ asset('img/logo.png') }}" alt="NPIA">
                            </div>
                            <div class="logo-text-premium">
                                NPIA <span class="text-gradient">PREMIUM</span>
                            </div>
                        </a>
                        <p class="text-muted mb-5 pe-lg-5" style="line-height: 1.8;">
                            {{ __('Crafting premium beverage and snack experiences with lightning-fast delivery to the academic community.') }}
                        </p>
                        <div class="d-flex gap-3">
                            @php $socials = [['bi-facebook', '#'], ['bi-instagram', '#'], ['bi-tiktok', '#'], ['bi-telegram', '#']]; @endphp
                            @foreach($socials as $social)
                                <a href="{{ $social[1] }}" class="social-link-luxury"><i class="bi {{ $social[0] }}"></i></a>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="col-6 col-lg-2 ms-lg-auto">
                        <h6 class="fw-800 mb-5 text-uppercase ls-2 small" style="color:var(--text);">{{ __('Discover') }}</h6>
                        <ul class="list-unstyled d-grid gap-3">
                            <li><a href="{{ route('home') }}" class="footer-link-luxury">{{ __('Home') }}</a></li>
                            <li><a href="{{ route('shop') }}" class="footer-link-luxury">{{ __('Shop') }}</a></li>
                            <li><a href="{{ route('categories') }}" class="footer-link-luxury">{{ __('Categories') }}</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-lg-2">
                        <h6 class="fw-800 mb-5 text-uppercase ls-2 small" style="color:var(--text);">{{ __('Company') }}</h6>
                        <ul class="list-unstyled d-grid gap-3">
                            <li><a href="{{ route('about') }}" class="footer-link-luxury">{{ __('About Us') }}</a></li>
                            <li><a href="#" class="footer-link-luxury">{{ __('Privacy Policy') }}</a></li>
                            <li><a href="#" class="footer-link-luxury">{{ __('Terms of Service') }}</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3">
                        <h6 class="fw-800 mb-5 text-uppercase ls-2 small" style="color:var(--text);">{{ __('Get Updates') }}</h6>
                        <p class="text-muted small mb-4">{{ __('Join our community for exclusive offers and news.') }}</p>
                        <div class="newsletter-box-luxury glass rounded-pill p-1">
                            <input type="email" placeholder="{{ __('Email address') }}">
                            <button><i class="bi bi-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                
                <hr class="my-5 opacity-10">
                
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-4">
                    <p class="small text-muted mb-0">&copy; {{ date('Y') }} NPIA Drink Store. {{ __('All rights reserved.') }}</p>
                    <div class="d-flex align-items-center gap-4">
                        <span class="small text-muted d-flex align-items-center gap-2">
                            <i class="bi bi-shield-check text-success"></i> {{ __('Secure Transaction') }}
                        </span>
                        <span class="small text-muted d-flex align-items-center gap-2">
                            <i class="bi bi-stars text-warning"></i> {{ __('Premium Quality') }}
                        </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>


    {{-- Mobile Bottom Navigation --}}
    <div class="mobile-nav d-lg-none">
        <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>
            <span>{{ __('Home') }}</span>
        </a>
        <a href="{{ route('categories') }}" class="mobile-nav-link {{ request()->routeIs('categories') ? 'active' : '' }}">
            <i class="bi bi-grid"></i>
            <span>{{ __('Categories') }}</span>
        </a>
        <a href="{{ route('shop') }}" class="mobile-nav-link {{ request()->routeIs('shop') ? 'active' : '' }}">
            <i class="bi bi-bag-heart"></i>
            <span>{{ __('Shop') }}</span>
        </a>
        <a href="{{ route('orders') }}" class="mobile-nav-link {{ request()->routeIs('orders') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i>
            <span>{{ __('Orders') }}</span>
        </a>
        @auth
            <a href="{{ route('profile.edit') }}" class="mobile-nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i>
                <span>{{ __('Profile') }}</span>
            </a>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="mobile-nav-link {{ request()->is('admin*') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>{{ __('Admin') }}</span>
                </a>
            @endif
        @endauth
    </div>

    {{-- Product Quick View Modal --}}
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content glass rounded-5 border-0 overflow-hidden">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-4 z-3 glass rounded-circle p-2" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body p-0">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="quickview-img-wrapper h-100">
                                <img id="qv-image" src="" alt="" class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>
                        <div class="col-md-6 p-4 p-lg-5 d-flex flex-direction-column">
                            <span id="qv-category" class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 mb-2 small fw-bold"></span>
                            <h2 id="qv-name" class="fw-800 mb-3" style="color:var(--text);"></h2>
                            <p id="qv-description" class="text-muted mb-4"></p>
                            
                            <div class="mt-auto">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <span id="qv-price" class="price-text fs-2"></span>
                                    <div class="delivery-badge-mini">
                                        <i class="bi bi-lightning-charge-fill"></i>
                                        <span>{{ __('Fast Delivery') }}</span>
                                    </div>
                                </div>
                                
                                <form id="qv-form" action="{{ route('add-to-cart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" id="qv-product-id">
                                    <div class="d-flex gap-3">
                                        <div class="glass rounded-pill px-3 d-flex align-items-center gap-3">
                                            <button type="button" class="btn btn-link p-0 text-decoration-none text-text fw-bold" onclick="updateQVQty(-1)">-</button>
                                            <input type="number" name="quantity" id="qv-qty" value="1" min="1" class="border-0 bg-transparent text-center fw-bold" style="width: 40px; outline: none;">
                                            <button type="button" class="btn btn-link p-0 text-decoration-none text-text fw-bold" onclick="updateQVQty(1)">+</button>
                                        </div>
                                        <button type="submit" class="btn-luxury btn-luxury-primary flex-grow-1 py-3">
                                            <i class="bi bi-cart-plus-fill me-2"></i> {{ __('Add to Cart') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FAB --}}
    <a href="https://t.me/npiadrink" class="fab-support" title="{{ __('Contact Support') }}" target="_blank">
        <i class="bi bi-chat-dots-fill"></i>
    </a>

    {{-- Scroll to Top --}}
    <button id="scrollToTop" class="glass rounded-circle position-fixed shadow-lg border-0 d-none" style="bottom: 90px; right: 20px; width: 48px; height: 48px; z-index: 1000; color: var(--primary); transition: var(--transition);">
        <i class="bi bi-arrow-up fs-4"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // ── Quick View Modal ──
    function openQuickView(data) {
        document.getElementById('qv-image').src = data.image;
        document.getElementById('qv-name').innerText = data.name;
        document.getElementById('qv-category').innerText = data.category;
        document.getElementById('qv-description').innerText = data.description;
        document.getElementById('qv-price').innerText = '៛' + data.price;
        document.getElementById('qv-product-id').value = data.id;
        document.getElementById('qv-qty').value = 1;
        
        const modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
        modal.show();
    }

    function updateQVQty(delta) {
        const input = document.getElementById('qv-qty');
        let val = parseInt(input.value) + delta;
        if (val < 1) val = 1;
        input.value = val;
    }

    document.addEventListener('DOMContentLoaded', function () {
        // ── SPA Navigation ──
        const spaContent = document.getElementById('spaContent');
        const pageContent = document.getElementById('pageContent');
        const transition  = document.getElementById('pageTransition');

        function loadPage(url, push = true) {
            if (transition) {
                transition.classList.remove('fade-out');
                transition.classList.add('fade-in');
            }

            fetch(url, { headers: { 'X-SPA-REQUEST': 'true' } })
                .then(r => r.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.getElementById('pageContent');
                    const newTitle = doc.querySelector('title').innerText;

                    if (newContent) {
                        pageContent.innerHTML = newContent.innerHTML;
                        document.title = newTitle;
                        if (push) history.pushState({ url }, newTitle, url);
                        
                        // Re-initialize SPA elements
                        window.scrollTo({ top: 0, behavior: 'instant' });
                        reinitSPA();
                        
                        // Active state in nav
                        document.querySelectorAll('.nav-link-luxury, .mobile-nav-link').forEach(link => {
                            link.classList.toggle('active', link.href === window.location.href);
                        });
                    }
                })
                .catch(err => {
                    console.error('SPA Load Error:', err);
                    window.location.href = url; // Fallback
                })
                .finally(() => {
                    if (transition) {
                        transition.classList.remove('fade-in');
                        transition.classList.add('fade-out');
                    }
                });
        }

        function reinitSPA() {
            // Re-observe reveal elements
            document.querySelectorAll('[data-animate]').forEach(el => observer.observe(el));
            
            // Re-run page specific scripts if any
            const scripts = pageContent.querySelectorAll('script');
            scripts.forEach(s => {
                const newScript = document.createElement('script');
                if (s.src) newScript.src = s.src;
                else newScript.textContent = s.textContent;
                document.body.appendChild(newScript).parentNode.removeChild(newScript);
            });

            // Update Progress Bar to 0
            if (scrollProgress) scrollProgress.style.width = '0%';
        }

        document.addEventListener('click', e => {
            const link = e.target.closest('a');
            if (!link) return;
            
            const url = link.href;
            const isSameOrigin = url.startsWith(window.location.origin);
            const isSpaIgnored = link.hasAttribute('data-no-spa') || 
                                 url.includes('/admin') || 
                                 url.includes('/logout') || 
                                 url.includes('/login') || 
                                 url.includes('/register') || 
                                 url.includes('#');

            if (isSameOrigin && !isSpaIgnored) {
                e.preventDefault();
                loadPage(url);
            }
        });

        window.addEventListener('popstate', e => {
            if (e.state && e.state.url) loadPage(e.state.url, false);
            else location.reload();
        });

        // ── Theme Toggle ──
        const themeToggles = document.querySelectorAll('#themeToggle, .theme-toggle-mobile');
        const themeIcons   = document.querySelectorAll('#themeIcon, .theme-icon-mobile');

        function setTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
            themeIcons.forEach(icon => {
                if (icon) icon.className = theme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-stars';
            });
        }
        setTheme(document.documentElement.getAttribute('data-theme'));

        themeToggles.forEach(toggle => {
            if (toggle) {
                toggle.addEventListener('click', () => {
                    const cur = document.documentElement.getAttribute('data-theme');
                    setTheme(cur === 'dark' ? 'light' : 'dark');
                });
            }
        });

        // ── Sticky Navbar & Scroll To Top ──
        const nav = document.getElementById('mainNav');
        const scrollBtn = document.getElementById('scrollToTop');

        let isScrolling = false;
        const scrollProgress = document.getElementById('scrollProgress');
        
        const onScroll = () => { 
            if (!isScrolling) {
                window.requestAnimationFrame(() => {
                    const currentScroll = window.scrollY;
                    const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
                    
                    // Update Progress Bar
                    if (scrollProgress && totalHeight > 0) {
                        const progress = (currentScroll / totalHeight) * 100;
                        scrollProgress.style.width = progress + '%';
                    }

                    if (nav) nav.classList.toggle('scrolled', currentScroll > 40); 
                    
                    if (scrollBtn) {
                        if (currentScroll > 500) {
                            scrollBtn.classList.remove('d-none');
                        } else {
                            scrollBtn.classList.add('d-none');
                        }
                    }
                    isScrolling = false;
                });
                isScrolling = true;
            }
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        
        if (scrollBtn) {
            scrollBtn.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // ── Page Transition ──
        if (transition) {
            setTimeout(() => transition.classList.add('fade-out'), 100);
        }

        // ── Form Interceptor (AJAX) ──
        document.addEventListener('submit', function (e) {
            const form = e.target;
            const skipAjax = form.getAttribute('data-no-ajax') || form.action.includes('login') || form.action.includes('logout') || form.action.includes('place-order');
            
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
                    if (data.redirect) loadPage(data.redirect);
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
                            el.innerHTML = `<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:9px;min-width:18px;">${data.count}</span>`;
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
            const color = type === 'success' ? 'var(--primary)' : '#ef4444';
            
            const toastHtml = `
                <div id="${id}" class="toast show glass rounded-3 mb-3" role="alert" style="background: var(--surface);">
                    <div class="toast-body d-flex align-items-center gap-3 p-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:36px;height:36px;background:${color}20;color:${color};flex-shrink:0;">
                            <i class="bi ${icon} fs-5"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold small" style="color:var(--text);">${type.toUpperCase()}</div>
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