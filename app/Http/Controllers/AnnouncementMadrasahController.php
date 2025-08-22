<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementMadrasah;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AnnouncementRequest;

class AnnouncementMadrasahController extends Controller
{
    public function index()
    {
        $data = AnnouncementMadrasah::paginate(5);
        return view('manage3landing.madrasah.pengumuman.index', compact('data'));
    }

    public function create()
    {
        return view('manage3landing.madrasah.pengumuman.create');
    }

    public function store(AnnouncementRequest $request)
    {
        $data = $request->validated();
        $data['status'] = auth()->user()->hasRole('master-admin') ? 'approved' : 'pending';

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengumumanmadrasah', 'public');
        }

        AnnouncementMadrasah::create($data);

        return redirect()->route('pengumumanmadrasah.index')->with('success', 'Pengumuman diajukan.');
    }

    public function edit(AnnouncementMadrasah $pengumumanmadrasah)
    {
        return view('manage3landing.madrasah.pengumuman.edit', compact('pengumumanmadrasah'));
    }

    public function update(AnnouncementRequest $request, AnnouncementMadrasah $pengumumanmadrasah)
    {
        $data = $request->validated();
        $data = $request->only(['judul', 'tanggal', 'deskripsi']);
        $newimage = $pengumumanmadrasah->new_gambar;

        if ($request->hasFile('gambar')) {
            $newimage = $request->file('gambar')->store('pengumumanmadrasah', 'public');
        }

        if (auth()->user()->hasRole('madrasah')) {
            $pengumumanmadrasah->update([
                'previous_data' => json_encode([
                    'judul' => $pengumumanmadrasah->judul,
                    'tanggal' => $pengumumanmadrasah->tanggal,
                    'deskripsi' => $pengumumanmadrasah->deskripsi,
                ]),
                'judul' => $data['judul'],
                'tanggal' => $data['tanggal'],
                'deskripsi' => $data['deskripsi'],
                'new_gambar' => $newimage,
                'status' => 'pending',
            ]);
        } else {
            if ($newimage) {
                if ($pengumumanmadrasah->gambar && Storage::disk('public')->exists($pengumumanmadrasah->gambar)) {
                    Storage::disk('public')->delete($pengumumanmadrasah->gambar);
                }
                $pengumumanmadrasah->gambar = $newimage;
                $pengumumanmadrasah->new_gambar = null;
            }

            $pengumumanmadrasah->update([
                'judul' => $data['judul'],
                'tanggal' => $data['tanggal'],
                'deskripsi' => $data['deskripsi'],
                'status' => 'approved',
                'previous_data' => null,
            ]);
        }


        return redirect()->route('pengumumanmadrasah.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(AnnouncementMadrasah $pengumumanmadrasah)
    {
        if (auth()->user()->hasRole('madrasah')) {
            $pengumumanmadrasah->update([
                'status' => 'pending-delete'
            ]);
            return redirect()->back()->with('success', 'Penghapusan diajukan');
        }

        if (auth()->user()->hasRole('master-admin')) {
            if ($pengumumanmadrasah->gambar && Storage::disk('public')->exists($pengumumanmadrasah->gambar)) {
                Storage::disk('public')->delete($pengumumanmadrasah->gambar);
            }

            $pengumumanmadrasah->delete();
            return redirect()->back()->with('success', 'Berhasil Menghapus');
        }
    }

    public function approval()
    {
        $data = AnnouncementMadrasah::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('manage3landing.madrasah.pengumuman.index', compact('data'));
    }

    public function approve($id)
    {
        $pengumumanmadrasah = AnnouncementMadrasah::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
        ];

        if ($pengumumanmadrasah->new_gambar) {
            if ($pengumumanmadrasah->gambar && Storage::disk('public')->exists($pengumumanmadrasah->gambar)) {
                Storage::disk('public')->delete($pengumumanmadrasah->gambar);
            }
            $updateData['gambar'] = $pengumumanmadrasah->new_gambar;
            $updateData['new_gambar'] = null;
        }

        $pengumumanmadrasah->update($updateData);

        return back()->with('success', 'Pengumuman disetujui.');
    }

    public function reject($id)
    {
        $pengumumanmadrasah = AnnouncementMadrasah::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
            'new_gambar' => null,
        ];

        if ($pengumumanmadrasah->previous_data) {
            $old = json_decode($pengumumanmadrasah->previous_data, true);
            $updateData['judul'] = $old['judul'];
            $updateData['tanggal'] = $old['tanggal'];
            $updateData['deskripsi'] = $old['deskripsi'];
        }

        if ($pengumumanmadrasah->new_gambar && Storage::disk('public')->exists($pengumumanmadrasah->new_gambar)) {
            Storage::disk('public')->delete($pengumumanmadrasah->new_gambar);
        }

        $pengumumanmadrasah->update($updateData);

        return back()->with('success', 'Perubahan ditolak, data dikembalikan.');
    }

    public function approveDelete($id)
    {
        $pengumumanmadrasah = AnnouncementMadrasah::findOrFail($id);

        if ($pengumumanmadrasah->gambar && Storage::disk('public')->exists($pengumumanmadrasah->gambar)) {
            Storage::disk('public')->delete($pengumumanmadrasah->gambar);
        }

        $pengumumanmadrasah->delete();
        return back()->with('success', 'Penghapusan event disetujui.');
    }

    public function rejectDelete($id)
    {
        $pengumumanmadrasah = AnnouncementMadrasah::findOrFail($id);

        $pengumumanmadrasah->update(['status' => 'approved']);

        return back()->with('success', 'Penghapusan ditolak, data tetap ada.');
    }
}
