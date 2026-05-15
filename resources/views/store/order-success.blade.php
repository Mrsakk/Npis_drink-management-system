@extends('store.layout')

@section('title', __('Order Successful') . ' - NPIA Drink Store')

@section('content')

<div class="text-center mb-5 py-5" data-animate>
    <div class="success-insignia-luxury mx-auto mb-4">
        <div class="insignia-glow"></div>
        <i class="bi bi-stars"></i>
    </div>
    <h1 class="hero-title display-3 fw-900 mb-3" style="line-height: 1.1;">
        {{ __('Order') }} <span class="text-gradient">{{ __('Confirmed') }}</span>
    </h1>
    <p class="hero-sub fs-5 opacity-75 max-w-600 mx-auto">
        {{ __('Thank you for choosing NPIA Premium. Your artisanal beverage experience is now being meticulously prepared and will be delivered shortly.') }}
    </p>
    <div class="d-flex justify-content-center gap-3 mt-5">
        <div class="glass rounded-pill px-4 py-2 d-flex align-items-center gap-3">
            <span class="text-muted small fw-bold">{{ __('ID') }}</span>
            <span class="fw-900 text-primary">#{{ $order->order_number }}</span>
        </div>
        <div class="glass rounded-pill px-4 py-2 d-flex align-items-center gap-3">
            <div class="pulse-indicator bg-success"></div>
            <span class="text-success small fw-bold">{{ __('Processing') }}</span>
        </div>
    </div>
</div>

<div class="row g-5 mb-5">
    <div class="col-lg-6" data-animate>
        <div class="glass h-100 rounded-5 border-0 overflow-hidden shadow-lg">
            <div class="p-4 p-md-5 border-bottom border-opacity-10 d-flex align-items-center gap-4" style="background: rgba(37, 99, 235, 0.03);">
                <div class="icon-circle-premium glass text-primary"><i class="bi bi-geo-alt"></i></div>
                <h4 class="fw-900 mb-0" style="color:var(--text);">{{ __('Delivery Destination') }}</h4>
            </div>
            <div class="p-4 p-md-5">
                <div class="d-grid gap-4">
                    <div class="d-flex justify-content-between align-items-center pb-3 border-bottom border-opacity-10">
                        <span class="text-muted fw-bold">{{ __('Recipient') }}</span>
                        <span class="fw-800" style="color:var(--text);">{{ $order->student_name }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pb-3 border-bottom border-opacity-10">
                        <span class="text-muted fw-bold">{{ __('Contact Number') }}</span>
                        <span class="fw-800" style="color:var(--text);">{{ $order->phone }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center pb-3 border-bottom border-opacity-10">
                        <span class="text-muted fw-bold">{{ __('Location') }}</span>
                        <span class="fw-800" style="color:var(--text);">{{ $order->building }}, {{ __('Room') }} {{ $order->room_number }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6" data-animate>
        <div class="glass h-100 rounded-5 border-0 overflow-hidden shadow-lg">
            <div class="p-4 p-md-5 border-bottom border-opacity-10 d-flex align-items-center gap-4" style="background: rgba(124, 58, 237, 0.03);">
                <div class="icon-circle-premium glass text-accent"><i class="bi bi-receipt"></i></div>
                <h4 class="fw-900 mb-0" style="color:var(--text);">{{ __('Artisanal Review') }}</h4>
            </div>
            <div class="p-4 p-md-5">
                <div class="d-grid gap-4 mb-4">
                    @foreach($order->items as $item)
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column">
                            <span class="fw-800 fs-5" style="color:var(--text);">{{ $item->product_name }}</span>
                            <span class="text-muted small">{{ __('Quantity') }}: {{ $item->quantity }}</span>
                        </div>
                        <span class="fw-900 fs-5" style="color:var(--text);">៛{{ number_format($item->subtotal, 0) }}</span>
                    </div>
                    @endforeach
                </div>
                <div class="pt-4 border-top border-dashed border-opacity-20 d-flex justify-content-between align-items-center">
                    <span class="fw-900 fs-4" style="color:var(--text);">{{ __('Grand Total') }}</span>
                    <span class="price-text" style="font-size: 2.5rem;">៛{{ number_format($order->total, 0) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center mt-5 mb-5 py-4" data-animate>
    <div class="d-flex flex-column flex-md-row justify-content-center gap-4">
        <a href="{{ route('shop') }}" class="btn-luxury btn-luxury-primary-lg px-5">
            <i class="bi bi-bag-plus"></i> {{ __('Continue Exploration') }}
        </a>
        <a href="{{ route('orders') }}" class="btn-luxury btn-luxury-outline px-5">
            <i class="bi bi-clock-history me-2"></i> {{ __('View Transaction History') }}
        </a>
    </div>
</div>

@endsection