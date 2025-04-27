<!DOCTYPE html>
<html>

<head>
    <title>Bukti Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .judul {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }

        .info {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="judul">TANDA BUKTI PENDAFTARAN</div>

    <div class="info">
        <strong>Nomor Pendaftaran:</strong> {{ $pendaftar->no_pendaftaran }}<br>
        <strong>Nama Lengkap:</strong> {{ $pendaftar->nama_lengkap }}<br>
        <strong>Alamat:</strong> {{ $pendaftar->desa }}, {{ $pendaftar->kecamatan }}<br>
        <strong>No. Handphone:</strong> {{ $pendaftar->no_wa }}<br>
        <strong>Asal Sekolah:</strong> {{ $pendaftar->asal_sekolah }}<br>
    </div>

    <div class="info" style="margin-top: 30px;">
        <strong>Nama Ayah:</strong> {{ $pendaftar->nama_ayah }}<br>
        <strong>Nama Ibu:</strong> {{ $pendaftar->nama_ibu }}<br>
    </div>
</body>

</html>
