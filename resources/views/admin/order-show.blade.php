@extends('admin.layout')
@section('title', 'Order #' . $order->order_number)

@section('content')

<div class="d-flex align-items-center gap-3 mb-4" data-animate>
    <a href="{{ route('admin.orders') }}" class="topbar-btn text-decoration-none">
        <i class="bi bi-arrow-left"></i> {{ __('Back') }}
    </a>
    <div>
        <h4 class="fw-bold mb-0">{{ __('Order') }} #{{ $order->order_number }}</h4>
        <p class="text-muted small mb-0 mt-1">
            <i class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('D, d M Y – H:i') }}
        </p>
    </div>
    <div class="ms-auto">
        @switch($order->status)
            @case('pending')    <span class="badge-status badge-pending"><i class="bi bi-hourglass-split"></i> {{ __('Pending') }}</span> @break
            @case('processing') <span class="badge-status badge-processing"><i class="bi bi-arrow-repeat"></i> {{ __('Processing') }}</span> @break
            @case('completed')  <span class="badge-status badge-completed"><i class="bi bi-check-circle-fill"></i> {{ __('Completed') }}</span> @break
            @case('cancelled')  <span class="badge-status badge-cancelled"><i class="bi bi-x-circle-fill"></i> {{ __('Cancelled') }}</span> @break
        @endswitch
    </div>
</div>

<div class="row g-4">
    {{-- Left: Items + Notes --}}
    <div class="col-lg-8">
        <div class="table-card mb-4" data-animate>
            <div class="card-header">
                <span><i class="bi bi-bag-check-fill me-2 text-primary"></i>{{ __('Order Items') }}</span>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>{{ __('Product') }}</th>
                            <th>{{ __('Unit Price') }}</th>
                            <th>{{ __('Qty') }}</th>
                            <th class="text-end">{{ __('Subtotal') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td class="fw-bold">{{ $item->product_name }}</td>
                            <td class="text-muted">៛{{ number_format($item->product_price, 2) }}</td>
                            <td>
                                <span class="badge-status badge-processing">×{{ $item->quantity }}</span>
                            </td>
                            <td class="text-end fw-bold text-primary">៛{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold text-muted">{{ __('Total') }}:</td>
                            <td class="text-end">
                                <span class="fw-bold text-primary" style="font-size: 1.2rem;">៛{{ number_format($order->total, 2) }}</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @if($order->notes)
        <div class="table-card" data-animate>
            <div class="card-header">
                <span><i class="bi bi-sticky-fill me-2 text-warning"></i>{{ __('Delivery Notes') }}</span>
            </div>
            <div class="card-body">
                <p class="text-muted mb-0" style="font-style: italic;">"{{ $order->notes }}"</p>
            </div>
        </div>
        @endif
    </div>

    {{-- Right: Customer + Status --}}
    <div class="col-lg-4">
        <div class="table-card mb-4" data-animate>
            <div class="card-header">
                <span><i class="bi bi-person-circle me-2 text-primary"></i>{{ __('Customer Info') }}</span>
            </div>
            <div class="card-body">
                @php
                    $info = [
                        ['icon' => 'bi-person-fill', 'label' => __('Name'),     'value' => $order->student_name],
                        ['icon' => 'bi-telephone-fill','label' => __('Phone'),  'value' => $order->phone],
                        ['icon' => 'bi-building',    'label' => __('Building'), 'value' => $order->building],
                        ['icon' => 'bi-door-closed', 'label' => __('Room'),     'value' => $order->room_number],
                        ['icon' => 'bi-wallet2',     'label' => __('Payment'),  'value' => ucfirst($order->payment_method)],
                    ];
                @endphp
                <div class="d-flex flex-column gap-3">
                    @foreach($info as $row)
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-3 text-primary" style="width:34px;height:34px;background:rgba(37,99,235,0.1);">
                            <i class="{{ $row['icon'] }}"></i>
                        </div>
                        <div>
                            <div class="text-muted small text-uppercase fw-bold" style="font-size:0.7rem;letter-spacing:0.5px;">{{ $row['label'] }}</div>
                            <div class="fw-bold small">{{ $row['value'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="table-card" data-animate>
            <div class="card-header">
                <span><i class="bi bi-pencil-fill me-2 text-success"></i>{{ __('Update Status') }}</span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.order.status', $order) }}">
                    @csrf
                    <div class="mb-3">
                        <select name="status" class="form-select">
                            <option value="pending"    {{ $order->status=='pending'    ? 'selected':'' }}>🟡 {{ __('Pending') }}</option>
                            <option value="processing" {{ $order->status=='processing' ? 'selected':'' }}>🔵 {{ __('Processing') }}</option>
                            <option value="completed"  {{ $order->status=='completed'  ? 'selected':'' }}>🟢 {{ __('Completed') }}</option>
                            <option value="cancelled"  {{ $order->status=='cancelled'  ? 'selected':'' }}>🔴 {{ __('Cancelled') }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ __('Update Status') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection