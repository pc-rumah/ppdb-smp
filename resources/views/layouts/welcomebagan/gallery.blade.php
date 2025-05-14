<section id="gallery" class="py-20 bg-primary">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16">School Gallery</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="lightgallery">
            <!-- Gallery Item 1 -->
            @foreach ($galeri as $item)
                <a href="{{ asset('storage/' . $item->gambar) }}" class="gallery-item"
                    data-sub-html="{{ $item->judul }}<p>{{ $item->deskripsi }}</p>">
                    <div class="card bg-base-100 shadow-xl">
                        <figure><img style="width:80%;height:300px;" src="{{ asset('storage/' . $item->gambar) }}"
                                alt="Science Fair" />
                        </figure>
                        <div class="card-body">
                            <h3 class="card-title">{{ $item->judul }}</h3>
                            <p>{{ Str::limit($item->deskripsi, 100) }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="#" class="btn bg-secondary hover:bg-secondary/80">View All Galleries</a>
        </div>
</section>
