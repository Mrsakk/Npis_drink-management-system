<section class="mb-4">
    <header class="mb-4">
        <h2 class="fs-4 fw-800 text-danger">
            {{ __('Delete Account') }}
        </h2>
        <p style="color: var(--clr-text-muted); font-size: 0.9rem;">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal" style="border-radius: 12px; padding: 10px 24px; font-weight: 600;">
        {{ __('Delete Account') }}
    </button>

    <!-- Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true" @if($errors->userDeletion->isNotEmpty()) data-bs-show="true" @endif>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background: var(--clr-surface); backdrop-filter: blur(24px); border: 1px solid var(--clr-border); border-radius: 24px;">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-800" id="confirmUserDeletionModalLabel" style="color: var(--clr-text);">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <p style="color: var(--clr-text-muted); font-size: 0.9rem;">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mt-4">
                            <label for="password" class="visually-hidden">{{ __('Password') }}</label>
                            <input type="password" id="password" name="password" 
                                class="form-control @if($errors->userDeletion->has('password')) is-invalid @endif" 
                                placeholder="{{ __('Password') }}"
                                style="background: rgba(255,255,255,0.05); border: 1px solid var(--clr-border); border-radius: 12px; padding: 12px 16px; color: var(--clr-text);">
                            @if($errors->userDeletion->has('password'))
                                <div class="invalid-feedback d-block mt-1">{{ $errors->userDeletion->first('password') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 12px; padding: 8px 20px;">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-danger" style="border-radius: 12px; padding: 8px 20px;">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if($errors->userDeletion->isNotEmpty())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var myModal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
                myModal.show();
            });
        </script>
    @endif
</section>
