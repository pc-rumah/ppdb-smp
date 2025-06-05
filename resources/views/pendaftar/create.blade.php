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

            <div class="form-group">
                <label class="label required">Jenis Kelamin</label>
                <div class="flex gap-4">
                    <label class="label cursor-pointer">
                        <input type="radio" name="jenis_kelamin" value="Laki-laki" class="radio radio-primary" required
                            {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}>
                        <span class="label-text ml-2">Laki-laki</span>
                    </label>
                    <label class="label cursor-pointer">
                        <input type="radio" name="jenis_kelamin" value="Perempuan" class="radio radio-primary" required
                            {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}>
                        <span class="label-text ml-2">Perempuan</span>
                    </label>
                </div>
            </div>

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
        </div>

        <!-- Alamat -->
        <fieldset>
            <legend>Alamat</legend>
            <div class="address-grid">
                <div class="form-group">
                    <label for="dusun" class="label">Dusun</label>
                    <input value="{{ old('dusun') }}" type="text" id="dusun" name="dusun"
                        class="input input-bordered w-full">
                </div>

                <div class="form-group">
                    <label for="rt" class="label">RT</label>
                    <input value="{{ old('rt') }}" type="text" id="rt" name="rt"
                        class="input input-bordered w-full">
                </div>

                <div class="form-group">
                    <label for="rw" class="label">RW</label>
                    <input value="{{ old('rw') }}" type="text" id="rw" name="rw"
                        class="input input-bordered w-full">
                </div>

                <div class="form-group">
                    <label for="desa" class="label required">Desa/Kelurahan</label>
                    <input value="{{ old('desa') }}" type="text" id="desa" name="desa"
                        class="input input-bordered w-full" required>
                </div>

                <div class="form-group">
                    <label for="kecamatan" class="label required">Kecamatan</label>
                    <input value="{{ old('kecamatan') }}" type="text" id="kecamatan" name="kecamatan"
                        class="input input-bordered w-full" required>
                </div>

                <div class="form-group">
                    <label for="kabupaten" class="label required">Kabupaten/Kota</label>
                    <input value="{{ old('kabupaten') }}" type="text" id="kabupaten" name="kabupaten"
                        class="input input-bordered w-full" required>
                </div>

                <div class="form-group">
                    <label for="provinsi" class="label required">Provinsi</label>
                    <input value="{{ old('provinsi') }}" type="text" id="provinsi" name="provinsi"
                        class="input input-bordered w-full" required>
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

            <div class="form-group">
                <label class="label ">Berkas yang dilampirkan (checklist yang sudah ada)</label>
                <div class="flex flex-col gap-2">
                    <label class="label cursor-pointer">
                        <input type="checkbox" name="berkas[]" value="KK" class="checkbox checkbox-primary">
                        <span class="label-text ml-2">Kartu Keluarga (KK)</span>
                    </label>
                    <label class="label cursor-pointer">
                        <input type="checkbox" name="berkas[]" value="Akte" class="checkbox checkbox-primary">
                        <span class="label-text ml-2">Akte Kelahiran</span>
                    </label>
                    <label class="label cursor-pointer">
                        <input type="checkbox" name="berkas[]" value="KTP" class="checkbox checkbox-primary">
                        <span class="label-text ml-2">KTP Orang Tua</span>
                    </label>
                    <label class="label cursor-pointer">
                        <input type="checkbox" name="berkas[]" value="Rapot" class="checkbox checkbox-primary">
                        <span class="label-text ml-2">Rapot Kelas 6 Semester 2</span>
                    </label>
                </div>
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
