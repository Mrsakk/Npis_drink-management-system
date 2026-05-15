@extends('store.layout')

@section('title', __('Shop') . ' – ' . __('NPIA Drink Store'))

@section('styles')
{{-- Custom styles for this page if needed --}}
@endsection

@section('content')

{{-- Page Header --}}
<div class="shop-hero-luxury mb-5" data-animate>
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <div class="luxury-badge mb-3">
                <i class="bi bi-shop"></i> {{ __('Premium Collection') }}
            </div>
            <h1 class="hero-title-luxury fs-2 mb-3">{{ __('Explore Our') }} <span class="text-gradient">{{ __('Boutique') }}</span></h1>
            <p class="hero-sub-luxury mb-0">{{ __('Indulge in a curated selection of refined beverages and gourmet snacks, crafted for those who demand excellence.') }}</p>
        </div>
        <div class="col-lg-5 text-lg-end">
            <div class="inventory-card-luxury glass rounded-4 p-4 d-inline-flex align-items-center gap-4">
                <div class="stat-icon-luxury bg-primary"><i class="bi bi-collection"></i></div>
                <div class="text-start">
                    <div class="small text-muted fw-800 text-uppercase ls-1">{{ __('Total Curated') }}</div>
                    <div class="fw-900 fs-4" style="color:var(--text);">{{ $products->total() }} {{ __('Items') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- ── Sidebar Filter ── --}}
    <div class="col-lg-3">
        <div class="glass rounded-5 p-4 sticky-top d-none d-lg-block" style="top: 110px; z-index: 100;" data-animate>
            <h6 class="fw-900 text-uppercase ls-2 mb-4 p-2" style="color:var(--text); font-size: 0.8rem;">{{ __('Categories') }}</h6>
            
            <div class="d-grid gap-2">
                <a href="{{ route('shop') }}"
                   class="luxury-filter-link glass {{ !request()->category ? 'active' : '' }}">
                    <span class="d-flex align-items-center gap-2"><i class="bi bi-grid-fill"></i>{{ __('All Collections') }}</span>
                    <span class="count-badge">{{ $products->total() }}</span>
                </a>
                
                @foreach($categories as $category)
                    <a href="{{ route('category', $category->slug) }}"
                       class="luxury-filter-link glass {{ request()->category == $category->slug ? 'active' : '' }}">
                        <span class="text-truncate">{{ __($category->name) }}</span>
                        <span class="count-badge ghost">{{ $category->products->count() }}</span>
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
                    <div class="search-box-luxury">
                        <i class="bi bi-search"></i>
                        <input type="text" name="search" placeholder="{{ __('Search products, flavors, brands...') }}" value="{{ request()->search }}">
                        <button type="submit">{{ __('Search Now') }}</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="responsive-card-grid-luxury">
            @forelse($products as $index => $product)
            <div data-animate style="transition-delay: {{ $index * 0.05 }}s;">
                <div class="luxury-product-card glass-card">
                    <div class="card-img-wrapper-luxury">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="product-img-luxury" alt="{{ $product->name }}" loading="lazy">
                        @else
                            <div class="product-img-placeholder"><i class="bi bi-cup-straw fs-1 opacity-25"></i></div>
                        @endif
                        <div class="category-badge-luxury">{{ $product->category->name }}</div>
                        
                        <div class="quick-view-overlay-luxury">
                            <button type="button" class="btn-qv-luxury" onclick="openQuickView({
                                id: '{{ $product->id }}',
                                name: '{{ addslashes($product->name) }}',
                                category: '{{ addslashes($product->category->name) }}',
                                description: '{{ addslashes($product->description) }}',
                                price: '{{ number_format($product->price, 0) }}',
                                image: '{{ $product->image ? asset('storage/' . $product->image) : asset('img/logo.png') }}'
                            })">
                                <i class="bi bi-eye"></i> {{ __('Quick View') }}
                            </button>
                        </div>
                    </div>
                    <div class="product-info-luxury">
                        <h5 class="product-name-luxury">{{ $product->name }}</h5>
                        <p class="text-muted small mb-0 line-clamp-2" style="font-size: 0.8rem; height: 2.4rem;">{{ Str::limit($product->description, 60) }}</p>
                        
                        <div class="product-meta-luxury mt-3">
                            <span class="price-val-luxury">៛{{ number_format($product->price, 0) }}</span>
                            <div class="delivery-stat-luxury"><i class="bi bi-lightning-charge-fill"></i> FAST</div>
                        </div>
                        
                        <form action="{{ route('add-to-cart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn-cart-luxury">
                                <i class="bi bi-plus-lg me-2"></i> {{ __('Add to Bag') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12" data-animate>
                <div class="glass rounded-5 p-5 text-center border-dashed">
                    <div class="icon-circle bg-primary bg-opacity-10 text-primary mx-auto mb-4" style="width: 80px; height: 80px; border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-search fs-1"></i>
                    </div>
                    <h4 class="fw-900" style="color:var(--text);">{{ __('No exquisite items found') }}</h4>
                    <p class="text-muted mb-4">{{ __('We could not locate any products matching your refined search criteria.') }}</p>
                    <a href="{{ route('shop') }}" class="btn-luxury-ghost">
                        <i class="bi bi-arrow-counterclockwise me-2"></i>{{ __('Reset All Filters') }}
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