@extends('store.layout')

@section('title', __('Order Successful') . ' - NPIA Drink Store')

@section('content')

<div class="text-center mb-5 mt-4" data-animate>
    <div class="logo-hero-wrapper mx-auto mb-4" style="width: 120px; height: 120px;">
        <div class="logo-hero-inner" style="width: 120px; height: 120px;">
            <i class="bi bi-check-lg text-primary fs-1"></i>
        </div>
    </div>
    <h1 class="hero-title mb-2">{{ __('Order Placed Successfully!') }}</h1>
    <p class="hero-sub">{{ __('Thank you! Your order has been received and is being processed.') }}</p>
    <div class="badge glass rounded-pill px-4 py-2 mt-3" style="font-size: 1rem; color: var(--clr-primary);">
        {{ __('Order') }} #{{ $order->order_number }}
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-6" data-animate>
        <div class="glass h-100 rounded-5 border-0 overflow-hidden">
            <div class="p-4 border-bottom border-opacity-10" style="background: rgba(14,165,233,0.05);">
                <h5 class="fw-800 mb-0" style="color:var(--clr-text);"><i class="bi bi-geo-alt me-2 text-primary"></i>{{ __('Delivery Information') }}</h5>
            </div>
            <div class="p-4">
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex justify-content-between border-bottom border-opacity-10 pb-2">
                        <span class="text-muted small">{{ __('Student Name') }}</span>
                        <span class="fw-700" style="color:var(--clr-text);">{{ $order->student_name }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom border-opacity-10 pb-2">
                        <span class="text-muted small">{{ __('Phone Number') }}</span>
                        <span class="fw-700" style="color:var(--clr-text);">{{ $order->phone }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom border-opacity-10 pb-2">
                        <span class="text-muted small">{{ __('Building') }}</span>
                        <span class="fw-700" style="color:var(--clr-text);">{{ $order->building }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom border-opacity-10 pb-2">
                        <span class="text-muted small">{{ __('Room Number') }}</span>
                        <span class="fw-700" style="color:var(--clr-text);">{{ $order->room_number }}</span>
                    </div>
                    @if($order->notes)
                    <div class="mt-2">
                        <span class="text-muted small d-block mb-1">{{ __('Additional Notes') }}</span>
                        <p class="small p-3 rounded-3 mb-0" style="background: rgba(255,255,255,0.03); color:var(--clr-text);">{{ $order->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6" data-animate>
        <div class="glass h-100 rounded-5 border-0 overflow-hidden">
            <div class="p-4 border-bottom border-opacity-10" style="background: rgba(14,165,233,0.05);">
                <h5 class="fw-800 mb-0" style="color:var(--clr-text);"><i class="bi bi-receipt me-2 text-primary"></i>{{ __('Order Summary') }}</h5>
            </div>
            <div class="p-4">
                <div class="d-flex flex-column gap-3">
                    @foreach($order->items as $item)
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column">
                            <span class="fw-700 small" style="color:var(--clr-text);">{{ $item->product_name }}</span>
                            <span class="text-muted" style="font-size: 0.75rem;">{{ __('Qty') }}: {{ $item->quantity }}</span>
                        </div>
                        <span class="fw-800" style="color:var(--clr-text);">៛{{ number_format($item->subtotal, 2) }}</span>
                    </div>
                    @endforeach
                    <div class="mt-3 pt-3 border-top border-dashed border-opacity-20 d-flex justify-content-between align-items-center">
                        <span class="fw-800 fs-5" style="color:var(--clr-text);">{{ __('Grand Total') }}</span>
                        <span class="price-text" style="font-size: 1.8rem;">៛{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center mt-5 mb-5" data-animate>
    <a href="{{ route('shop') }}" class="btn-luxury btn-luxury-primary px-5 py-3 me-3">
        <i class="bi bi-bag-check me-2"></i>{{ __('Continue Shopping') }}
    </a>
    <a href="{{ route('orders') }}" class="btn-luxury btn-luxury-outline px-5 py-3">
        <i class="bi bi-list-ul me-2"></i>{{ __('View My Orders') }}
    </a>
</div>

@endsection