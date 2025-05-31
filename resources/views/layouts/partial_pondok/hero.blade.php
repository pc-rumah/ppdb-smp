<section id="beranda" class="hero min-h-screen pondok-gradient islamic-pattern">
    <div class="hero-content flex-col lg:flex-row">
        <div class="text-white lg:w-1/2">
            <h1 class="text-5xl font-bold mb-6">{{ $cover->judul_pondok }}</h1>
            <p class="text-xl mb-6 leading-relaxed">
                {{ $cover->deskripsi_pondok }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <button class="btn btn-accent btn-lg">Bergabung Bersama Kami</button>
            </div>
        </div>
        <div class="lg:w-1/2">
            <img src="{{ asset('storage/' . $cover->cover_pondok) }}" class="max-w-sm rounded-lg shadow-2xl mx-auto"
                alt="Pondok Pesantren" />
        </div>
    </div>
</section>
