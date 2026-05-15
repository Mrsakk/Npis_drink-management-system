@extends('store.layout')

@section('title', __('My Orders') . ' - NPIA Drink Store')

@section('content')

<div class="mb-5" data-animate>
    <h1 class="section-title">
        <i class="bi bi-bag-check-fill"></i> {{ __('My Orders') }}
    </h1>
    <p class="text-muted">{{ __('Track and review your recent beverage and snack orders.') }}</p>
</div>

@if($orders->isEmpty())
    <div class="glass text-center p-5 rounded-5 border-dashed" data-animate>
        <i class="bi bi-receipt fs-1 text-primary opacity-50 mb-3 d-block"></i>
        <h4 class="fw-800" style="color:var(--clr-text);">{{ __('No orders yet') }}</h4>
        <p class="text-muted">{{ __('Start exploring our menu and place your first order today!') }}</p>
        <a href="{{ route('shop') }}" class="btn-luxury btn-luxury-primary mt-4 px-5">
            <i class="bi bi-shop me-2"></i>{{ __('Shop Now') }}
        </a>
    </div>
@else
    <div class="row g-4">
        @foreach($orders as $order)
        <div class="col-12" data-animate>
            <div class="glass rounded-4 overflow-hidden border-0 transition-bounce hover-up">
                <div class="p-4 border-bottom border-opacity-10 d-flex justify-content-between align-items-center" style="background: rgba(14,165,233,0.03);">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-circle glass text-primary" style="width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-hash fs-5"></i>
                        </div>
                        <div>
                            <span class="fw-800 fs-5 d-block" style="color:var(--clr-text);">{{ $order->order_number }}</span>
                            <small class="text-muted">{{ $order->created_at->format('d M Y, h:i A') }}</small>
                        </div>
                    </div>
                    <div>
                        @switch($order->status)
                            @case('pending')
                                <span class="badge rounded-pill px-3 py-2" style="background: rgba(245,158,11,0.1); color: #f59e0b; border: 1px solid rgba(245,158,11,0.2);">
                                    <i class="bi bi-clock-history me-1"></i> {{ __('PENDING') }}
                                </span>
                            @break
                            @case('processing')
                                <span class="badge rounded-pill px-3 py-2" style="background: rgba(14,165,233,0.1); color: #0ea5e9; border: 1px solid rgba(14,165,233,0.2);">
                                    <i class="bi bi-gear-wide-connected me-1"></i> {{ __('PROCESSING') }}
                                </span>
                            @break
                            @case('completed')
                                <span class="badge rounded-pill px-3 py-2" style="background: rgba(16,185,129,0.1); color: #10b981; border: 1px solid rgba(16,185,129,0.2);">
                                    <i class="bi bi-check2-circle me-1"></i> {{ __('COMPLETED') }}
                                </span>
                            @break
                            @case('cancelled')
                                <span class="badge rounded-pill px-3 py-2" style="background: rgba(239,68,68,0.1); color: #ef4444; border: 1px solid rgba(239,68,68,0.2);">
                                    <i class="bi bi-x-circle me-1"></i> {{ __('CANCELLED') }}
                                </span>
                            @break
                        @endswitch
                    </div>
                </div>
                <div class="p-4">
                    <div class="row align-items-center g-4">
                        <div class="col-md-7">
                            <div class="d-flex flex-column gap-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-geo-alt text-primary opacity-50"></i>
                                    <span class="text-muted small">{{ __('Location') }}:</span>
                                    <span class="fw-700 small" style="color:var(--clr-text);">{{ $order->building }}, {{ __('Room') }} {{ $order->room_number }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-telephone text-primary opacity-50"></i>
                                    <span class="text-muted small">{{ __('Phone') }}:</span>
                                    <span class="fw-700 small" style="color:var(--clr-text);">{{ $order->phone }}</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-box-seam text-primary opacity-50"></i>
                                    <span class="text-muted small">{{ __('Items') }}:</span>
                                    <span class="fw-700 small" style="color:var(--clr-text);">{{ $order->items->count() }} {{ __('unit') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 text-md-end">
                            <span class="text-muted small d-block mb-1">{{ __('Total Valuation') }}</span>
                            <span class="price-text" style="font-size: 1.8rem;">៛{{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection