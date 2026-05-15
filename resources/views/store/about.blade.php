@extends('store.layout')

@section('title', __('About') . ' – ' . __('NPIA Drink Store'))

@section('content')


{{-- Hero Section --}}
<div class="about-hero-luxury py-10 mb-5" data-animate>
    <div class="row align-items-center g-5">
        <div class="col-lg-7">
            <div class="luxury-badge mb-4">
                <i class="bi bi-stars"></i> {{ __('Our Premium Story') }}
            </div>
            <h1 class="hero-title display-2 fw-900 mb-4" style="line-height: 1.05;">
                {{ __('Crafting') }} <span class="text-gradient">{{ __('Excellence') }}</span><br>
                {{ __('Since 2024') }}
            </h1>
            <p class="hero-sub fs-4 mb-5 opacity-75" style="line-height: 1.6;">
                {{ __('NPIA Drink Store is dedicated to elevating the academic lifestyle through artisanal beverage experiences and lightning-fast delivery fluidics.') }}
            </p>
            <div class="d-flex flex-wrap gap-4">
                <a href="{{ route('shop') }}" class="btn-luxury btn-luxury-primary-lg px-5">
                    <i class="bi bi-shop"></i> {{ __('Explore Collection') }}
                </a>
            </div>
        </div>
        <div class="col-lg-5 text-center position-relative">
            <div class="hero-image-wrapper">
                <div class="logo-hero-ultra glass mx-auto">
                    <img src="{{ asset('img/logo.png') }}" alt="NPIA" class="logo-img-main">
                </div>
                <div class="floating-luxury-badge badge-top glass">
                    <div class="badge-icon bg-warning"><i class="bi bi-lightning-charge-fill"></i></div>
                    <div class="badge-text text-start">
                        <div class="fw-900">FAST</div>
                        <div class="small opacity-75">Delivery</div>
                    </div>
                </div>
                <div class="floating-luxury-badge badge-bottom glass">
                    <div class="badge-icon bg-success"><i class="bi bi-shield-check"></i></div>
                    <div class="badge-text text-start">
                        <div class="fw-900">SECURE</div>
                        <div class="small opacity-75">Payments</div>
                    </div>
                </div>
            </div>
            <div class="mt-4" data-animate>
                <h3 class="fw-900 mb-1" style="color:var(--text);">NPIA <span class="text-gradient">Drink</span></h3>
                <p class="text-muted small ls-2 text-uppercase fw-bold">{{ __('Artisanal Beverage Guild') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 g-lg-5">
    {{-- Philosophy Grid --}}
    <div class="col-lg-7">
        <div class="glass rounded-5 p-4 p-md-5 h-100 shadow-lg" data-animate>
            <div class="d-flex align-items-center gap-4 mb-5">
                <div class="icon-circle-premium glass text-warning"><i class="bi bi-lightning-charge"></i></div>
                <h2 class="fw-900 mb-0" style="color:var(--text);">{{ __('Artisanal Workflow') }}</h2>
            </div>
            
            <div class="d-grid gap-4">
                @php $steps = [
                    ['Curated Selection', 'Browse our elite beverage inventory', 'bi-search', 'text-primary'],
                    ['Digital Acquisition', 'Add premium items to your tactile cart', 'bi-bag-plus', 'text-accent'],
                    ['Precision Logistics', 'Define your exact delivery coordinates', 'bi-geo-alt', 'text-success'],
                    ['Rapid Execution', 'Orders confirmed with lightning speed', 'bi-check2-all', 'text-warning'],
                    ['Elite Fulfillment', 'Direct-to-room delivery excellence', 'bi-stars', 'text-primary'],
                ]; @endphp
                @foreach($steps as $i => $step)
                <div class="workflow-card-luxury glass p-4 d-flex align-items-center gap-4" data-animate style="transition-delay: {{ $i * 0.1 }}s;">
                    <div class="workflow-number">{{ $i+1 }}</div>
                    <div class="workflow-icon {{ $step[3] }} glass"><i class="bi {{ $step[2] }}"></i></div>
                    <div>
                        <div class="fw-900 fs-5 mb-1" style="color:var(--text);">{{ __($step[0]) }}</div>
                        <div class="text-muted small">{{ __($step[1]) }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Contact + Hours --}}
    <div class="col-lg-5">
        <div class="glass rounded-5 p-4 p-md-5 mb-4" data-animate>
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="icon-circle glass text-primary" style="width: 48px; height: 48px; border-radius: 14px;">
                    <i class="bi bi-telephone-fill fs-5"></i>
                </div>
                <h3 class="fw-800 mb-0" style="color:var(--text);">{{ __('Get In Touch') }}</h3>
            </div>

            <div class="d-grid gap-3">
                @php $contacts = [
                    ['Email Us', 'info@npiadrink.com', 'bi-envelope', 'text-primary'],
                    ['Call Support', '+855 12 345 678', 'bi-telephone', 'text-accent'],
                    ['Telegram', '@npiadrink', 'bi-telegram', 'text-info'],
                ]; @endphp
                @foreach($contacts as $contact)
                <div class="contact-card-luxury glass p-4 d-flex align-items-center gap-4">
                    <div class="contact-icon {{ $contact[3] }}"><i class="bi {{ $contact[2] }}"></i></div>
                    <div>
                        <div class="small text-muted fw-bold">{{ __($contact[0]) }}</div>
                        <div class="fw-800 fs-5" style="color:var(--text);">{{ $contact[1] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="glass rounded-5 p-4 p-md-5" data-animate>
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="icon-circle glass text-accent" style="width: 48px; height: 48px; border-radius: 14px;">
                    <i class="bi bi-clock-fill fs-5"></i>
                </div>
                <h3 class="fw-800 mb-0" style="color:var(--text);">{{ __('Open Hours') }}</h3>
            </div>

            <div class="d-grid gap-3">
                @php $hours = [
                    ['Mon – Fri', '8:00 AM – 10:00 PM'],
                    ['Saturday',  '9:00 AM – 10:00 PM'],
                    ['Sunday',    '9:00 AM – 9:00 PM'],
                ]; @endphp
                @foreach($hours as $h)
                <div class="d-flex justify-content-between align-items-center py-3 border-bottom border-opacity-10">
                    <span class="text-muted fw-bold">{{ __($h[0]) }}</span>
                    <span class="fw-800" style="color:var(--text);">{{ $h[1] }}</span>
                </div>
                @endforeach
            </div>
            
            <div class="mt-5 p-4 glass rounded-4 border-success border-opacity-25 d-flex align-items-center gap-3">
                <div class="pulse-indicator bg-success"></div>
                <span class="text-success fw-bold">{{ __('Free Delivery Always!') }}</span>
            </div>
        </div>
    </div>
</div>

@endsection