<section id="prestasi" class="py-20 bg-base-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Prestasi Sekolah</h2>
            <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
                Pencapaian membanggakan yang diraih siswa-siswi SMP Negeri 1 Harapan
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($prestasi as $item)
                <div class="card text-white shadow-xl" style="background-color: {{ $item->background_color }}">
                    <div class="card-body items-center text-center">
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Piala" class="w-44 h-44">
                        </div>
                        <h3 class="card-title text-lg">{{ $item->juara }}</h3>
                        <p class="text-sm">{{ $item->title }}</p>
                        <p class="text-xs opacity-80">{{ $item->subjudul }}</p>
                    </div>
                </div>
            @empty
                <h2>Tidak ada data</h2>
            @endforelse

        </div>
    </div>
</section>
