@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Sidebar (optional) -->
        <div class="col-md-3 d-none d-md-block">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Quick Menu</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="fas fa-users me-2"></i> Manage Users
                    </a>
                    <a href="{{ route('profile.show') }}" class="list-group-item list-group-item-action {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="fas fa-user me-2"></i> My Profile
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-tshirt me-2"></i> Laundry Orders
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="fas fa-chart-line me-2"></i> Reports
                    </a>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">System Status</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Users</span>
                        <span class="badge bg-primary">{{ $usersCount }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Active Orders</span>
                        <span class="badge bg-success">24</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Today's Revenue</span>
                        <span class="badge bg-info">Rp 1,250,000</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Dashboard Overview</h3>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dashboardDropdown" data-bs-toggle="dropdown">
                            <i class="fas fa-calendar-alt me-1"></i> Last 30 Days
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                            <li><a class="dropdown-item" href="#">Last 30 Days</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show mb-4">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Welcome Card -->
                    <div class="card border-0 bg-light mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="mb-3">Welcome back, {{ Auth::user()->name }}!</h4>
                                    <p class="mb-0">Here's what's happening with your laundry business today.</p>
                                </div>
                                <div class="col-md-4 text-center">
                                    @if(Auth::user()->photo)
                                        <img src="{{ asset('storage/'.Auth::user()->photo) }}"
                                             class="rounded-circle shadow"
                                             width="120"
                                             height="120">
                                    @else
                                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center shadow"
                                             style="width: 120px; height: 120px;">
                                            <span class="text-white display-4">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <div class="text-primary mb-2">
                                        <i class="fas fa-users fa-2x"></i>
                                    </div>
                                    <h3>{{ $usersCount }}</h3>
                                    <p class="mb-0 text-muted">Total Users</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <div class="text-success mb-2">
                                        <i class="fas fa-tshirt fa-2x"></i>
                                    </div>
                                    <h3>48</h3>
                                    <p class="mb-0 text-muted">Today's Orders</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <div class="text-warning mb-2">
                                        <i class="fas fa-spinner fa-2x"></i>
                                    </div>
                                    <h3>12</h3>
                                    <p class="mb-0 text-muted">In Progress</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center">
                                    <div class="text-info mb-2">
                                        <i class="fas fa-money-bill-wave fa-2x"></i>
                                    </div>
                                    <h3>Rp 2.5M</h3>
                                    <p class="mb-0 text-muted">Monthly Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row mb-4">
                        <div class="col-md-8 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Order Statistics</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="orderChart" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-white">
                                    <h5 class="mb-0">Service Distribution</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="serviceChart" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activities -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Recent Users</h5>
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Joined</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentUsers as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($user->photo)
                                                        <img src="{{ asset('storage/'.$user->photo) }}"
                                                             class="rounded-circle me-2"
                                                             width="32"
                                                             height="32">
                                                    @else
                                                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-2"
                                                             style="width: 32px; height: 32px;">
                                                            <span class="text-white small">{{ substr($user->name, 0, 1) }}</span>
                                                        </div>
                                                    @endif
                                                    {{ $user->name }}
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">No recent users found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Order Statistics Chart
        const orderCtx = document.getElementById('orderChart').getContext('2d');
        const orderChart = new Chart(orderCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Orders Completed',
                    data: [65, 59, 80, 81, 56, 72],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Service Distribution Chart
        const serviceCtx = document.getElementById('serviceChart').getContext('2d');
        const serviceChart = new Chart(serviceCtx, {
            type: 'doughnut',
            data: {
                labels: ['Regular Wash', 'Dry Clean', 'Ironing', 'Express'],
                datasets: [{
                    data: [45, 25, 15, 15],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });
    });
</script>
@endsection
