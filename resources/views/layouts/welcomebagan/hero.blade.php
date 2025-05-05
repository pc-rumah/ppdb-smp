<!-- Hero Section with Carousel -->
<section id="home" class="pt-20">
    <div class="swiper mySwiper h-[500px] md:h-[600px]">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            @foreach ($slides as $item)
                <div class="swiper-slide relative">
                    <img src="{{ asset('storage/' . $item['image']) }}" alt="gammbar carousel"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r flex items-center justify-center">
                        <div class="text-center text-white px-4">
                            <h2 class="text-4xl md:text-6xl font-bold mb-4">{{ $item['title'] }}</h2>
                            <p class="text-xl md:text-2xl mb-8">{{ $item['description'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next text-white"></div>
        <div class="swiper-button-prev text-white"></div>
    </div>
</section>
