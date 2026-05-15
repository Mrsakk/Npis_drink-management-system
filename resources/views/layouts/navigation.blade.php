<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-premium" style="height: 32px; width: 32px;">
            <span>NPIA Drink</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list fs-2"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                </li>
            </ul>

            <ul class="navbar-nav align-items-center gap-2">
                <!-- Language Switcher -->
                <li class="nav-item dropdown">
                    <a class="nav-link glass rounded-pill px-3 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-translate"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('lang.switch', 'en') }}">🇬🇧 English</a></li>
                        <li><a class="dropdown-item {{ app()->getLocale() == 'km' ? 'active' : '' }}" href="{{ route('lang.switch', 'km') }}">🇰🇭 Khmer</a></li>
                    </ul>
                </li>

                <!-- Theme Toggle -->
                <li class="nav-item">
                    <button id="themeToggle" class="nav-link glass rounded-pill border-0 px-3" title="{{ __('Dark Mode') }}">
                        <i class="bi bi-moon-stars" id="themeIcon"></i>
                    </button>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
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