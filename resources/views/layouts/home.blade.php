@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h3 class="mb-0">Dashboard</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <!-- Welcome Card -->
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Welcome, {{ Auth::user()->name }}!</h5>
                                    <p class="card-text">You're logged in to Yuk Laundry Online management system.</p>
                                    <div class="d-flex align-items-center mt-3">
                                        @if(Auth::user()->photo)
                                            <img src="{{ asset('storage/'.Auth::user()->photo) }}"
                                                 class="rounded-circle me-3"
                                                 width="80"
                                                 height="80">
                                        @else
                                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-3"
                                                 style="width: 80px; height: 80px;">
                                                <span class="text-white display-6">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-user-edit me-1"></i> Edit Profile
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="col-md-6 mb-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Quick Stats</h5>
                                    <div class="row text-center mt-3">
                                        <div class="col-6 mb-3">
                                            <div class="p-3 bg-light rounded">
                                                <h2 class="text-primary">{{ $usersCount ?? 0 }}</h2>
                                                <small class="text-muted">Total Users</small>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="p-3 bg-light rounded">
                                                <h2 class="text-success">{{ $activeUsersCount ?? 0 }}</h2>
                                                <small class="text-muted">Active Users</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activities -->
                    <div class="card border-0 shadow-sm mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Recent Activities</h5>
                            <div class="list-group">
                                @forelse($recentUsers as $user)
                                <a href="{{ route('users.show', $user->id) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $user->name }}</h6>
                                        <small>{{ $user->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">{{ $user->email }}</p>
                                </a>
                                @empty
                                <div class="list-group-item">
                                    No recent activities found
                                </div>
                                @endforelse
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dashboard specific scripts can go here
    });
</script>
@endsection
