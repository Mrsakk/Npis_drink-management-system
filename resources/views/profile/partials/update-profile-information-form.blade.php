<section>
    <header class="mb-4">
        <h2 class="fs-4 fw-bold">{{ __('Profile Information') }}</h2>
        <p class="text-muted small">{{ __("Update your account's profile information and email address.") }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label class="form-label fw-bold" for="name">{{ __('Name') }}</label>
            <input type="text" id="name" name="name"
                class="form-control-luxury w-100 @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold" for="email">{{ __('Email') }}</label>
            <input type="email" id="email" name="email"
                class="form-control-luxury w-100 @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="small">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-decoration-none text-primary">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="small text-success mt-2">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn-luxury btn-luxury-primary px-4 py-2">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="mb-0 small text-success" style="font-weight: 500;">
                    <i class="bi bi-check-circle me-1"></i>{{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
