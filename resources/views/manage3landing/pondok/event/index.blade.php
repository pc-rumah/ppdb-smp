@extends('dashboard')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h4>Kelola Data Acara Mendatang (Pondok)</h4>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Data Event</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card  bg-info bg-gradient">
                    <div class="card-body pt-3">
                        <div class="row">
                            <div class="col-lg-8">
                                <a href="{{ route('eventpondok.create') }}" type="button" class="btn btn-light">Tambah
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
                                                <th scope="col">Judul</th>
                                                <th scope="col">Lokasi</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Waktu Mulai</th>
                                                <th scope="col">Waktu Selesai</th>
                                                <th scope="col">Deskripsi</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($data as $item)
                                                <tr>
                                                    <th scope="row">{{ $data->firstItem() + $loop->index }}</th>
                                                    <td>{{ $item->judul }}</td>
                                                    <td>{{ $item->lokasi }}</td>
                                                    <td>{{ $item->tanggal }}</td>
                                                    <td>{{ $item->waktu_mulai }}</td>
                                                    <td>{{ $item->waktu_selesai }}</td>
                                                    <td>{{ $item->deskripsi }}</td>
                                                    <td>{{ $item->status }}</td>
                                                    <td class="d-flex gap-2">
                                                        @if (Auth::user()->hasRole('master-admin'))
                                                            @if ($item->status == 'pending')
                                                                <form action="{{ route('eventpondok.approve', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-sm">Approve</button>
                                                                </form>
                                                                <form action="{{ route('eventpondok.reject', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Reject</button>
                                                                </form>
                                                            @else
                                                                <form
                                                                    action="{{ route('eventpondok.approveDelete', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-sm">Approve</button>
                                                                </form>
                                                                <form
                                                                    action="{{ route('eventpondok.rejectDelete', $item->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm">Reject</button>
                                                                </form>
                                                            @endif
                                                        @else
                                                            <a href="{{ route('eventpondok.edit', $item) }}"
                                                                class="btn btn-primary {{ in_array($item->status, ['pending', 'pending-delete']) ? 'disabled' : '' }}">Edit</a>
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                                                data-action="{{ route('eventpondok.destroy', $item->id) }}"
                                                                data-title="Hapus Event"
                                                                data-body="Apakah Anda yakin ingin menghapus data ini?"
                                                                {{ in_array($item->status, ['pending', 'pending-delete']) ? 'disabled' : '' }}>
                                                                Delete
                                                            </button>
                                                        @endif

                                                        <!-- Modal delete foto -->
                                                        @include('modal')
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
