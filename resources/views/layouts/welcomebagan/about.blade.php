<!-- About Section -->
<section id="about" class="py-16 gradient-primary">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-purple-800">Tentang Sekolah Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <img src="{{ asset('storage/' . $welcome->about_image) }}" alt="School Building"
                    class="rounded-lg shadow-lg w-96">
            </div>
            <div>
                <h3 class="text-2xl font-semibold mb-4 text-blue-700">Excellence in Education</h3>
                <p class="mb-4 text-gray-700">{{ $welcome->about_description }}</p>

            </div>
        </div>
    </div>
</section>
