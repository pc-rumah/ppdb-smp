@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <main id="main" class="main">
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
                                <div class="card">
                                    <div class="card-body pt-3">
                                        <!-- Bordered Tabs -->
                                        <div class="col-lg-8">
                                            <a href="{{ route('pendaftar.create') }}" type="button"
                                                class="btn btn-primary">Tambah
                                                Data</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                @if (Session::has('success'))
                                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                                @endif
                                            </div>
                                            <div class="col-lg-4">
                                                @if ($errors->any())
                                                    <div class="div div-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                @if (session('error'))
                                                    <div class="div div-danger" role="alert">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <hr class="hr">
                                        <div class="card">
                                            <div class="card-body">
                                                <!-- Default Table -->
                                                <table class="table">
                                                    <thead>
                                                        <tr class="bg-info bg-gradient bg-opacity-75 text-dark">
                                                            <th scope="col">#</th>
                                                            <th scope="col">No. Pendaftaran</th>
                                                            <th scope="col">Nama Lengkap</th>
                                                            <th scope="col">Jenis Pendaftaran</th>
                                                            <th scope="col">Asal Sekolah</th>
                                                            <th scope="col">No. WA</th>
                                                            <th scope="col">Administrasi</th>
                                                            <th scope="col">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($pendaftar as $item)
                                                            <tr>
                                                                <th scope="row">{{ $loop->iteration }}</th>
                                                                <td>{{ $item->no_pendaftaran }}</td>
                                                                <td>{{ $item->nama_lengkap }}</td>
                                                                <td>{{ ucfirst($item->jenis_pendaftaran) }}</td>
                                                                <td>{{ $item->asal_sekolah }}</td>
                                                                <td>{{ $item->no_wa }}</td>
                                                                <td>
                                                                    <span
                                                                        class="badge {{ $item->administrasi_lunas ? 'bg-success' : 'bg-danger' }}">
                                                                        {{ $item->administrasi_lunas ? 'Lunas' : 'Belum' }}
                                                                    </span>
                                                                </td>
                                                                <td class="d-flex gap-2">
                                                                    <a href="{{ route('pendaftar.edit', $item) }}"
                                                                        class="btn btn-primary btn-sm">Edit</a>
                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#alert-hapus-kategori{{ $item->id }}">
                                                                        Delete
                                                                    </button>

                                                                    {{-- Modal Konfirmasi Hapus --}}
                                                                    <div class="modal fade"
                                                                        id="alert-hapus-kategori{{ $item->id }}"
                                                                        tabindex="-1"
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
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary"
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
                                                </table>
                                                <!-- End Default Table Example -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection
