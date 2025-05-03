<!-- Gallery Section with Cards -->
<section id="gallery" class="py-16 gradient-accent">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-purple-800">School Gallery</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Gallery Card 1 -->
            @foreach ($galeri as $item)
                <div class="card gradient-card soft-shadow">
                    <figure>
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="Classroom"
                            class="w-full h-48 object-cover">
                    </figure>
                    <div class="card-body">
                        <h3 class="card-title text-purple-700">{{ $item->judul }}</h3>
                        <p class="text-gray-600">{{ $item->deskripsi }}</p>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
