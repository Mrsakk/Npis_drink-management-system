@extends('store.layout')

@section('title', __('NPIA Drink Store') . ' – ' . __('Fresh Beverages Delivered'))

@section('styles')
{{-- Custom styles for this page if needed --}}
@endsection

@section('content')

{{-- ── Hero ── --}}
<div class="hero-section mb-5" data-animate>
    <div class="row align-items-center">
        <div class="col-lg-7">
            <div class="d-inline-flex align-items-center gap-2 mb-4 px-3 py-2 glass rounded-pill" style="font-size: 0.85rem; font-weight: 700;">
                <i class="bi bi-stars text-warning"></i> {{ __('Premium Quality Guaranteed') }}
            </div>
            <h1 class="hero-title">
                NPIA {{ __('Drink') }}<br><span class="text-gradient">{{ __('Store') }}</span>
            </h1>
            <p class="hero-sub">
                {{ __('Your favourite beverages and snacks delivered straight to your room. Experience instant gratification with our lightning-fast service.') }}
            </p>
            
            <div class="d-flex flex-wrap gap-4 mt-5">
                <a href="{{ route('shop') }}" class="btn-luxury btn-luxury-primary btn-lg px-5">
                    <i class="bi bi-bag-fill"></i>{{ __('Shop Now') }}
                </a>
                <a href="{{ route('about') }}" class="btn-luxury btn-luxury-outline btn-lg px-5">
                    <i class="bi bi-info-circle"></i>{{ __('Learn More') }}
                </a>
            </div>
        </div>
        <div class="col-lg-5 text-center d-none d-lg-block">
            <div class="logo-hero-wrapper">
                <div class="logo-hero-inner">
                    <img src="{{ asset('img/logo.png') }}" alt="NPIA Logo">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Featured Products ── --}}
<section class="mb-5 pb-4">
    <div class="d-flex justify-content-between align-items-end mb-4" data-animate>
        <div>
            <h2 class="section-title mb-1"><i class="bi bi-stars"></i>{{ __('Featured Products') }}</h2>
            <p class="text-muted">{{ __('Handpicked selections for you') }}</p>
        </div>
        <a href="{{ route('shop') }}" class="btn-luxury btn-luxury-outline btn-sm px-4 mb-3">{{ __('View All') }} <i class="bi bi-arrow-right ms-1"></i></a>
    </div>
    
    <div class="row g-4">
        @foreach($featuredProducts as $index => $product)
        <div class="col-xl-3 col-md-4 col-sm-6" data-animate style="transition-delay: {{ $index * 0.1 }}s;">
            <div class="product-card">
                <div class="card-img-wrapper">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <div class="bg-secondary bg-opacity-10 text-primary d-flex align-items-center justify-content-center h-100"><i class="bi bi-cup-straw fs-1"></i></div>
                    @endif
                    <span class="product-badge">{{ $product->category->name }}</span>
                </div>
                <div class="product-info">
                    <h5 class="product-name">{{ $product->name }}</h5>
                    <div class="mt-auto d-flex align-items-center justify-content-between pt-3">
                        <span class="price-text">៛{{ number_format($product->price, 0) }}</span>
                        <div class="small text-muted fw-bold"><i class="bi bi-lightning-charge-fill text-warning me-1"></i>Fast Delivery</div>
                    </div>
                    <form action="{{ route('add-to-cart') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-add-cart">
                            <i class="bi bi-cart-plus-fill"></i> {{ __('Add to cart') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- ── Categories ── --}}
<section class="mb-5 pb-5">
    <div class="mb-4" data-animate>
        <h2 class="section-title mb-1"><i class="bi bi-grid"></i>{{ __('Browse by Category') }}</h2>
        <p class="text-muted">{{ __('Explore our wide range of collections') }}</p>
    </div>
    
    <div class="row g-4">
        @foreach($categories as $index => $category)
        <div class="col-xl-2 col-md-3 col-sm-4 col-6" data-animate style="transition-delay: {{ $index * 0.05 }}s;">
            <a href="{{ route('category', $category->slug) }}" class="category-card h-100">
                <div class="cat-icon">
                    @if($category->image)
                        <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}" style="width:38px;height:38px;object-fit:cover;border-radius:10px;">
                    @else
                        <i class="bi bi-tag"></i>
                    @endif
                </div>
                <div class="cat-name">{{ __($category->name) }}</div>
                <small class="fw-bold text-primary opacity-75">{{ $category->products->count() }} {{ __('items') }}</small>
            </a>
        </div>
        @endforeach
    </div>
</section>

@endsection

@section('scripts')
{{-- Additional scripts if needed --}}
@endsection