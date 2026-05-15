@extends('admin.layout')
@section('title', __('Dashboard'))

@section('content')

{{-- Stats Row --}}
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" data-animate>
            <div class="stat-icon" style="background: rgba(217, 119, 6, 0.1); color: #d97706;">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="stat-label">{{ __('Pending Orders') }}</div>
            <div class="stat-value">{{ $pendingOrders }}</div>
            <div class="stat-trend badge-pending">
                <i class="bi bi-clock me-1"></i> {{ __('Awaiting') }}
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" data-animate>
            <div class="stat-icon" style="background: rgba(22, 163, 74, 0.1); color: #16a34a;">
                <i class="bi bi-currency-exchange"></i>
            </div>
            <div class="stat-label">{{ __('Total Revenue') }}</div>
            <div class="stat-value" style="font-size: 1.5rem;">៛{{ number_format($totalRevenue, 0) }}</div>
            <div class="stat-trend badge-completed">
                <i class="bi bi-graph-up-arrow me-1"></i> {{ __('Revenue') }}
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" data-animate>
            <div class="stat-icon" style="background: rgba(37, 99, 235, 0.1); color: #2563eb;">
                <i class="bi bi-bag-check-fill"></i>
            </div>
            <div class="stat-label">{{ __('Total Orders') }}</div>
            <div class="stat-value">{{ $totalOrders }}</div>
            <div class="stat-trend badge-processing">
                <i class="bi bi-receipt me-1"></i> {{ __('All Time') }}
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" data-animate>
            <div class="stat-icon" style="background: rgba(124, 58, 237, 0.1); color: #7c3aed;">
                <i class="bi bi-calendar-check-fill"></i>
            </div>
            <div class="stat-label">{{ __('Today\'s Orders') }}</div>
            <div class="stat-value">{{ $todayOrders }}</div>
            <div class="stat-trend" style="background: rgba(124, 58, 237, 0.08); color: #7c3aed;">
                <i class="bi bi-sun me-1"></i> {{ __('Today') }}
            </div>
        </div>
    </div>
</div>

{{-- Quick Actions & Overview --}}
<div class="row g-4">
    <div class="col-lg-6">
        <div class="table-card h-100" data-animate>
            <div class="card-header">
                <span><i class="bi bi-lightning-fill me-2 text-warning"></i>{{ __('Quick Actions') }}</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">
                        <a href="{{ route('admin.orders') }}" class="btn btn-outline-primary w-100 text-start d-flex align-items-center gap-3 py-3">
                            <i class="bi bi-bag-check-fill fs-5"></i>
                            <span class="fw-bold">{{ __('Manage Orders') }}</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-outline-primary w-100 text-start d-flex align-items-center gap-3 py-3">
                            <i class="bi bi-plus-circle-fill fs-5"></i>
                            <span class="fw-bold">{{ __('Add Product') }}</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.products') }}" class="btn btn-outline-primary w-100 text-start d-flex align-items-center gap-3 py-3">
                            <i class="bi bi-cup-straw fs-5"></i>
                            <span class="fw-bold">{{ __('All Products') }}</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.users') }}" class="btn btn-outline-primary w-100 text-start d-flex align-items-center gap-3 py-3">
                            <i class="bi bi-people-fill fs-5"></i>
                            <span class="fw-bold">{{ __('Manage Users') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="table-card h-100" data-animate>
            <div class="card-header">
                <span><i class="bi bi-activity me-2 text-success"></i>{{ __('Overview') }}</span>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-4">
                    @php
                        $items = [
                            ['label' => __('Pending Orders'), 'value' => $pendingOrders, 'color' => '#d97706', 'pct' => min(100, $totalOrders > 0 ? ($pendingOrders / $totalOrders * 100) : 0)],
                            ['label' => __('Completed Today'), 'value' => $todayOrders, 'color' => '#16a34a', 'pct' => min(100, $totalOrders > 0 ? ($todayOrders / $totalOrders * 100) : 0)],
                            ['label' => __('Total Revenue'), 'value' => '៛'.number_format($totalRevenue, 0), 'color' => '#2563eb', 'pct' => 85],
                        ];
                    @endphp
                    @foreach($items as $item)
                    <div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.5px;">{{ $item['label'] }}</span>
                            <span class="fw-bold">{{ $item['value'] }}</span>
                        </div>
                        <div style="height: 6px; border-radius: 6px; overflow: hidden; background: var(--ad-surface-2);">
                            <div style="height: 100%; width: {{ $item['pct'] }}%; background: {{ $item['color'] }}; border-radius: 6px; transition: width 1s ease;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection