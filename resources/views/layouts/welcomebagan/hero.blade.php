<!-- Hero Section with Carousel -->
<section id="home" class="w-full">
    <div class="swiper w-full h-[500px]">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="w-full h-full bg-cover bg-center"
                    style="background-image: url('https://placehold.co/1200x500/3b82f6/ffffff?text=School+Campus')">
                    <div class="flex items-center justify-center h-full bg-black bg-opacity-40">
                        <div class="text-center text-white px-4">
                            <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to Excellence Academy</h1>
                            <p class="text-xl md:text-2xl">Where Future Leaders Grow</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide">
                <div class="w-full h-full bg-cover bg-center"
                    style="background-image: url('https://placehold.co/1200x500/4ade80/ffffff?text=Academic+Excellence')">
                    <div class="flex items-center justify-center h-full bg-black bg-opacity-40">
                        <div class="text-center text-white px-4">
                            <h1 class="text-4xl md:text-5xl font-bold mb-4">Academic Excellence</h1>
                            <p class="text-xl md:text-2xl">Nurturing Minds, Building Futures</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide">
                <div class="w-full h-full bg-cover bg-center"
                    style="background-image: url('https://placehold.co/1200x500/f97316/ffffff?text=Student+Activities')">
                    <div class="flex items-center justify-center h-full bg-black bg-opacity-40">
                        <div class="text-center text-white px-4">
                            <h1 class="text-4xl md:text-5xl font-bold mb-4">Vibrant Student Life</h1>
                            <p class="text-xl md:text-2xl">Developing Well-Rounded Individuals</p>
                        </div>
                    </div>
                </div>
            </div>
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
