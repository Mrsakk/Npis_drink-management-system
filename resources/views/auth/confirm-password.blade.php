@extends('layouts.guest')

@section('content')
<h3>Confirm Password 🔒</h3>
<p class="subtitle">This is a secure area. Please confirm your password before continuing.</p>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div class="mb-4">
        <label class="form-label">Password</label>
        <div class="input-icon-wrap">
            <i class="bi bi-lock icon"></i>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Enter your password"
                required autocomplete="current-password">
        </div>
        @error('password')
            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-auth">
        <i class="bi bi-shield-check me-2"></i>Confirm Password
    </button>
</form>
@endsection
