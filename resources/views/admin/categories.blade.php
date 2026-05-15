@extends('admin.layout')
@section('title', __('Categories'))

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4" data-animate>
    <div>
        <h4 class="fw-bold mb-0">{{ __('Categories') }}</h4>
        <p class="text-muted small mt-1 mb-0">{{ __('Organize your product catalog effectively.') }}</p>
    </div>
    <a href="{{ route('admin.category.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="bi bi-plus-circle-fill"></i> {{ __('Add Category') }}
    </a>
</div>

<div class="table-card" data-animate>
    <div class="card-header">
        <span><i class="bi bi-collection-fill me-2 text-primary"></i>{{ __('All Categories') }}</span>
        <span class="badge rounded-pill px-3 py-1 text-muted" style="font-size: 0.75rem; background: var(--ad-surface-2);">
            {{ $categories->count() }} {{ __('Categories') }}
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>{{ __('Category') }}</th>
                    <th>{{ __('Slug') }}</th>
                    <th>{{ __('Products') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th class="text-end">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            @if($category->image)
                                <img src="{{ asset('storage/'.$category->image) }}" class="rounded-3" style="width:40px;height:40px;object-fit:cover;border:1px solid var(--ad-border);">
                            @else
                                <div class="glass rounded-3 text-primary d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                    <i class="bi bi-tag-fill"></i>
                                </div>
                            @endif
                            <span class="fw-bold">{{ $category->name }}</span>
                        </div>
                    </td>
                    <td><code class="px-2 py-1 rounded small text-muted" style="background: var(--ad-surface-2);">{{ $category->slug }}</code></td>
                    <td>
                        <span class="fw-bold text-primary">{{ $category->products->count() }}</span>
                        <span class="text-muted small"> {{ __('unit') }}</span>
                    </td>
                    <td>
                        @if(isset($category->is_active) && $category->is_active)
                            <span class="badge-status badge-completed"><i class="bi bi-check-circle-fill"></i> {{ __('Active') }}</span>
                        @else
                            <span class="badge-status badge-cancelled"><i class="bi bi-x-circle-fill"></i> {{ __('Inactive') }}</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-outline-primary btn-sm px-3">
                                <i class="bi bi-pencil-fill me-1"></i>{{ __('Edit') }}
                            </a>
                            <a href="{{ route('admin.category.delete', $category) }}" class="btn btn-danger btn-sm px-3" onclick="return confirm('{{ __('Are you sure?') }}')">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-collection fs-1 text-muted d-block mb-2"></i>
                        <span class="text-muted">{{ __('No categories found') }}</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection