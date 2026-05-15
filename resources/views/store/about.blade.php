@extends('store.layout')

@section('title', __('About') . ' – ' . __('NPIA Drink Store'))

@section('content')
@section('content')

{{-- Hero --}}
<div class="hero-section mb-5 py-5 px-5" data-animate>
    <div class="row align-items-center">
        <div class="col-lg-8">
            <div class="d-inline-flex align-items-center gap-2 mb-4 px-3 py-2 glass rounded-pill" style="font-size: 0.85rem; font-weight: 700;">
                <i class="bi bi-info-circle-fill text-primary"></i> {{ __('About Us') }}
            </div>
            <h1 class="hero-title mb-4" style="font-size: 3.5rem;">NPIA <span class="text-gradient">{{ __('Drink Store') }}</span></h1>
            <p class="hero-sub mb-5" style="font-size: 1.1rem;">
                {{ __('We provide convenient beverage and snack delivery services to students and staff. Our mission is to ensure everyone can enjoy their favourite drinks — delivered fresh, fast, and right to their room.') }}
            </p>
            <div class="d-flex gap-3">
                <a href="{{ route('shop') }}" class="btn-luxury btn-luxury-primary px-5">
                    <i class="bi bi-bag me-2"></i>{{ __('Start Shopping') }}
                </a>
            </div>
        </div>
        <div class="col-lg-4 text-center d-none d-lg-block">
            <div class="logo-hero-wrapper">
                <div class="logo-hero-inner" style="width: 320px; height: 320px;">
                    <img src="{{ asset('img/logo.png') }}" alt="NPIA Drink">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- How it works --}}
    <div class="col-lg-7">
        <div class="glass p-4 rounded-4 h-100" data-animate>
            <h3 class="section-title mb-4" style="font-size: 1.4rem;">
                <i class="bi bi-lightning-charge"></i>{{ __('How It Works') }}
            </h3>
            <div class="d-grid gap-4">
                @php $steps = [
                    ['Browse our selection of beverages and snacks', 'bi-bag'],
                    ['Add your favourite items to the cart', 'bi-cart-plus'],
                    ['Enter your building and room number', 'bi-geo-alt'],
                    ['Place your order and get confirmation', 'bi-check-circle'],
                    ['Enjoy your delivery — right at your door!', 'bi-stars'],
                ]; @endphp
                @foreach($steps as $i => $step)
                <div class="d-flex align-items-center gap-4 p-3 glass rounded-4 transition-smooth">
                    <div class="rounded-3 bg-primary text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px; flex-shrink: 0; font-weight: 800;">
                        {{ $i+1 }}
                    </div>
                    <div>
                        <span class="fw-600 text-muted-to-text">{{ __($step[0]) }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Contact + Hours --}}
    <div class="col-lg-5">
        <div class="glass p-4 rounded-4 mb-4" data-animate>
            <h3 class="section-title mb-4" style="font-size: 1.4rem;">
                <i class="bi bi-telephone"></i>{{ __('Contact Us') }}
            </h3>
            <div class="d-grid gap-3">
                <div class="glass p-3 rounded-4 d-flex align-items-center gap-3">
                    <div class="icon-circle bg-primary bg-opacity-10 text-primary" style="width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="bi bi-envelope fs-5"></i>
                    </div>
                    <div>
                        <div class="small text-muted fw-bold text-uppercase" style="letter-spacing: 1px;">{{ __('Email') }}</div>
                        <div class="fw-bold">info@npiadrink.com</div>
                    </div>
                </div>
                <div class="glass p-3 rounded-4 d-flex align-items-center gap-3">
                    <div class="icon-circle bg-primary bg-opacity-10 text-primary" style="width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="bi bi-telephone fs-5"></i>
                    </div>
                    <div>
                        <div class="small text-muted fw-bold text-uppercase" style="letter-spacing: 1px;">{{ __('Phone') }}</div>
                        <div class="fw-bold">+855 12 345 678</div>
                    </div>
                </div>
                <div class="glass p-3 rounded-4 d-flex align-items-center gap-3">
                    <div class="icon-circle bg-primary bg-opacity-10 text-primary" style="width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="bi bi-instagram fs-5"></i>
                    </div>
                    <div>
                        <div class="small text-muted fw-bold text-uppercase" style="letter-spacing: 1px;">{{ __('Instagram') }}</div>
                        <div class="fw-bold">@npiadrink</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass p-4 rounded-4" data-animate>
            <h3 class="section-title mb-4" style="font-size: 1.4rem;">
                <i class="bi bi-clock"></i>{{ __('Delivery Hours') }}
            </h3>
            <div class="d-grid gap-2">
                @php $hours = [
                    ['Monday – Friday', '8:00 AM – 10:00 PM'],
                    ['Saturday',        '9:00 AM – 10:00 PM'],
                    ['Sunday',          '9:00 AM – 9:00 PM'],
                ]; @endphp
                @foreach($hours as $h)
                <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-opacity-10 border-white">
                    <span class="text-muted small fw-bold">{{ __($h[0]) }}</span>
                    <span class="text-primary fw-800 small">{{ __($h[1]) }}</span>
                </div>
                @endforeach
            </div>
            <div class="mt-4 p-3 glass rounded-4 d-flex align-items-center gap-3 border-success border-opacity-25">
                <div class="pulse-glow rounded-circle bg-success" style="width: 12px; height: 12px;"></div>
                <span class="text-success fw-bold small">{{ __('Free delivery on all orders!') }}</span>
            </div>
        </div>
    </div>
</div>

@endsection


@endsection