@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0">Detail Pengguna</h3>
                </div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        @if($user->photo)
                            <img src="{{ asset('storage/'.$user->photo) }}"
                                 alt="User Photo"
                                 class="rounded-circle shadow"
                                 width="150"
                                 height="150">
                        @else
                            <div class="bg-secondary rounded-circle shadow d-inline-flex align-items-center justify-content-center"
                                 style="width: 150px; height: 150px;">
                                <span class="text-white display-4">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Nama Lengkap</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control-plaintext"
                                   value="{{ $user->name }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control-plaintext"
                                   value="{{ $user->email }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Status</label>
                        <div class="col-md-6">
                            @if($user->trashed())
                                <span class="badge bg-danger">Terhapus</span>
                            @else
                                <span class="badge bg-success">Aktif</span>
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-4 col-form-label text-md-end">Dibuat Pada</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control-plaintext"
                                   value="{{ $user->created_at->format('d/m/Y H:i') }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
