@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Profil Saya</h3>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        @if(auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                                 alt="Foto Profil"
                                 class="rounded-circle"
                                 width="150"
                                 height="150">
                        @else
                            <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center"
                                 style="width: 150px; height: 150px;">
                                <span class="text-white h4">No Photo</span>
                            </div>
                        @endif
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Nama</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control-plaintext"
                                   value="{{ auth()->user()->name }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control-plaintext"
                                   value="{{ auth()->user()->email }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
