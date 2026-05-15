<section>
    <header class="mb-4">
        <h2 class="fs-4 fw-800" style="color: var(--clr-text);">
            {{ __('Update Password') }}
        </h2>
        <p style="color: var(--clr-text-muted); font-size: 0.9rem;">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-4">
            <label class="form-label fw-bold opacity-75" for="update_password_current_password">{{ __('Current Password') }}</label>
            <input type="password" id="update_password_current_password" name="current_password" 
                class="form-control @if($errors->updatePassword->has('current_password')) is-invalid @endif" 
                autocomplete="current-password"
                style="background: rgba(255,255,255,0.05); border: 1px solid var(--clr-border); border-radius: 12px; padding: 12px 16px; color: var(--clr-text);">
            @if($errors->updatePassword->has('current_password'))
                <div class="invalid-feedback d-block mt-1">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold opacity-75" for="update_password_password">{{ __('New Password') }}</label>
            <input type="password" id="update_password_password" name="password" 
                class="form-control @if($errors->updatePassword->has('password')) is-invalid @endif" 
                autocomplete="new-password"
                style="background: rgba(255,255,255,0.05); border: 1px solid var(--clr-border); border-radius: 12px; padding: 12px 16px; color: var(--clr-text);">
            @if($errors->updatePassword->has('password'))
                <div class="invalid-feedback d-block mt-1">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold opacity-75" for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation" 
                class="form-control @if($errors->updatePassword->has('password_confirmation')) is-invalid @endif" 
                autocomplete="new-password"
                style="background: rgba(255,255,255,0.05); border: 1px solid var(--clr-border); border-radius: 12px; padding: 12px 16px; color: var(--clr-text);">
            @if($errors->updatePassword->has('password_confirmation'))
                <div class="invalid-feedback d-block mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn border-0" style="background: linear-gradient(135deg, var(--clr-primary), var(--clr-accent)); color: white; border-radius: 12px; padding: 10px 24px; font-weight: 600;">
                {{ __('Save Password') }}
            </button>

            @if (session('status') === 'password-updated')
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
