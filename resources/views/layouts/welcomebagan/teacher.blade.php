<!-- Teachers and Staff Section -->
<section id="staf" class="py-16 gradient-secondary">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 text-blue-800">Staff dan Guru Kami</h2>
        <p class="text-center max-w-3xl mx-auto mb-12 text-gray-700">Our dedicated team of educators and staff
            members are committed to providing the highest quality education and support for our students.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Teacher Card 1 -->
            @if (isset($staf))
                @foreach ($staf as $item)
                    <div class="card gradient-card soft-shadow">
                        <figure>
                            <img src="{{ asset('storage/' . $item->image) }}" alt="gambar staff"
                                class="w-full h-64 object-cover object-center">
                        </figure>
                        <div class="card-body">
                            <div
                                class="badge bg-gradient-to-r from-purple-400 to-blue-400 text-white border-none absolute right-2 top-2">
                                {{ $item->position }}
                            </div>
                            <h3 class="card-title text-xl text-purple-700">{{ $item->name }}</h3>
                            <p class="text-gray-600">
                                {{ Str::limit(strip_tags($item->description), 100) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full flex items-center justify-center min-h-[200px]">
                    <p class="text-lg text-gray-700 text-center">Informasi tentang Staf belum tersedia.</p>
                </div>
            @endif

        </div>

        <div class="text-center mt-12">
            <a href="#"
                class="btn bg-gradient-to-r from-purple-500 to-blue-500 text-white border-none hover:from-purple-600 hover:to-blue-600">View
                Semua Staff Kami</a>
        </div>
    </div>
</section>
