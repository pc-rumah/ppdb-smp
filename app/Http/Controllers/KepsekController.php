<?php

namespace App\Http\Controllers;

use App\Models\Kepsek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KepsekController extends Controller
{
    public function create()
    {
        $kepsek = Kepsek::first();
        return view('managestaff.kepsek', compact('kepsek'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $kepsek = Kepsek::first();

        if (!$kepsek) {
            $kepsek = new Kepsek();
        }

        $kepsek->nama_kepsek = $request->name;
        $kepsek->description_kepsek = $request->description;

        if ($request->hasFile('image')) {
            if ($kepsek->image_kepsek && Storage::exists('public/' . $kepsek->image_kepsek)) {
                Storage::delete('public/' . $kepsek->image_kepsek);
            }

            $imagePath = $request->file('image')->store('staff', 'public');
            $kepsek->image_kepsek = $imagePath;
        }

        $kepsek->save();

        return redirect()->back()->with('success', 'Data Kepala Sekolah berhasil disimpan.');
    }
}
