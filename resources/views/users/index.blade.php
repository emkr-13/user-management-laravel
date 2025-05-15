@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Manajemen Pengguna</h3>
                        <a href="{{ route('users.create') }}" class="btn btn-light">
                            <i class="fas fa-plus"></i> Tambah Pengguna
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Dibuat Pada</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr class="{{ $user->trashed() ? 'table-danger' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($user->photo)
                                            <img src="{{ asset('storage/'.$user->photo) }}"
                                                 alt="User Photo"
                                                 class="rounded-circle"
                                                 width="40"
                                                 height="40">
                                        @else
                                            <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center"
                                                 style="width: 40px; height: 40px;">
                                                <span class="text-white">{{ substr($user->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->trashed())
                                            <span class="badge bg-danger">Terhapus</span>
                                        @else
                                            <span class="badge bg-success">Aktif</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            @if($user->trashed())
                                                <form action="{{ route('users.restore', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success" title="Pulihkan">
                                                        <i class="fas fa-trash-restore"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('users.force-delete', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Permanen"
                                                            onclick="return confirm('Yakin hapus permanen?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus"
                                                            onclick="return confirm('Yakin menghapus pengguna ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
