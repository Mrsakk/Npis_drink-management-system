@extends('store.layout')

@section('title', __('Checkout') . ' - NPIA Drink Store')

@section('content')

{{-- Page Header --}}
<div class="checkout-hero-luxury mb-5" data-animate>
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <div class="luxury-badge mb-3">
                <i class="bi bi-shield-lock-fill"></i> {{ __('Elite Security') }}
            </div>
            <h1 class="hero-title-luxury fs-2 mb-3">{{ __('Secure') }} <span class="text-gradient">{{ __('Final Step') }}</span></h1>
            <p class="hero-sub-luxury mb-0">{{ __('Complete your premium delivery details. Your artisanal selection is prepared for an elite journey to your doorstep.') }}</p>
        </div>
        <div class="col-lg-5 text-lg-end">
            <div class="checkout-stat-card glass rounded-4 p-4 d-inline-flex align-items-center gap-4">
                <div class="stat-icon-luxury bg-success"><i class="bi bi-lock-fill"></i></div>
                <div class="text-start">
                    <div class="small text-muted fw-800 text-uppercase ls-1">{{ __('Order Encryption') }}</div>
                    <div class="fw-900 fs-4" style="color:var(--text);">256-BIT SSL</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <form action="{{ route('place-order') }}" method="POST">
            @csrf
            {{-- Delivery Info --}}
            <div class="glass rounded-5 p-4 p-md-5 mb-4" data-animate>
                <div class="d-flex align-items-center gap-3 mb-5">
                    <div class="icon-circle glass text-primary" style="width: 48px; height: 48px; border-radius: 14px;">
                        <i class="bi bi-geo-alt-fill fs-5"></i>
                    </div>
                    <h5 class="fw-900 mb-0" style="color:var(--text);">{{ __('Delivery Destination') }}</h5>
                </div>

                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label-luxury">{{ __('Recipient Identity') }}</label>
                        <input type="text" name="student_name" class="form-control-luxury" value="{{ old('student_name', Auth::user()->name ?? '') }}" required placeholder="{{ __('Enter full legal name') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-luxury">{{ __('Building / Wing') }}</label>
                        <input type="text" name="building" class="form-control-luxury" value="{{ old('building', Auth::user()->building ?? '') }}" required placeholder="{{ __('e.g., Tower A') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-luxury">{{ __('Room / Suite') }}</label>
                        <input type="text" name="room_number" class="form-control-luxury" value="{{ old('room_number', Auth::user()->room_number ?? '') }}" required placeholder="{{ __('e.g., Suite 302') }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label-luxury">{{ __('Direct Contact Number') }}</label>
                        <input type="tel" name="phone" class="form-control-luxury" value="{{ old('phone', Auth::user()->phone ?? '') }}" required placeholder="{{ __('012 345 678') }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label-luxury">{{ __('Concierge Instructions') }}</label>
                        <textarea name="notes" class="form-control-luxury" rows="3" placeholder="{{ __('e.g., Leave with the front desk concierge') }}">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Payment --}}
            <div class="glass rounded-5 p-4 p-md-5 mb-5" data-animate>
                <div class="d-flex align-items-center gap-3 mb-5">
                    <div class="icon-circle glass text-primary" style="width: 48px; height: 48px; border-radius: 14px;">
                        <i class="bi bi-wallet2 fs-5"></i>
                    </div>
                    <h5 class="fw-900 mb-0" style="color:var(--text);">{{ __('Settlement Method') }}</h5>
                </div>

                <label class="payment-option-ultra glass rounded-5 active">
                    <input type="radio" name="payment_method" value="cash" checked class="d-none">
                    <div class="d-flex align-items-center gap-4">
                        <div class="payment-icon-luxury"><i class="bi bi-cash-stack"></i></div>
                        <div>
                            <div class="fw-900 fs-5" style="color:var(--text);">{{ __('Cash on Delivery') }}</div>
                            <div class="small text-muted fw-700">{{ __('Settle the account upon elite delivery') }}</div>
                        </div>
                        <div class="ms-auto check-circle-luxury"><i class="bi bi-check-circle-fill"></i></div>
                    </div>
                </label>
            </div>

            <button type="submit" class="btn-luxury-primary-lg w-100 justify-content-center">
                <i class="bi bi-bag-check-fill me-2"></i> {{ __('Place Premium Order') }}
            </button>
        </form>
    </div>

    <div class="col-lg-5">
        <div class="glass rounded-5 p-4 p-md-5 sticky-top" style="top: 110px;" data-animate>
            <div class="d-flex align-items-center gap-3 mb-5">
                <div class="icon-circle glass text-primary" style="width: 48px; height: 48px; border-radius: 14px;">
                    <i class="bi bi-bag-check fs-5"></i>
                </div>
                <h5 class="fw-900 mb-0" style="color:var(--text);">{{ __('Artisanal Review') }}</h5>
            </div>
            
            <div class="d-grid gap-4 mb-5">
                @foreach($cartItems as $item)
                <div class="d-flex align-items-center gap-3">
                    <div class="luxury-cart-img-wrapper" style="width: 56px; height: 56px; border-radius: 14px;">
                        @if(isset($item['image']) && $item['image'])
                            <img src="{{ asset('storage/'.$item['image']) }}" class="w-100 h-100 object-fit-cover">
                        @else
                            <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-primary-bg text-primary"><i class="bi bi-cup-straw"></i></div>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-900 small" style="color:var(--text);">{{ $item['name'] }}</div>
                        <div class="text-muted fw-700" style="font-size: 0.75rem;">{{ $item['quantity'] }} × ៛{{ number_format($item['price'], 0) }}</div>
                    </div>
                    <div class="fw-900 small" style="color:var(--text);">៛{{ number_format($item['price'] * $item['quantity'], 0) }}</div>
                </div>
                @endforeach
            </div>

            <div class="receipt-divider"></div>

            <div class="d-grid gap-3">
                <div class="d-flex justify-content-between">
                    <span class="text-muted fw-800 text-uppercase ls-1 small">{{ __('Service Fee') }}</span>
                    <span class="text-success fw-900 small">{{ __('INCLUDED') }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-2">
                    <span class="fw-900 fs-4" style="color:var(--text);">{{ __('Final Est.') }}</span>
                    <span class="fw-900 fs-2 text-gradient">៛{{ number_format($subtotal, 0) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection