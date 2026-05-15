@extends('admin.layout')
@section('title', __('Users'))

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4" data-animate>
    <div>
        <h4 class="fw-bold mb-0">{{ __('Users') }}</h4>
        <p class="text-muted small mt-1 mb-0">{{ __('Registered customers & administrative staff.') }}</p>
    </div>
</div>

{{-- Search --}}
<div class="table-card mb-4" data-animate>
    <div class="card-header">
        <span><i class="bi bi-search me-2 text-primary"></i>{{ __('Search Users') }}</span>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-9">
                <div class="position-relative">
                    <i class="bi bi-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" name="search" class="form-control ps-5" placeholder="{{ __('Search by name or email...') }}" value="{{ request()->search }}">
                </div>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search me-1"></i>{{ __('Search') }}</button>
            </div>
        </form>
    </div>
</div>

<div class="table-card" data-animate>
    <div class="card-header">
        <span><i class="bi bi-people-fill me-2 text-primary"></i>{{ __('All Users') }}</span>
        <span class="badge rounded-pill px-3 py-1 text-muted" style="font-size: 0.75rem; background: var(--ad-surface-2);">
            {{ $users->total() }} {{ __('users') }}
        </span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>{{ __('User') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Role') }}</th>
                    <th>{{ __('Orders') }}</th>
                    <th>{{ __('Joined') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center justify-content-center fw-bold text-primary rounded-circle" style="width:36px;height:36px;background:rgba(37,99,235,0.1);font-size:0.85rem;flex-shrink:0;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span class="fw-bold">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="text-muted small">{{ $user->email }}</td>
                    <td>
                        @if($user->role === 'admin')
                            <span class="badge-status" style="background: rgba(124, 58, 237, 0.1); color: #7c3aed; border: 1px solid rgba(124, 58, 237, 0.2);">
                                <i class="bi bi-shield-fill-check me-1"></i> {{ __('Admin') }}
                            </span>
                        @else
                            <span class="badge-status badge-processing">
                                <i class="bi bi-person-fill me-1"></i> {{ __('User') }}
                            </span>
                        @endif
                    </td>
                    <td>
                        <span class="fw-bold text-primary">{{ $user->orders->count() }}</span>
                    </td>
                    <td class="text-muted small">
                        <i class="bi bi-calendar3 me-1"></i>{{ $user->created_at->format('M d, Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <i class="bi bi-people fs-1 text-muted d-block mb-2"></i>
                        <span class="text-muted">{{ __('No users found') }}</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($users->hasPages())
<div class="d-flex justify-content-center mt-4">{{ $users->links('pagination::bootstrap-5') }}</div>
@endif

@endsection