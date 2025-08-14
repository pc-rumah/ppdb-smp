@extends('dashboard')

@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <main id="main" class="main">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Nama Lengkap</h5>
                                        <p>{{ $pendaftar->nama_lengkap }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Email</h5>
                                        <p>{{ $pendaftar->email }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Nomor Telepon</h5>
                                        <p>{{ $pendaftar->no_wa }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Jenis Pendaftaran</h5>
                                        <p>{{ $pendaftar->jenis_pendaftaran }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Alamat</h5>
                                        <p>{{ $pendaftar->provinsi }}, {{ $pendaftar->kabupaten_kota }},
                                            {{ $pendaftar->kecamatan }}, {{ $pendaftar->desa_kelurahan }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Jenis Kelamin</h5>
                                        <p>{{ $pendaftar->jenis_kelamin }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Tanggal Lahir</h5>
                                        <p>{{ $pendaftar->tanggal_lahir }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Asal Sekolah</h5>
                                        <p>{{ $pendaftar->asal_sekolah }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Foto Pendaftar</h5>
                                        <img src="{{ asset('storage/' . $pendaftar->foto) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Kartu Keluarga</h5>
                                        <p>{{ $pendaftar->asal_sekolah }}</p>
                                    </div>

                                    @php
                                        $dokumenList = [
                                            'bukti_pembayaran' => 'Bukti Pembayaran',
                                            'kk' => 'Kartu Keluarga',
                                            'akte' => 'Akta',
                                            'ktp' => 'KTP',
                                            'rapot' => 'Rapot',
                                        ];
                                    @endphp

                                    @foreach ($dokumenList as $field => $label)
                                        @if ($pendaftar->$field)
                                            <div class="col-md-12 mt-3">
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modal_{{ $field }}">
                                                    Lihat {{ $label }}
                                                </button>
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modal_{{ $field }}" tabindex="-1"
                                                aria-labelledby="modalLabel_{{ $field }}" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalLabel_{{ $field }}">
                                                                {{ $label }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            @php
                                                                $ext = pathinfo($pendaftar->$field, PATHINFO_EXTENSION);
                                                            @endphp

                                                            @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png']))
                                                                <img src="{{ asset('storage/' . $pendaftar->$field) }}"
                                                                    class="img-fluid" alt="{{ $label }}">
                                                            @elseif (strtolower($ext) === 'pdf')
                                                                <iframe src="{{ asset('storage/' . $pendaftar->$field) }}"
                                                                    frameborder="0" width="100%" height="600px"></iframe>
                                                            @else
                                                                <p>Tidak dapat menampilkan file.</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    @if ($pendaftar->administrasi_lunas)
                                        <div
                                            class="mt-3 p-3 border border-success rounded-3 bg-success bg-opacity-10 text-success">
                                            Administrasi: <strong>Lunas</strong>
                                        </div>
                                    @else
                                        <div
                                            class="mt-3 p-3 border border-warning rounded-3 bg-warning bg-opacity-10 text-warning">
                                            Administrasi: <strong>Belum Lunas</strong>
                                        </div>
                                    @endif

                                    <form action="{{ route('pendaftar.updateStatus', $pendaftar->id) }}" method="POST"
                                        class="mt-3">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="administrasi_lunas"
                                                id="lunas" value="1"
                                                {{ $pendaftar->administrasi_lunas == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="lunas">Lunas</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="administrasi_lunas"
                                                id="belum" value="0"
                                                {{ $pendaftar->administrasi_lunas == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="belum">Belum Lunas</label>
                                        </div>

                                        <button type="submit" class="btn btn-success btn-sm ms-2">Update
                                            Status</button>
                                    </form>
                                    <a href="{{ route('admin.download', $pendaftar->id) }}" class="btn btn-info mt-2">
                                        Download Bukti
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    @endsection
