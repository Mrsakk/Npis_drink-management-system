@extends('store.layout')

@section('title', __('Checkout') . ' - NPIA Drink Store')

@section('styles')
<style>
    .page-header { background: var(--clr-surface); border: 1px solid var(--clr-border); border-radius: 20px; padding: 28px 32px; margin-bottom: 28px; animation: fadeInUp 0.5s ease; }
    .page-header h1 { margin:0; font-size:2rem; color: var(--clr-text); font-weight: 800; letter-spacing: -1px; }

    .checkout-card { background: var(--clr-surface); border: 1px solid var(--clr-border); border-radius: 24px; overflow: hidden; margin-bottom: 24px; animation: fadeInUp 0.5s ease 0.1s both; }
    .checkout-card-header { padding: 18px 24px; border-bottom: 1px solid var(--clr-border); font-weight: 700; color: var(--clr-text); font-size:1.05rem; display: flex; align-items: center; gap: 10px; }
    .checkout-card-header i { color: var(--clr-primary); font-size: 1.2rem; }
    .checkout-card-body { padding: 24px; }

    .form-label { color: var(--clr-text); font-weight:600; font-size:0.92rem; margin-bottom:8px; }
    .form-control { background: rgba(255,255,255,0.05); border: 1px solid var(--clr-border); border-radius: 14px; color: var(--clr-text); padding: 14px 18px; transition: all .3s ease; font-weight: 500; }
    .form-control:focus { background: var(--clr-surface); border-color: var(--clr-primary); box-shadow: 0 0 0 3px rgba(14,165,233,.2); }
    .form-control::placeholder { color: var(--clr-text-muted); opacity: 0.5; }

    .payment-option { display: flex; align-items: center; gap: 16px; padding: 18px 20px; border: 2px solid var(--clr-border); border-radius: 16px; cursor: pointer; transition: all .25s ease; background: var(--clr-surface); }
    .payment-option:hover { border-color: rgba(14,165,233,.4); background: rgba(14,165,233,.03); }
    .payment-option input[type="radio"] { display:none; }
    .payment-option input:checked ~ .payment-check { background: var(--clr-primary); border-color: var(--clr-primary); }
    .payment-option input:checked ~ .payment-check::after { content:''; position: absolute; width: 10px; height: 10px; background: white; border-radius: 50%; }
    .payment-check { width: 24px; height: 24px; border-radius: 50%; border: 2px solid var(--clr-border); position: relative; flex-shrink:0; transition: all .25s; display:flex; align-items:center;justify-content:center; }
    .payment-icon-wrap { width: 48px; height: 48px; border-radius: 12px; background: rgba(14,165,233,.1); border: 1px solid rgba(14,165,233,.2); display: flex; align-items:center; justify-content:center; font-size: 1.5rem; color: var(--clr-primary); }
    .payment-label-title { color: var(--clr-text); font-weight: 700; font-size:1rem; }
    .payment-label-sub   { color: var(--clr-text-muted); font-size:.85rem; font-weight: 500; }

    .btn-place-order { width: 100%; background: linear-gradient(135deg, #0ea5e9, #8b5cf6); border: none; border-radius: 16px; color: #fff; font-weight: 800; font-size: 1.1rem; padding: 18px; transition: all .3s ease; cursor: pointer; }
    .btn-place-order:hover { transform: translateY(-3px); box-shadow: 0 15px 35px rgba(14,165,233,.5); color: #fff; }

    .summary-card { background: var(--clr-surface); border: 1px solid var(--clr-border); border-radius: 24px; overflow: hidden; position: sticky; top: 100px; animation: fadeInUp 0.5s ease 0.15s both; }
    .summary-header { padding: 20px 24px; border-bottom: 1px solid var(--clr-border); font-weight:800; color: var(--clr-text); font-size: 1.1rem; display:flex; align-items:center; gap:10px; }
    .order-item { display: flex; justify-content:space-between; align-items:center; padding: 14px 0; border-bottom: 1px solid var(--clr-border); font-size:.95rem; }
    .order-item:last-of-type { border-bottom:none; }
    .order-item-name { color: var(--clr-text-muted); font-weight: 600; }
    .order-item-price { color: var(--clr-text); font-weight:800; }
    .summary-total-row { display:flex; justify-content:space-between; align-items:center; margin-top: 20px; border-top: 1px dashed var(--clr-border); padding-top: 20px; }
    .summary-total-label { color: var(--clr-text); font-weight:800; font-size: 1.2rem; }
    .summary-total-price { font-size: 1.8rem; font-weight:900; background: linear-gradient(135deg, #0ea5e9, #14b8a6); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }

    @keyframes fadeInUp { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }
</style>
@endsection

@section('content')

<div class="page-header">
    <h1 class="fw-bold"><i class="bi bi-credit-card-2-front me-2 text-primary"></i>{{ __('Secure Checkout') }}</h1>
    <p>{{ __('Complete your delivery details to finalize the order.') }}</p>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <form action="{{ route('place-order') }}" method="POST">
            @csrf
            <div class="checkout-card">
                <div class="checkout-card-header">
                    <i class="bi bi-geo-alt-fill"></i> {{ __('Delivery Information') }}
                </div>
                <div class="checkout-card-body">
                    <div class="mb-4">
                        <label class="form-label">{{ __('Student Name') }} *</label>
                        <input type="text" name="student_name" class="form-control" value="{{ old('student_name', Auth::user()->name ?? '') }}" required placeholder="{{ __('Enter your full name') }}">
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Building') }} *</label>
                            <input type="text" name="building" class="form-control" value="{{ old('building', Auth::user()->building ?? '') }}" required placeholder="{{ __('e.g., Building A') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Room Number') }} *</label>
                            <input type="text" name="room_number" class="form-control" value="{{ old('room_number', Auth::user()->room_number ?? '') }}" required placeholder="{{ __('e.g., 101') }}">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">{{ __('Phone Number') }} *</label>
                        <input type="tel" name="phone" class="form-control" value="{{ old('phone', Auth::user()->phone ?? '') }}" required placeholder="{{ __('012 345 678') }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">{{ __('Delivery Notes (Optional)') }}</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="{{ __('Any specific instructions for the delivery...') }}">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="checkout-card">
                <div class="checkout-card-header">
                    <i class="bi bi-wallet2"></i> {{ __('Payment Method') }}
                </div>
                <div class="checkout-card-body">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="cash" checked>
                        <div class="payment-check"></div>
                        <div class="payment-icon-wrap"><i class="bi bi-cash-stack"></i></div>
                        <div>
                            <div class="payment-label-title">{{ __('Cash on Delivery') }}</div>
                            <div class="payment-label-sub">{{ __('Pay when you receive your order') }}</div>
                        </div>
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-place-order">
                <i class="bi bi-check-circle-fill me-2"></i>{{ __('Confirm & Place Order') }}
            </button>
        </form>
    </div>
    
    <div class="col-lg-5">
        <div class="summary-card">
            <div class="summary-header">
                <i class="bi bi-receipt"></i> {{ __('Order Summary') }}
            </div>
            <div class="summary-body px-4 py-3">
                @foreach($cartItems as $item)
                <div class="order-item">
                    <span class="order-item-name">{{ $item['name'] }} <span class="badge bg-secondary ms-1">×{{ $item['quantity'] }}</span></span>
                    <span class="order-item-price">៛{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                </div>
                @endforeach
                
                <div class="order-item mt-3 border-0">
                    <span class="order-item-name">{{ __('Delivery Fee') }}</span>
                    <span class="text-success fw-bold">{{ __('Free') }}</span>
                </div>
                
                <div class="summary-total-row">
                    <span class="summary-total-label">{{ __('Total') }}</span>
                    <span class="summary-total-price">៛{{ number_format($subtotal, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection