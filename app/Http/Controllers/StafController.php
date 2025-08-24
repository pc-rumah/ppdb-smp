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
        $validated['status'] = auth()->user()->hasRole('master-admin') ? 'approved' : 'pending';
        $validated['status_verifikasi'] = auth()->user()->hasRole('master-admin') ? 'approved' : 'pending';

        Staff::create($validated);

        return redirect()->route('staff.index')->with('success', 'Data staff berhasil diajukan.');
    }

    public function edit(Staff $staff)
    {
        return view('managestaff.edit', ['data' => $staff]);
    }

    public function update(StafUpdateRequest $request, Staff $staff)
    {
        $request->validated();
        $data = $request->only(['name', 'position', 'description']);
        $newImage = $staff->new_gambar;

        if ($request->hasFile('image')) {
            // simpan ke staging dulu
            $newImage = $request->file('image')->store('staff', 'public');
        }

        if (auth()->user()->hasRole('staff')) {
            $staff->update([
                'previous_data' => json_encode([
                    'name' => $staff->name,
                    'position' => $staff->position,
                    'description' => $staff->description,
                ]),
                'name' => $data['name'],
                'position' => $data['position'],
                'description' => $data['description'],
                'new_gambar' => $newImage,
                'status' => 'pending',
                'status_verifikasi' => 'pending',
            ]);
        } else {
            if ($newImage) {
                if ($staff->image && Storage::disk('public')->exists($staff->image)) {
                    Storage::disk('public')->delete($staff->image);
                }
                $staff->image = $newImage;
                $staff->new_gambar = null;
            }

            $staff->update([
                'name' => $data['name'],
                'position' => $data['position'],
                'description' => $data['description'],
                'status' => 'approved',
                'status_verifikasi' => 'approved',
                'previous_data' => null,
            ]);
        }

        return redirect()->route('staff.index')->with('success', 'Perubahan data staff diajukan.');
    }

    public function destroy(Staff $staff)
    {
        if (!auth()->user()->hasRole('master-admin')) {
            $staff->update([
                'status' => 'pending-delete',
                'status_verifikasi' => 'pending',
            ]);

            return redirect()->route('staff.index')->with('success', 'Permintaan hapus dikirim.');
        }

        if ($staff->image && Storage::disk('public')->exists($staff->image)) {
            Storage::disk('public')->delete($staff->image);
        }

        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Data staff berhasil dihapus permanen.');
    }

    public function approval()
    {
        $data = Staff::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('managestaff.index', compact('data'));
    }

    public function approve($id)
    {
        $staff = Staff::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'status_verifikasi' => 'approved',
            'previous_data' => null,
        ];

        if ($staff->new_gambar) {
            if ($staff->image && Storage::disk('public')->exists($staff->image)) {
                Storage::disk('public')->delete($staff->image);
            }
            $updateData['image'] = $staff->new_gambar;
            $updateData['new_gambar'] = null;
        }

        $staff->update($updateData);

        return back()->with('success', 'Staff disetujui.');
    }

    public function reject($id)
    {
        $staff = Staff::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'status_verifikasi' => 'approved',
            'new_gambar' => null,
            'previous_data' => null,
        ];

        if ($staff->previous_data) {
            $old = json_decode($staff->previous_data, true);
            $updateData['name'] = $old['name'];
            $updateData['position'] = $old['position'];
            $updateData['description'] = $old['description'];
        }

        if ($staff->new_gambar && Storage::disk('public')->exists($staff->new_gambar)) {
            Storage::disk('public')->delete($staff->new_gambar);
        }

        $staff->update($updateData);

        return back()->with('success', 'Perubahan staff ditolak dan data dikembalikan.');
    }

    public function approveDelete($id)
    {
        $staff = Staff::findOrFail($id);

        if ($staff->image && Storage::disk('public')->exists($staff->image)) {
            Storage::disk('public')->delete($staff->image);
        }

        $staff->delete();

        return back()->with('success', 'Penghapusan staff disetujui.');
    }

    public function rejectDelete($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->update([
            'status' => 'approved',
            'status_verifikasi' => 'approved',
        ]);

        return back()->with('success', 'Penghapusan staff ditolak, data tetap ada.');
    }
}
