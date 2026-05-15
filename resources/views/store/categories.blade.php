@extends('store.layout')

@section('title', __('Browse by Category') . ' - NPIA Drink Store')

@section('content')
<div class="categories-hero-luxury mb-5" data-animate>
    <div class="row justify-content-center text-center">
        <div class="col-lg-8">
            <div class="luxury-badge mx-auto mb-3">
                <i class="bi bi-compass-fill"></i> {{ __('Signature Collections') }}
            </div>
            <h1 class="hero-title-luxury mb-3">{{ __('Explore Our') }} <span class="text-gradient">{{ __('Boutique') }}</span></h1>
            <p class="hero-sub-luxury mx-auto mb-5">{{ __('Discover our meticulously curated selection of premium beverages and artisanal snacks, organized for your browsing pleasure.') }}</p>
            
            <div class="search-box-luxury mx-auto">
                <i class="bi bi-search"></i>
                <input type="text" class="search-input-glass" placeholder="{{ __('Search for flavors, brands or items...') }}">
                <button type="button">{{ __('Search') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="responsive-card-grid-luxury mb-5">
    @foreach($categories as $index => $category)
    <div data-animate class="category-grid-item" style="transition-delay: {{ $index * 0.05 }}s;">
        <a href="{{ route('category', $category->slug) }}" class="luxury-product-card glass-card text-decoration-none">
            <div class="card-img-wrapper-luxury">
                @if($category->image)
                    <img src="{{ asset('storage/'.$category->image) }}" class="product-img-luxury" alt="{{ $category->name }}" loading="lazy">
                @else
                    <div class="product-img-placeholder"><i class="bi bi-folder2 fs-1"></i></div>
                @endif
                <div class="category-badge-luxury">{{ $category->products->count() }} {{ __('Products') }}</div>
                
                <div class="quick-view-overlay-luxury">
                    <div class="btn-qv-luxury">
                        <i class="bi bi-eye"></i> {{ __('Enter Boutique') }}
                    </div>
                </div>
            </div>
            <div class="product-info-luxury">
                <h5 class="product-name-luxury">{{ $category->name }}</h5>
                @if($category->description)
                    <p class="text-muted small mb-0 line-clamp-2" style="font-size: 0.8rem; height: 2.4rem;">{{ Str::limit($category->description, 80) }}</p>
                @endif
                
                <div class="mt-auto pt-4">
                    <div class="btn-cart-luxury text-center">
                        {{ __('Explore Collection') }} <i class="bi bi-arrow-right ms-2"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search-input-glass');
    const cards = document.querySelectorAll('.category-grid-item');
    
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase().trim();
            
            cards.forEach(card => {
                const title = card.querySelector('.product-title-premium').textContent.toLowerCase();
                const desc = card.querySelector('.text-muted') ? card.querySelector('.text-muted').textContent.toLowerCase() : '';
                
                if (title.includes(query) || desc.includes(query)) {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                    setTimeout(() => {
                        card.style.display = '';
                    }, 200);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 200);
                }
            });
        });
    }
});
</script>
@endsection
@endsection