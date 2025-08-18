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
        $validated['status_verifikasi'] = 'pending';

        Staff::create($validated);

        return redirect()->route('staff.index')->with('success', 'Data staff berhasil disimpan dan menunggu verifikasi Master Admin.');
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
            if ($staff->image && Storage::disk('public')->exists($staff->image)) {
                Storage::disk('public')->delete($staff->image);
            }

            $data['image'] = $request->file('image')->store('staff', 'public');
        }

        $data['status_verifikasi'] = 'pending';
        $staff->update($data);

        return redirect()->route('staff.index')->with('success', 'Data staff berhasil diperbarui dan menunggu verifikasi Master Admin.');
    }

    public function destroy(Staff $staff)
    {
        if (!auth()->user()->hasRole('master-admin')) {
            $staff->update([
                'status_verifikasi' => 'pending',
                'action_request' => 'delete',
            ]);

            return redirect()->route('staff.index')->with('success', 'Permintaan hapus dikirim dan menunggu verifikasi Master Admin.');
        }

        if ($staff->image && Storage::disk('public')->exists($staff->image)) {
            Storage::disk('public')->delete($staff->image);
        }

        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Data staff berhasil dihapus.');
    }

    public function listVerifikasi()
    {
        // Ambil semua data pending
        $staffs = Staff::where('status_verifikasi', 'pending')->get();

        return view('staff.verifikasi', compact('staffs'));
    }

    public function verifikasi(Request $request, Staff $staff)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        // Kalau request delete dan disetujui → hapus
        if ($staff->action_request === 'delete' && $request->status === 'approved') {
            if ($staff->image && Storage::disk('public')->exists($staff->image)) {
                Storage::disk('public')->delete($staff->image);
            }
            $staff->delete();
        } else {
            // Kalau create/update → ubah status saja
            $staff->update([
                'status_verifikasi' => $request->status,
                'action_request' => 'create', // reset ke default
            ]);
        }

        return back()->with('success', 'Data berhasil diverifikasi.');
    }
}
