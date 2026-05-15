@extends('admin.layout')
@section('title', __('Telegram Broadcast'))

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4" data-animate>
    <div>
        <h4 class="fw-bold mb-0">{{ __('Telegram Broadcast') }}</h4>
        <p class="text-muted small mt-1 mb-0">{{ __('Send announcements to your Telegram channel.') }}</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="table-card" data-animate>
            <div class="card-header">
                <span><i class="bi bi-send-fill me-2 text-primary"></i>{{ __('Send Message') }}</span>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.telegram.send') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">{{ __('Message') }} (HTML Support)</label>
                        <textarea name="message" class="form-control" rows="8" placeholder="{{ __('Enter message... Use <b>text</b> for bold.') }}">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-send-fill me-2"></i>{{ __('Send Message') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="table-card" data-animate>
            <div class="card-header">
                <span><i class="bi bi-code-slash me-2 text-primary"></i>{{ __('Formatting') }}</span>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-3">
                    <div>
                        <code class="px-2 py-1 rounded small" style="background: var(--ad-surface-2);">&lt;b&gt;Bold&lt;/b&gt;</code>
                        <span class="text-muted small ms-2">{{ __('Bold text') }}</span>
                    </div>
                    <div>
                        <code class="px-2 py-1 rounded small" style="background: var(--ad-surface-2);">&lt;i&gt;Italic&lt;/i&gt;</code>
                        <span class="text-muted small ms-2">{{ __('Italic text') }}</span>
                    </div>
                    <div>
                        <code class="px-2 py-1 rounded small" style="background: var(--ad-surface-2);">&lt;code&gt;Code&lt;/code&gt;</code>
                        <span class="text-muted small ms-2">{{ __('Monospace') }}</span>
                    </div>
                    <div>
                        <code class="px-2 py-1 rounded small" style="background: var(--ad-surface-2);">&lt;a href="..."&gt;Link&lt;/a&gt;</code>
                        <span class="text-muted small ms-2">{{ __('Hyperlink') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection