<section id="about" class="py-20 bg-neutral">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16">Unit Sekolah Kami</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $unitList = [
                    [
                        'judul' => 'Sekolah',
                        'deskripsi' => 'Halaman Sekolah',
                        'warna' => 'bg-green-600',
                        'url' => '/landing/sekolah',
                        'icon' => $cover->logo_smp ? asset('storage/' . $cover->logo_smp) : null,
                    ],
                    [
                        'judul' => 'Madrasah',
                        'deskripsi' => 'Halaman Madrasah',
                        'warna' => 'bg-blue-500',
                        'url' => '/landing/madrasah',
                        'icon' => $cover->logo_madrasah ? asset('storage/' . $cover->logo_madrasah) : null,
                    ],
                    [
                        'judul' => 'Ponpes',
                        'deskripsi' => 'Halaman Ponpes',
                        'warna' => 'bg-yellow-500',
                        'url' => '/landing/pondok',
                        'icon' => $cover->logo_pondok ? asset('storage/' . $cover->logo_pondok) : null,
                    ],
                    [
                        'judul' => 'PPDB',
                        'deskripsi' => 'Penerimaan Peserta Didik Baru online',
                        'warna' => 'bg-orange-500',
                        'url' => '/ppdb',
                        'icon' => '',
                    ],
                ];
            @endphp

            @foreach ($unitList as $unit)
                <div class="card bg-base-100 shadow-md border hover:shadow-lg transition duration-300">
                    <div class="flex flex-col items-center text-center p-6">
                        <div class="rounded-full p-4 mb-4 {{ $unit['warna'] }}">
                            @if (!empty($unit['icon']))
                                <img src="{{ $unit['icon'] }}" alt="{{ $unit['judul'] }}" class="h-8 w-8 object-contain"
                                    loading="lazy">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            @endif
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
