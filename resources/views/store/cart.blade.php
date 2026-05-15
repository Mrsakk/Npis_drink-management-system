@extends('store.layout')

@section('title', __('Shopping Cart') . ' - NPIA Drink Store')

@section('styles')
{{-- Custom styles for this page if needed --}}
@endsection

@section('content')

{{-- Page Header --}}
<div class="cart-hero-luxury mb-5" data-animate>
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <div class="luxury-badge mb-3">
                <i class="bi bi-cart3"></i> {{ __('Your Selection') }}
            </div>
            <h1 class="hero-title-luxury fs-2 mb-3">{{ __('Review Your') }} <span class="text-gradient">{{ __('Bag') }}</span></h1>
            <p class="hero-sub-luxury mb-0">{{ __('Indulge in your curated selection. Review your items and proceed to an elite delivery experience.') }}</p>
        </div>
        <div class="col-lg-5 text-lg-end">
            <div class="cart-stat-card-luxury glass rounded-4 p-4 d-inline-flex align-items-center gap-4">
                <div class="stat-icon-luxury bg-accent"><i class="bi bi-bag-check"></i></div>
                <div class="text-start">
                    <div class="small text-muted fw-800 text-uppercase ls-1">{{ __('Items In Bag') }}</div>
                    <div class="fw-900 fs-4" style="color:var(--text);">{{ !empty($cartItems) ? count($cartItems) : 0 }} {{ __('Products') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(empty($cartItems))
    <div class="glass rounded-5 p-5 text-center border-dashed" data-animate>
        <div class="icon-circle bg-primary bg-opacity-10 text-primary mx-auto mb-4" style="width: 100px; height: 100px; border-radius: 20px; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-cart-x fs-1"></i>
        </div>
        <h3 class="fw-900" style="color:var(--text);">{{ __('Your bag is currently empty') }}</h3>
        <p class="text-muted mb-5">{{ __('It seems you haven\'t added any exquisite items to your selection yet.') }}</p>
        <a href="{{ route('shop') }}" class="btn-luxury-primary-lg">
            <i class="bi bi-arrow-left me-2"></i>{{ __('Start Exploring') }}
        </a>
    </div>
@else
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="glass rounded-5 p-4 p-md-5" data-animate>
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <h5 class="fw-800 mb-0" style="color:var(--text);"><i class="bi bi-bag-check-fill text-primary me-2"></i>{{ __('Review Items') }}</h5>
                    <span class="badge glass rounded-pill px-3 py-2 text-muted fw-bold">{{ count($cartItems) }} {{ __('Items') }}</span>
                </div>
                
                <div class="d-grid gap-4">
                    @foreach($cartItems as $index => $item)
                    <div class="luxury-cart-item-card glass-card" data-animate style="transition-delay: {{ $index * 0.1 }}s;">
                        <div class="row align-items-center g-4">
                            <div class="col-auto">
                                <div class="luxury-cart-img-wrapper">
                                    @if(isset($item['image']) && $item['image'])
                                        <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" class="cart-img-luxury">
                                    @else
                                        <div class="cart-img-placeholder-luxury"><i class="bi bi-cup-straw"></i></div>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <h6 class="fw-900 mb-1 fs-5" style="color:var(--text);">{{ $item['name'] }}</h6>
                                <p class="text-muted small mb-0">{{ __('Unit Price') }}: <span class="fw-800 text-primary">៛{{ number_format($item['price'], 0) }}</span></p>
                            </div>
                            <div class="col-md-auto">
                                <div class="d-flex align-items-center gap-4">
                                    {{-- Quantity Selector --}}
                                    <form action="{{ route('update-cart') }}" method="POST" class="luxury-qty-selector glass p-1">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                        <button type="button" class="btn-qty-luxury" onclick="this.nextElementSibling.stepDown(); this.form.submit();"><i class="bi bi-dash"></i></button>
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="qty-input-ultra" readonly>
                                        <button type="button" class="btn-qty-luxury" onclick="this.previousElementSibling.stepUp(); this.form.submit();"><i class="bi bi-plus"></i></button>
                                    </form>

                                    <div class="text-end" style="min-width: 120px;">
                                        <div class="small text-muted fw-800 text-uppercase ls-1" style="font-size: 0.65rem;">{{ __('Subtotal') }}</div>
                                        <div class="fw-900 fs-5 text-primary">៛{{ number_format($item['price'] * $item['quantity'], 0) }}</div>
                                    </div>

                                    <form action="{{ route('remove-from-cart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                        <button type="submit" class="btn-remove-ultra" title="{{ __('Remove Item') }}"><i class="bi bi-x-lg"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="glass rounded-5 p-4 p-md-5 sticky-top" style="top: 110px;" data-animate>
                <div class="d-flex align-items-center gap-3 mb-5">
                    <div class="icon-circle glass text-primary" style="width: 48px; height: 48px; border-radius: 14px;">
                        <i class="bi bi-receipt fs-5"></i>
                    </div>
                    <h5 class="fw-900 mb-0" style="color:var(--text);">{{ __('Order Review') }}</h5>
                </div>
                
                <div class="d-grid gap-4 mb-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted fw-800 text-uppercase ls-1 small">{{ __('Items Total') }}</span>
                        <span class="fw-900" style="color:var(--text);">៛{{ number_format($subtotal, 0) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted fw-800 text-uppercase ls-1 small">{{ __('Service Fee') }}</span>
                        <span class="text-success fw-900 small">{{ __('COMPLIMENTARY') }}</span>
                    </div>
                    
                    <div class="receipt-divider"></div>
                    
                    <div class="d-flex justify-content-between align-items-end">
                        <div>
                            <div class="fw-900 fs-4 mb-1" style="color:var(--text);">{{ __('Total Est.') }}</div>
                            <div class="small text-muted fw-700">{{ __('Final price in local currency') }}</div>
                        </div>
                        <div class="fw-900 fs-2 text-gradient">៛{{ number_format($subtotal, 0) }}</div>
                    </div>
                </div>
                
                <div class="d-grid gap-3">
                    <a href="{{ route('checkout') }}" class="btn-luxury-primary-lg w-100 justify-content-center">
                        {{ __('Proceed to Checkout') }} <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('shop') }}" class="btn-luxury-ghost w-100 text-center">
                        <i class="bi bi-bag me-2"></i>{{ __('Continue Browsing') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection