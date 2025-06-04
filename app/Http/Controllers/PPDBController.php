<?php

namespace App\Http\Controllers;

use App\Models\Sakit;
use App\Models\Saudara;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PPDBController extends Controller
{
    public function create()
    {
        $riwayatPenyakitList = Sakit::all();
        $saudara = Saudara::all();

        return view('pendaftar.create', compact('riwayatPenyakitList', 'saudara'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jenis_pendaftaran' => 'required|in:online,offline',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|date',
            'dusun' => 'required|string|max:255',
            'rt' => 'required|string|max:30',
            'rw' => 'required|string|max:30',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:50',
            'kabupaten' => 'required|string|max:50',
            'provinsi' => 'required|string|max:50',
            'nama_ayah' => 'required|string|max:100',
            'nama_ibu' => 'required|string|max:100',
            'no_wa' => 'required|regex:/^[0-9]+$/|min:10|max:18',
            'email' => 'required|email|max:100',
            'asal_sekolah' => 'required|string|max:100',
            'riwayat_penyakit' => 'required|array',
            'riwayat_saudara' => 'required',
            'berkas' => 'required|array|min:1',
            'berkas.*' => 'in:KK,Akte,KTP,Rapot',
            'penanggung_jawab' => 'required|string|max:255',
            'bukti_pembayaran' => 'required_if:jenis_pendaftaran,online|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'piagam' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ]);

        $lastPendaftar = Pendaftar::latest()->first();
        $nextNumber = $lastPendaftar ? ((int) substr($lastPendaftar->no_pendaftaran, -4)) + 1 : 1;
        $noPendaftaran = 'SMP' . date('Y') . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $buktiPembayaranPath = $request->hasFile('bukti_pembayaran')
            ? $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public')
            : null;

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

        $pdf = Pdf::loadView('pdf.bukti_pendaftaran', compact('pendaftar'));
        $pdfPath = 'bukti_pendaftaran/' . $noPendaftaran . '-' . now()->timestamp . '.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        $pendaftar->update([
            'bukti_pendaftaran' => $pdfPath,
        ]);

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
