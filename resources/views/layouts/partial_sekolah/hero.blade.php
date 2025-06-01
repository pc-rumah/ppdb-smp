<section id="beranda" class="hero min-h-[80vh] school-gradient geometric-pattern">
    <div class="hero-content flex-col lg:flex-row-reverse">
        <div class="lg:w-1/2 floating-animation">
            <img src="{{ asset('storage/' . ($cover->cover_smp ?? '')) }}"
                onerror="this.onerror=null;this.src='https://placehold.co/600x400';"
                class="max-w-sm rounded-lg shadow-2xl mx-auto" alt="SMP Negeri 1 Harapan" />
        </div>
        <div class="text-black lg:w-1/2">
            <h1 class="text-5xl font-bold mb-6">{{ $cover->judul_smp ?? 'ini judul' }}</h1>
            <p class="text-xl mb-6 leading-relaxed">
                {{ $cover->deskripsi_smp ?? 'ini deskripsi' }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#staf" class="btn btn-accent btn-lg">Jelajahi Sekolah</a>
            </div>
        </div>
    </div>
</section>
