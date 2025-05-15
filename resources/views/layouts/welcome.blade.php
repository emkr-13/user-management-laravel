@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="display-4 mb-4">Welcome to Yuk Laundry Online</h1>
            <p class="lead mb-5">Your modern laundry management solution</p>

            <div class="d-flex justify-content-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-4">
                            <i class="fas fa-user-plus me-2"></i> Register
                        </a>
                    @endif
                @else
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-tachometer-alt me-2"></i> Go to Dashboard
                    </a>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection
