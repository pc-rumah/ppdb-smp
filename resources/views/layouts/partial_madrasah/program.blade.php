<section id="program" class="py-20 bg-base-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Program Madrasah</h2>
            <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
                Program unggulan yang dirancang untuk mengembangkan potensi siswa secara optimal
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($program as $item)
                <div class="card bg-base-200 shadow-xl card-hover">
                    <div class="card-body">
                        <div class="text-primary text-4xl mb-4">
                            <i class="{{ $item->icon }}"></i>
                        </div>
                        <h3 class="card-title text-xl">{{ $item->title }}</h3>
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
            @empty
                <h2>tidak ada data</h2>
            @endforelse
        </div>
    </div>
</section>
