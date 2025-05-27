<section id="about" class="py-20 bg-neutral">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16">Unit Sekolah Kami</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $unitList = [
                    [
                        'judul' => 'Sekolah',
                        'deskripsi' => 'Halaman Sekolah',
                        'warna' => 'bg-blue-500',
                        'url' => '/landing/sekolah',
                        'icon' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-10.922L12 14z" /></svg>',
                    ],
                    [
                        'judul' => 'Madrasah',
                        'deskripsi' => 'Halaman Madrasah',
                        'warna' => 'bg-green-500',
                        'url' => '/landing/madrasah',
                        'icon' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>',
                    ],
                    [
                        'judul' => 'Ponpes',
                        'deskripsi' => 'Halaman Ponpes',
                        'warna' => 'bg-purple-500',
                        'url' => '/landing/pondok',
                        'icon' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4v11H3zM17 10h4v11h-4zM10 3h4v18h-4z" /></svg>',
                    ],
                    [
                        'judul' => 'PPDB',
                        'deskripsi' => 'Penerimaan Peserta Didik Baru online',
                        'warna' => 'bg-orange-500',
                        'url' => '/',
                        'icon' =>
                            '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A11.952 11.952 0 0012 20c2.04 0 3.953-.51 5.633-1.404M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>',
                    ],
                ];
            @endphp

            @foreach ($unitList as $unit)
                <div class="card bg-base-100 shadow-md border hover:shadow-lg transition duration-300">
                    <div class="flex flex-col items-center text-center p-6">
                        <div class="rounded-full p-4 mb-4 text-white {{ $unit['warna'] }}">
                            {!! $unit['icon'] !!}
                        </div>
                        <h3 class="text-xl font-bold mb-2">{{ $unit['judul'] }}</h3>
                        <p class="text-sm text-gray-500 mb-4">{{ $unit['deskripsi'] }}</p>
                        <a href="{{ $unit['url'] }}"
                            class="btn w-full text-white {{ $unit['warna'] }} hover:opacity-90">
                            Akses {{ $unit['judul'] }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
