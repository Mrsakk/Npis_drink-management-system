<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('Admin')) – NPIA Drink</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('styles')
</head>
<body>
    {{-- ── Sidebar ── --}}
    <aside class="sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-logo">
                <img src="{{ asset('img/logo.png') }}" alt="NPIA" style="width:28px;height:28px;object-fit:cover;border-radius:50%;">
            </div>
            <div>
                <div class="sidebar-brand-text">NPIA Admin</div>
                <div class="sidebar-brand-sub">{{ __('Management System') }}</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section">{{ __('Navigation') }}</div>

            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <div class="sidebar-link-icon"><i class="bi bi-grid-1x2-fill"></i></div>
                <span>{{ __('Dashboard') }}</span>
            </a>
            <a href="{{ route('admin.orders') }}" class="sidebar-link {{ request()->routeIs('admin.order*') ? 'active' : '' }}">
                <div class="sidebar-link-icon"><i class="bi bi-bag-check-fill"></i></div>
                <span>{{ __('Orders') }}</span>
            </a>

            <div class="sidebar-section" style="margin-top:12px;">{{ __('Catalog') }}</div>

            <a href="{{ route('admin.products') }}" class="sidebar-link {{ request()->routeIs('admin.product*') ? 'active' : '' }}">
                <div class="sidebar-link-icon"><i class="bi bi-cup-straw"></i></div>
                <span>{{ __('Products') }}</span>
            </a>
            <a href="{{ route('admin.categories') }}" class="sidebar-link {{ request()->routeIs('admin.category*') ? 'active' : '' }}">
                <div class="sidebar-link-icon"><i class="bi bi-collection-fill"></i></div>
                <span>{{ __('Categories') }}</span>
            </a>

            <div class="sidebar-section" style="margin-top:12px;">{{ __('Administrative') }}</div>

            <a href="{{ route('admin.users') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <div class="sidebar-link-icon"><i class="bi bi-people-fill"></i></div>
                <span>{{ __('Users') }}</span>
            </a>
            <a href="{{ route('admin.telegram') }}" class="sidebar-link {{ request()->routeIs('admin.telegram*') ? 'active' : '' }}">
                <div class="sidebar-link-icon"><i class="bi bi-send-fill"></i></div>
                <span>{{ __('Broadcast') }}</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('home') }}" class="sidebar-link active">
                <div class="sidebar-link-icon"><i class="bi bi-globe2"></i></div>
                <span>{{ __('View Store') }}</span>
            </a>
        </div>
    </aside>

    {{-- ── Main ── --}}
    <div class="admin-main">
        {{-- Topbar --}}
        <div class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="topbar-btn d-md-none border-0" id="sidebarToggle">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <div>
                    <div class="topbar-title">@yield('title', __('Dashboard'))</div>
                    <div class="text-muted small">
                        <i class="bi bi-clock me-1"></i>{{ now()->format('D, d M Y') }}
                    </div>
                </div>
            </div>
            <div class="topbar-actions">
                <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm d-none d-sm-flex align-items-center gap-2 px-3">
                    <i class="bi bi-globe2"></i> <span>{{ __('View Store') }}</span>
                </a>
                <div class="dropdown">
                    <div class="topbar-avatar" data-bs-toggle="dropdown" title="{{ Auth::user()->name ?? 'Admin' }}">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 glass">
                        <li>
                            <div class="px-3 py-2 border-bottom border-opacity-10 mb-2">
                                <div class="fw-800 text-white" style="font-size:0.9rem;">{{ Auth::user()->name ?? 'Admin' }}</div>
                                <div class="text-muted small">{{ __('Administrator') }}</div>
                            </div>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2 py-2">
                                    <i class="bi bi-box-arrow-right"></i> {{ __('Logout') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="admin-content">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4 glass shadow-sm">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-4 glass shadow-sm">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                <span>{{ session('error') }}</span>
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    {{-- Mobile overlay --}}
    <div id="sidebarOverlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:150;backdrop-filter:blur(8px);" onclick="closeSidebar()"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // ── Sidebar Management ──
    function openSidebar() {
        document.getElementById('adminSidebar').classList.add('open');
        document.getElementById('sidebarOverlay').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent background scroll
    }
    function closeSidebar() {
        document.getElementById('adminSidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    const sidebarToggleBtn = document.getElementById('sidebarToggle');
    if (sidebarToggleBtn) {
        sidebarToggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const sidebar = document.getElementById('adminSidebar');
            sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
        });
    }

    // ── Content Reveal Animation ──
    const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                revealObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('[data-animate]').forEach(el => revealObserver.observe(el));

    // ── Auto-dismiss Alerts ──
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(a => {
            try { bootstrap.Alert.getOrCreateInstance(a).close(); } catch(e) {}
        });
    }, 6000);
    </script>
    @yield('scripts')
</body>
</html>