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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftar = Pendaftar::paginate(5);
        return view('pendaftar.index', compact('pendaftar'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
            'administrasi_lunas' => 'required|in:1,0',
            'riwayat_penyakit' => 'required',
            'riwayat_saudara' => 'required',
            'penanggung_jawab' => 'required',
        ]);

        $lastPendaftar = Pendaftar::latest()->first();
        $nextNumber = $lastPendaftar ? ((int) substr($lastPendaftar->no_pendaftaran, -4)) + 1 : 1;
        $noPendaftaran = 'SMP' . date('Y') . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $buktiPendaftaran = null;

        $pendaftar = Pendaftar::create([
            'no_pendaftaran' => $noPendaftaran,
            'nama_lengkap' => $request->nama_lengkap,
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
            'administrasi_lunas' => $request->administrasi_lunas,
            'saudaras_id' => $request->riwayat_saudara,
            'penanggung_jawab' => $request->penanggung_jawab,
        ]);

        // Generate Bukti Pendaftaran
        if ($request->jenis_pendaftaran === 'online') {
            $pdf = Pdf::loadView('pdf.bukti_pendaftaran', compact('pendaftar')); // buat file blade pdf
            $pdfPath = 'bukti_pendaftaran/' . $noPendaftaran . '.pdf';
            Storage::disk('public')->put($pdfPath, $pdf->output());

            // Update bukti_pendaftaran field di database
            $pendaftar->update([
                'bukti_pendaftaran' => $pdfPath,
            ]);
        }

        if ($request->has('riwayat_penyakit')) {
            $pendaftar->riwayatPenyakit()->attach($request->riwayat_penyakit);
        }

        return view('pendaftar.success', compact('pendaftar'));
        // return redirect()->route('pendaftar.download', ['pendaftar' => $pendaftar->id]);
    }

    public function download(Pendaftar $pendaftar)
    {
        // dd($pendaftar->bukti_pendaftaran, Storage::disk('public')->exists($pendaftar->bukti_pendaftaran));

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
