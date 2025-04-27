@extends('dashboard') {{-- ganti layout sesuai yang kamu pakai --}}

@section('content')
    <div class="container mt-5 text-center">
        <h1 class="text-success">🎉 Pendaftaran Berhasil!</h1>
        <p class="mt-3">Terima kasih telah mendaftar di SMP kami.</p>

        <div class="card shadow-sm p-4 mt-4">
            <h5><strong>Nomor Pendaftaran:</strong> {{ $pendaftar->no_pendaftaran }}</h5>
            <h5><strong>Nama:</strong> {{ $pendaftar->nama_lengkap }}</h5>

            @if ($pendaftar->bukti_pendaftaran)
                <a href="{{ route('pendaftar.download', $pendaftar->id) }}" class="btn btn-success mt-4">
                    📄 Download Bukti Pendaftaran
                </a>
            @else
                <p class="text-warning mt-4">Tidak ada bukti pendaftaran tersedia.</p>
            @endif

            <a href="{{ route('pendaftar.index') }}" class="btn btn-primary mt-2">Kembali ke Pendaftaran</a>
        </div>
    </div>
@endsection
