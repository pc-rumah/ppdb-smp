<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function create()
    {
        $kontak = Kontak::first();

        return view('kontakweb.create', compact('kontak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'email' => 'required|email',
        ]);


        $kontak = Kontak::first();

        // Simpan data teks ke dalam array
        $data = [
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'email' => $request->email,
        ];

        // Jika belum ada data: create
        if (!$kontak) {
            Kontak::create($data);
            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        }

        // Jika sudah ada data: update
        $kontak->update($data);
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
}
