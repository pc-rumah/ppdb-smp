<section id="events" class="py-20 bg-secondary">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16">Acara & Pengumuman</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Announcements Column -->
            <div>
                <h3 class="text-2xl font-bold mb-6 text-center">Pengumuman Terbaru</h3>

                <div class="space-y-6">
                    <!-- Announcement 1 -->
                    @foreach ($pengumuman as $item)
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h4 class="card-title">{{ $item->judul }}</h4>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</p>
                                <p>{{ $item->deskripsi }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Events Column -->
            <div>
                <h3 class="text-2xl font-bold mb-6 text-center">Acara Mendatang</h3>

                <div class="space-y-6">
                    <!-- Event 1 -->
                    @foreach ($event as $item)
                        <div class="card bg-base-100 shadow-xl">
                            <div class="card-body">
                                <h4 class="card-title">{{ $item->judul }}</h4>
                                <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }} -
                                        {{ $item->waktu_mulai }} / {{ $item->waktu_selesai }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>{{ $item->lokasi }}</span>
                                </div>
                                <p>{{ $item->deskripsi }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
