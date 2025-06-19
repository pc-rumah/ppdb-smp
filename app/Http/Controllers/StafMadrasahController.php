<?php

namespace App\Http\Controllers;

use App\Models\StaffMadrasah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StafMadrasahController extends Controller
{
    public function index()
    {
        $staff = StaffMadrasah::paginate(5);
        return view('manage3landing.madrasah.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('manage3landing.madrasah.staff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'position'      => 'required|string|max:255',
            'image'         => 'required|image|mimes:png,jpg|max:2048',
            'description'   => 'nullable|string',
        ]);

        $validated['image'] = $request->file('image')->store('staffmadrasah', 'public');

        StaffMadrasah::create($validated);

        return redirect()->route('stafmadrasah.index')->with('success', 'Berhasil Menambah Data');
    }

    public function edit(StaffMadrasah $stafmadrasah)
    {
        return view('manage3landing.madrasah.staff.edit', compact('stafmadrasah'));
    }

    public function update(Request $request, StaffMadrasah $stafmadrasah)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg|max:2048',
            'description' => 'nullable|string'
        ]);

        $data = $request->only(['name', 'position', 'description']);

        if ($request->hasFile('image')) {
            if ($stafmadrasah->image && Storage::disk('public')->exists($stafmadrasah->image)) {
                Storage::disk('public')->delete($stafmadrasah->image);
            }
            $data['image'] = $request->file('image')->store('staffmadrasah', 'public');
        }

        $stafmadrasah->update($data);

        return redirect()->route('stafmadrasah.index')->with('success', 'Berhasil Mengupdate Data');
    }

    public function destroy(StaffMadrasah $stafmadrasah)
    {
        if ($stafmadrasah->image && Storage::disk('public')->exists($stafmadrasah->image)) {
            Storage::disk('public')->delete($stafmadrasah->image);
        }

        $stafmadrasah->delete();

        return redirect()->route('stafmadrasah.index')->with('success', 'Berhasil Menghapus Data');
    }
}
