<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KontakController extends Controller
{
    public function create()
    {
        $kontak = Kontak::first();
        return view('kontakweb.create', compact('kontak'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_telp' => 'required|string|max:20',
            'alamat'  => 'required|string',
            'email'   => 'required|email',
        ]);

        $kontak = Kontak::first();

        if ($kontak) {
            $kontak->update($validated);
            $message = 'Data berhasil diperbarui.';
        } else {
            Kontak::create($validated);
            $message = 'Data berhasil ditambahkan.';
        }

        Cache::forget('landing_kontak');

        return redirect()->back()->with('success', $message);
    }
}
