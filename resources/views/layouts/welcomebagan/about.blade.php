<!-- About Section -->
<section id="about" class="py-16 gradient-primary">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-purple-800">Tentang Sekolah Kami</h2>
        @if (isset($welcome->about))
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('storage/' . $about->image) }}" alt="About Image"
                        class="rounded-lg shadow-lg w-full max-w-md">
                </div>
                <div class="flex items-center justify-center">
                    <div class="text-lg text-gray-700">
                        {!! $about->description !!}
                    </div>
                </div>
            </div>
        @else
            <div class="flex items-center justify-center">
                <p class="text-lg text-gray-700">Informasi tentang sekolah belum tersedia.</p>
            </div>
        @endif
    </div>
</section>
