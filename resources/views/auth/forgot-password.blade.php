@extends('layouts.guest')

@section('content')
<h3>Forgot Password? 🔐</h3>
<p class="subtitle">No worries! Enter your email and we'll send a reset link.</p>

@if(session('status'))
    <div class="mb-4 p-3 rounded-3" style="background:rgba(16,185,129,0.12);border:1px solid rgba(16,185,129,0.25);color:#6ee7b7;font-size:.88rem;">
        <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-4">
        <label class="form-label">Email Address</label>
        <div class="input-icon-wrap">
            <i class="bi bi-envelope icon"></i>
            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="your@email.com"
                value="{{ old('email') }}" required autofocus>
        </div>
        @error('email')
            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-auth">
        <i class="bi bi-send me-2"></i>Send Reset Link
    </button>
</form>

<div class="auth-footer-text">
    Remember your password? <a href="{{ route('login') }}">Sign in</a>
</div>
@endsection
