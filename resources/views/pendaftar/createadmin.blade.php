@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">MANAGE PPDB</h5>
            @include('layouts.semuaalert')
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('pendaftar.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap"
                                value="{{ old('nama_lengkap') }}" required>
                        </div>

                        {{-- jenis kelamin --}}
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_laki"
                                    value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="laki_laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                    value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>

                        {{-- jenis pendaftaran --}}
                        <div class="mb-3">
                            <label for="jenis_pendaftaran" class="form-label">Pendaftaran</label>
                            <select name="jenis_pendaftaran" class="form-control" id="jenis_pendaftaran" required>
                                <option value="online" {{ old('jenis_pendaftaran') == 'online' ? 'selected' : '' }}>Online
                                </option>
                                <option value="offline" {{ old('jenis_pendaftaran') == 'offline' ? 'selected' : '' }}>
                                    Offline</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                                value="{{ old('tempat_lahir') }}">
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir"
                                value="{{ old('tanggal_lahir') }}">
                        </div>

                        {{-- alamat --}}
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>

                            {{-- Provinsi --}}
                            <select id="provinsi" class="form-control mb-2">
                                <option value="">Pilih Provinsi</option>
                            </select>
                            <input type="hidden" id="provinsi_id" name="provinsi_id" value="{{ old('provinsi_id') }}">
                            <input type="hidden" id="provinsi_text" name="provinsi" value="{{ old('provinsi') }}">

                            {{-- Kabupaten --}}
                            <select id="kabupaten" class="form-control mb-2" disabled>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                            <input type="hidden" id="kabupaten_id" name="kabupaten_id" value="{{ old('kabupaten_id') }}">
                            <input type="hidden" id="kabupaten_text" name="kabupaten" value="{{ old('kabupaten_kota') }}">

                            {{-- Kecamatan --}}
                            <select id="kecamatan" class="form-control mb-2" disabled>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            <input type="hidden" id="kecamatan_id" name="kecamatan_id" value="{{ old('kecamatan_id') }}">
                            <input type="hidden" id="kecamatan_text" name="kecamatan" value="{{ old('kecamatan') }}">

                            {{-- Desa --}}
                            <select id="desa" class="form-control mb-2" disabled>
                                <option value="">Pilih Desa/Kelurahan</option>
                            </select>
                            <input type="hidden" id="desa_id" name="desa_id" value="{{ old('desa_id') }}">
                            <input type="hidden" id="desa_text" name="desa" value="{{ old('desa_kelurahan') }}">

                            {{-- Dusun --}}
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
                        </div>

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

                        <div class="mb-3">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" class="form-control" id="asal_sekolah"
                                value="{{ old('asal_sekolah') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Pendaftar</label>
                            <input type="file" name="foto" class="form-control" accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kartu Keluarga (KK)</label>
                            <input type="file" name="kk" class="form-control" accept="image/*,application/pdf">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Akte Kelahiran</label>
                            <input type="file" name="akte" class="form-control" accept="image/*,application/pdf">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">KTP Orang Tua</label>
                            <input type="file" name="ktp" class="form-control" accept="image/*,application/pdf">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Raport</label>
                            <input type="file" name="rapot" class="form-control" accept="image/*,application/pdf">
                        </div>

                        <div class="mb-3">
                            <label for="piagam" class="form-label">Piagam Penghargaan (Opsional)</label>
                            <input type="file" name="piagam" class="form-control" accept="image/*,application/pdf">
                        </div>

                        <div class="mb-3 d-none" id="bukti_pembayaran_group">
                            <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran" class="form-control" id="bukti_pembayaran"
                                accept="image/*,application/pdf">
                        </div>

                        <div class="mb-3">
                            <label for="penyakit" class="form-label">Riwayat Penyakit</label>
                            <select id="penyakit" name="riwayat_penyakit[]" multiple placeholder="Pilih penyakit...">
                                @foreach ($riwayatPenyakitList as $penyakit)
                                    <option value="{{ $penyakit->id }}">{{ $penyakit->nama }}</option>
                                @endforeach
                            </select>

                            <div class="mb-3">
                                <label for="riwayat_saudara" class="form-label">Saudara</label>
                                <select name="riwayat_saudara" class="form-control" id="riwayat_saudara">
                                    <option selected>Pilih</option>
                                    @foreach ($saudara as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                                <input type="text" name="penanggung_jawab" class="form-control" id="penanggung_jawab"
                                    value="{{ old('penanggung_jawab') }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
