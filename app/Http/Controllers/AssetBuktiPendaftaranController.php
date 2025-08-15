<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetBuktiPendaftaran;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreRequestAsset;

class AssetBuktiPendaftaranController extends Controller
{
    public function create()
    {
        $data = AssetBuktiPendaftaran::first();
        return view('assetPpdb.create', compact('data'));
    }

    public function store(StoreRequestAsset $request)
    {
        $request->validated();

        $data = AssetBuktiPendaftaran::first() ?? new AssetBuktiPendaftaran();

        $data->nama_kontak_1 = $request->nama_kontak_1;
        $data->nomor_kontak_1 = $request->nomor_kontak_1;
        $data->nama_kontak_2 = $request->nama_kontak_2;
        $data->nomor_kontak_2 = $request->nomor_kontak_2;
        $data->ketua_panitia = $request->ketua_panitia;
        $data->tahun_ajar = $request->tahun_ajar;

        if ($request->hasFile('logo_pondok_kiri')) {
            if ($data->logo_pondok_kiri && Storage::disk('public')->exists($data->logo_pondok_kiri)) {
                Storage::disk('public')->delete($data->logo_pondok_kiri);
            }
            $data->logo_pondok_kiri = $request->file('logo_pondok_kiri')->store('asset_bukti', 'public');
        }

        if ($request->hasFile('logo_pondok_kanan')) {
            if ($data->logo_pondok_kanan && Storage::disk('public')->exists($data->logo_pondok_kanan)) {
                Storage::disk('public')->delete($data->logo_pondok_kanan);
            }
            $data->logo_pondok_kanan = $request->file('logo_pondok_kanan')->store('asset_bukti', 'public');
        }

        if ($request->hasFile('tanda_tangan')) {
            if ($data->tanda_tangan && Storage::disk('public')->exists($data->tanda_tangan)) {
                Storage::disk('public')->delete($data->tanda_tangan);
            }

            $data->tanda_tangan = $request->file('tanda_tangan')->store('asset_bukti', 'public');
        }

        $data->save();
        return redirect()->back()->with('success', 'Data Berhasil diupdate');
    }
}
