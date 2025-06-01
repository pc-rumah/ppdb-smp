<section id="beranda" class="hero min-h-screen pondok-gradient islamic-pattern">
    <div class="hero-content flex-col lg:flex-row">
        <div class="text-white lg:w-1/2">
            <h1 class="text-5xl font-bold mb-6">{{ $cover->judul_pondok ?? 'ini judul' }}</h1>
            <p class="text-xl mb-6 leading-relaxed">
                {{ $cover->deskripsi_pondok ?? 'ini deskripsi' }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="/" class="btn btn-accent btn-lg">Bergabung Bersama Kami</a>
            </div>
        </div>
        <div class="lg:w-1/2">
            <img src="{{ asset('storage/' . ($cover->cover_pondok ?? '')) }}"
                onerror="this.onerror=null;this.src='https://placehold.co/600x400';"
                class="max-w-sm rounded-lg shadow-2xl mx-auto" alt="gambar" />
        </div>
    </div>
</section>
