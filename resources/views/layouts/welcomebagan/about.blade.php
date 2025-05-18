<section id="about" class="py-20 bg-neutral">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16">Unit Sekolah Kami</h2>
        <!-- Primary School Modal -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse ($unit as $item)
                <div class="card bg-base-100 shadow-xl h-full flex flex-col">
                    <figure class="h-64 overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                            class="object-cover w-full h-full" />
                    </figure>
                    <div class="card-body flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="card-title">{{ $item->judul }}</h3>
                            <p>{{ $item->deskripsi }}</p>
                        </div>
                        <div class="card-actions justify-end mt-4">
                            <button class="btn bg-primary hover:bg-primary/80"
                                onclick="document.getElementById('modal-{{ $item->id }}').showModal()">
                                Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal for this item -->
                <dialog id="modal-{{ $item->id }}" class="modal">
                    <div class="modal-box max-w-4xl">
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                        </form>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                    class="rounded-lg w-full">
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold mb-4">{{ $item->judul }}</h3>
                                <p class="mb-4">{{ $item->deskripsi }}</p>

                                <h4 class="text-xl font-semibold mb-2">Fasilitas:</h4>
                                <ul class="list-disc pl-5">
                                    @forelse ($item->fasilitas as $fasilitas)
                                        <li>{{ $fasilitas->name }}</li>
                                    @empty
                                        <li>Tidak ada Data</li>
                                    @endforelse
                                </ul>

                                <h4 class="text-xl font-semibold mb-2">Keunggulan:</h4>
                                <ul class="list-disc pl-5">
                                    @forelse ($item->keunggulan as $keunggulan)
                                        <li>{{ $keunggulan->name }}</li>
                                    @empty
                                        <li>Tidak ada Data</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </dialog>
            @empty
                <div class="flex justify-center items-center">
                    <h5 class="text-center">Tidak ada data</h5>
                </div>
            @endforelse
        </div>
    </div>
</section>
