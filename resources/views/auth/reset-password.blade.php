@extends('layouts.guest')

@section('content')
<h3>Reset Password 🔑</h3>
<p class="subtitle">Choose a strong new password for your account.</p>

<form method="POST" action="{{ route('password.store') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="mb-3">
        <label class="form-label">Email Address</label>
        <div class="input-icon-wrap">
            <i class="bi bi-envelope icon"></i>
            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $request->email) }}"
                placeholder="your@email.com"
                required autofocus autocomplete="username">
        </div>
        @error('email')
            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">New Password</label>
        <div class="input-icon-wrap">
            <i class="bi bi-lock icon"></i>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Min 8 characters"
                required autocomplete="new-password">
        </div>
        @error('password')
            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="form-label">Confirm New Password</label>
        <div class="input-icon-wrap">
            <i class="bi bi-shield-lock icon"></i>
            <input type="password" name="password_confirmation" id="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                placeholder="Repeat your new password"
                required autocomplete="new-password">
        </div>
        @error('password_confirmation')
            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-auth">
        <i class="bi bi-check-circle me-2"></i>Reset Password
    </button>
</form>

<div class="auth-footer-text">
    Remembered it? <a href="{{ route('login') }}">Back to Sign in</a>
</div>
@endsection
