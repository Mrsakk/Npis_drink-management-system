@extends('store.layout')

@section('title', 'Dashboard – NPIA Drink')

@section('content')
<div class="animate-up" style="max-width: 900px; margin: 0 auto; padding: 40px 0;">
    {{-- Header Section --}}
    <div class="card mb-5 border-0 overflow-hidden" style="background: linear-gradient(135deg, rgba(14,165,233,0.1), rgba(139,92,246,0.1)); border-radius: 32px;">
        <div class="card-body p-5 text-center position-relative">
            <div class="bg-noise"></div>
            <div class="d-flex flex-column align-items-center position-relative z-1">
                <div class="mb-4">
                    <div class="p-1 rounded-circle" style="background: linear-gradient(135deg, var(--clr-primary), var(--clr-accent)); box-shadow: 0 0 30px rgba(14,165,233,0.4);">
                        <img src="{{ asset('img/logo.png') }}" alt="User Avatar" class="rounded-circle bg-dark p-2" style="width: 120px; height: 120px; object-fit: contain;">
                    </div>
                </div>
                <h1 class="display-5 fw-800 text-white mb-2" style="letter-spacing: -1.5px;">Welcome back, <span class="text-gradient-primary">{{ explode(' ', Auth::user()->name)[0] }}</span>!</h1>
                <p class="opacity-50 fw-500 mb-4">You are currently connected to the NPIA Drink Secure Hub</p>
                <div class="d-flex justify-content-center gap-3">
                    <span class="badge rounded-pill bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-3 py-2">
                        <i class="bi bi-shield-check me-1"></i> Account Verified
                    </span>
                    <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 px-3 py-2">
                        <i class="bi bi-clock me-1"></i> Member since {{ Auth::user()->created_at->format('M Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions Grid --}}
    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('home') }}" class="dashboard-action-card">
                <div class="action-icon bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-house-door-fill"></i>
                </div>
                <h5>Shop Drinks</h5>
                <p>Browse our latest collection of fresh beverages.</p>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('orders') }}" class="dashboard-action-card">
                <div class="action-icon bg-accent bg-opacity-10 text-accent">
                    <i class="bi bi-bag-check-fill"></i>
                </div>
                <h5>My Orders</h5>
                <p>Track your current deliveries and order history.</p>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('cart') }}" class="dashboard-action-card">
                <div class="action-icon bg-success bg-opacity-10 text-success">
                    <i class="bi bi-cart-fill"></i>
                </div>
                <h5>Shopping Cart</h5>
                <p>Check the items you've selected for delivery.</p>
            </a>
        </div>
    </div>
</div>

<style>
    .fw-800 { font-weight: 800; }
    .text-gradient-primary {
        background: linear-gradient(135deg, var(--clr-primary), var(--clr-accent));
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }
    .dashboard-action-card {
        display: block; text-decoration: none; padding: 32px; border-radius: 24px;
        background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.08);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1); height: 100%;
    }
    .dashboard-action-card:hover {
        transform: translateY(-8px);
        background: rgba(255,255,255,0.08);
        border-color: var(--clr-primary);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }
    .action-icon {
        width: 56px; height: 56px; border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; margin-bottom: 20px;
        transition: transform 0.3s ease;
    }
    .dashboard-action-card:hover .action-icon { transform: scale(1.1) rotate(5deg); }
    .dashboard-action-card h5 { color: #fff; font-weight: 700; margin-bottom: 8px; }
    .dashboard-action-card p { color: rgba(255,255,255,0.4); font-size: 0.85rem; margin: 0; line-height: 1.5; }
    
    .bg-accent { background-color: #8b5cf6 !important; }
    .text-accent { color: #8b5cf6 !important; }
</style>
@endsection
