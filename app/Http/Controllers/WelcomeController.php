<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Kontak;
use App\Models\Welcome;
use App\Models\Announcement;
use App\Models\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $welcome = Cache::remember('landing_welcome', 60 * 60, function () {
            $w = Welcome::firstOrNew([]);
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
                if (empty($w->$key)) {
                    $w->$key = $value;
                }
            }

            return $w;
        });

        $kontak = Cache::remember('landing_kontak', 60 * 60, fn() => Kontak::first());
        $event = Cache::remember('landing_event', 60 * 10, fn() => Event::latest()->take(3)->get());
        $pengumuman = Cache::remember('landing_pengumuman', 60 * 10, fn() => Announcement::latest()->take(3)->get());

        $slides = $this->prepareSlides($welcome);
        $cover = Cover::first();
        return view('welcome', compact('event', 'pengumuman', 'cover', 'slides', 'kontak', 'welcome'));
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

        Cache::forget('landing_welcome');

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
