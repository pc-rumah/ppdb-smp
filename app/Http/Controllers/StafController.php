<?php

namespace App\Http\Controllers;

use App\Http\Requests\StafRequest;
use App\Http\Requests\StafUpdateRequest;
use App\Models\Staff;
use Illuminate\Support\Facades\Storage;

class StafController extends Controller
{
    public function index()
    {
        $data = Staff::latest()->paginate(5);
        return view('managestaff.index', compact('data'));
    }

    public function create()
    {
        return view('managestaff.create');
    }

    public function store(StafRequest $request)
    {
        $validated = $request->validated();

        $validated['image'] = $request->file('image')->store('staff', 'public');

        Staff::create($validated);

        return redirect()->route('staff.index')->with('success', 'Data staff berhasil disimpan.');
    }

    public function edit(Staff $staff)
    {
        return view('managestaff.edit', ['data' => $staff]);
    }

    public function update(StafUpdateRequest $request, Staff $staff)
    {
        $request->validated();

        $data = $request->only(['name', 'position', 'description']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($staff->image && Storage::disk('public')->exists($staff->image)) {
                Storage::disk('public')->delete($staff->image);
            }

            $data['image'] = $request->file('image')->store('staff', 'public');
        }

        $staff->update($data);

        return redirect()->route('staff.index')->with('success', 'Data staff berhasil diperbarui.');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->image && Storage::disk('public')->exists($staff->image)) {
            Storage::disk('public')->delete($staff->image);
        }

        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Data staff berhasil dihapus.');
    }
}
