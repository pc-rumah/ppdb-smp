<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Staff;
use App\Models\Galeri;
use App\Models\Welcome;
use App\Models\Announcement;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $welcome = Welcome::first();
        $staf = Staff::latest()->take(4)->get();
        $event = Event::latest()->take(3)->get();
        $pengumuman = Announcement::latest()->take(3)->get();
        $galeri = Galeri::latest()->take(6)->get();
        if (!$welcome) {
            return view('welcome', ['slides' => [
                [
                    'title' => 'Selamat Datang di Sekolah Kami',
                    'description' => 'Ini adalah deskripsi dummy slide pertama.',
                    'image' => 'images/dummy1.jpg',
                ],
                [
                    'title' => 'Fasilitas Lengkap dan Modern',
                    'description' => 'Ini adalah deskripsi dummy slide kedua.',
                    'image' => 'images/dummy2.jpg',
                ],
                [
                    'title' => 'Lingkungan Nyaman untuk Belajar',
                    'description' => 'Ini adalah deskripsi dummy slide ketiga.',
                    'image' => 'images/dummy3.jpg',
                ]
            ], 'welcome' => null]);
        }

        // Buat array slide dari title1-title3, image1-image3, dll
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
            'staf' => $staf,
            'galeri' => $galeri,
            'event' => $event,
            'pengumuman' => $pengumuman,
            'slides' => $slides,
            'welcome' => $welcome // Untuk bagian about, contact, dll
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

            'about_description' => 'string',
            'about_image' => 'image|mimes:jpg,jpeg,png|max:2048',

            'address' => 'string|max:255',
            'phone' => 'string|max:255',
            'email' => 'email|max:255',
        ]);

        $welcome = Welcome::first();

        // Simpan data teks ke dalam array
        $data = [
            'title1' => $request->title1,
            'description1' => $request->description1,
            'title2' => $request->title2,
            'description2' => $request->description2,
            'title3' => $request->title3,
            'description3' => $request->description3,
            'about_description' => $request->about_description,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
        ];

        // Handle file upload (hanya jika diisi)
        if ($request->hasFile('image1')) {
            $data['image1'] = $request->file('image1')->store('images', 'public');
        }
        if ($request->hasFile('image2')) {
            $data['image2'] = $request->file('image2')->store('images', 'public');
        }
        if ($request->hasFile('image3')) {
            $data['image3'] = $request->file('image3')->store('images', 'public');
        }
        if ($request->hasFile('about_image')) {
            $data['about_image'] = $request->file('about_image')->store('images', 'public');
        }

        // Jika belum ada data: create
        if (!$welcome) {
            Welcome::create($data);
            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        }

        // Jika sudah ada data: update
        $welcome->update($data);
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
}
