@extends('store.layout')

@section('title', __('Profile') . ' – NPIA Drink')

@section('content')
<div class="animate-up" style="max-width: 800px; margin: 0 auto; padding: 40px 0;">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="display-6 fw-800 mb-2 text-gradient-primary" style="letter-spacing: -1.5px;">{{ __('Profile Settings') }}</h1>
            <p style="color: var(--clr-text-muted); font-weight: 500;">{{ __('Manage your personal information and security preferences') }}</p>
        </div>
    </div>

    <div class="card mb-4 border-0" style="background: var(--clr-surface); backdrop-filter: blur(24px); border-radius: 24px; box-shadow: 0 24px 80px rgba(0,0,0,0.05); border: 1px solid var(--clr-border);">
        <div class="card-body p-4 p-md-5">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="card mb-4 border-0" style="background: var(--clr-surface); backdrop-filter: blur(24px); border-radius: 24px; box-shadow: 0 24px 80px rgba(0,0,0,0.05); border: 1px solid var(--clr-border);">
        <div class="card-body p-4 p-md-5">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="card mb-4 border-0" style="background: var(--clr-surface); backdrop-filter: blur(24px); border-radius: 24px; box-shadow: 0 24px 80px rgba(0,0,0,0.05); border: 1px solid var(--clr-border);">
        <div class="card-body p-4 p-md-5">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>

<style>
    .text-gradient-primary {
        background: linear-gradient(135deg, var(--clr-primary), var(--clr-accent));
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }
    .fw-800 { font-weight: 800; }
</style>
@endsection
