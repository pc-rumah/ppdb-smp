<!-- About Section -->
<section id="about" class="py-16 gradient-primary">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-purple-800">Tentang Sekolah Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @if (isset($welcome))
                <div class="flex items-center justify-center">
                    <img src="{{ asset('storage/' . $welcome->about_image) }}" alt="About Image"
                        class="rounded-lg shadow-lg w-80 max-w-md">
                </div>
                <div class="flex items-center justify-center">
                    <div class="text-lg text-gray-700">
                        {!! $welcome->about_description !!}
                    </div>
                </div>
            @else
                <div class="col-span-full flex items-center justify-center min-h-[200px]">
                    <p class="text-lg text-gray-700 text-center">Informasi tentang About belum tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</section>
