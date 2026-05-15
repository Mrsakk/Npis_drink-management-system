@extends('store.layout')

@section('title', 'Dashboard – NPIA Drink')

@section('content')
<div style="max-width: 900px; margin: 0 auto; padding: 40px 0;">
    {{-- Header Section --}}
    <div class="glass rounded-4 mb-5 overflow-hidden">
        <div class="p-5 text-center">
            <div class="d-flex flex-column align-items-center">
                <div class="mb-4">
                    <img src="{{ asset('img/logo.png') }}" alt="User Avatar" class="rounded-circle border" style="width: 100px; height: 100px; object-fit: contain; background: var(--surface-hover); padding: 12px;">
                </div>
                <h1 class="display-6 fw-bold mb-2" style="letter-spacing: -1px;">Welcome back, <span class="text-gradient">{{ explode(' ', Auth::user()->name)[0] }}</span>!</h1>
                <p class="text-muted mb-4">You are currently connected to the NPIA Drink Hub</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <span class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-3 py-2">
                        <i class="bi bi-shield-check me-1"></i>Account Verified
                    </span>
                    <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 px-3 py-2">
                        <i class="bi bi-clock me-1"></i>Member since {{ Auth::user()->created_at->format('M Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions Grid --}}
    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('home') }}" class="glass rounded-4 p-4 d-block text-decoration-none h-100" style="transition: all 0.2s ease;">
                <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px;">
                    <i class="bi bi-house-door-fill fs-5"></i>
                </div>
                <h5 class="fw-bold mb-1" style="color: var(--text);">Shop Drinks</h5>
                <p class="text-muted small mb-0">Browse our latest collection of fresh beverages.</p>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('orders') }}" class="glass rounded-4 p-4 d-block text-decoration-none h-100" style="transition: all 0.2s ease;">
                <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px;">
                    <i class="bi bi-bag-check-fill fs-5"></i>
                </div>
                <h5 class="fw-bold mb-1" style="color: var(--text);">My Orders</h5>
                <p class="text-muted small mb-0">Track your current deliveries and order history.</p>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('cart') }}" class="glass rounded-4 p-4 d-block text-decoration-none h-100" style="transition: all 0.2s ease;">
                <div class="bg-success bg-opacity-10 text-success rounded-3 d-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px;">
                    <i class="bi bi-cart-fill fs-5"></i>
                </div>
                <h5 class="fw-bold mb-1" style="color: var(--text);">Shopping Cart</h5>
                <p class="text-muted small mb-0">Check the items you've selected for delivery.</p>
            </a>
        </div>
    </div>
</div>
@endsection
