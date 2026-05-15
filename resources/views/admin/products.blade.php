@extends('admin.layout')
@section('title', __('Products'))

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4" data-animate>
    <div>
        <h4 class="fw-800 text-white mb-0">{{ __('Products Catalog') }}</h4>
        <p class="text-muted small mt-1">{{ __('Manage your drink & snack inventory.') }}</p>
    </div>
    <a href="{{ route('admin.product.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="bi bi-plus-circle-fill"></i> {{ __('Add Product') }}
    </a>
</div>

{{-- Filter --}}
<div class="table-card mb-4" data-animate>
    <div class="card-header">
        <span><i class="bi bi-funnel-fill me-2 text-primary"></i>{{ __('Filters') }}</span>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-5">
                <div class="position-relative">
                    <i class="bi bi-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" name="search" class="form-control ps-5" placeholder="{{ __('Search products...') }}" value="{{ request()->search }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">{{ __('All Categories') }}</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request()->category==$cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search me-1"></i>{{ __('Filter') }}</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.products') }}" class="btn btn-outline-primary w-100"><i class="bi bi-arrow-counterclockwise me-1"></i>{{ __('Reset') }}</a>
            </div>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="table-card" data-animate>
    <div class="card-header">
        <span><i class="bi bi-cup-straw me-2 text-primary"></i>{{ __('All Products') }}</span>
        <span class="badge glass rounded-pill px-3 py-1" style="font-size: 0.75rem; border: 1px solid rgba(14,165,233,0.2);">
            {{ $products->total() }} {{ __('unit') }}
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>{{ __('Product') }}</th>
                    <th>{{ __('Category') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th>{{ __('Stock') }}</th>
                    <th>{{ __('Featured') }}</th>
                    <th class="text-end">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}" class="rounded-3 border border-opacity-10" style="width:42px;height:42px;object-fit:cover;">
                            @else
                                <div class="glass rounded-3 text-primary d-flex align-items-center justify-content-center" style="width:42px;height:42px;border:1px solid rgba(14,165,233,0.2);">
                                    <i class="bi bi-box-fill"></i>
                                </div>
                            @endif
                            <div>
                                <div class="fw-700 text-white">{{ $product->name }}</div>
                                <div class="text-muted small opacity-50">ID #{{ $product->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge glass rounded-pill px-3 py-1 text-primary-emphasis" style="font-size: 0.75rem; border: 1px solid rgba(14,165,233,0.2);">
                            {{ $product->category->name }}
                        </span>
                    </td>
                    <td>
                        <span class="fw-800 text-primary">៛{{ number_format($product->price, 2) }}</span>
                    </td>
                    <td>
                        <span class="fw-700" style="color:{{ $product->stock > 10 ? '#10b981' : ($product->stock > 0 ? '#f59e0b' : '#ef4444') }};">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td>
                        @if($product->is_featured)
                            <span class="badge-status" style="background:rgba(245,158,11,0.1); color:#f59e0b; border: 1px solid rgba(245,158,11,0.2);">
                                <i class="bi bi-star-fill me-1"></i> {{ __('Yes') }}
                            </span>
                        @else
                            <span class="text-muted small opacity-50">—</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-outline-primary btn-sm px-3">
                                <i class="bi bi-pencil-fill me-1"></i>{{ __('Edit') }}
                            </a>
                            <a href="{{ route('admin.product.delete', $product) }}" class="btn btn-danger btn-sm px-3" onclick="return confirm('{{ __('Are you sure?') }}')">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <i class="bi bi-box-seam fs-1 text-primary opacity-25 d-block mb-2"></i>
                        <span class="text-muted">{{ __('No products found') }}</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($products->hasPages())
<div class="d-flex justify-content-center mt-4">{{ $products->links('pagination::bootstrap-5') }}</div>
@endif

@endsection
on