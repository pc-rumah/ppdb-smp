<section id="prestasi" class="py-20 bg-base-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Prestasi Madrasah</h2>
            <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
                Pencapaian membanggakan yang diraih siswa-siswi Madrasah Al-Hikmah
            </p>
        </div>
        @php
            $gradients = [
                ['from' => 'from-pink-500', 'to' => 'to-pink-700'],
                ['from' => 'from-blue-500', 'to' => 'to-blue-700'],
                ['from' => 'from-green-500', 'to' => 'to-green-700'],
                ['from' => 'from-purple-500', 'to' => 'to-purple-700'],
                ['from' => 'from-yellow-500', 'to' => 'to-yellow-700'],
                ['from' => 'from-red-500', 'to' => 'to-red-700'],
                ['from' => 'from-indigo-500', 'to' => 'to-indigo-700'],
                ['from' => 'from-cyan-500', 'to' => 'to-cyan-700'],
            ];
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse ($prestasi as $item)
                @php
                    $randomGradient = $gradients[array_rand($gradients)];
                @endphp
                <div
                    class="stat bg-gradient-to-br {{ $randomGradient['from'] }} {{ $randomGradient['to'] }} text-primary-content rounded-lg p-4 flex flex-col items-center">
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Trophy"
                            class="w-32 h-32 object-cover rounded-full shadow-md" />
                    </div>
                    <div class="text-center text-black">
                        <div class="stat-title text-primary-content/70">{{ $item->gelar }}</div>
                        <div class="text-lg">{{ $item->nama_kegiatan }}</div>
                        <div class="stat-desc text-primary-content/70">{{ $item->tingkat }}</div>
                    </div>
                </div>
            @empty
                <h2>tidak ada data</h2>
            @endforelse
        </div>

    </div>
</section>
