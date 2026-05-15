@extends('store.layout')

@section('title', __('My Orders') . ' - NPIA Drink Store')

@section('content')

<div class="mb-5 py-4" data-animate>
    <div class="luxury-badge mb-3">
        <i class="bi bi-clock-history"></i> {{ __('Transaction History') }}
    </div>
    <h1 class="hero-title display-4 fw-900 mb-2">
        {{ __('My') }} <span class="text-gradient">{{ __('Orders') }}</span>
    </h1>
    <p class="hero-sub fs-5 opacity-75">{{ __('Track and review your elite beverage experiences in real-time.') }}</p>
</div>

@if($orders->isEmpty())
    <div class="glass text-center p-5 rounded-5 border-dashed" data-animate>
        <i class="bi bi-receipt fs-1 text-primary opacity-50 mb-3 d-block"></i>
        <h4 class="fw-800" style="color:var(--text);">{{ __('No orders yet') }}</h4>
        <p class="text-muted">{{ __('Start exploring our menu and place your first order today!') }}</p>
        <a href="{{ route('shop') }}" class="btn-luxury btn-luxury-primary mt-4 px-5">
            <i class="bi bi-shop me-2"></i>{{ __('Shop Now') }}
        </a>
    </div>
@else
    <div class="row g-5">
        @foreach($orders as $order)
        <div class="col-12" data-animate>
            <div class="glass rounded-5 overflow-hidden border-0 shadow-lg position-relative order-card-luxury">
                {{-- Card Header --}}
                <div class="p-4 p-md-5 border-bottom border-opacity-10 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4" style="background: rgba(37, 99, 235, 0.03);">
                    <div class="d-flex align-items-center gap-4">
                        <div class="icon-circle-premium glass text-primary">
                            <i class="bi bi-hash fs-4"></i>
                        </div>
                        <div>
                            <span class="fs-3 fw-900 d-block mb-1" style="color:var(--text);">{{ $order->order_number }}</span>
                            <div class="d-flex align-items-center gap-2 text-muted small">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $order->created_at->format('d M Y') }}</span>
                                <span class="mx-2 opacity-25">•</span>
                                <i class="bi bi-clock"></i>
                                <span>{{ $order->created_at->format('h:i A') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center gap-3">
                        <div class="text-md-end">
                            <span class="small text-muted d-block mb-1">{{ __('Total Valuation') }}</span>
                            <span class="price-text fs-2">៛{{ number_format($order->total, 0) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Status Timeline --}}
                <div class="px-4 px-md-5 py-5 border-bottom border-opacity-10" style="background: rgba(255,255,255,0.01);">
                    <div class="order-timeline-luxury">
                        <div class="timeline-step {{ in_array($order->status, ['pending', 'processing', 'completed']) ? 'active' : '' }}">
                            <div class="step-circle"><i class="bi bi-send-check"></i></div>
                            <div class="step-label">{{ __('Received') }}</div>
                        </div>
                        <div class="timeline-bar {{ in_array($order->status, ['processing', 'completed']) ? 'active' : '' }}"></div>
                        <div class="timeline-step {{ in_array($order->status, ['processing', 'completed']) ? 'active' : '' }}">
                            <div class="step-circle"><i class="bi bi-cup-hot"></i></div>
                            <div class="step-label">{{ __('Preparing') }}</div>
                        </div>
                        <div class="timeline-bar {{ in_array($order->status, ['completed']) ? 'active' : '' }}"></div>
                        <div class="timeline-step {{ $order->status == 'completed' ? 'active' : '' }}">
                            <div class="step-circle"><i class="bi bi-lightning-charge"></i></div>
                            <div class="step-label">{{ __('Delivered') }}</div>
                        </div>
                    </div>
                </div>

                {{-- Details Grid --}}
                <div class="p-4 p-md-5">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-8">
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center gap-3 p-3 glass rounded-4">
                                        <div class="icon-circle-sm glass text-primary"><i class="bi bi-geo-alt"></i></div>
                                        <div>
                                            <span class="text-muted small d-block">{{ __('Delivery Point') }}</span>
                                            <span class="fw-800" style="color:var(--text);">{{ $order->building }}, {{ __('Room') }} {{ $order->room_number }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="d-flex align-items-center gap-3 p-3 glass rounded-4">
                                        <div class="icon-circle-sm glass text-accent"><i class="bi bi-receipt"></i></div>
                                        <div>
                                            <span class="text-muted small d-block">{{ __('Items Ordered') }}</span>
                                            <span class="fw-800" style="color:var(--text);">{{ $order->items->count() }} {{ __('Elite Units') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="javascript:void(0)" class="btn-luxury btn-luxury-ghost px-4">
                                <i class="bi bi-file-earmark-text me-2"></i>{{ __('Full Details') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endif

@endsection