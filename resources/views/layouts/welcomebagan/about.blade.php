<!-- About Section -->
<section id="about" class="py-16 bg-base-200">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold section-title">Tentang Sekolah</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <p class="mb-4">{{ $welcome->about_description }}</p>
            </div>
            <div class="flex justify-center">
                <img style="width: 300px" src="{{ asset('storage/' . $welcome->about_image) }}" alt="School Building"
                    class="rounded-lg shadow-lg max-w-full h-auto">
            </div>
        </div>
    </div>
</section>
