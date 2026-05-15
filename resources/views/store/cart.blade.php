@extends('store.layout')

@section('title', __('Shopping Cart') . ' - NPIA Drink Store')

@section('styles')
{{-- Custom styles for this page if needed --}}
@endsection

@section('content')

{{-- Page Header --}}
<div class="hero-section mb-5 py-4 px-5" data-animate>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
        <div>
            <h1 class="hero-title mb-2" style="font-size: 3rem;"><i class="bi bi-cart3 me-2 text-gradient"></i>{{ __('Shopping Cart') }}</h1>
            <p class="hero-sub mb-0">{{ __('Review your selected items before checkout') }}</p>
        </div>
        <div class="glass px-4 py-3 rounded-pill d-flex align-items-center gap-3">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-list-check"></i>
            </div>
            <div>
                <div class="small text-muted fw-bold">{{ __('Items') }}</div>
                <div class="fw-bold fs-5">{{ !empty($cartItems) ? count($cartItems) : 0 }}</div>
            </div>
        </div>
    </div>
</div>

@if(empty($cartItems))
    <div class="glass p-5 text-center rounded-4 border-dashed" data-animate>
        <div class="icon-circle bg-secondary bg-opacity-10 text-muted mx-auto mb-4" style="width: 100px; height: 100px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
            <i class="bi bi-cart-x fs-1"></i>
        </div>
        <h3 class="fw-bold">{{ __('Your cart is empty') }}</h3>
        <p class="text-muted mb-5">{{ __('Looks like you haven\'t added any items to your cart yet.') }}</p>
        <a href="{{ route('shop') }}" class="btn-luxury btn-luxury-primary px-5 py-3">
            <i class="bi bi-arrow-left me-2"></i>{{ __('Continue Shopping') }}
        </a>
    </div>
@else
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="glass p-4 rounded-4" data-animate>
                <h5 class="section-title mb-4" style="font-size: 1.2rem;"><i class="bi bi-bag-check-fill"></i> {{ __('Cart Items') }}</h5>
                
                <div class="d-grid gap-3">
                    @foreach($cartItems as $index => $item)
                    <div class="glass p-3 rounded-4 d-flex align-items-center gap-4 flex-wrap" data-animate style="transition-delay: {{ $index * 0.05 }}s;">
                        @if(isset($item['image']) && $item['image'])
                            <img src="{{ asset('storage/'.$item['image']) }}" class="rounded-3 shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <div class="rounded-3 bg-secondary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;"><i class="bi bi-cup-straw fs-2"></i></div>
                        @endif
                        
                        <div class="flex-grow-1 min-width-0">
                            <h6 class="fw-bold mb-1">{{ $item['name'] }}</h6>
                            <div class="text-muted small fw-bold">៛{{ number_format($item['price'], 0) }} / unit</div>
                        </div>
                        
                        <div class="d-flex align-items-center gap-2">
                            <form action="{{ route('update-cart') }}" method="POST" class="d-flex align-items-center glass px-2 py-1 rounded-pill">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control border-0 bg-transparent text-center fw-bold p-0" style="width: 40px; box-shadow: none;">
                                <button type="submit" class="btn btn-link text-primary p-1 shadow-none" title="Update"><i class="bi bi-arrow-clockwise"></i></button>
                            </form>
                            
                            <div class="text-end px-3">
                                <div class="small text-muted">{{ __('Total') }}</div>
                                <div class="fw-bold text-primary">៛{{ number_format($item['price'] * $item['quantity'], 0) }}</div>
                            </div>
                            
                            <form action="{{ route('remove-from-cart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                <button type="submit" class="btn btn-outline-danger border-0 rounded-circle" style="width: 40px; height: 40px;" title="Remove Item"><i class="bi bi-trash3"></i></button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="glass p-4 rounded-4 sticky-top" style="top: 100px;" data-animate>
                <h5 class="section-title mb-4" style="font-size: 1.2rem;"><i class="bi bi-receipt"></i> {{ __('Order Summary') }}</h5>
                
                <div class="d-grid gap-3 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">{{ __('Subtotal') }}</span>
                        <span class="fw-bold">៛{{ number_format($subtotal, 0) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">{{ __('Delivery') }}</span>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">{{ __('Free') }}</span>
                    </div>
                    <hr class="my-2 opacity-10">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold fs-5">{{ __('Grand Total') }}</span>
                        <span class="fw-900 fs-3 text-gradient">៛{{ number_format($subtotal, 0) }}</span>
                    </div>
                </div>
                
                <div class="d-grid gap-3">
                    <a href="{{ route('checkout') }}" class="btn-luxury btn-luxury-primary w-100 py-3 fs-5">
                        {{ __('Checkout Now') }} <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('shop') }}" class="btn-luxury btn-luxury-outline w-100 py-2">
                        {{ __('Continue Shopping') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection