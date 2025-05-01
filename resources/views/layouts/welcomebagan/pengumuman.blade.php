<!-- Announcements & Events Section -->
<section id="announcements" class="py-16 bg-base-200">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold section-title">Pengumuman dan Acara</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Announcements -->
            <div>
                <h3 class="text-2xl font-bold mb-4">Pengumuman Terbaru</h3>
                <ul class="space-y-4">
                    @foreach ($pengumuman as $item)
                        <li class="card bg-base-100 shadow-md h-full">
                            <div class="card-body p-4 flex flex-col h-full">
                                <h4 class="font-bold">{{ $item->judul }}</h4>
                                <p class="text-sm text-gray-600 mt-1 mb-2">Waktu Posting:
                                    {{ date('d-m-Y', strtotime($item->tanggal)) }}
                                </p>
                                <p class="flex-grow">{{ $item->deskripsi }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Events -->
            <div>
                <h3 class="text-2xl font-bold mb-4">Acara Mendatang</h3>
                <ul class="space-y-4">
                    @foreach ($event as $item)
                        <li class="card bg-base-100 shadow-md h-full">
                            <div class="card-body p-4 h-full">
                                <div class="flex items-start">
                                    <div class="bg-primary text-white p-2 rounded-lg text-center min-w-16">
                                        <div class="text-xl font-bold">{{ date('d', strtotime($item->tanggal)) }}</div>
                                        <div class="text-xs">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('F') }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-bold">{{ $item->judul }}</h4>
                                        <p class="text-sm">{{ $item->waktu_mulai }} - {{ $item->waktu_selesai }} |
                                            {{ $item->lokasi }}</p>
                                        <p class="mt-2">{{ $item->deskripsi }}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="text-center mt-8">
            <button class="btn btn-primary">Show All Announcements & Events</button>
        </div>
    </div>
</section>
