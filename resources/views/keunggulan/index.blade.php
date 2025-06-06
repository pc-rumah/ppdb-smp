@extends('dashboard')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h4>Kelola Data Keunggulan</h4>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Data Keunggulan</li>
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
                                <a href="{{ route('keunggulan.create') }}" type="button" class="btn btn-light">Tambah
                                    Data</a>
                            </div>
                            @include('layouts.allerror')
                        </div>
                        <hr class="hr">
                        <div class="card">
                            <div class="card-body">
                                <!-- Default Table -->
                                <div class="table-reponsive">
                                    <table class="table">
                                        <form method="GET" action="{{ route('keunggulan.index') }}" class="mb-4">
                                            <div class="flex gap-2 items-center">
                                                <label for="unitFilter" class="form-label">Filter Unit:</label>
                                                <select name="unit" id="unitFilter" class="form-select w-auto"
                                                    onchange="this.form.submit()">
                                                    <option value="">Semua</option>
                                                    @foreach ($unit as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ request('unit') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->judul }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>
                                        <br>
                                        <thead>
                                            <tr class="bg-info bg-gradient bg-opacity-75 text-dark">
                                                <th scope="col">#</th>
                                                <th scope="col">Nama Unit</th>
                                                <th scope="col">Keunggulan</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($keunggulan as $item)
                                                <tr>
                                                    <th scope="row">
                                                        {{ $keunggulan->firstItem() + $loop->index }}
                                                    </th>
                                                    <td>{{ $item->unit->judul }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td class="d-flex gap-2">
                                                        <a href="{{ route('keunggulan.edit', $item) }}"
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
                                                                                action="{{ route('keunggulan.destroy', $item->id) }}"
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
                                        {{ $keunggulan->links() }}
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
