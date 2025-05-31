<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StafController extends Controller
{
    public function index()
    {
        $data = Staff::orderBy('created_at', 'desc')->paginate(5);
        return view('managestaff.index', compact('data'));
    }

    public function create()
    {
        return view('managestaff.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('staff', 'public');
        }

        Staff::create($validated);

        return redirect()->route('staff.index')->with('success', 'Data staff berhasil disimpan.');
    }

    public function show(string $id)
    {
        //
    }

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
            if ($staff->image && Storage::disk('public')->exists($staff->image)) {
                Storage::disk('public')->delete($staff->image);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('staff', $filename, 'public');

            $data['image'] = $filePath;
        }

        $staff->update($data);

        return redirect()->route('staff.index')->with('success', 'Data staff berhasil diperbarui.');
    }

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
