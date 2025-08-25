<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use App\Models\AnnouncementSmp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementSmpController extends Controller
{
    public function index()
    {
        $pengumumansmp = AnnouncementSmp::paginate(5);
        return view('sekolah.pengumuman.index', compact('pengumumansmp'));
    }

    public function create()
    {
        return view('sekolah.pengumuman.create');
    }

    public function store(AnnouncementRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pengumumansmp', 'public');
        }

        $data['status'] = auth()->user()->hasRole('master-admin') ? 'approved' : 'pending';

        AnnouncementSmp::create($data);

        return redirect()->route('pengumumansmp.index')->with('success', 'Pengumuman diajukan.');
    }


    public function edit(AnnouncementSmp $pengumumansmp)
    {
        return view('sekolah.pengumuman.edit', compact('pengumumansmp'));
    }

    public function update(AnnouncementRequest $request, AnnouncementSmp $pengumumansmp)
    {
        $data = $request->validated();
        $newImage = $pengumumansmp->new_gambar;

        if ($request->hasFile('gambar')) {
            $newImage = $request->file('gambar')->store('pengumumansmp', 'public');
        }

        if (auth()->user()->hasRole('staff')) {
            $pengumumansmp->update([
                'previous_data' => json_encode([
                    'judul' => $pengumumansmp->judul,
                    'tanggal' => $pengumumansmp->tanggal,
                    'deskripsi' => $pengumumansmp->deskripsi,
                ]),
                'judul' => $data['judul'],
                'tanggal' => $data['tanggal'],
                'deskripsi' => $data['deskripsi'],
                'new_gambar' => $newImage,
                'status' => 'pending',
            ]);
        } else {
            if ($newImage) {
                if ($pengumumansmp->gambar && Storage::disk('public')->exists($pengumumansmp->gambar)) {
                    Storage::disk('public')->delete($pengumumansmp->gambar);
                }
                $pengumumansmp->gambar = $newImage;
                $pengumumansmp->new_gambar = null;
            }

            $pengumumansmp->update([
                'judul' => $data['judul'],
                'tanggal' => $data['tanggal'],
                'deskripsi' => $data['deskripsi'],
                'status' => 'approved',
                'previous_data' => null,
            ]);
        }

        return redirect()->route('pengumumansmp.index')->with('success', 'Pengumuman diajukan.');
    }

    public function destroy(AnnouncementSmp $pengumumansmp)
    {
        if (auth()->user()->hasRole('staff')) {
            $pengumumansmp->update(['status' => 'pending-delete']);
            return redirect()->back()->with('success', 'Permintaan hapus diajukan.');
        }

        if ($pengumumansmp->gambar && Storage::disk('public')->exists($pengumumansmp->gambar)) {
            Storage::disk('public')->delete($pengumumansmp->gambar);
        }

        $pengumumansmp->delete();
        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus permanen.');
    }

    public function approval()
    {
        $pengumumansmp = AnnouncementSmp::whereIn('status', ['pending', 'pending-delete'])->paginate(5);
        return view('sekolah.pengumuman.index', compact('pengumumansmp'));
    }

    public function approve($id)
    {
        $pengumuman = AnnouncementSmp::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
        ];

        if ($pengumuman->new_gambar) {
            if ($pengumuman->gambar && Storage::disk('public')->exists($pengumuman->gambar)) {
                Storage::disk('public')->delete($pengumuman->gambar);
            }
            $updateData['gambar'] = $pengumuman->new_gambar;
            $updateData['new_gambar'] = null;
        }

        $pengumuman->update($updateData);

        return back()->with('success', 'Pengumuman disetujui.');
    }

    public function reject($id)
    {
        $pengumuman = AnnouncementSmp::findOrFail($id);

        $updateData = [
            'status' => 'approved',
            'previous_data' => null,
            'new_gambar' => null,
        ];

        if ($pengumuman->previous_data) {
            $old = json_decode($pengumuman->previous_data, true);
            $updateData['judul'] = $old['judul'];
            $updateData['tanggal'] = $old['tanggal'];
            $updateData['deskripsi'] = $old['deskripsi'];
        }

        if ($pengumuman->new_gambar && Storage::disk('public')->exists($pengumuman->new_gambar)) {
            Storage::disk('public')->delete($pengumuman->new_gambar);
        }

        $pengumuman->update($updateData);

        return back()->with('success', 'Perubahan pengumuman ditolak dan dikembalikan.');
    }

    public function approveDelete($id)
    {
        $pengumuman = AnnouncementSmp::findOrFail($id);

        if ($pengumuman->gambar && Storage::disk('public')->exists($pengumuman->gambar)) {
            Storage::disk('public')->delete($pengumuman->gambar);
        }

        $pengumuman->delete();

        return back()->with('success', 'Penghapusan pengumuman disetujui.');
    }

    public function rejectDelete($id)
    {
        $pengumuman = AnnouncementSmp::findOrFail($id);
        $pengumuman->update(['status' => 'approved']);

        return back()->with('success', 'Penghapusan ditolak, data tetap ada.');
    }
}
