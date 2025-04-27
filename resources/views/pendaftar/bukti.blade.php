<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .judul {
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .section {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div style="float:left; width:30%;">
            <img src="{{ public_path('logo_sekolah.png') }}" style="width:100px;">
        </div>
        <div style="float:right; width:60%; text-align:right;">
            SMPN <br>
            Panitia Penerimaan Peserta Didik Baru <br>
            Nomor Pendaftaran: {{ $pendaftar->no_pendaftaran }}
        </div>
    </div>

    <div style="clear:both;"></div>

    <div class="judul">TANDA BUKTI PENDAFTARAN</div>

    <div class="section">
        <strong>A. Calon Siswa</strong><br>
        Nama Lengkap: {{ $pendaftar->nama_lengkap }}<br>
        Alamat: {{ $pendaftar->alamat_lengkap }}<br>
        No. Handphone: {{ $pendaftar->no_wa }}<br>
        Jenis Kelamin: {{ $pendaftar->jenis_kelamin }}<br>
        Sekolah Asal: {{ $pendaftar->asal_sekolah }}
    </div>

    <div class="section">
        <strong>B. Orang Tua</strong><br>
        Nama Ayah: {{ $pendaftar->nama_ayah }}<br>
        Nama Ibu: {{ $pendaftar->nama_ibu }}<br>
        Alamat: {{ $pendaftar->alamat_lengkap }}<br>
        No. Handphone: {{ $pendaftar->no_wa }}
    </div>

</body>

</html>
