@extends('dashboard')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h4>Kelola Data Pengumuman SMP</h4>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Data Pengumuman SMP</li>
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
                                <a href="{{ route('pengumumansmp.create') }}" type="button" class="btn btn-light">Tambah
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
                                                <th scope="col">Judul</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Deskripsi</th>
                                                <th scope="col">Gambar</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pengumumansmp as $item)
                                                <tr>
                                                    <th scope="row">{{ $pengumumansmp->firstItem() + $loop->index }}</th>
                                                    <td>{{ $item->judul }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                                                    <td>{{ $item->deskripsi }}</td>
                                                    <td>
                                                        @if ($item->gambar)
                                                            <div class="mt-2">
                                                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                                                    alt="Gambar"
                                                                    style="width: 100px; height: auto; border-radius: 4px;">
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td class="d-flex gap-2">
                                                        <a href="{{ route('pengumumansmp.edit', $item) }}"
                                                            class="btn btn-primary">Edit</a>
                                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#alert-hapus-kategori{{ $item->id }}">
                                                            Delete
                                                        </button>
                                                        <!-- Modal delete foto -->
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
                                                                                action="{{ route('pengumumansmp.destroy', $item->id) }}"
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
                                        {{ $pengumumansmp->links() }}
                                    </table>
                                </div>
                                <!-- End Default Table Example -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
