@extends('dashboard')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h4>Kelola Data Program Madrasah</h4>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Data Program Madrasah</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card  bg-info bg-gradient">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <div class="row">
                            <div class="col-lg-8">
                                <a href="{{ route('programmadrasah.create') }}" type="button" class="btn btn-light">Tambah
                                    Data</a>
                            </div>
                            @include('layouts.allerror')
                        </div>
                        <hr class="hr">
                        <div class="card">
                            <div class="card-body">
                                <!-- Default Table -->
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="bg-info bg-gradient bg-opacity-75 text-dark">
                                                <th scope="col">#</th>
                                                <th scope="col">Icon</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Deskripsi</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $item)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>
                                                        @if ($item->icon)
                                                            <i class="{{ $item->icon }} fa-sm"
                                                                style="font-size: 1.25rem;"></i>
                                                        @else
                                                            <i class="fa-solid fa-circle-question text-muted"
                                                                title="Tidak ada icon"></i>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>{{ Str::limit($item->description, 50) }}</td>
                                                    <td>{{ $item->status }}</td>
                                                    <td class="d-flex gap-2">
                                                        @if (Auth::user()->hasRole('master-admin'))
                                                            @if ($item->status == 'pending')
                                                                <form
                                                                    action="{{ route('programmadrasah.approve', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-sm">Approve</button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('programmadrasah.reject', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Reject</button>
                                                                </form>
                                                            @else
                                                                <form
                                                                    action="{{ route('programmadrasah.approveDelete', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-sm">Approve</button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('programmadrasah.rejectDelete', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Reject</button>
                                                                </form>
                                                            @endif
                                                        @else
                                                            <a href="{{ route('programmadrasah.edit', $item) }}"
                                                                class="btn btn-primary {{ in_array($item->status, ['pending', 'pending-delete']) ? 'disabled' : '' }}">
                                                                Edit
                                                            </a>

                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#alert-hapus-kategori{{ $item->id }}"
                                                                {{ in_array($item->status, ['pending', 'pending-delete']) ? 'disabled' : '' }}>
                                                                Delete
                                                            </button>
                                                        @endif

                                                        <!-- Modal delete -->
                                                        @if (isset($item))
                                                            <div class="modal fade"
                                                                id="alert-hapus-kategori{{ $item->id }}" tabindex="-1"
                                                                aria-labelledby="confirmDeleteModal{{ $item->id }}Label"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="confirmDeleteModal{{ $item->id }}Label">
                                                                                Konfirmasi Hapus Data</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            Apakah Anda yakin ingin menghapus
                                                                            Data
                                                                            ini?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Batal</button>
                                                                            <form id="deleteForm{{ $item->id }}"
                                                                                action="{{ route('programmadrasah.destroy', $item->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Hapus</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data</td>
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
    </main>
@endsection
