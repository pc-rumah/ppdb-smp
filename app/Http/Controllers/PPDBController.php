<?php

namespace App\Http\Controllers;

use App\Models\Sakit;
use App\Models\Saudara;
use App\Models\Pendaftar;
use App\PendaftarService;
use App\Models\PendaftaranStatus;
use App\Models\AssetBuktiPendaftaran;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePendaftarRequest;
use Illuminate\Http\Request;

class PPDBController extends Controller
{
    public function home()
    {
        $tahun = AssetBuktiPendaftaran::pluck('tahun_ajar')->first();
        $jadwal = PendaftaranStatus::first();

        return view('ppdb', compact('tahun', 'jadwal'));
    }

    public function create_jadwal()
    {
        $data = PendaftaranStatus::first();
        return view('layouts.ppdbpart.create', compact('data'));
    }

    public function jadwal(Request $request)
    {
        $request->validate([
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $data = PendaftaranStatus::first();

        if ($data) {
            $data->update([
                'tanggal_mulai'   => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);
        } else {
            PendaftaranStatus::create([
                'tanggal_mulai'   => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);
        }

        return redirect()->back()->with('success', 'Jadwal pendaftaran berhasil disimpan!');
    }

    public function status()
    {
        $pendaftarData = Pendaftar::select('status')->get();
        $data = Pendaftar::all();

        $stats = [
            'total' => $pendaftarData->count(),
            'diterima' => $pendaftarData->where('status', 'diterima')->count(),
            'ditolak' => $pendaftarData->where('status', 'ditolak')->count(),
            'menunggu' => $pendaftarData->where('status', 'menunggu')->count(),
            'data' => $data
        ];

        return view('status', $stats);
    }

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
        $buktiPembayaranPath = $request->hasFile('bukti_pembayaran') ? $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public') : null;

        $lastPendaftar = Pendaftar::latest()->first();
        $nextNumber = $lastPendaftar ? ((int) substr($lastPendaftar->no_pendaftaran, -4)) + 1 : 1;
        $noPendaftaran = 'SMP' . date('Y') . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $piagamPath = $request->hasFile('piagam') ? $request->file('piagam')->store('piagam', 'public') : null;
        $fotoPath = $request->hasFile('foto') ? $request->file('foto')->store('foto', 'public') : null;
        $kkPath    = $request->hasFile('kk') ? $request->file('kk')->store('berkas/kk', 'public') : null;
        $aktePath  = $request->hasFile('akte') ? $request->file('akte')->store('berkas/akte', 'public') : null;
        $ktpPath   = $request->hasFile('ktp') ? $request->file('ktp')->store('berkas/ktp', 'public') : null;
        $rapotPath = $request->hasFile('rapot') ? $request->file('rapot')->store('berkas/rapot', 'public') : null;

        $pendaftar = Pendaftar::create([
            'no_pendaftaran'      => $noPendaftaran,
            'nama_lengkap'        => $request->nama_lengkap,
            'jenis_kelamin'       => $request->jenis_kelamin,
            'jenis_pendaftaran'   => $request->jenis_pendaftaran,
            'tempat_lahir'        => $request->tempat_lahir,
            'tanggal_lahir'       => $request->tanggal_lahir,
            'foto'                => $fotoPath,
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
            'kk'    => $kkPath,
            'akte'  => $aktePath,
            'ktp'   => $ktpPath,
            'rapot' => $rapotPath,
            'saudaras_id'         => $request->riwayat_saudara,
            'penanggung_jawab'    => $request->penanggung_jawab,
            'bukti_pembayaran'    => $buktiPembayaranPath,
            'piagam_penghargaan'  => $piagamPath,
            'status'              => 'menunggu',
        ]);

        $pendaftarService->generateBuktiPendaftaran($pendaftar);

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
