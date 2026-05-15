@extends('admin.layout')
@section('title', isset($product) ? 'Edit Product' : 'Add Product')

@section('content')

<div class="d-flex align-items-center gap-3 mb-4" style="animation:fadeInUp 0.4s ease;">
    <a href="{{ route('admin.products') }}" class="topbar-btn text-decoration-none">
        <i class="bi bi-arrow-left"></i> Back
    </a>
    <div>
        <h4 style="font-weight:800;color:var(--ad-text);margin:0;">{{ isset($product) ? 'Edit Product' : 'Add New Product' }}</h4>
        <p style="color:var(--ad-text-muted);font-size:0.82rem;margin:3px 0 0;">{{ isset($product) ? 'Update product information' : 'Fill in the product details below' }}</p>
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
            <div class="table-card mb-4" style="animation-delay:0.05s;">
                <div class="card-header">
                    <span><i class="bi bi-info-circle-fill me-2" style="color:var(--ad-primary);"></i>Product Details</span>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label">Product Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required placeholder="e.g. Fresh Orange Juice">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Category *</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">— Select a Category —</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ (isset($product) && $product->category_id==$cat->id) || old('category_id')==$cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="5" placeholder="Describe the product...">{{ old('description', $product->description ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right --}}
        <div class="col-lg-4">
            <div class="table-card mb-4" style="animation-delay:0.1s;">
                <div class="card-header">
                    <span><i class="bi bi-currency-dollar me-2" style="color:#10b981;"></i>Pricing & Stock</span>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label">Price ($) *</label>
                        <input type="number" name="price" step="0.01" min="0" class="form-control" value="{{ old('price', $product->price ?? '') }}" required placeholder="0.00">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" name="stock" min="0" class="form-control" value="{{ old('stock', $product->stock ?? 100) }}" placeholder="100">
                    </div>
                    <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background:rgba(14,165,233,0.06);border:1px solid rgba(14,165,233,0.15);">
                        <input type="checkbox" name="is_featured" class="form-check-input" id="featured" style="width:20px;height:20px;" {{ (isset($product) && $product->is_featured) ? 'checked':'' }}>
                        <label for="featured" style="cursor:pointer;margin:0;">
                            <div style="font-weight:700;">Featured Product</div>
                            <div style="font-size:0.78rem;color:var(--ad-text-muted);">Show on home page</div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="table-card" style="animation-delay:0.15s;">
                <div class="card-header">
                    <span><i class="bi bi-image-fill me-2" style="color:#a78bfa;"></i>Product Image</span>
                </div>
                <div class="card-body text-center">
                    @if(isset($product) && $product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid rounded-3 mb-3" style="max-height:160px;object-fit:cover;">
                        <div class="d-flex align-items-center gap-2 mb-3 p-2 rounded-3" style="background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);">
                            <input type="checkbox" name="remove_image" id="remove_image" value="1" class="form-check-input" style="width:18px;height:18px;">
                            <label for="remove_image" style="cursor:pointer;font-size:0.85rem;color:#f87171;margin:0;">Remove current image</label>
                        </div>
                    @else
                        <div style="height:120px;border:2px dashed rgba(14,165,233,0.25);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
                            <div style="text-align:center;color:var(--ad-text-muted);">
                                <i class="bi bi-cloud-upload fs-2 d-block mb-1" style="color:var(--ad-primary);opacity:0.5;"></i>
                                <small>No image uploaded</small>
                            </div>
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small style="color:var(--ad-text-muted);font-size:0.75rem;">PNG, JPG, WEBP – max 2MB</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Actions --}}
    <div class="d-flex gap-3 mt-4">
        <button type="submit" class="btn btn-primary px-5">
            <i class="bi bi-check-circle-fill me-2"></i>{{ isset($product) ? 'Update Product' : 'Save Product' }}
        </button>
        <a href="{{ route('admin.products') }}" class="topbar-btn text-decoration-none" style="padding:10px 20px;">
            Cancel
        </a>
    </div>
</form>

@endsection