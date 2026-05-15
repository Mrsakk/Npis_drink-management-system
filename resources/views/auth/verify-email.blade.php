@extends('layouts.guest')

@section('content')
<div class="text-center mb-4">
    <div style="width:64px;height:64px;background:linear-gradient(135deg,#0ea5e9,#8b5cf6);border-radius:16px;display:inline-flex;align-items:center;justify-content:center;font-size:1.8rem;color:#fff;box-shadow:0 8px 25px rgba(14,165,233,.4);margin-bottom:16px;">
        <i class="bi bi-envelope-check"></i>
    </div>
    <h3>Verify Your Email 📧</h3>
    <p class="subtitle">Thanks for signing up! Please verify your email address by clicking the link we sent you.</p>
</div>

@if(session('status') == 'verification-link-sent')
    <div class="mb-4 p-3 rounded-3" style="background:rgba(16,185,129,0.12);border:1px solid rgba(16,185,129,0.25);color:#6ee7b7;font-size:.88rem;">
        <i class="bi bi-check-circle me-2"></i>A new verification link has been sent to your email address.
    </div>
@endif

<form method="POST" action="{{ route('verification.send') }}" class="mb-3">
    @csrf
    <button type="submit" class="btn-auth">
        <i class="bi bi-arrow-repeat me-2"></i>Resend Verification Email
    </button>
</form>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn-continue" style="width:100%;background:none;border:1px solid rgba(255,255,255,.12);border-radius:12px;color:rgba(255,255,255,.45);padding:12px;font-size:.88rem;cursor:pointer;transition:all .25s ease;"
        onmouseover="this.style.borderColor='rgba(239,68,68,.4)';this.style.color='#fca5a5';"
        onmouseout="this.style.borderColor='rgba(255,255,255,.12)';this.style.color='rgba(255,255,255,.45)';">
        <i class="bi bi-box-arrow-right me-2"></i>Log Out
    </button>
</form>
@endsection
