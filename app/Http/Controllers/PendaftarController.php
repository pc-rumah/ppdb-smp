<?php

namespace App\Http\Controllers;

use App\Models\Sakit;
use App\Models\Saudara;
use App\Models\Pendaftar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

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
            'dokumen_tambahan' => 'nullable|array',
            'dokumen_tambahan.*' => 'in:kk,akte,ktp,rapot',
            'penanggung_jawab' => 'required|string|max:255',
            'bukti_pembayaran' => 'required_if:jenis_pendaftaran,online|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'piagam' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ]);

        $lastPendaftar = Pendaftar::latest()->first();
        $nextNumber = $lastPendaftar ? ((int) substr($lastPendaftar->no_pendaftaran, -4)) + 1 : 1;
        $noPendaftaran = 'SMP' . date('Y') . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $buktiPembayaranPath = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        $piagamPath = null;
        if ($request->hasFile('piagam')) {
            $piagamPath = $request->file('piagam')->store('piagam', 'public');
        }

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

        $pdf = Pdf::loadView('pdf.bukti_pendaftaran', compact('pendaftar'));
        $pdfPath = 'bukti_pendaftaran/' . $noPendaftaran . '-' . now()->timestamp . '.pdf';
        Storage::disk('public')->put($pdfPath, $pdf->output());

        $pendaftar->update([
            'bukti_pendaftaran' => $pdfPath,
        ]);

        if ($request->has('riwayat_penyakit')) {
            $pendaftar->riwayatPenyakit()->attach($request->riwayat_penyakit);
        }

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

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
