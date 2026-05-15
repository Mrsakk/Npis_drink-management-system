@extends('store.layout')

@section('title', __('Browse by Category') . ' - NPIA Drink Store')

@section('content')
<div class="categories-hero" data-animate>
    <div class="cat-badge-premium">
        <i class="bi bi-compass-fill"></i> {{ __('Explore Collections') }}
    </div>
    <h1 class="hero-title mb-3" style="font-size: 4rem;">{{ __('Browse by Category') }}</h1>
    <p class="hero-sub" style="max-width: 700px;">{{ __('Discover our meticulously curated selection of premium beverages and artisanal snacks, organized for your browsing pleasure.') }}</p>
    
    <div class="search-box-glass">
        <i class="bi bi-search search-icon-glass"></i>
        <input type="text" class="search-input-glass" placeholder="{{ __('Search for flavors, brands, or categories...') }}">
    </div>
</div>

<div class="row g-4">
    @foreach($categories as $category)
    <div class="col-lg-4 col-md-6" data-animate>
        <a href="{{ route('category', $category->slug) }}" class="text-decoration-none">
            <div class="product-card-premium">
                <div class="product-img-box">
                    @if($category->image)
                        <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}">
                    @else
                        <div class="bg-secondary bg-opacity-10 text-primary d-flex align-items-center justify-content-center h-100">
                            <i class="bi bi-folder2 fs-1"></i>
                        </div>
                    @endif
                    <div class="position-absolute top-0 end-0 p-3">
                        <span class="badge glass rounded-pill px-3 py-2 text-primary" style="font-size: 0.7rem;">
                            <i class="bi bi-box-seam me-1"></i> {{ $category->products->count() }} {{ __('products') }}
                        </span>
                    </div>
                </div>
                <div class="product-info-box">
                    <h5 class="product-title-premium">{{ $category->name }}</h5>
                    @if($category->description)
                        <p class="text-muted small mb-4">{{ Str::limit($category->description, 80) }}</p>
                    @endif
                    
                    <div class="mt-auto">
                        <div class="btn-premium-cart">
                            {{ __('View Collection') }} <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endsection