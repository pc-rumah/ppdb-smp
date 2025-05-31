@extends('dashboard')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h4>Kelola Data Kegiatan</h4>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Data Kegiatan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card bg-info bg-gradient">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <div class="row">
                            <div class="col-lg-8">
                                <a href="{{ route('kegiatanpondok.create') }}" type="button" class="btn btn-light">Tambah
                                    Data</a>
                            </div>
                            @include('layouts.allerror')
                        </div>
                        <hr class="hr">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="bg-info bg-gradient bg-opacity-75 text-dark">
                                                <th scope="col">#</th>
                                                <th scope="col">Gambar</th>
                                                <th scope="col">Waktu</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col">Deskripsi</th>

                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $item)
                                                <tr>
                                                    <th scope="row">
                                                        {{ $data->firstItem() + $loop->index }}
                                                    </th>
                                                    </td>
                                                    <td>
                                                        @if ($item->image)
                                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                                alt="{{ $item->title }}" class="img-fluid"
                                                                style="width: 100px; height: 100px; object-fit: cover;">
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($item->time)->format('H:i') }}</td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>{{ $item->description }}</td>

                                                    <td class="d-flex gap-2">
                                                        <a href="{{ route('kegiatanpondok.edit', $item) }}"
                                                            class="btn btn-primary">Edit</a>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#alert-hapus-kategori{{ $item->id }}">
                                                            Delete
                                                        </button>

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
                                                                                action="{{ route('kegiatanpondok.destroy', $item->id) }}"
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
                                        {{ $data->links() }}
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
