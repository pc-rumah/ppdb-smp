<?php

namespace App\Http\Controllers;

use App\Models\Kontak_Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontakUnitController extends Controller
{
    public function create()
    {
        $roleName = Auth::user()->getRoleNames()->first();
        $kontak = Kontak_Unit::where('role_name', $roleName)->firstOrFail();

        return view('layouts.kontak', compact('kontak'));
    }

    public function store(Request $request)
    {
        $roleName = Auth::user()->getRoleNames()->first();

        $validated = $request->validate([
            'telepon' => 'required|string|max:20',
            'alamat'  => 'required|string',
            'email'   => 'required|email',
        ]);

        $kontak = Kontak_Unit::where('role_name', $roleName)->first();

        if ($kontak) {
            $kontak->update($validated);
        } else {
            Kontak_Unit::create([
                'role_name' => $roleName,
                ...$validated
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil disimpan!');
    }
}
