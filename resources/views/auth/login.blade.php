@extends('layouts.guest')

@section('content')
<div class="mb-4">
    <h3 class="fw-800 mb-1" style="color:var(--clr-text);">{{ __('Welcome Back') }} 👋</h3>
    <p class="text-muted small">{{ __('Sign in to your NPIA Drink account to continue.') }}</p>
</div>

@if(session('status'))
    <div class="glass border-primary border-opacity-25 p-3 rounded-4 mb-4 text-primary small">
        <i class="bi bi-info-circle me-2"></i>{{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-4">
        <label class="auth-label">{{ __('Email Address') }}</label>
        <div class="auth-input-group">
            <i class="bi bi-envelope auth-icon"></i>
            <input type="email" name="email"
                class="auth-input @error('email') is-invalid @enderror"
                placeholder="your@email.com"
                value="{{ old('email') }}" required autofocus>
        </div>
        @error('email')
            <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="auth-label">{{ __('Password') }}</label>
        <div class="auth-input-group">
            <i class="bi bi-lock auth-icon"></i>
            <input type="password" name="password"
                class="auth-input @error('password') is-invalid @enderror"
                placeholder="••••••••" required>
        </div>
        @error('password')
            <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="form-check">
            <input type="checkbox" name="remember" class="form-check-input glass-check" id="remember">
            <label class="form-check-label text-muted small" for="remember">{{ __('Remember me') }}</label>
        </div>
        @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="auth-link small">
                {{ __('Forgot password?') }}
            </a>
        @endif
    </div>

    <button type="submit" class="btn-auth">
        <i class="bi bi-box-arrow-in-right"></i> {{ __('Sign In') }}
    </button>
</form>

<div class="text-center mt-5">
    <span class="text-muted small">{{ __("Don't have an account?") }}</span> 
    <a href="{{ route('register') }}" class="auth-link small ms-1 fw-bold">{{ __('Create one free') }}</a>
</div>
@endsection