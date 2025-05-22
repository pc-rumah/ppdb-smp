@extends('dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">MANAGE PPDB</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('pendaftar.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Nama Lengkap --}}
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap"
                                value="{{ old('nama_lengkap') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki"
                                    value="Laki-laki" required>
                                <label class="form-check-label" for="laki_laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                    value="Perempuan" required>
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>

                        {{-- Jenis Pendaftaran --}}
                        <div class="mb-3">
                            <label for="jenis_pendaftaran" class="form-label">Pendaftaran</label>
                            <select name="jenis_pendaftaran" class="form-control" id="jenis_pendaftaran" required>
                                <option value="online">Online</option>
                                <option value="offline">Offline</option>
                            </select>
                        </div>

                        {{-- Tempat & Tanggal Lahir --}}
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                                value="{{ old('tempat_lahir') }}">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir">
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="dusun" class="form-control mb-2" placeholder="Dusun"
                                value="{{ old('dusun') }}">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="rt" class="form-control" placeholder="RT"
                                        value="{{ old('rt') }}">
                                </div>
                                <div class="col">
                                    <input type="text" name="rw" class="form-control" placeholder="RW"
                                        value="{{ old('rw') }}">
                                </div>
                            </div>
                            <input type="text" name="desa" class="form-control mt-2" placeholder="Desa/Kelurahan"
                                value="{{ old('desa') }}">
                            <input type="text" name="kecamatan" class="form-control mt-2" placeholder="Kecamatan"
                                value="{{ old('kecamatan') }}">
                            <input type="text" name="kabupaten" class="form-control mt-2" placeholder="Kabupaten/Kota"
                                value="{{ old('kabupaten') }}">
                            <input type="text" name="provinsi" class="form-control mt-2" placeholder="Provinsi"
                                value="{{ old('provinsi') }}">
                        </div>

                        {{-- Nama Orang Tua --}}
                        <div class="mb-3">
                            <label for="nama_ayah" class="form-label">Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control" id="nama_ayah"
                                value="{{ old('nama_ayah') }}">
                        </div>
                        <div class="mb-3">
                            <label for="nama_ibu" class="form-label">Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control" id="nama_ibu"
                                value="{{ old('nama_ibu') }}">
                        </div>

                        {{-- Kontak --}}
                        <div class="mb-3">
                            <label for="no_wa" class="form-label">No. WA</label>
                            <input type="number" name="no_wa" class="form-control" id="no_wa"
                                value="{{ old('no_wa') }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                value="{{ old('email') }}">
                        </div>

                        {{-- Asal Sekolah --}}
                        <div class="mb-3">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="form-control" id="asal_sekolah"
                                value="{{ old('asal_sekolah') }}">
                        </div>

                        {{-- piagam --}}
                        <div class="mb-3" id="piagam">
                            <label for="piagam" class="form-label">Upload Piagam (Bila Ada)</label>
                            <input type="file" name="piagam" class="form-control" id="piagam"
                                accept="image/*,application/pdf">
                        </div>

                        {{-- Administrasi --}}
                        <div class="mb-3 d-none" id="bukti_pembayaran_group">
                            <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" class="form-control" id="bukti_pembayaran"
                                accept="image/*,application/pdf">
                        </div>

                        {{-- Riwayat Penyakit --}}
                        <div class="mb-3">
                            <label class="form-label">Riwayat Penyakit</label><br>
                            @foreach ($riwayatPenyakitList as $penyakit)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="riwayat_penyakit[]"
                                        value="{{ $penyakit->id }}" id="penyakit{{ $penyakit->id }}">
                                    <label class="form-check-label" for="penyakit{{ $penyakit->id }}">
                                        {{ $penyakit->nama }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        {{-- Riwayat Saudara --}}
                        <div class="mb-3">
                            <label for="riwayat_saudara" class="form-label">Saudara</label>
                            <select name="riwayat_saudara" class="form-control" id="riwayat_saudara">
                                <option selected>Pilih</option>
                                @foreach ($saudara as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Penanggung Jawab --}}
                        <div class="mb-3">
                            <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                            <input type="text" name="penanggung_jawab" class="form-control" id="penanggung_jawab"
                                value="{{ old('penanggung_jawab') }}">
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
