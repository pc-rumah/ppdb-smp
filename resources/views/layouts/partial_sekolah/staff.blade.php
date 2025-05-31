<section id="staf" class="scroll-mt-28 py-20 bg-base-100 mt-20 relative z-10">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Staf & Guru</h2>
            <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
                Tim pendidik profesional dan berpengalaman yang berkomitmen untuk memberikan pendidikan terbaik
            </p>
        </div>
        <!-- Kepala Sekolah -->
        <div class="mb-16">
            <div class="card lg:card-side bg-base-200 shadow-xl max-w-4xl mx-auto">
                <figure class="lg:w-1/3">
                    <img src="{{ asset('storage/' . $kepsek->image_kepsek) }}" alt="Kepala Sekolah"
                        class="w-full h-64 lg:h-full object-cover" />
                </figure>
                <div class="card-body lg:w-2/3">
                    <h3 class="card-title text-2xl">{{ $kepsek->nama_kepsek }}</h3>
                    <p class="text-lg text-primary font-semibold">Kepala Sekolah</p>
                    <p class="text-base-content/80 leading-relaxed">
                        {{ $kepsek->description_kepsek }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Guru-guru -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($staff as $item)
                <div class="card staff-card shadow-lg">
                    <figure class="px-6 pt-6">
                        <div class="avatar">
                            <div class="w-24 rounded-full">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="Guru Matematika" />
                            </div>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-lg">{{ $item->name }}</h3>
                        <p class="text-sm text-primary">{{ $item->position }}</p>
                        <p class="text-xs text-base-content/70">{{ $item->description }}</p>
                    </div>
                </div>
            @empty
                <h2>tidak ada data</h2>
            @endforelse

        </div>
    </div>
</section>
