<?php

namespace App\Http\Controllers;

use App\Models\StaffMadrasah;
use App\Http\Requests\StafRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StafUpdateRequest;

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

    public function store(StafRequest $request)
    {
        $validated = $request->validated();

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('staffmadrasah', 'public');
        }

        StaffMadrasah::create([
            'name' => $validated['name'],
            'position' => $validated['position'],
            'description' => $validated['description'],
            'image' => $image,
            'status' => auth()->user()->hasRole('master-admin') ? 'approved' : 'pending',
        ]);

        return redirect()->route('stafmadrasah.index')->with('success', 'Staff diajukan.');
    }

    public function edit(StaffMadrasah $stafmadrasah)
    {
        return view('manage3landing.madrasah.staff.edit', compact('stafmadrasah'));
    }

    public function update(StafUpdateRequest $request, StaffMadrasah $stafmadrasah)
    {
        $request->validated();

        $data = $request->only(['name', 'position', 'description']);
        $newImage = $stafmadrasah->new_gambar;

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')->store('staffmadrasah', 'public');
        }

        if (auth()->user()->hasRole('madrasah')) {
            $stafmadrasah->update([
                'previous_data' => json_encode([
                    'name' => $stafmadrasah->name,
                    'position' => $stafmadrasah->position,
                    'description' => $stafmadrasah->description,
                ]),
                'name' => $data['name'],
                'position' => $data['position'],
                'description' => $data['description'],
                'new_gambar' => $newImage,
                'status' => 'pending',
            ]);
        } else {
            if ($newImage) {
                if ($stafmadrasah->image && Storage::disk('public')->exists($stafmadrasah->image)) {
                    Storage::disk('public')->delete($stafmadrasah->image);
                }
                $stafmadrasah->image = $newImage;
                $stafmadrasah->new_gambar = null;
            }

            $stafmadrasah->update([
                'name' => $data['name'],
                'position' => $data['position'],
                'description' => $data['description'],
                'status' => 'approved',
                'previous_data' => null,
            ]);
        }

        return redirect()->route('stafmadrasah.index')->with('success', 'Perubahan data staff diajukan.');
    }

    public function destroy(StaffMadrasah $stafmadrasah)
    {
        if (auth()->user()->hasRole('madrasah')) {
            $stafmadrasah->update([
                'status' => 'pending-delete'
            ]);

            return redirect()->route('stafmadrasah.index')->with('success', 'Penghapusan staff diajukan.');
        }

        if (auth()->user()->hasRole('master-admin')) {
            if ($stafmadrasah->image && Storage::disk('public')->exists($stafmadrasah->image)) {
                Storage::disk('public')->delete($stafmadrasah->image);
            }

            $stafmadrasah->delete();

            return redirect()->route('stafmadrasah.index')->with('success', 'Staff berhasil dihapus permanen.');
        }
    }

    public function approval()
    {
        $staff = StaffMadrasah::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('manage3landing.madrasah.staff.index', compact('staff'));
    }

    public function approve($id)
    {
        $staff = StaffMadrasah::findOrFail($id);

        if ($staff->new_gambar) {
            if ($staff->image && Storage::disk('public')->exists($staff->image)) {
                Storage::disk('public')->delete($staff->image);
            }
            $staff->update([
                'image' => $staff->new_gambar,
                'new_gambar' => null,
            ]);
        }

        $staff->update([
            'status' => 'approved',
            'previous_data' => null,
        ]);

        return back()->with('success', 'Data staff disetujui.');
    }

    public function reject($id)
    {
        $staff = StaffMadrasah::findOrFail($id);

        if ($staff->previous_data) {
            $old = json_decode($staff->previous_data, true);

            $staff->update([
                'name' => $old['name'],
                'position' => $old['position'],
                'description' => $old['description'],
                'previous_data' => null,
            ]);
        }

        if ($staff->new_gambar && Storage::disk('public')->exists($staff->new_gambar)) {
            Storage::disk('public')->delete($staff->new_gambar);
        }

        $staff->update([
            'new_gambar' => null,
            'status' => 'approved',
        ]);

        return back()->with('success', 'Perubahan staff ditolak dan dikembalikan ke data lama.');
    }

    public function approveDelete($id)
    {
        $staff = StaffMadrasah::findOrFail($id);

        if ($staff->image && Storage::disk('public')->exists($staff->image)) {
            Storage::disk('public')->delete($staff->image);
        }

        $staff->delete();

        return back()->with('success', 'Penghapusan staff disetujui.');
    }

    public function rejectDelete($id)
    {
        $staff = StaffMadrasah::findOrFail($id);

        $staff->update(['status' => 'approved']);

        return back()->with('success', 'Penghapusan staff ditolak, data tetap ada.');
    }
}
