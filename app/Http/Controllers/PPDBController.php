<?php

namespace App\Http\Controllers;

use App\Models\Sakit;
use App\Models\Saudara;
use App\Models\Pendaftar;
use App\PendaftarService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePendaftarRequest;

class PPDBController extends Controller
{
    public function preview($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        return view('pdf.bukti_pendaftaran', compact('pendaftar'));
    }

    public function create()
    {
        $riwayatPenyakitList = Sakit::all();
        $saudara = Saudara::all();

        return view('pendaftar.create', compact('riwayatPenyakitList', 'saudara'));
    }

    public function store(StorePendaftarRequest $request, PendaftarService $pendaftarService)
    {
        $noPendaftaran = $pendaftarService->generateNoPendaftaran();

        $buktiPembayaranPath = $request->hasFile('bukti_pembayaran')
            ? $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public')
            : null;

        $lastPendaftar = Pendaftar::latest()->first();
        $nextNumber = $lastPendaftar ? ((int) substr($lastPendaftar->no_pendaftaran, -4)) + 1 : 1;
        $noPendaftaran = 'SMP' . date('Y') . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $piagamPath = $request->hasFile('piagam')
            ? $request->file('piagam')->store('piagam', 'public')
            : null;

        $pendaftar = Pendaftar::create([
            'no_pendaftaran'      => $noPendaftaran,
            'nama_lengkap'        => $request->nama_lengkap,
            'jenis_kelamin'       => $request->jenis_kelamin,
            'jenis_pendaftaran'   => $request->jenis_pendaftaran,
            'tempat_lahir'        => $request->tempat_lahir,
            'tanggal_lahir'       => $request->tanggal_lahir,
            'dusun'               => $request->dusun,
            'rt'                  => $request->rt,
            'rw'                  => $request->rw,
            'desa_kelurahan'      => $request->desa,
            'kecamatan'           => $request->kecamatan,
            'kabupaten_kota'      => $request->kabupaten,
            'provinsi'            => $request->provinsi,
            'nama_ayah'           => $request->nama_ayah,
            'nama_ibu'            => $request->nama_ibu,
            'no_wa'               => $request->no_wa,
            'email'               => $request->email,
            'asal_sekolah'        => $request->asal_sekolah,
            'administrasi_lunas' => false,
            'kk'                  => in_array('KK', $request->berkas ?? []),
            'akte'                => in_array('Akte', $request->berkas ?? []),
            'ktp'                 => in_array('KTP', $request->berkas ?? []),
            'rapot'               => in_array('Rapot', $request->berkas ?? []),
            'saudaras_id'         => $request->riwayat_saudara,
            'penanggung_jawab'    => $request->penanggung_jawab,
            'bukti_pembayaran'    => $buktiPembayaranPath,
            'piagam_penghargaan'  => $piagamPath,
        ]);

        $pendaftarService->generateBuktiPendaftaran($pendaftar);

        $pendaftar->riwayatPenyakit()->attach($request->riwayat_penyakit);

        if ($request->has('riwayat_penyakit')) {
            $pendaftar->riwayatPenyakit()->attach($request->riwayat_penyakit);
        }

        return redirect()->route('pendaftar.success', $pendaftar->id);
    }

    public function success($id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        return view('pendaftar.success', compact('pendaftar'));
    }

    public function download(Pendaftar $pendaftar)
    {
        if ($pendaftar->bukti_pendaftaran && Storage::disk('public')->exists($pendaftar->bukti_pendaftaran)) {
            return response()->download(storage_path('app/public/' . $pendaftar->bukti_pendaftaran));
        }

        return redirect()->route('pendaftar.index')->with('error', 'Bukti pendaftaran tidak ditemukan.');
    }
}
