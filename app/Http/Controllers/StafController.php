<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StafController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Staff::orderBy('created_at', 'desc')->paginate(5);
        return view('managestaff.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('managestaff.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        // Handle upload file jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('staff', 'public');
        }

        // Simpan ke database
        Staff::create($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('staff.index')->with('success', 'Data staff berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Staff::find($id);
        return view('managestaff.edit', compact('data'));
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'position', 'description']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($staff->image && Storage::disk('public')->exists($staff->image)) {
                Storage::disk('public')->delete($staff->image);
            }

            // Upload gambar baru
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('staff', $filename, 'public');

            $data['image'] = $filePath;
        }

        $staff->update($data);

        return redirect()->route('staff.index')->with('success', 'Data staff berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Staff::find($id);
        if ($data->image) {
            Storage::disk('public')->delete($data->image);
        }
        $data->delete();
        return redirect()->route('staff.index')->with('success', 'Data staff berhasil dihapus.');
    }
}
