<section id="pengasuh" class="py-20 bg-base-200">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Staff Madrasah</h2>
            <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
                Para ulama dan kiai yang memimpin dan membimbing santri dengan penuh dedikasi
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($guru as $item)
                <div class="card staff-card shadow-lg">
                    <figure class="px-6 pt-6">
                        <div class="avatar">
                            <div class="w-32 rounded-full">
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
