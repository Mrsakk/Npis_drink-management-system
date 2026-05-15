@extends('admin.layout')

@section('title', isset($category) ? 'Edit Category' : 'Add Category')

@section('content')

<h1 class="mb-4">{{ isset($category) ? 'Edit Category' : 'Add Category' }}</h1>

<form method="POST" action="{{ isset($category) ? route('admin.category.update', $category) : route('admin.category.store') }}" enctype="multipart/form-data">
    @csrf
    @if(isset($category)) @method('PUT') @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Category Details</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description ?? '') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Image</div>
                <div class="card-body text-center">
                    @if(isset($category) && $category->image)
                        <img src="{{ asset('storage/'.$category->image) }}" class="img-thumbnail mb-2" style="max-width: 100%;">
                        <div class="form-check">
                            <input type="checkbox" name="remove_image" id="remove_image" value="1" class="form-check-input">
                            <label class="form-check-label" for="remove_image">Remove image</label>
                        </div>
                    @else
                        <p class="text-muted">No image</p>
                    @endif
                    <input type="file" name="image" class="form-control mt-3" accept="image/*">
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">Status</div>
                <div class="card-body">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="active" {{ (isset($category) && $category->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Update' : 'Save' }} Category</button>
    <a href="{{ route('admin.categories') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection