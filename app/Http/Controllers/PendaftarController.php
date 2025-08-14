<?php

namespace App\Http\Controllers;

use App\Models\Sakit;
use App\Models\Saudara;
use App\Models\Pendaftar;
use App\PendaftarService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePendaftarRequest;

class PendaftarController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftar::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%');
        }

        $pendaftar = $query->orderBy('created_at', 'desc')->paginate(5)->withQueryString();
        $saudara = Saudara::all();

        return view('pendaftar.index', compact('pendaftar', 'saudara'));
    }

    public function create()
    {
        $riwayatPenyakitList = Sakit::all();
        $saudara = Saudara::all();

        return view('pendaftar.createadmin', compact('riwayatPenyakitList', 'saudara'));
    }

    public function updateStatus(Request $request, Pendaftar $pendaftar)
    {
        $request->validate([
            'administrasi_lunas' => 'required|in:0,1',
        ]);

        $pendaftar->update([
            'administrasi_lunas' => $request->administrasi_lunas,
        ]);

        return back()->with('success', 'Status administrasi berhasil diperbarui.');
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
            'no_pendaftaran' => $noPendaftaran,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jenis_pendaftaran' => $request->jenis_pendaftaran,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'dusun' => $request->dusun,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'desa_kelurahan' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten_kota' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'no_wa' => $request->no_wa,
            'email' => $request->email,
            'asal_sekolah' => $request->asal_sekolah,
            'administrasi_lunas' => false,
            'kk'    => in_array('kk', $request->dokumen_tambahan ?? []),
            'akte'  => in_array('akte', $request->dokumen_tambahan ?? []),
            'ktp'   => in_array('ktp', $request->dokumen_tambahan ?? []),
            'rapot' => in_array('rapot', $request->dokumen_tambahan ?? []),
            'saudaras_id' => $request->riwayat_saudara,
            'penanggung_jawab' => $request->penanggung_jawab,
            'bukti_pembayaran' => $buktiPembayaranPath,
            'piagam_penghargaan' => $piagamPath,
        ]);

        $pendaftarService->generateBuktiPendaftaran($pendaftar);

        $pendaftar->riwayatPenyakit()->attach($request->riwayat_penyakit);

        return redirect()->route('pendaftar.index')->with('success', 'Data Berhasil disimpan.');
    }

    public function download(Pendaftar $pendaftar)
    {
        if ($pendaftar->bukti_pendaftaran && Storage::disk('public')->exists($pendaftar->bukti_pendaftaran)) {
            return response()->download(storage_path('app/public/' . $pendaftar->bukti_pendaftaran));
        }

        return redirect()->route('pendaftar.index')->with('error', 'Bukti pendaftaran tidak ditemukan.');
    }

    public function show(string $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        return view('pendaftar.show', compact('pendaftar'));
    }

    public function destroy(string $id)
    {
        $pendaftar = Pendaftar::findOrFail($id);
        $pendaftar->delete();

        return redirect()->back()->with('success', 'Berhasil di Hapus');
    }
}
