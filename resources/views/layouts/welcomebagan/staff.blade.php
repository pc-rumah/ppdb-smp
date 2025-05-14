<section id="staff" class="py-20 bg-accent">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16">Our Staff & Teachers</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ($staf as $item)
                <div class="card bg-base-100 shadow-xl">
                    <figure class="px-10 pt-10">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="Teacher 1" class="rounded-xl" />
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title">{{ $item->name }}</h3>
                        <p class="text-sm font-semibold text-gray-600">{{ $item->position }}</p>
                        <p>{{ Str::limit($item->description, 100) }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tombol ini dipindah keluar dari grid -->
        <div class="text-center mt-12">
            <a href="/staffpage" class="btn bg-secondary hover:bg-secondary/80">View All Teachers & Staff</a>
        </div>

</section>
