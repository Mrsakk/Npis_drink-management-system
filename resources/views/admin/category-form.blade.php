@extends('admin.layout')
@section('title', isset($category) ? __('Edit Category') : __('Add Category'))

@section('content')

<div class="d-flex align-items-center gap-3 mb-4" data-animate>
    <a href="{{ route('admin.categories') }}" class="topbar-btn text-decoration-none">
        <i class="bi bi-arrow-left"></i> {{ __('Back') }}
    </a>
    <div>
        <h4 class="fw-bold mb-0">{{ isset($category) ? __('Edit Category') : __('Add Category') }}</h4>
        <p class="text-muted small mb-0 mt-1">{{ isset($category) ? __('Update category details') : __('Create a new product category') }}</p>
    </div>
</div>

@if($errors->any())
<div class="alert alert-danger mb-4">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    <ul class="mb-0 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<form method="POST" action="{{ isset($category) ? route('admin.category.update', $category) : route('admin.category.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($category)) @method('PUT') @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="table-card mb-4" data-animate>
                <div class="card-header">
                    <span><i class="bi bi-info-circle-fill me-2 text-primary"></i>{{ __('Category Details') }}</span>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">{{ __('Name') }} *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required placeholder="{{ __('Category name') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Description') }}</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="{{ __('Category description...') }}">{{ old('description', $category->description ?? '') }}</textarea>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">{{ __('Sort Order') }}</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="table-card mb-4" data-animate>
                <div class="card-header">
                    <span><i class="bi bi-image-fill me-2 text-primary"></i>{{ __('Image') }}</span>
                </div>
                <div class="card-body text-center">
                    @if(isset($category) && $category->image)
                        <img src="{{ asset('storage/'.$category->image) }}" class="img-fluid rounded-3 mb-3" style="max-height:150px;object-fit:cover;">
                        <div class="d-flex align-items-center gap-2 mb-3 p-2 rounded-3" style="background: rgba(220,38,38,0.08); border: 1px solid rgba(220,38,38,0.15);">
                            <input type="checkbox" name="remove_image" id="remove_image" value="1" class="form-check-input" style="width:18px;height:18px;">
                            <label for="remove_image" class="text-danger small mb-0" style="cursor:pointer;">{{ __('Remove image') }}</label>
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center mb-3 rounded-3" style="height:100px;border:2px dashed var(--ad-border);">
                            <div class="text-center text-muted">
                                <i class="bi bi-cloud-upload fs-3 d-block mb-1 text-primary" style="opacity:0.5;"></i>
                                <small>{{ __('No image') }}</small>
                            </div>
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>

            <div class="table-card" data-animate>
                <div class="card-header">
                    <span><i class="bi bi-toggle-on me-2 text-success"></i>{{ __('Status') }}</span>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3 p-3 rounded-3" style="background: var(--ad-surface-2);">
                        <input type="checkbox" name="is_active" class="form-check-input" id="active" style="width:20px;height:20px;" {{ (isset($category) && $category->is_active) ? 'checked' : '' }}>
                        <label for="active" style="cursor:pointer;margin:0;">
                            <div class="fw-bold small">{{ __('Active') }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">{{ __('Category visible on store') }}</div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex gap-3 mt-4">
        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-check-circle-fill me-2"></i>{{ isset($category) ? __('Update Category') : __('Save Category') }}
        </button>
        <a href="{{ route('admin.categories') }}" class="btn btn-outline-primary px-4">{{ __('Cancel') }}</a>
    </div>
</form>

@endsection