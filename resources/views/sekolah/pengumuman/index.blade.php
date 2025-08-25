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
                                                <th scope="col">Status</th>
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
                                                    <td> {{ $item->status }} </td>
                                                    <td class="d-flex gap-2">
                                                        @if (Auth::user()->hasRole('master-admin'))
                                                            @if ($item->status == 'pending')
                                                                <form
                                                                    action="{{ route('pengumumansmp.approve', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-sm">Approve</button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('pengumumansmp.reject', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Reject</button>
                                                                </form>
                                                            @else
                                                                <form
                                                                    action="{{ route('pengumumansmp.approveDelete', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-sm">Approve</button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('pengumumansmp.rejectDelete', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Reject</button>
                                                                </form>
                                                            @endif
                                                        @else
                                                            <a href="{{ route('pengumumansmp.edit', $item) }}"
                                                                class="btn btn-primary {{ in_array($item->status, ['pending', 'pending-delete']) ? 'disabled' : '' }}">Edit</a>
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                                data-action="{{ route('pengumumansmp.destroy', $item->id) }}"
                                                                data-title="Hapus Pengumuman"
                                                                data-body="Apakah Anda yakin ingin menghapus data ini?"
                                                                {{ in_array($item->status, ['pending', 'pending-delete']) ? 'disabled' : '' }}>
                                                                Delete
                                                            </button>
                                                        @endif

                                                        <!-- Modal delete -->
                                                        @include('modal')
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
