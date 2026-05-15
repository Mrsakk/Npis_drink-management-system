<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}" style="color: var(--clr-text);">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 32px; width: 32px; object-fit: contain;">
            <span>NPIA Drink</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                </li>
            </ul>
            
            <ul class="navbar-nav align-items-center">
                <!-- Language Switcher -->
                <li class="nav-item dropdown me-2">
                    <a class="nav-tool dropdown-toggle border-0" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-translate"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" style="background: var(--clr-surface); backdrop-filter: blur(20px); border: 1px solid var(--clr-border); border-radius: 12px;">
                        <li><a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('lang.switch', 'en') }}">🇬🇧 English</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale() == 'km' ? 'active' : '' }}" href="{{ route('lang.switch', 'km') }}">🇰🇭 Khmer</a></li>
                    </ul>
                </li>

                <!-- Theme Toggle -->
                <li class="nav-item me-2">
                    <div id="themeToggle" class="nav-tool" title="{{ __('Dark Mode') }}">
                        <i class="bi bi-moon-stars" id="themeIcon"></i>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" style="background: var(--clr-surface); backdrop-filter: blur(20px); border: 1px solid var(--clr-border); border-radius: 12px;">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('My Profile') }}</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">{{ __('Logout') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>