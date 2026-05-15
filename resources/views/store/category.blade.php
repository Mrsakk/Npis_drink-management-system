@extends('store.layout')

@section('title', $category->name . ' - NPIA Drink Store')

@section('content')

<div class="breadcrumb-bar" data-animate>
    <a href="{{ route('home') }}"><i class="bi bi-house-door me-1"></i>{{ __('Home') }}</a>
    <span class="sep"><i class="bi bi-chevron-right"></i></span>
    <a href="{{ route('categories') }}">{{ __('Categories') }}</a>
    <span class="sep"><i class="bi bi-chevron-right"></i></span>
    <span class="current">{{ $category->name }}</span>
</div>

<div class="cat-banner-luxury" data-animate>
    @if($category->image)
        <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}">
    @else
        <div class="cat-banner-placeholder h-100 d-flex align-items-center justify-content-center" style="background: rgba(14,165,233,0.05);">
            <i class="bi bi-grid-3x3-gap-fill fs-1 text-primary opacity-20"></i>
        </div>
    @endif
    <div class="cat-banner-overlay-premium">
        <div>
            <div class="cat-badge-premium">
                <i class="bi bi-tag-fill"></i> {{ __('Collection') }}
            </div>
            <h1 class="hero-title text-white mb-3" style="font-size: 3.5rem;">{{ $category->name }}</h1>
            @if($category->description)
                <p class="text-white text-opacity-80 mb-4" style="max-width: 600px; font-size: 1.1rem; line-height: 1.6;">{{ $category->description }}</p>
            @endif
            <div class="badge glass rounded-pill px-4 py-2" style="font-size: 0.9rem; border-color: rgba(255,255,255,0.2);">
                <i class="bi bi-box-seam me-2"></i> {{ $products->total() }} {{ __('Items Found') }}
            </div>
        </div>
    </div>
</div>

<div class="filter-bar" data-animate>
    <div class="filter-group">
        <span class="text-muted small fw-700 text-uppercase letter-spacing-1">{{ __('Sort By') }}:</span>
        <button class="btn-filter active">{{ __('All Products') }}</button>
        <button class="btn-filter">{{ __('Premium Only') }}</button>
    </div>
    <div class="filter-group">
        <span class="text-muted small">{{ __('Displaying') }} {{ $products->count() }} {{ __('of') }} {{ $products->total() }}</span>
    </div>
</div>

<div class="row g-4 mb-5">
    @forelse($products as $index => $product)
    <div class="col-lg-4 col-md-6" data-animate>
        <div class="product-card-premium">
            <div class="product-img-box">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                @else
                    <div class="bg-secondary bg-opacity-10 text-primary d-flex align-items-center justify-content-center h-100">
                        <i class="bi bi-cup-straw fs-1"></i>
                    </div>
                @endif
                <div class="position-absolute top-0 end-0 p-3">
                    <span class="badge glass rounded-pill px-3 py-2 text-primary" style="font-size: 0.7rem;">
                        <i class="bi bi-stars me-1"></i> {{ __('Premium') }}
                    </span>
                </div>
            </div>
            <div class="product-info-box">
                <h5 class="product-title-premium">{{ $product->name }}</h5>
                <p class="text-muted small mb-4">{{ Str::limit($product->description, 70) }}</p>
                
                <div class="mt-auto">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="product-price-premium">៛{{ number_format($product->price, 2) }}</span>
                    </div>
                    <form action="{{ route('add-to-cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-premium-cart">
                            <i class="bi bi-cart-plus-fill fs-5"></i> {{ __('Add to Cart') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12" data-animate>
        <div class="glass text-center p-5 rounded-5 border-dashed">
            <i class="bi bi-emoji-frown fs-1 text-primary opacity-50 mb-3 d-block"></i>
            <h4 class="fw-800" style="color:var(--clr-text);">{{ __('No products found') }}</h4>
            <p class="text-muted">{{ __('We are currently updating our inventory for this category.') }}</p>
            <a href="{{ route('categories') }}" class="btn-luxury btn-luxury-outline mt-4 px-5">
                <i class="bi bi-arrow-left me-2"></i>{{ __('Back to Categories') }}
            </a>
        </div>
    </div>
    @endforelse
</div>

@if($products->hasPages())
<div class="d-flex justify-content-center mt-5 mb-5" data-animate>
    {{ $products->links('pagination::bootstrap-5') }}
</div>
@endif

@endsection