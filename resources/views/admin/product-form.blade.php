@extends('admin.layout')
@section('title', isset($product) ? __('Edit Product') : __('Add Product'))

@section('content')

<div class="d-flex align-items-center gap-3 mb-4" data-animate>
    <a href="{{ route('admin.products') }}" class="topbar-btn text-decoration-none">
        <i class="bi bi-arrow-left"></i> {{ __('Back') }}
    </a>
    <div>
        <h4 class="fw-bold mb-0">{{ isset($product) ? __('Edit Product') : __('Add New Product') }}</h4>
        <p class="text-muted small mb-0 mt-1">{{ isset($product) ? __('Update product information') : __('Fill in the product details below') }}</p>
    </div>
</div>

@if($errors->any())
<div class="alert alert-danger mb-4">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    <ul class="mb-0 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<form method="POST" action="{{ isset($product) ? route('admin.product.update', $product) : route('admin.product.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($product)) @method('PUT') @endif

    <div class="row g-4">
        {{-- Left --}}
        <div class="col-lg-8">
            <div class="table-card mb-4" data-animate>
                <div class="card-header">
                    <span><i class="bi bi-info-circle-fill me-2 text-primary"></i>{{ __('Product Details') }}</span>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">{{ __('Product Name') }} *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required placeholder="{{ __('e.g. Fresh Orange Juice') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Category') }} *</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">— {{ __('Select a Category') }} —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ (isset($product) && $product->category_id==$cat->id) || old('category_id')==$cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">{{ __('Description') }}</label>
                        <textarea name="description" class="form-control" rows="5" placeholder="{{ __('Describe the product...') }}">{{ old('description', $product->description ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right --}}
        <div class="col-lg-4">
            <div class="table-card mb-4" data-animate>
                <div class="card-header">
                    <span><i class="bi bi-currency-dollar me-2 text-success"></i>{{ __('Pricing & Stock') }}</span>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">{{ __('Price') }} (៛) *</label>
                        <input type="number" name="price" step="0.01" min="0" class="form-control" value="{{ old('price', $product->price ?? '') }}" required placeholder="0.00">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Stock Quantity') }}</label>
                        <input type="number" name="stock" min="0" class="form-control" value="{{ old('stock', $product->stock ?? 100) }}" placeholder="100">
                    </div>
                    <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: var(--ad-surface-2);">
                        <input type="checkbox" name="is_featured" class="form-check-input" id="featured" style="width:20px;height:20px;" {{ (isset($product) && $product->is_featured) ? 'checked':'' }}>
                        <label for="featured" style="cursor:pointer;margin:0;">
                            <div class="fw-bold small">{{ __('Featured Product') }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">{{ __('Show on home page') }}</div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="table-card" data-animate>
                <div class="card-header">
                    <span><i class="bi bi-image-fill me-2 text-primary"></i>{{ __('Product Image') }}</span>
                </div>
                <div class="card-body text-center">
                    @if(isset($product) && $product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded-3 mb-3" style="max-height:160px;object-fit:cover;">
                        <div class="d-flex align-items-center gap-2 mb-3 p-2 rounded-3" style="background: rgba(220,38,38,0.08); border: 1px solid rgba(220,38,38,0.15);">
                            <input type="checkbox" name="remove_image" id="remove_image" value="1" class="form-check-input" style="width:18px;height:18px;">
                            <label for="remove_image" class="text-danger small mb-0" style="cursor:pointer;">{{ __('Remove current image') }}</label>
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center mb-3 rounded-3" style="height:120px;border:2px dashed var(--ad-border);">
                            <div class="text-center text-muted">
                                <i class="bi bi-cloud-upload fs-2 d-block mb-1 text-primary" style="opacity:0.5;"></i>
                                <small>{{ __('No image uploaded') }}</small>
                            </div>
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted" style="font-size:0.75rem;">PNG, JPG, WEBP – max 2MB</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Actions --}}
    <div class="d-flex gap-3 mt-4">
        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-check-circle-fill me-2"></i>{{ isset($product) ? __('Update Product') : __('Save Product') }}
        </button>
        <a href="{{ route('admin.products') }}" class="btn btn-outline-primary px-4">{{ __('Cancel') }}</a>
    </div>
</form>

@endsection