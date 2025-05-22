@extends('layouts.ppdbpart.layout') {{-- ganti layout sesuai yang kamu pakai --}}

@section('content')
    <div class="max-w-xl mx-auto mt-10 bg-white shadow-lg rounded-2xl p-8 text-center space-y-6">
        <h1 class="text-2xl font-bold text-green-600">🎉 Pendaftaran Berhasil!</h1>
        <p class="text-gray-700">Terima kasih telah mendaftar di SMP kami.</p>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 space-y-4">
            <div class="text-left space-y-2">
                <p><span class="font-semibold">Nomor Pendaftaran:</span> {{ $pendaftar->no_pendaftaran }}</p>
                <p><span class="font-semibold">Nama:</span> {{ $pendaftar->nama_lengkap }}</p>
            </div>

            @if ($pendaftar->bukti_pendaftaran)
                <a href="{{ route('ppdb.download', $pendaftar->id) }}" class="btn btn-success w-full">
                    📄 Download Bukti Pendaftaran
                </a>
            @else
                <p class="text-warning text-yellow-600">Tidak ada bukti pendaftaran tersedia.</p>
            @endif
        </div>

        <a href="/" class="btn btn-primary w-full">
            🔙 Kembali ke Halaman Utama
        </a>
    </div>
@endsection
