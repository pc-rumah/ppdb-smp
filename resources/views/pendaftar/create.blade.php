@extends('layouts.ppdbpart.layout')

@section('content')
    <form action="{{ route('ppdb.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Data Diri -->
        <div class="form-section">
            <h2 class="text-xl font-semibold mb-4">Data Diri</h2>

            <div class="form-group">
                <label for="nama_lengkap" class="label required">Nama Lengkap</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                    class="input input-bordered w-full" required>
            </div>

            {{-- jenis kelamin --}}
            <div class="form-group">
                <label class="label required">Jenis Kelamin</label>
                <div class="flex gap-4">
                    {{-- <label class="label cursor-pointer">
                        <input type="radio" name="jenis_kelamin" value="Laki-laki" class="radio radio-primary" required
                            {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}>
                        <span class="label-text ml-2">Laki-laki</span>
                    </label> --}}
                    <label class="label cursor-pointer">
                        <input type="radio" name="jenis_kelamin" value="Perempuan" class="radio radio-primary" required
                            {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                        <span class="label-text ml-2">Perempuan</span>
                    </label>
                </div>
            </div>

            {{-- jenis pendaftaran --}}
            <div class="form-group">
                <label for="jenis_pendaftaran" class="label required">Jenis Pendaftaran</label>
                <select id="jenis_pendaftaran" name="jenis_pendaftaran" class="select select-bordered w-full" required>
                    <option value="" disabled {{ old('jenis_pendaftaran') ? '' : 'selected' }}>Pilih jenis pendaftaran
                    </option>
                    <option value="online" {{ old('jenis_pendaftaran') == 'online' ? 'selected' : '' }}>Online</option>
                    <option value="offline" {{ old('jenis_pendaftaran') == 'offline' ? 'selected' : '' }}>Offline</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tempat_lahir" class="label required">Tempat Lahir</label>
                <input type="text" value="{{ old('tempat_lahir') }}" id="tempat_lahir" name="tempat_lahir"
                    class="input input-bordered w-full" required>
            </div>

            <div class="form-group">
                <label for="tanggal_lahir" class="label required">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="input input-bordered w-full"
                    value="{{ old('tanggal_lahir') }}" required>
            </div>

            <div class="form-group">
                <label class="label">Foto Pendaftar</label>
                <input type="file" id="foto" name="foto" class="file-input file-input-bordered w-full"
                    accept=".jpg,.jpeg,.png,.pdf">
            </div>
        </div>

        <!-- Alamat -->
        <fieldset>
            <legend>Alamat</legend>
            <div class="address-grid">
                {{-- PROVINSI --}}
                <div class="form-group">
                    <label for="provinsi" class="label required">Provinsi</label>
                    <select id="provinsi" class="input input-bordered w-full" required></select>
                    <input type="hidden" id="provinsi_id" name="provinsi_id" value="{{ old('provinsi_id') }}">
                    <input type="hidden" id="provinsi_text" name="provinsi" value="{{ old('provinsi') }}">
                    @error('provinsi_id')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                {{-- KABUPATEN/KOTA --}}
                <div class="form-group">
                    <label for="kabupaten" class="label required">Kabupaten/Kota</label>
                    <select id="kabupaten" class="input input-bordered w-full" required disabled></select>
                    <input type="hidden" id="kabupaten_id" name="kabupaten_id" value="{{ old('kabupaten_id') }}">
                    <input type="hidden" id="kabupaten_text" name="kabupaten" value="{{ old('kabupaten') }}">
                    @error('kabupaten_id')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                {{-- KECAMATAN --}}
                <div class="form-group">
                    <label for="kecamatan" class="label required">Kecamatan</label>
                    <select id="kecamatan" class="input input-bordered w-full" required disabled></select>
                    <input type="hidden" id="kecamatan_id" name="kecamatan_id" value="{{ old('kecamatan_id') }}">
                    <input type="hidden" id="kecamatan_text" name="kecamatan" value="{{ old('kecamatan') }}">
                    @error('kecamatan_id')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                {{-- DESA/KELURAHAN --}}
                <div class="form-group">
                    <label for="desa" class="label required">Desa/Kelurahan</label>
                    <select id="desa" class="input input-bordered w-full" required disabled></select>
                    <input type="hidden" id="desa_id" name="desa_id" value="{{ old('desa_id') }}">
                    <input type="hidden" id="desa_text" name="desa" value="{{ old('desa') }}">
                    @error('desa_id')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dusun" class="label">Dusun</label>
                    <input value="{{ old('dusun') }}" type="text" id="dusun" name="dusun"
                        class="input input-bordered w-full">
                </div>

                <div class="form-group">
                    <label for="rw" class="label">RW</label>
                    <input value="{{ old('rw') }}" type="text" id="rw" name="rw"
                        class="input input-bordered w-full">
                </div>

                <div class="form-group">
                    <label for="rt" class="label">RT</label>
                    <input value="{{ old('rt') }}" type="text" id="rt" name="rt"
                        class="input input-bordered w-full">
                </div>
            </div>
        </fieldset>

        <!-- Data Orang Tua -->
        <div class="form-section">
            <h2 class="text-xl font-semibold mb-4">Data Orang Tua</h2>

            <div class="form-group">
                <label for="nama_ayah" class="label required">Nama Ayah</label>
                <input value="{{ old('nama_ayah') }}" type="text" id="nama_ayah" name="nama_ayah"
                    class="input input-bordered w-full" required>
            </div>

            <div class="form-group">
                <label for="nama_ibu" class="label required">Nama Ibu</label>
                <input value="{{ old('nama_ibu') }}" type="text" id="nama_ibu" name="nama_ibu"
                    class="input input-bordered w-full" required>
            </div>
        </div>

        <!-- Kontak dan Informasi Tambahan -->
        <div class="form-section">
            <h2 class="text-xl font-semibold mb-4">Kontak dan Informasi Tambahan</h2>

            <div class="form-group">
                <label for="no_wa" class="label required">Nomor WhatsApp</label>
                <input value="{{ old('no_wa') }}" type="tel" id="no_wa" name="no_wa"
                    class="input input-bordered w-full" required>
            </div>

            <div class="form-group">
                <label for="email" class="label required">Email</label>
                <input value="{{ old('email') }}" type="email" id="email" name="email"
                    class="input input-bordered w-full" required>
            </div>

            <div class="form-group">
                <label for="asal_sekolah" class="label required">Asal Sekolah</label>
                <input value="{{ old('asal_sekolah') }}" type="text" id="asal_sekolah" name="asal_sekolah"
                    class="input input-bordered w-full" required>
            </div>

            <div class="form-group" id="form-piagam">
                <label for="piagam" class="label">Upload Piagam (Bila Ada)</label>
                <input type="file" id="piagam" name="piagam" class="file-input file-input-bordered w-full"
                    accept="image/*,application/pdf">
                <p class="text-xs mt-1">Format: JPG, PNG, atau PDF. Maksimal 2MB.</p>
            </div>

            <div class="form-group hidden" id="form-grouppembayaran">
                <label for="bukti_pembayaran" class="label required">Bukti Pembayaran</label>
                <input type="file" id="bukti_pembayaran" name="bukti_pembayaran"
                    class="file-input file-input-bordered w-full" accept="image/*,application/pdf" required>
                <p class="text-xs mt-1">Format: JPG, PNG, atau PDF. Maksimal 2MB.</p>

                <div id="file-preview" class="file-preview">
                    <div id="preview-content"></div>
                    <div class="file-info">
                        <div>
                            <p id="file-name" class="font-medium"></p>
                            <p id="file-size" class="text-sm text-gray-500"></p>
                        </div>
                        <button type="button" id="remove-file" class="btn btn-sm btn-error">Hapus</button>
                    </div>
                </div>
            </div>

            <!-- GROUP BERKAS -->
            <div class="form-group hidden" id="form-groupberkas">
                <label class="label">Upload Berkas</label>

                <label class="label">Kartu Keluarga (KK)</label>
                <input type="file" id="berkas_kk" name="kk" class="file-input file-input-bordered w-full"
                    accept=".jpg,.jpeg,.png,.pdf">

                <label class="label">Akte Kelahiran</label>
                <input type="file" id="berkas_akte" name="akte" class="file-input file-input-bordered w-full"
                    accept=".jpg,.jpeg,.png,.pdf">

                <label class="label">KTP Orang Tua</label>
                <input type="file" id="berkas_ktp" name="ktp" class="file-input file-input-bordered w-full"
                    accept=".jpg,.jpeg,.png,.pdf">

                <label class="label">Rapot Kelas 6 Semester 2</label>
                <input type="file" id="berkas_rapot" name="rapot" class="file-input file-input-bordered w-full"
                    accept=".jpg,.jpeg,.png,.pdf">
            </div>

            <div class="form-group">
                <label for="riwayat_penyakit" class="label">Riwayat Penyakit</label>
                <select name="riwayat_penyakit[]" id="riwayat_penyakit" multiple class="form-control tom-select">
                    @foreach ($riwayatPenyakitList as $penyakit)
                        <option value="{{ $penyakit->id }}">{{ $penyakit->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="riwayat_saudara" class="label">Saudara</label>
                <select id="riwayat_saudara" name="riwayat_saudara" class="select select-bordered w-full">
                    <option disabled {{ old('riwayat_saudara') ? '' : 'selected' }}>Pilih</option>
                    @foreach ($saudara as $item)
                        <option value="{{ $item->id }}" {{ old('riwayat_saudara') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="penanggung_jawab" class="label required">Penanggung Jawab</label>
                <input value="{{ old('penanggung_jawab') }}" type="text" id="penanggung_jawab"
                    name="penanggung_jawab" class="input input-bordered w-full" required>
            </div>
        </div>

        <div class="form-group mt-8 text-center">
            <button type="submit" class="btn btn-primary btn-wide">Daftar</button>
        </div>
    </form>
    </div>
@endsection
