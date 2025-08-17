@extends('dashboard')

@section('content')
    <main id="main" class="main">
        <!-- Page Title -->
        <div class="pagetitle">
            <h4>Kelola Data PPDB</h4>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">PPDB</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card bg-info bg-gradient">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <div class="row">
                            <div class="col-8 col-lg-2 mb-2">
                                <a href="{{ route('pendaftar.create') }}" class="btn btn-light w-100">Tambah Data</a>
                            </div>
                            <div class="col-8 col-lg-2 mb-2">
                                <a href="/export-pendaftar" class="btn btn-success w-100">Export Excel</a>
                            </div>
                        </div>

                        <div class="row">
                            @include('layouts.allerror')
                        </div>
                        <hr class="hr">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('pendaftar.index') }}" method="GET" class="mb-3">
                                    <div class="input-group">
                                        <input type="text" name="search" value="{{ request('search') }}"
                                            class="form-control" placeholder="Cari nama lengkap...">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                        <a href="{{ route('pendaftar.index') }}" class="btn btn-secondary ms-2">Reset</a>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr class="bg-info bg-gradient bg-opacity-75 text-dark">
                                                <th scope="col">#</th>
                                                <th scope="col">Nama Lengkap</th>
                                                <th scope="col">Jenis Pendaftaran</th>
                                                <th scope="col">Asal Sekolah</th>
                                                <th scope="col">Status Pembayaran</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">No. WA</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pendaftar as $item)
                                                <tr>
                                                    <th scope="row">
                                                        {{ $pendaftar->firstItem() + $loop->index }}
                                                    </th>
                                                    <td>{{ $item->nama_lengkap }}</td>
                                                    <td>{{ ucfirst($item->jenis_pendaftaran) }}</td>
                                                    <td>{{ $item->asal_sekolah }}</td>
                                                    <td>
                                                        @if ($item->administrasi_lunas == '0')
                                                            Menunggu Verifikasi
                                                        @elseif ($item->administrasi_lunas == '1')
                                                            Lunas
                                                        @else
                                                            Belum Lunas
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->status }}</td>
                                                    <td>{{ $item->no_wa }}</td>
                                                    <td class="d-flex gap-2">
                                                        <a href="{{ route('pendaftar.show', $item) }}"
                                                            class="btn btn-primary btn-sm">Show</a>

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#alert-hapus-kategori{{ $item->id }}">
                                                            Delete
                                                        </button>

                                                        {{-- Modal Konfirmasi Hapus --}}
                                                        <div class="modal fade"
                                                            id="alert-hapus-kategori{{ $item->id }}" tabindex="-1"
                                                            aria-labelledby="confirmDeleteModal{{ $item->id }}Label"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="confirmDeleteModal{{ $item->id }}Label">
                                                                            Konfirmasi Hapus Data
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Apakah Anda yakin ingin menghapus data
                                                                        ini?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <form
                                                                            action="{{ route('pendaftar.destroy', $item->id) }}"
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
                                                        {{-- End Modal --}}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        {{ $pendaftar->links() }}
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
