<section id="ekstrakurikuler" class="py-20 bg-base-200">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Ekstrakurikuler</h2>
            <p class="text-lg text-base-content/70 max-w-2xl mx-auto">
                Beragam kegiatan ekstrakurikuler untuk mengembangkan bakat dan minat siswa
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $gradients = [
                    ['from' => 'from-pink-500', 'to' => 'to-pink-700'],
                    ['from' => 'from-blue-500', 'to' => 'to-blue-700'],
                    ['from' => 'from-green-500', 'to' => 'to-green-700'],
                    ['from' => 'from-purple-500', 'to' => 'to-purple-700'],
                    ['from' => 'from-yellow-500', 'to' => 'to-yellow-700'],
                    ['from' => 'from-red-500', 'to' => 'to-red-700'],
                    ['from' => 'from-indigo-500', 'to' => 'to-indigo-700'],
                    ['from' => 'from-cyan-500', 'to' => 'to-cyan-700'],
                ];
            @endphp

            @forelse ($ekstra as $item)
                @php
                    $randomGradient = $gradients[array_rand($gradients)];
                @endphp

                <div
                    class="card bg-gradient-to-br {{ $randomGradient['from'] }} {{ $randomGradient['to'] }} text-white shadow-xl">
                    <div class="card-body">
                        <h3 class="card-title text-xl">{{ $item->title }}</h3>
                        <p>{{ $item->description }}</p>
                    </div>
                </div>
            @empty
                <h2>Tidak ada data</h2>
            @endforelse

        </div>
    </div>
</section>
