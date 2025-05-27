<section id="beranda" class="hero min-h-screen nord-gradient hero-pattern">
    <div class="hero-content flex-col lg:flex-row-reverse">
        <img src="{{ asset('storage/' . $cover->cover_madrasah) }}" class="max-w-sm rounded-lg shadow-2xl"
            alt="gambar" />
        <div class="text-black">
            <h1 class="text-5xl font-bold mb-6">{{ $cover->judul_madrasah }}</h1>
            <p class="text-xl mb-6 leading-relaxed">
                {{ $cover->deskripsi_madrasah }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <button class="btn btn-accent btn-lg">Pelajari Lebih Lanjut</button>
            </div>
        </div>
    </div>
</section>
