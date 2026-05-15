@extends('store.layout')

@section('title', __('NPIA Drink Store') . ' – ' . __('Fresh Beverages Delivered'))

@section('styles')
{{-- Custom styles for this page if needed --}}
@endsection

@section('content')

<div class="hero-section-luxury mb-5" data-animate>
    <div class="row align-items-center g-xl-5">
        <div class="col-lg-7">
            <div class="luxury-badge mb-4">
                <i class="bi bi-stars"></i> {{ __('Official Premium Store') }}
            </div>
            <h1 class="hero-title-luxury mb-4">
                NPIA <span class="text-gradient">{{ __('Drink') }}</span><br>
                <span class="ls-tight">{{ __('Experience Excellence') }}</span>
            </h1>
            <p class="hero-sub-luxury mb-5">
                {{ __('Discover an elite collection of premium beverages and gourmet snacks, delivered with lightning speed and surgical precision to your doorstep.') }}
            </p>
            
            <div class="d-flex flex-wrap gap-4 mb-5">
                <a href="{{ route('shop') }}" class="btn-luxury-primary-lg">
                    <i class="bi bi-bag-check-fill me-2"></i>{{ __('Start Shopping') }}
                </a>
                <a href="{{ route('about') }}" class="btn-luxury-outline-lg">
                    <i class="bi bi-info-circle me-2"></i>{{ __('Our Story') }}
                </a>
            </div>
            
            <div class="hero-stats-luxury glass rounded-4 p-4 d-flex gap-5">
                <div class="stat-box">
                    <div class="stat-val">15+</div>
                    <div class="stat-label">{{ __('Mins Delivery') }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-val">500+</div>
                    <div class="stat-label">{{ __('Products') }}</div>
                </div>
                <div class="stat-box">
                    <div class="stat-val">100%</div>
                    <div class="stat-label">{{ __('Freshness') }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 text-center position-relative">
            <div class="hero-image-wrapper">
                <div class="logo-hero-ultra glass">
                    <img src="{{ asset('img/logo.png') }}" alt="NPIA" class="logo-img-main">
                </div>
                <div class="floating-luxury-badge badge-top glass">
                    <div class="badge-icon bg-warning"><i class="bi bi-lightning-charge-fill"></i></div>
                    <div class="badge-text">
                        <div class="fw-900">FAST</div>
                        <div class="small opacity-75">Delivery</div>
                    </div>
                </div>
                <div class="floating-luxury-badge badge-bottom glass">
                    <div class="badge-icon bg-success"><i class="bi bi-shield-check"></i></div>
                    <div class="badge-text">
                        <div class="fw-900">SECURE</div>
                        <div class="small opacity-75">Payments</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="mb-5 pb-5">
    <div class="d-flex justify-content-between align-items-end mb-5" data-animate>
        <div>
            <h2 class="section-title-luxury mb-2"><i class="bi bi-stars text-warning"></i> {{ __('Curated Collection') }}</h2>
            <p class="text-muted fs-5">{{ __('Handpicked premium selections for your refined taste') }}</p>
        </div>
        <a href="{{ route('shop') }}" class="btn-view-all-luxury">{{ __('Explore All') }} <i class="bi bi-arrow-right ms-2"></i></a>
    </div>
    
    <div class="responsive-card-grid-luxury">
        @foreach($featuredProducts as $index => $product)
        <div data-animate style="transition-delay: {{ $index * 0.1 }}s;">
            <div class="luxury-product-card glass-card">
                <div class="card-img-wrapper-luxury">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="product-img-luxury" alt="{{ $product->name }}">
                    @else
                        <div class="product-img-placeholder"><i class="bi bi-cup-straw fs-1"></i></div>
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
                    <div class="product-meta-luxury">
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
        @endforeach
    </div>
</section>

{{-- ── Categories ── --}}
<section class="mb-5 pb-5">
    <div class="mb-5 d-flex justify-content-between align-items-end" data-animate>
        <div>
            <h2 class="section-title-luxury mb-2"><i class="bi bi-grid-3x3-gap text-primary"></i> {{ __('Signature Categories') }}</h2>
            <p class="text-muted fs-5">{{ __('Refined collections crafted for every mood and moment') }}</p>
        </div>
        <a href="{{ route('categories') }}" class="btn-view-all-luxury">{{ __('All Categories') }} <i class="bi bi-arrow-right ms-2"></i></a>
    </div>
    
    <div class="responsive-card-grid-luxury" style="--card-min-width: clamp(160px, 20vw, 220px);">
        @foreach($categories as $index => $category)
        <div data-animate style="transition-delay: {{ $index * 0.05 }}s;">
            <a href="{{ route('category', $category->slug) }}" class="luxury-category-card glass-card">
                <div class="cat-icon-luxury glass shadow-sm">
                    @if($category->image)
                        <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}" class="cat-img-mini">
                    @else
                        <i class="bi bi-tag-fill"></i>
                    @endif
                </div>
                <div class="cat-content-luxury">
                    <div class="cat-name-luxury">{{ __($category->name) }}</div>
                    <div class="cat-count-luxury">{{ $category->products->count() }} {{ __('Products') }}</div>
                </div>
                <div class="cat-arrow-luxury"><i class="bi bi-chevron-right"></i></div>
            </a>
        </div>
        @endforeach
    </div>
</section>

{{-- ── Features / Why Us ── --}}
<section class="mb-5 pb-5" data-animate>
    <div class="glass-card p-4 p-lg-5 rounded-4 border-0 shadow-premium overflow-hidden position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="section-title mb-4">{{ __('Why Choose') }} <span class="text-gradient">NPIA Drink</span>?</h2>
                <div class="d-grid gap-4">
                    <div class="d-flex gap-3">
                        <div class="icon-box-premium glass">
                            <i class="bi bi-lightning-charge fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">{{ __('Lightning Fast Delivery') }}</h5>
                            <p class="text-muted small mb-0">{{ __('We understand cravings. That\'s why we deliver in under 15 minutes to your doorstep.') }}</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="icon-box-premium glass">
                            <i class="bi bi-shield-check fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">{{ __('Premium Quality') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Only the best brands and freshest products make it to our store shelves.') }}</p>
                        </div>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="icon-box-premium glass">
                            <i class="bi bi-headset fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-1">{{ __('24/7 Support') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Have a question? Our friendly support team is always here to help you via Telegram.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-center">
                <div class="position-relative">
                    <div class="glass p-3 rounded-4 shadow-lg rotate-3d-hover">
                        <img src="{{ asset('img/logo.png') }}" alt="Premium Service" class="img-fluid rounded-4" style="max-height: 300px; filter: drop-shadow(0 20px 30px rgba(0,0,0,0.1));">
                    </div>
                    {{-- Decorative elements --}}
                    <div class="position-absolute top-0 start-0 translate-middle p-3 glass rounded-circle shadow-sm" style="animation: float 4s infinite alternate;">
                        <i class="bi bi-heart-fill text-danger fs-4"></i>
                    </div>
                    <div class="position-absolute bottom-0 end-0 translate-middle p-3 glass rounded-circle shadow-sm" style="animation: float 5s infinite alternate-reverse;">
                        <i class="bi bi-cup-hot-fill text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
{{-- Additional scripts if needed --}}
@endsection