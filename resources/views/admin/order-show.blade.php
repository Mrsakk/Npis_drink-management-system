@extends('admin.layout')
@section('title', 'Order #' . $order->order_number)

@section('content')

<div class="d-flex align-items-center gap-3 mb-4" style="animation:fadeInUp 0.4s ease;">
    <a href="{{ route('admin.orders') }}" class="topbar-btn text-decoration-none">
        <i class="bi bi-arrow-left"></i> Back
    </a>
    <div>
        <h4 style="font-weight:800;color:var(--ad-text);margin:0;">Order #{{ $order->order_number }}</h4>
        <p style="color:var(--ad-text-muted);font-size:0.82rem;margin:3px 0 0;">
            <i class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('D, d M Y – H:i') }}
        </p>
    </div>
    <div class="ms-auto">
        @switch($order->status)
            @case('pending')    <span class="badge-status badge-pending"><i class="bi bi-hourglass-split"></i> Pending</span> @break
            @case('processing') <span class="badge-status badge-processing"><i class="bi bi-arrow-repeat"></i> Processing</span> @break
            @case('completed')  <span class="badge-status badge-completed"><i class="bi bi-check-circle-fill"></i> Completed</span> @break
            @case('cancelled')  <span class="badge-status badge-cancelled"><i class="bi bi-x-circle-fill"></i> Cancelled</span> @break
        @endswitch
    </div>
</div>

<div class="row g-4">
    {{-- Left: Items + Notes --}}
    <div class="col-lg-8">
        <div class="table-card mb-4" style="animation-delay:0.1s;">
            <div class="card-header">
                <span><i class="bi bi-bag-check-fill me-2" style="color:var(--ad-primary);"></i>Order Items</span>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Unit Price</th>
                            <th>Qty</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td style="font-weight:700;">{{ $item->product_name }}</td>
                            <td style="color:var(--ad-text-muted);">${{ number_format($item->product_price, 2) }}</td>
                            <td>
                                <span style="background:rgba(14,165,233,0.12);color:#38bdf8;border:1px solid rgba(14,165,233,0.22);border-radius:6px;padding:2px 10px;font-weight:700;">×{{ $item->quantity }}</span>
                            </td>
                            <td class="text-end">
                                <span style="font-weight:800;background:linear-gradient(135deg,#0ea5e9,#14b8a6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">${{ number_format($item->subtotal, 2) }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end" style="font-weight:700;color:var(--ad-text-muted);">Total:</td>
                            <td class="text-end">
                                <span style="font-size:1.3rem;font-weight:900;background:linear-gradient(135deg,#0ea5e9,#14b8a6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">${{ number_format($order->total, 2) }}</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @if($order->notes)
        <div class="table-card" style="animation-delay:0.15s;">
            <div class="card-header">
                <span><i class="bi bi-sticky-fill me-2" style="color:#f59e0b;"></i>Delivery Notes</span>
            </div>
            <div class="card-body">
                <p style="color:var(--ad-text-muted);margin:0;font-style:italic;">"{{ $order->notes }}"</p>
            </div>
        </div>
        @endif
    </div>

    {{-- Right: Customer + Status --}}
    <div class="col-lg-4">
        <div class="table-card mb-4" style="animation-delay:0.1s;">
            <div class="card-header">
                <span><i class="bi bi-person-circle me-2" style="color:var(--ad-accent);"></i>Customer Info</span>
            </div>
            <div class="card-body">
                @php
                    $info = [
                        ['icon' => 'bi-person-fill', 'label' => 'Name',     'value' => $order->student_name],
                        ['icon' => 'bi-telephone-fill','label' => 'Phone',  'value' => $order->phone],
                        ['icon' => 'bi-building',    'label' => 'Building', 'value' => $order->building],
                        ['icon' => 'bi-door-closed', 'label' => 'Room',     'value' => $order->room_number],
                        ['icon' => 'bi-wallet2',     'label' => 'Payment',  'value' => ucfirst($order->payment_method)],
                    ];
                @endphp
                <div class="d-flex flex-column gap-3">
                    @foreach($info as $row)
                    <div class="d-flex align-items-center gap-3">
                        <div style="width:34px;height:34px;border-radius:10px;background:rgba(14,165,233,0.10);border:1px solid rgba(14,165,233,0.18);display:flex;align-items:center;justify-content:center;color:var(--ad-primary);flex-shrink:0;">
                            <i class="{{ $row['icon'] }}"></i>
                        </div>
                        <div>
                            <div style="font-size:0.72rem;font-weight:600;color:var(--ad-text-muted);text-transform:uppercase;letter-spacing:0.5px;">{{ $row['label'] }}</div>
                            <div style="font-weight:700;font-size:0.9rem;">{{ $row['value'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="table-card" style="animation-delay:0.15s;">
            <div class="card-header">
                <span><i class="bi bi-pencil-fill me-2" style="color:#10b981;"></i>Update Status</span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.order.status', $order) }}">
                    @csrf
                    <div class="mb-3">
                        <select name="status" class="form-select">
                            <option value="pending"    {{ $order->status=='pending'    ? 'selected':'' }}>🟡 Pending</option>
                            <option value="processing" {{ $order->status=='processing' ? 'selected':'' }}>🔵 Processing</option>
                            <option value="completed"  {{ $order->status=='completed'  ? 'selected':'' }}>🟢 Completed</option>
                            <option value="cancelled"  {{ $order->status=='cancelled'  ? 'selected':'' }}>🔴 Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-circle-fill me-2"></i>Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection