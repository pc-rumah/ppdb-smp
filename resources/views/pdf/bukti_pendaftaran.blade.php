<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .kop {
            text-align: center;
            margin-top: 30px;
        }

        .logo-kiri,
        .logo-kanan {
            width: 80px;
            height: auto;
        }

        .table-identitas {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-identitas th {
            background-color: #000;
            color: #fff;
            padding: 5px;
            text-align: left;
        }

        .table-identitas td {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
        }

        .header-table {
            width: 100%;
        }

        .header-table td {
            text-align: center;
            vertical-align: top;
        }

        .footer {
            margin-top: 30px;
        }

        .qr-image {
            margin-top: 10px;
            display: flex;
            align-items: right;
            justify-content: right;
        }

        .signature-table {
            width: 100%;
            margin-top: 30px;
        }

        .signature-table td {
            width: 50%;
            vertical-align: top;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <table class="header-table">
            <tr>
                <td style="width: 20%;">
                    @if ($logo_kiri)
                        <img src="{{ $logo_kiri }}" style="width: 100px;" alt="Logo Kiri">
                    @endif
                </td>
                <td style="width: 60%;">
                    <div class="kop">
                        <strong>PONDOK PESANTREN AL MAS'UDIYYAH PUTRI update<br>
                            02 SMP AL MAS'UDIYYAH BANDUNGAN</strong><br>
                        <em>Alamat: Dsn. Blater, Desa Jimbaran, Kec. Bandungan, Kab. Semarang 50661<br>
                            Telp. (0298) 6072011 Email : smpblater01@gmail.com</em>
                    </div>
                </td>
                <td style="width: 20%;">
                    @if ($logo_kanan)
                        <img src="{{ $logo_kanan }}" style="width: 100px;" alt="Logo Kanan">
                    @endif
                </td>
            </tr>
        </table>

        <!-- Main Content -->
        <div class="content">
            <div class="main-title">
                <hr style="border: 5px black solid;">
                <h2 style="text-align: center;">FORMULIR BUKTI PENDAFTARAN SANTRI BARU</h2>
                <p style="text-align: center;">Tahun Ajaran {{ $tahun_ajar }}</p>
            </div>

            <!-- Identity Table -->
            <table class="table-identitas">
                <thead>
                    <tr>
                        <th colspan="2">IDENTITAS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nomor Pendaftaran</td>
                        <td>{{ $pendaftar->no_pendaftaran }}</td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>{{ $pendaftar->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td>Tempat, Tanggal Lahir</td>
                        <td>{{ $pendaftar->tempat_lahir }},
                            {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Lengkap</td>
                        <td>
                            {{ $pendaftar->dusun }} RT {{ $pendaftar->rt }} RW {{ $pendaftar->rw }},
                            {{ $pendaftar->kecamatan }}, {{ $pendaftar->kabupaten_kota }},
                            {{ $pendaftar->provinsi }}
                        </td>
                    </tr>
                    <tr>
                        <td>Asal Sekolah</td>
                        <td>{{ $pendaftar->asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <td>Nomor HP (WA)</td>
                        <td>{{ $pendaftar->no_wa }}</td>
                    </tr>
                    <tr>
                        <td>Nama Ayah</td>
                        <td>{{ $pendaftar->nama_ayah }}</td>
                    </tr>
                    <tr>
                        <td>Nama Ibu</td>
                        <td>{{ $pendaftar->nama_ibu }}</td>
                    </tr>
                </tbody>
            </table>

            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px;">
                <table class="data-table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th colspan="4">ADMINISTRASI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2" class="indent">1. Biaya Pendaftaran</td>
                            <td>:</td>
                            <td>{{ $pendaftar->administrasi_lunas == 1 ? 'Lunas' : 'Menunggu Verifikasi' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="indent">2. FC. Kartu Keluarga</td>
                            <td>:</td>
                            <td>{{ $pendaftar->kk == 1 ? 'Ada' : 'Tidak Ada' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="indent">3. FC. Akta Kelahiran</td>
                            <td>:</td>
                            <td>{{ $pendaftar->akte == 1 ? 'Ada' : 'Tidak Ada' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="indent">4. FC. Raport kelas 6 smt. 1</td>
                            <td>:</td>
                            <td>{{ $pendaftar->rapot == 1 ? 'Ada' : 'Tidak Ada' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="indent">5. FC. Piagam *<em>jika ada</em></td>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="indent">6. Kartu/Keterangan NISN</td>
                            <td>:</td>
                            <td>undefined</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="notes">
                <p><strong>Keterangan :</strong></p>
                <p>1. Bukti ini WAJIB dibawa ketika DAFTAR ULANG</p>
                <p>2. Contact person : {{ $nama_kontak_1 }} ({{ $nomor_kontak_1 }}) atau {{ $nama_kontak_1 }}
                    ({{ $nomor_kontak_2 }})</p>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>Bandungan, {{ $pendaftar->created_at->format('d/m/Y H:i:s') }}</p>
                <table class="signature-table">
                    <tr>
                        <td>
                            <p style="text-align: center;">Orang Tua/Wali</p>
                            <br>
                            <br>
                            <br>
                            <br>
                            <p style="text-align: center">{{ $pendaftar->penanggung_jawab }}</p>
                        </td>
                        <td style="text-align: center;">
                            <p style="text-align: center;">Ketua Panitia PSB,</p>
                            <div class="qr-image">
                                @if ($tanda_tangan)
                                    <img src="{{ $tanda_tangan }}" style="width: 100px;" alt="TTD">
                                @endif
                            </div>
                            <p style="text-align: center;"> {{ $ketua_panitia }} </p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
