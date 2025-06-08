<section id="program" class="py-20 bg-base-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Program Pondok</h2>
            <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
                Program pendidikan yang mengacu pada tradisi pesantren salafiyah
            </p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @forelse ($program as $item)
                <div class="card bg-gradient-to-br from-primary to-primary-focus text-primary-content shadow-xl">
                    <div class="card-body flex flex-row items-start justify-between gap-4">
                        <div>
                            <h3 class="card-title text-2xl mb-4">
                                <i class="fas fa-book-open mr-2"></i>
                                {{ $item->nama }}
                            </h3>
                            <ul class="space-y-2">
                                @forelse ($item->kategori as $kategori)
                                    <li class="flex items-center">
                                        <i class="fas fa-check mr-2"></i>{{ $kategori->nama }}
                                    </li>
                                @empty
                                    <li class="text-sm italic">Tidak ada kategori</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="flex-shrink-0">
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Kitab Image"
                                class="w-32 h-auto rounded shadow-lg">
                        </div>
                    </div>
                </div>
            @empty
                <h2>Tidak ada program</h2>
            @endforelse

        </div>
    </div>
</section>
