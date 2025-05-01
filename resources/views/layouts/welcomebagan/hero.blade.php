<!-- Hero Section with Carousel -->
<section id="home" class="w-full">
    <div class="swiper w-full h-[500px]">
        <div class="swiper-wrapper">
            {{-- Carousel Section --}}
            @foreach ($slides as $slide)
                <div class="swiper-slide">
                    <div class="w-full h-full bg-cover bg-center"
                        style="background-image: url('{{ asset('storage/' . $slide['image']) }}')">
                        <div class="flex items-center justify-center h-full bg-black bg-opacity-40">
                            <div class="text-center text-white px-4">
                                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $slide['title'] }}</h1>
                                <p class="text-xl md:text-2xl">{{ $slide['description'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Tombol navigasi -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- Pagination (bulat-bulat) -->
        <div class="swiper-pagination"></div>
    </div>

    <!-- Inisialisasi Swiper -->
    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            autoplay: {
                delay: 4000, // 4 detik
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            effect: 'slide', // bisa diganti jadi 'fade', 'cube', 'coverflow', dsb
        });
    </script>
</section>
