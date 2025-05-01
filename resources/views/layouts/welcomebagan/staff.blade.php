<!-- Staff & Teachers Section -->
<section id="staff" class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold section-title">Staff dan Guru Kami</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <!-- Staff Card 1 -->
            @foreach ($staf as $item)
                <div class="card bg-base-100 shadow-xl h-[350px]">
                    <figure class="px-10 pt-10">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="Principal"
                            class="rounded-xl h-48 w-48 object-cover" />
                    </figure>
                    <div class="card-body items-center text-center">
                        <h2 class="card-title">{{ $item->name }}</h2>
                        <p class="bg-info p-2 rounded-lg">{{ $item->position }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <button class="btn btn-primary">View All Staff</button>
        </div>
    </div>
</section>
