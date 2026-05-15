<section>
    <header class="mb-4">
        <h2 class="fs-4 fw-bold">{{ __('Update Password') }}</h2>
        <p class="text-muted small">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <label class="form-label fw-bold" for="update_password_current_password">{{ __('Current Password') }}</label>
            <input type="password" id="update_password_current_password" name="current_password"
                class="form-control-luxury w-100 @if($errors->updatePassword->has('current_password')) is-invalid @endif"
                autocomplete="current-password">
            @if($errors->updatePassword->has('current_password'))
                <div class="invalid-feedback d-block mt-1">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold" for="update_password_password">{{ __('New Password') }}</label>
            <input type="password" id="update_password_password" name="password"
                class="form-control-luxury w-100 @if($errors->updatePassword->has('password')) is-invalid @endif"
                autocomplete="new-password">
            @if($errors->updatePassword->has('password'))
                <div class="invalid-feedback d-block mt-1">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold" for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation"
                class="form-control-luxury w-100 @if($errors->updatePassword->has('password_confirmation')) is-invalid @endif"
                autocomplete="new-password">
            @if($errors->updatePassword->has('password_confirmation'))
                <div class="invalid-feedback d-block mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn-luxury btn-luxury-primary px-4 py-2">{{ __('Save Password') }}</button>

            @if (session('status') === 'password-updated')
                <p class="mb-0 small text-success" style="font-weight: 500;">
                    <i class="bi bi-check-circle me-1"></i>{{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
