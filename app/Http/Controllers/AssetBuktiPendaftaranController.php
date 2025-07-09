<?php

namespace App\Http\Controllers;

use App\Models\AssetBuktiPendaftaran;
use Illuminate\Http\Request;

class AssetBuktiPendaftaranController extends Controller
{
    public function create()
    {
        $data = AssetBuktiPendaftaran::first();
        return view('assetPpdb.create', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajar' => 'required|string',
            'logo_pondok_kiri' => 'nullable|image|mimes:png,jpg|max:4096',
            'logo_pondok_kanan' => 'nullable|image|mimes:png,jpg|max:4096',
            'tanda_tangan' => 'nullable|image|mimes:png,jpg|max:4096',
        ]);

        $data = AssetBuktiPendaftaran::first() ?? new AssetBuktiPendaftaran();
        $data->tahun_ajar = $request->tahun_ajar;

        if ($request->hasFile('logo_pondok_kiri')) {
            $data->logo_pondok_kiri = $request->file('logo_pondok_kiri')->store('asset_bukti', 'public');
        }

        if ($request->hasFile('logo_pondok_kanan')) {
            $data->logo_pondok_kanan = $request->file('logo_pondok_kanan')->store('asset_bukti', 'public');
        }

        if ($request->hasFile('tanda_tangan')) {
            $data->tanda_tangan = $request->file('tanda_tangan')->store('asset_bukti', 'public');
        }

        $data->save();
        return redirect()->back()->with('success', 'Data Berhasil diupdate');
    }
}
