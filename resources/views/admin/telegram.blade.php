@extends('admin.layout')

@section('title', 'Telegram - Admin')

@section('content')

<h1 class="mb-4">Telegram</h1>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">Send Message</div>
            <div class="card-body">
                <form action="{{ route('admin.telegram.send') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Message (HTML Support)</label>
                        <textarea name="message" class="form-control" rows="8" placeholder="Enter message... Use &lt;b&gt;text&lt;/b&gt; for bold.">{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Formatting</div>
            <div class="card-body">
                <p><code>&lt;b&gt;Bold&lt;/b&gt;</code> - Bold text</p>
                <p><code>&lt;i&gt;Italic&lt;/i&gt;</code> - Italic text</p>
                <p><code>&lt;code&gt;Code&lt;/code&gt;</code> - Monospace</p>
            </div>
        </div>
    </div>
</div>

@endsection