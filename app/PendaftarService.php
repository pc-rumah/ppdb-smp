<?php

namespace App;

use App\Models\Pendaftar;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AssetBuktiPendaftaran;
use Illuminate\Support\Facades\Storage;

class PendaftarService
{
    public function generateNoPendaftaran(): string
    {
        $lastPendaftar = Pendaftar::latest()->first();
        $nextNumber = $lastPendaftar ? ((int) substr($lastPendaftar->no_pendaftaran, -4)) + 1 : 1;
        return 'SMP' . date('Y') . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    public function generateBuktiPendaftaran(Pendaftar $pendaftar): string
    {
        $asset = AssetBuktiPendaftaran::first();

        function base64_image($path)
        {
            return $path && file_exists($path)
                ? 'data:image/' . pathinfo($path, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($path))
                : null;
        }

        $nama_kontak_1  = $asset->nama_kontak_1;
        $nomor_kontak_1 = $asset->nomor_kontak_1;
        $nama_kontak_2  = $asset->nama_kontak_2;
        $nomor_kontak_2 = $asset->nomor_kontak_2;
        $ketua_panitia  = $asset->ketua_panitia;
        $tahun_ajar = $asset->tahun_ajar;
        $logo_pondok_kiri = base64_image(public_path('storage/' . $asset->logo_pondok_kiri));
        $logo_pondok_kanan = base64_image(public_path('storage/' . $asset->logo_pondok_kanan));
        $tanda_tangan = base64_image(public_path('storage/' . $asset->tanda_tangan));
        $stempel = base64_image(public_path('storage/' . $asset->stempel));

        $pdf = Pdf::loadView('pdf.bukti_pendaftaran', [
            'nama_kontak_1'  => $nama_kontak_1,
            'nomor_kontak_1' => $nomor_kontak_1,
            'nama_kontak_2'  => $nama_kontak_2,
            'nomor_kontak_2' => $nomor_kontak_2,
            'ketua_panitia'  => $ketua_panitia,
            'pendaftar' => $pendaftar,
            'tahun_ajar' => $tahun_ajar,
            'logo_kiri' => $logo_pondok_kiri,
            'logo_kanan' => $logo_pondok_kanan,
            'tanda_tangan' => $tanda_tangan,
            'stempel' => $stempel,
        ])->setPaper('a4', 'portrait');

        $pdfPath = 'bukti_pendaftaran/' . $pendaftar->no_pendaftaran . '-' . now()->timestamp . '.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        $pendaftar->update([
            'bukti_pendaftaran' => $pdfPath,
        ]);

        return $pdfPath;
    }
}
