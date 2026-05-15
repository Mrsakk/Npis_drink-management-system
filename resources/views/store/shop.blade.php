@extends('store.layout')

@section('title', __('Shop') . ' – ' . __('NPIA Drink Store'))

@section('styles')
{{-- Custom styles for this page if needed --}}
@endsection

@section('content')

{{-- Page Header --}}
<div class="hero-section mb-5 py-4 px-5" data-animate>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
        <div>
            <h1 class="hero-title mb-2" style="font-size: 3rem;"><i class="bi bi-bag-heart me-2 text-gradient"></i>{{ __('Shop Fresh Items') }}</h1>
            <p class="hero-sub mb-0">{{ __('Browse our premium collection of refreshing beverages and energizing snacks.') }}</p>
        </div>
        <div class="glass px-4 py-3 rounded-pill d-flex align-items-center gap-3">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-collection"></i>
            </div>
            <div>
                <div class="small text-muted fw-bold">{{ __('Inventory') }}</div>
                <div class="fw-bold fs-5">{{ $products->total() }} {{ __('Products') }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- ── Sidebar Filter ── --}}
    <div class="col-lg-3">
        <div class="glass p-4 rounded-4 sticky-top" style="top: 100px; z-index: 100;">
            <h5 class="section-title mb-4" style="font-size: 1.2rem;"><i class="bi bi-grid-3x3-gap-fill"></i> {{ __('Categories') }}</h5>
            
            <div class="d-grid gap-2">
                <a href="{{ route('shop') }}"
                   class="nav-link glass d-flex align-items-center justify-content-between px-3 py-2 {{ !request()->category ? 'active-page' : '' }}">
                    <span><i class="bi bi-collection me-2"></i>{{ __('All Products') }}</span>
                    <span class="badge bg-primary rounded-pill small">{{ $products->total() }}</span>
                </a>
                
                @foreach($categories as $category)
                    <a href="{{ route('category', $category->slug) }}"
                       class="nav-link glass d-flex align-items-center justify-content-between px-3 py-2 {{ request()->category == $category->slug ? 'active-page' : '' }}">
                        <span>{{ __($category->name) }}</span>
                        <span class="badge bg-secondary bg-opacity-25 text-primary rounded-pill small">{{ $category->products->count() }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── Products Area ── --}}
    <div class="col-lg-9">
        {{-- Search & Sort --}}
        <div class="glass p-4 rounded-4 mb-4" data-animate>
            <form action="{{ route('shop') }}" method="GET" class="row g-3">
                @if(request()->category)
                    <input type="hidden" name="category" value="{{ request()->category }}">
                @endif
                <div class="col-md-8">
                    <div class="glass d-flex align-items-center px-3 py-1 rounded-pill">
                        <i class="bi bi-search text-muted me-3"></i>
                        <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none py-2"
                            placeholder="{{ __('Search products, flavors, brands...') }}" value="{{ request()->search }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn-luxury btn-luxury-primary w-100 py-2 rounded-pill">
                        {{ __('Search Now') }}
                    </button>
                </div>
            </form>
        </div>

        {{-- Products Grid --}}
        <div class="row g-4 mb-5">
            @forelse($products as $index => $product)
            <div class="col-md-4 col-sm-6" data-animate style="transition-delay: {{ $index * 0.05 }}s;">
                <div class="product-card">
                    <div class="card-img-wrapper">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" loading="lazy">
                        @else
                            <div class="bg-secondary bg-opacity-10 text-primary d-flex align-items-center justify-content-center h-100"><i class="bi bi-cup-straw fs-1"></i></div>
                        @endif
                        <span class="product-badge">{{ $product->category->name }}</span>
                    </div>
                    <div class="product-info">
                        <h5 class="product-name">{{ $product->name }}</h5>
                        <p class="text-muted small mb-0">{{ Str::limit($product->description, 60) }}</p>
                        
                        <div class="mt-auto d-flex align-items-center justify-content-between pt-4">
                            <span class="price-text">៛{{ number_format($product->price, 0) }}</span>
                            <div class="pulse-glow rounded-circle bg-success" style="width: 8px; height: 8px;" title="In Stock"></div>
                        </div>
                        
                        <form action="{{ route('add-to-cart') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn-add-cart">
                                <i class="bi bi-cart-plus-fill"></i> {{ __('Add to Cart') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12" data-animate>
                <div class="glass p-5 text-center rounded-4 border-dashed">
                    <div class="icon-circle bg-secondary bg-opacity-10 text-muted mx-auto mb-4" style="width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-search fs-1"></i>
                    </div>
                    <h4 class="fw-bold">{{ __('No products found') }}</h4>
                    <p class="text-muted mb-4">{{ __('We could not find any products matching your current search or filters.') }}</p>
                    <a href="{{ route('shop') }}" class="btn-luxury btn-luxury-outline px-5 py-2">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>{{ __('Clear All Filters') }}
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
        <div class="d-flex justify-content-center mt-5 mb-5" data-animate>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>

@endsection