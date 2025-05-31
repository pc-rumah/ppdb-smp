<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Event;
use App\Models\Staff;
use App\Models\Galeri;
use App\Models\Welcome;
use App\Models\Announcement;
use App\Models\Kontak;
use App\Models\Madrasah;
use App\Models\Pondok;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $welcome = Welcome::first();
        $kontak = Kontak::first();
        $event = Event::latest()->take(3)->get();
        $pengumuman = Announcement::latest()->take(3)->get();
        $galeri = Galeri::latest()->take(6)->get();
        if (!$welcome) {

            $welcome = (object)[
                'title1' => 'Selamat Datang di Sekolah Kami',
                'description1' => 'Ini adalah deskripsi dummy slide pertama.',
                'image1' => '',
                'title2' => 'Fasilitas Lengkap dan Modern',
                'description2' => 'Ini adalah deskripsi dummy slide kedua.',
                'image2' => '',
                'title3' => 'Lingkungan Nyaman untuk Belajar',
                'description3' => 'Ini adalah deskripsi dummy slide ketiga.',
                'image3' => '',
            ];
        }

        $slides = [
            [
                'title' => $welcome->title1,
                'description' => $welcome->description1,
                'image' => $welcome->image1,
            ],
            [
                'title' => $welcome->title2,
                'description' => $welcome->description2,
                'image' => $welcome->image2,
            ],
            [
                'title' => $welcome->title3,
                'description' => $welcome->description3,
                'image' => $welcome->image3,
            ],
        ];

        return view('welcome', [
            'galeri' => $galeri,
            'event' => $event,
            'pengumuman' => $pengumuman,
            'slides' => $slides,
            'kontak' => $kontak,
            'welcome' => $welcome
        ]);
    }


    public function create()
    {
        $welcome = Welcome::first();
        return view('managelanding.create', compact('welcome'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image1' => 'image|mimes:jpg,jpeg,png|max:2048',
            'description1' => 'string|max:255',
            'title1' => 'string|max:255',

            'image2' => 'image|mimes:jpg,jpeg,png|max:2048',
            'description2' => 'string|max:255',
            'title2' => 'string|max:255',

            'image3' => 'image|mimes:jpg,jpeg,png|max:2048',
            'description3' => 'string|max:255',
            'title3' => 'string|max:255',
        ]);

        $welcome = Welcome::first();

        $data = [
            'title1' => $request->title1,
            'description1' => $request->description1,
            'title2' => $request->title2,
            'description2' => $request->description2,
            'title3' => $request->title3,
            'description3' => $request->description3,
        ];

        if ($request->hasFile('image1')) {
            $data['image1'] = $request->file('image1')->store('images', 'public');
        }
        if ($request->hasFile('image2')) {
            $data['image2'] = $request->file('image2')->store('images', 'public');
        }
        if ($request->hasFile('image3')) {
            $data['image3'] = $request->file('image3')->store('images', 'public');
        }

        if (!$welcome) {
            Welcome::create($data);
            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        }

        $welcome->update($data);
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
}
