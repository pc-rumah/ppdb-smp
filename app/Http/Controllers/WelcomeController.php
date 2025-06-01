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
        $welcome = Welcome::firstOrNew([]);
        $kontak = Kontak::first();
        $event = Event::latest()->take(3)->get();
        $pengumuman = Announcement::latest()->take(3)->get();
        $galeri = Galeri::latest()->take(6)->get();

        $defaultWelcome = [
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

        foreach ($defaultWelcome as $key => $value) {
            if (empty($welcome->$key)) {
                $welcome->$key = $value;
            }
        }

        $slides = $this->prepareSlides($welcome);

        return view('welcome', compact(
            'galeri',
            'event',
            'pengumuman',
            'slides',
            'kontak',
            'welcome'
        ));
    }

    protected function prepareSlides($welcome)
    {
        return [
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
    }

    public function create()
    {
        $welcome = Welcome::first();
        return view('managelanding.create', compact('welcome'));
    }

    public function store(Request $request)
    {
        $this->validateWelcomeData($request);

        $data = $this->prepareWelcomeData($request);

        $welcome = Welcome::firstOrNew([]);
        $action = $welcome->exists ? 'diperbarui' : 'ditambahkan';

        $welcome->fill($data)->save();

        return redirect()->back()->with('success', "Data berhasil $action.");
    }

    protected function validateWelcomeData(Request $request)
    {
        $rules = [];

        for ($i = 1; $i <= 3; $i++) {
            $rules["title$i"] = 'string|max:255';
            $rules["description$i"] = 'string|max:255';
            $rules["image$i"] = 'image|mimes:jpg,jpeg,png|max:2048';
        }

        $request->validate($rules);
    }

    protected function prepareWelcomeData(Request $request)
    {
        $data = [];

        for ($i = 1; $i <= 3; $i++) {
            $data["title$i"] = $request->input("title$i");
            $data["description$i"] = $request->input("description$i");

            if ($request->hasFile("image$i")) {
                $data["image$i"] = $request->file("image$i")->store('images', 'public');
            }
        }

        return $data;
    }
}
