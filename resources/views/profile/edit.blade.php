@extends('store.layout')

@section('title', __('Profile') . ' – NPIA Drink')

@section('content')
<div class="container py-5">
    <div class="row g-4 g-lg-5">
        {{-- Profile Header --}}
        <div class="col-12" data-animate>
            <div class="profile-hero-luxury glass rounded-5 p-4 p-md-5 mb-4 position-relative overflow-hidden">
                <div class="row align-items-center g-4">
                    <div class="col-auto">
                        <div class="profile-avatar-ultra shadow-premium">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                    <div class="col">
                        <div class="luxury-badge mb-2">
                            <i class="bi bi-person-check-fill"></i> {{ strtoupper(Auth::user()->role) }}
                        </div>
                        <h1 class="hero-title-luxury fs-2 mb-2">{{ Auth::user()->name }}</h1>
                        <div class="d-flex flex-wrap gap-4 mt-3">
                            <div class="stat-pill-luxury glass">
                                <i class="bi bi-envelope-fill"></i> {{ Auth::user()->email }}
                            </div>
                            <div class="stat-pill-luxury glass">
                                <i class="bi bi-calendar3"></i> {{ __('Member since') }} {{ Auth::user()->created_at->format('M Y') }}
                            </div>
                            <div class="stat-pill-luxury glass accent">
                                <i class="bi bi-star-fill"></i> 250 {{ __('Points') }}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Abstract decorative element --}}
                <div class="abstract-orb-profile"></div>
            </div>
        </div>

        {{-- Sidebar / Tab Navigation --}}
        <div class="col-lg-3" data-animate>
            <div class="glass rounded-5 p-3 sticky-top profile-sidebar-luxury" style="top: 110px;">
                <div class="nav flex-row flex-lg-column nav-pills gap-2 profile-nav-tabs-luxury" id="v-pills-tab" role="tablist">
                    <button class="nav-link-luxury active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab">
                        <i class="bi bi-speedometer2"></i> <span>{{ __('Overview') }}</span>
                    </button>
                    <button class="nav-link-luxury" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab">
                        <i class="bi bi-person-badge"></i> <span>{{ __('Identity') }}</span>
                    </button>
                    <button class="nav-link-luxury" id="v-pills-security-tab" data-bs-toggle="pill" data-bs-target="#v-pills-security" type="button" role="tab">
                        <i class="bi bi-shield-lock"></i> <span>{{ __('Security') }}</span>
                    </button>
                    <a href="{{ route('orders') }}" class="nav-link-luxury">
                        <i class="bi bi-receipt"></i> <span>{{ __('Orders') }}</span>
                    </a>
                    <div class="d-none d-lg-block my-3 border-top opacity-10"></div>
                    <button class="nav-link-luxury text-danger" id="v-pills-danger-tab" data-bs-toggle="pill" data-bs-target="#v-pills-danger" type="button" role="tab">
                        <i class="bi bi-trash3"></i> <span>{{ __('Privacy') }}</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Content Area --}}
        <div class="col-lg-9" data-animate>
            <div class="tab-content" id="v-pills-tabContent">
                {{-- Dashboard Overview --}}
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel">
                    <div class="profile-dashboard-grid">
                        <a href="javascript:void(0)" onclick="document.getElementById('v-pills-profile-tab').click()" class="profile-action-card glass rounded-5">
                            <div class="action-card-icon"><i class="bi bi-person-circle"></i></div>
                            <h5 class="action-card-title">{{ __('Identity Info') }}</h5>
                            <p class="action-card-desc">{{ __('Manage your personal details, email, and public profile information.') }}</p>
                        </a>
                        <a href="javascript:void(0)" onclick="document.getElementById('v-pills-security-tab').click()" class="profile-action-card glass rounded-5">
                            <div class="action-card-icon"><i class="bi bi-shield-check"></i></div>
                            <h5 class="action-card-title">{{ __('Security') }}</h5>
                            <p class="action-card-desc">{{ __('Keep your account safe by updating your password and credentials.') }}</p>
                        </a>
                        <a href="{{ route('orders') }}" class="profile-action-card glass rounded-5">
                            <div class="action-card-icon"><i class="bi bi-receipt-cutoff"></i></div>
                            <h5 class="action-card-title">{{ __('My Orders') }}</h5>
                            <p class="action-card-desc">{{ __('View your order history, tracking details, and past purchases.') }}</p>
                        </a>
                    </div>
                </div>

                {{-- Account Info --}}
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel">
                    <div class="glass rounded-5 p-4 p-md-5">
                        <div class="d-flex align-items-center gap-3 mb-5">
                            <button class="btn btn-icon d-lg-none" onclick="document.getElementById('v-pills-home-tab').click()"><i class="bi bi-arrow-left"></i></button>
                            <h4 class="fw-900 mb-0" style="color:var(--text);">{{ __('Update Identity') }}</h4>
                        </div>
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                {{-- Security --}}
                <div class="tab-pane fade" id="v-pills-security" role="tabpanel">
                    <div class="glass rounded-5 p-4 p-md-5">
                        <div class="d-flex align-items-center gap-3 mb-5">
                            <button class="btn btn-icon d-lg-none" onclick="document.getElementById('v-pills-home-tab').click()"><i class="bi bi-arrow-left"></i></button>
                            <h4 class="fw-900 mb-0" style="color:var(--text);">{{ __('Security Credentials') }}</h4>
                        </div>
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- Danger Zone --}}
                <div class="tab-pane fade" id="v-pills-danger" role="tabpanel">
                    <div class="glass rounded-5 p-4 p-md-5 border-danger border-opacity-10">
                        <div class="d-flex align-items-center gap-3 mb-5">
                            <button class="btn btn-icon d-lg-none" onclick="document.getElementById('v-pills-home-tab').click()"><i class="bi bi-arrow-left"></i></button>
                            <h4 class="fw-900 mb-0 text-danger">{{ __('Account Privacy') }}</h4>
                        </div>
                        <p class="text-muted mb-5">{{ __('Permanently remove your account and all associated data from our systems.') }}</p>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
