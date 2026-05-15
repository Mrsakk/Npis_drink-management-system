<section>
    <header class="mb-4">
        <h2 class="fs-4 fw-800" style="color: var(--clr-text);">
            {{ __('Profile Information') }}
        </h2>
        <p style="color: var(--clr-text-muted); font-size: 0.9rem;">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="mb-4">
            <label class="form-label fw-bold opacity-75" for="name">{{ __('Name') }}</label>
            <input type="text" id="name" name="name" 
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" 
                style="background: rgba(255,255,255,0.05); border: 1px solid var(--clr-border); border-radius: 12px; padding: 12px 16px; color: var(--clr-text);">
            @error('name')
                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold opacity-75" for="email">{{ __('Email') }}</label>
            <input type="email" id="email" name="email" 
                class="form-control @error('email') is-invalid @enderror" 
                value="{{ old('email', $user->email) }}" required autocomplete="username"
                style="background: rgba(255,255,255,0.05); border: 1px solid var(--clr-border); border-radius: 12px; padding: 12px 16px; color: var(--clr-text);">
            @error('email')
                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <p class="small" style="color: var(--clr-text);">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline text-decoration-none" style="color: var(--clr-primary);">
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
            <button type="submit" class="btn border-0" style="background: linear-gradient(135deg, var(--clr-primary), var(--clr-accent)); color: white; border-radius: 12px; padding: 10px 24px; font-weight: 600;">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p class="mb-0 small text-success transition-fade-out" style="font-weight: 500;">
                    <i class="bi bi-check-circle me-1"></i>{{ __('Saved.') }}
                </p>
                <script>
                    setTimeout(() => {
                        const el = document.querySelector('.transition-fade-out');
                        if (el) el.style.opacity = '0';
                    }, 2000);
                </script>
            @endif
        </div>
    </form>
</section>
