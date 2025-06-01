<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Arial Narrow', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        /* Header Styles */
        .header {
            display: table;
            width: 100%;
        }

        .logo {
            width: 100px;
        }

        .logo img {
            width: 77px;
            height: 85px;
            object-fit: contain;
        }

        .logo,
        .title {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .title h1 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .title p {
            font-size: 12px;
            margin: 3px 0;
        }

        .title .italic {
            font-style: italic;
        }

        /* Main Content */
        .content {
            padding: 20px;
        }

        .main-title {
            text-align: center;
            margin-bottom: 10px;
        }

        .main-title h2 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Tables */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .data-table th {
            background-color: #000;
            color: white;
            font-weight: bold;
        }

        .data-table tr td:first-child {
            width: 40%;
        }

        .data-table tr td:nth-child(2) {
            width: 5%;
            text-align: center;
        }

        .data-table tr td:last-child {
            width: 55%;
        }

        .indent {
            padding-left: 20px !important;
        }

        /* QR and Notes */
        .qr-section {
            display: table;
            width: 100%;
            margin-top: 30px;
        }

        .qr-code,
        .notes {
            display: table-cell;
            vertical-align: top;
            padding: 10px;
        }

        .qr-code img {
            width: 200px;
            height: 200px;
        }

        .notes p {
            margin-bottom: 8px;
        }

        .notes p:first-child {
            font-weight: bold;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            text-align: right;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .signature {
            text-align: center;
        }

        .signature p:last-child {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <img src="{{ public_path('suratbukti/Image_001.png') }}" alt="Logo Pesantren"
                    style="width: 77px; height: 85px;">
            </div>
            <div class="title">
                <h1>PONDOK PESANTREN AL MAS'UDIYYAH PUTRI 02 SMP AL MAS'UDIYYAH BANDUNGAN</h1>
                <p class="italic">Alamat : Dsn. Blater, Desa Jimbaran, Kec. Bandungan, Kab. Semarang 50661</p>
                <p>Telp. (0298) 6072011 Email : smpblater01@gmail.com</p>
            </div>
            <div class="logo">
                <img src="{{ public_path('suratbukti/Image_002.jpg') }}" alt="Logo Pesantren"
                    style="width: 77px; height: 85px;">
            </div>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="main-title">
                <h2>FORMULIR BUKTI PENDAFTARAN SANTRI BARU</h2>
                <p>Tahun Ajaran 2025 / 2026</p>
            </div>

            <!-- Identity Table -->
            <table class="data-table">
                <thead>
                    <tr>
                        <th colspan="4">IDENTITAS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">Nomor Pendaftaran</td>
                        <td>:</td>
                        <td>{{ $pendaftar->no_pendaftaran }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Nama Lengkap</td>
                        <td>:</td>
                        <td>{{ $pendaftar->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Tempat, Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{ $pendaftar->tempat_lahir }},
                            {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Alamat Lengkap</td>
                        <td>:</td>
                        <td>{{ $pendaftar->dusun }} RT {{ $pendaftar->rt }} RW {{ $pendaftar->rw }}
                            {{ $pendaftar->kecamatan }} {{ $pendaftar->kabupaten_kota }}
                            {{ $pendaftar->provinsi }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Asal Sekolah</td>
                        <td>:</td>
                        <td>{{ $pendaftar->asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Nomor HP (WA)</td>
                        <td>:</td>
                        <td>{{ $pendaftar->no_wa }}</td>
                    </tr>
                    <tr>
                        <td>Nama Ayah :</td>
                        <td>{{ $pendaftar->nama_ayah }}</td>
                        <td>Nama Ibu :</td>
                        <td>{{ $pendaftar->nama_ibu }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Administration Table -->
            <table class="data-table">
                <thead>
                    <tr>
                        <th colspan="4">ADMINISTRASI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" class="indent">1. Biaya Pendaftaran</td>
                        <td>:</td>
                        <td>
                            {{-- {{ dd($pendaftar->administrasi_lunas) }} --}}

                            {{ $pendaftar->administrasi_lunas == 1 ? 'Lunas' : 'Menunggu Verifikasi' }}
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2" class="indent">2. FC. Kartu Keluarga</td>
                        <td>:</td>
                        <td>{{ $pendaftar->kk }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="indent">3. FC. Akta Kelahiran</td>
                        <td>:</td>
                        <td>{{ $pendaftar->akte }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="indent">4. FC. Raport kelas 6 smt. 1</td>
                        <td>:</td>
                        <td>{{ $pendaftar->rapot }}</td>
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

            <!-- QR Code and Notes -->
            <div class="qr-section">
                <div class="qr-code">
                    <img src="{{ public_path('suratbukti/Image_003.png') }}" alt="QR Code">
                </div>
                <div class="notes">
                    <p>Keterangan :</p>
                    <p>1. Bukti ini WAJIB dibawa ketika DAFTAR ULANG</p>
                    <p>2. Contact person : Ust. Achmad Faiyun (0896 7644 0222) atau Ust. Tesa Melasari (0831 0208 4108)
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>Bandungan, {{ $pendaftar->created_at->format('d/m/Y H:i:s') }}</p>
                <div class="signatures">
                    <div class="signature">
                        <p>Orang Tua/Wali</p>
                        <p>DUROTUL BADI'AH S.Pd</p>
                    </div>
                    <div class="signature">
                        <p>Ketua Panitia PSB,</p>
                        <p>Achmad Faizun, S.Pd.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
