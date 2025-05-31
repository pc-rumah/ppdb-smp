<section id="kegiatan" class="py-20 bg-base-200">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Kegiatan Pondok</h2>
            <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
                Aktivitas harian dan mingguan yang membentuk karakter santri
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card 1 -->
            @forelse ($kegiatan as $item)
                <div class="card bg-base-100 shadow-xl">
                    <figure>
                        <img src="{{ asset('storage/' . $item->image) }}" alt="Ilustrasi Qiyamul Lail" />
                    </figure>
                    <div class="card-body">
                        <h3 class="card-title text-primary">
                            {{ \Carbon\Carbon::parse($item->time)->format('H:i') }} – {{ $item->title }}
                        </h3>

                        <p>{{ $item->description }}</p>
                    </div>
                </div>
            @empty
                <h2>tidak ada data</h2>
            @endforelse
        </div>
    </div>
</section>
