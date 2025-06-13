<section id="hero" class="hero-carousel">
    <!-- Swiper Carousel -->
    <div class="swiper heroSwiper h-screen">
        <div class="swiper-wrapper">
            @foreach ($slides as $item)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $item['image']) }}" alt="School Campus"
                        class="w-full h-full object-cover" loading="lazy">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-center justify-center">
                        <div class="text-white p-8 text-center max-w-3xl">
                            <h1 class="text-3xl md:text-6xl font-bold mb-5">{{ $item['title'] }}</h1>
                            <p class="text-xl md:text-2xl mb-8">{{ $item['description'] }}</p>
                            <div class="flex flex-col sm:flex-row justify-center gap-4">
                                <a href="/formppdb"
                                    class="btn btn-lg bg-secondary hover:bg-secondary/80 text-white border-none">Daftar
                                    Sekarang</a>
                                <a href="#about"
                                    class="btn btn-lg btn-outline text-white hover:bg-white hover:text-black border-white">Tentang
                                    Kami</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Add navigation arrows -->
        <div class="swiper-button-next text-white"></div>
        <div class="swiper-button-prev text-white"></div>
        <!-- Add pagination dots -->
        <div class="swiper-pagination"></div>
    </div>
</section>
