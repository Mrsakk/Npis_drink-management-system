@extends('admin.layout')
@section('title', __('Dashboard'))

@section('content')

{{-- Stats Row --}}
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" data-animate>
            <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="stat-label">{{ __('Pending Orders') }}</div>
            <div class="stat-value text-white">{{ $pendingOrders }}</div>
            <div class="stat-trend" style="background: rgba(245, 158, 11, 0.08); color: #f59e0b;">
                <i class="bi bi-clock me-1"></i> {{ __('Awaiting') }}
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" data-animate>
            <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                <i class="bi bi-currency-exchange"></i>
            </div>
            <div class="stat-label">{{ __('Total Revenue') }}</div>
            <div class="stat-value text-white" style="font-size: 1.6rem;">៛{{ number_format($totalRevenue, 0) }}</div>
            <div class="stat-trend" style="background: rgba(16, 185, 129, 0.08); color: #10b981;">
                <i class="bi bi-graph-up-arrow me-1"></i> {{ __('Revenue') }}
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" data-animate>
            <div class="stat-icon" style="background: rgba(14, 165, 233, 0.1); color: #0ea5e9;">
                <i class="bi bi-bag-check-fill"></i>
            </div>
            <div class="stat-label">{{ __('Total Orders') }}</div>
            <div class="stat-value text-white">{{ $totalOrders }}</div>
            <div class="stat-trend" style="background: rgba(14, 165, 233, 0.08); color: #0ea5e9;">
                <i class="bi bi-receipt me-1"></i> {{ __('All Time') }}
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card" data-animate>
            <div class="stat-icon" style="background: rgba(139, 92, 246, 0.1); color: #8b5cf6;">
                <i class="bi bi-calendar-check-fill"></i>
            </div>
            <div class="stat-label">{{ __('Today\'s Orders') }}</div>
            <div class="stat-value text-white">{{ $todayOrders }}</div>
            <div class="stat-trend" style="background: rgba(139, 92, 246, 0.08); color: #8b5cf6;">
                <i class="bi bi-sun me-1"></i> {{ __('Today') }}
            </div>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="row g-4">
    <div class="col-lg-6">
        <div class="table-card h-100" data-animate>
            <div class="card-header">
                <span><i class="bi bi-lightning-fill me-2 text-warning"></i>{{ __('Quick Actions') }}</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">
                        <a href="{{ route('admin.orders') }}" class="btn btn-primary w-100 text-start d-flex align-items-center gap-3 py-3 border-0" style="background: rgba(14,165,233,0.1); color: #0ea5e9;">
                            <i class="bi bi-bag-check-fill fs-5"></i>
                            <span class="fw-700">{{ __('Manage Orders') }}</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary w-100 text-start d-flex align-items-center gap-3 py-3 border-0" style="background: rgba(16,185,129,0.1); color: #10b981;">
                            <i class="bi bi-plus-circle-fill fs-5"></i>
                            <span class="fw-700">{{ __('Add Product') }}</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.products') }}" class="btn btn-primary w-100 text-start d-flex align-items-center gap-3 py-3 border-0" style="background: rgba(139,92,246,0.1); color: #8b5cf6;">
                            <i class="bi bi-cup-straw fs-5"></i>
                            <span class="fw-700">{{ __('All Products') }}</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.users') }}" class="btn btn-primary w-100 text-start d-flex align-items-center gap-3 py-3 border-0" style="background: rgba(244,63,94,0.1); color: #f43f5e;">
                            <i class="bi bi-people-fill fs-5"></i>
                            <span class="fw-700">{{ __('Manage Users') }}</span>
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
                            ['label' => __('Pending Orders'), 'value' => $pendingOrders, 'color' => '#f59e0b', 'pct' => min(100, $totalOrders > 0 ? ($pendingOrders / $totalOrders * 100) : 0)],
                            ['label' => __('Completed Today'), 'value' => $todayOrders, 'color' => '#10b981', 'pct' => min(100, $totalOrders > 0 ? ($todayOrders / $totalOrders * 100) : 0)],
                            ['label' => __('Total Revenue'), 'value' => '៛'.number_format($totalRevenue, 0), 'color' => '#0ea5e9', 'pct' => 85],
                        ];
                    @endphp
                    @foreach($items as $item)
                    <div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small fw-700 text-uppercase letter-spacing-1">{{ $item['label'] }}</span>
                            <span class="text-white fw-800">{{ $item['value'] }}</span>
                        </div>
                        <div class="glass" style="height: 8px; border-radius: 10px; overflow: hidden; border: 1px solid rgba(255,255,255,0.05);">
                            <div style="height: 100%; width: {{ $item['pct'] }}%; background: {{ $item['color'] }}; border-radius: 10px; transition: width 1.5s cubic-bezier(0.16,1,0.3,1);"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection