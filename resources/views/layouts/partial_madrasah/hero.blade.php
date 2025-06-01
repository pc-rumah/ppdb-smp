<section id="beranda" class="hero min-h-screen nord-gradient hero-pattern">
    <div class="hero-content flex-col lg:flex-row-reverse">
        <img src="{{ asset('storage/' . ($cover->cover_madrasah ?? '')) }}"
            onerror="this.onerror=null;this.src='https://placehold.co/600x400';"
            class="max-w-sm rounded-lg shadow-2xl mx-auto" alt="SMP Negeri 1 Harapan" />
        <div class="text-black">
            <h1 class="text-5xl font-bold mb-6">{{ $cover->judul_madrasah ?? 'ini judul' }}</h1>
            <p class="text-xl mb-6 leading-relaxed">
                {{ $cover->deskripsi_madrasah ?? 'ini deskripsi' }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <button class="btn btn-accent btn-lg">Pelajari Lebih Lanjut</button>
            </div>
        </div>
    </div>
</section>
