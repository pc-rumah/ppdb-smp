<section id="beranda" class="hero min-h-[80vh] school-gradient geometric-pattern">
    <div class="hero-content flex-col lg:flex-row-reverse">
        <div class="lg:w-1/2 floating-animation">
            <img src="{{ asset('storage/' . $cover->cover_smp) }}" class="max-w-sm rounded-lg shadow-2xl mx-auto"
                alt="SMP Negeri 1 Harapan" />
        </div>
        <div class="text-black lg:w-1/2">
            <h1 class="text-5xl font-bold mb-6">{{ $cover->judul_smp }}</h1>
            <p class="text-xl mb-6 leading-relaxed">
                {{ $cover->deskripsi_smp }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#staf" class="btn btn-accent btn-lg">Jelajahi Sekolah</a>
            </div>
        </div>
    </div>
</section>
