@extends('admin.layout')
@section('title', __('Orders'))

@section('content')

{{-- Filter Card --}}
<div class="table-card mb-4" data-animate>
    <div class="card-header">
        <span><i class="bi bi-funnel-fill me-2 text-primary"></i>{{ __('Filter Orders') }}</span>
        <span class="badge rounded-pill px-3 py-1 text-muted" style="font-size: 0.75rem; background: var(--ad-surface-2);">
            {{ $orders->total() }} {{ __('Total') }}
        </span>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-5">
                <div class="position-relative">
                    <i class="bi bi-search position-absolute top-50 translate-middle-y ms-3 text-muted"></i>
                    <input type="text" name="search" class="form-control ps-5" placeholder="{{ __('Search by order # or customer...') }}" value="{{ request()->search }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">{{ __('All Status') }}</option>
                    <option value="pending"    {{ request()->status=='pending'    ? 'selected':'' }}>🟡 {{ __('Pending') }}</option>
                    <option value="processing" {{ request()->status=='processing' ? 'selected':'' }}>🔵 {{ __('Processing') }}</option>
                    <option value="completed"  {{ request()->status=='completed'  ? 'selected':'' }}>🟢 {{ __('Completed') }}</option>
                    <option value="cancelled"  {{ request()->status=='cancelled'  ? 'selected':'' }}>🔴 {{ __('Cancelled') }}</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search me-1"></i> {{ __('Filter') }}</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.orders') }}" class="btn btn-outline-primary w-100"><i class="bi bi-arrow-counterclockwise me-1"></i> {{ __('Reset') }}</a>
            </div>
        </form>
    </div>
</div>

{{-- Orders Table --}}
<div class="table-card" data-animate>
    <div class="card-header">
        <span><i class="bi bi-bag-check-fill me-2 text-primary"></i>{{ __('All Orders') }}</span>
    </div>
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>{{ __('Order #') }}</th>
                    <th>{{ __('Customer') }}</th>
                    <th>{{ __('Location') }}</th>
                    <th>{{ __('Total') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th class="text-end">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>
                        <span class="fw-bold text-primary">#{{ $order->order_number }}</span>
                    </td>
                    <td>
                        <div class="fw-bold">{{ $order->student_name }}</div>
                        <div class="text-muted small"><i class="bi bi-telephone me-1"></i>{{ $order->phone }}</div>
                    </td>
                    <td>
                        <div class="small"><i class="bi bi-building me-1 text-muted"></i>{{ $order->building }}</div>
                        <div class="text-muted small">{{ __('Room') }} {{ $order->room_number }}</div>
                    </td>
                    <td>
                        <span class="fw-bold text-primary">៛{{ number_format($order->total, 2) }}</span>
                    </td>
                    <td>
                        @switch($order->status)
                            @case('pending')
                                <span class="badge-status badge-pending"><i class="bi bi-hourglass-split"></i> {{ __('Pending') }}</span>
                            @break
                            @case('processing')
                                <span class="badge-status badge-processing"><i class="bi bi-arrow-repeat"></i> {{ __('Processing') }}</span>
                            @break
                            @case('completed')
                                <span class="badge-status badge-completed"><i class="bi bi-check-circle-fill"></i> {{ __('Completed') }}</span>
                            @break
                            @case('cancelled')
                                <span class="badge-status badge-cancelled"><i class="bi bi-x-circle-fill"></i> {{ __('Cancelled') }}</span>
                            @break
                        @endswitch
                    </td>
                    <td class="text-muted small">
                        <i class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('M d, Y') }}
                    </td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.order.show', $order) }}" class="btn btn-outline-primary btn-sm px-3">
                                <i class="bi bi-eye-fill me-1"></i>{{ __('View') }}
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                        <span class="text-muted">{{ __('No orders found') }}</span>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($orders->hasPages())
<div class="d-flex justify-content-center mt-4">{{ $orders->links('pagination::bootstrap-5') }}</div>
@endif

@endsection