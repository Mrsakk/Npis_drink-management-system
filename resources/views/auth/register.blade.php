@extends('layouts.guest')

@section('content')
<div class="mb-4">
    <h3 class="fw-800 mb-1" style="color:var(--text);">{{ __('Create Account') }} 🚀</h3>
    <p class="text-muted small">{{ __('Join NPIA Drink and get drinks fast.') }}</p>
</div>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label class="auth-label">{{ __('Full Name') }}</label>
        <div class="auth-input-group">
            <i class="bi bi-person auth-icon"></i>
            <input type="text" name="name"
                class="auth-input @error('name') is-invalid @enderror"
                placeholder="Your full name"
                value="{{ old('name') }}" required autofocus>
        </div>
        @error('name')
            <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="auth-label">{{ __('Email Address') }}</label>
        <div class="auth-input-group">
            <i class="bi bi-envelope auth-icon"></i>
            <input type="email" name="email"
                class="auth-input @error('email') is-invalid @enderror"
                placeholder="your@email.com"
                value="{{ old('email') }}" required>
        </div>
        @error('email')
            <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="auth-label">{{ __('Password') }}</label>
        <div class="auth-input-group">
            <i class="bi bi-lock auth-icon"></i>
            <input type="password" name="password"
                class="auth-input @error('password') is-invalid @enderror"
                placeholder="Min 8 characters" required>
        </div>
        @error('password')
            <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="auth-label">{{ __('Confirm Password') }}</label>
        <div class="auth-input-group">
            <i class="bi bi-shield-lock auth-icon"></i>
            <input type="password" name="password_confirmation"
                class="auth-input"
                placeholder="Repeat your password" required>
        </div>
    </div>

    <button type="submit" class="btn-auth mt-2">
        <i class="bi bi-person-plus"></i> {{ __('Create Account') }}
    </button>
</form>

<div class="text-center mt-5">
    <span class="text-muted small">{{ __('Already have an account?') }}</span> 
    <a href="{{ route('login') }}" class="auth-link small ms-1 fw-bold">{{ __('Sign in here') }}</a>
</div>
@endsection