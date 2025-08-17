<section id="contact" class="py-20 bg-accent">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16">Kontak Kami</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="space-y-6">
                            <!-- Phone -->
                            @if (isset($kontak))
                                <div class="flex items-start gap-4">
                                    <div class="bg-primary p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold">Telepon</h4>
                                        <p class="mt-1">{{ $kontak->telepon }}</p>
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="flex items-start gap-4">
                                    <div class="bg-secondary p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold">Alamat</h4>
                                        <p class="mt-1">{{ $kontak->alamat }}</p>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="flex items-start gap-4">
                                    <div class="bg-accent p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-semibold">Email</h4>
                                        <p class="mt-1">{{ $kontak->email }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Hours -->
                            <div class="flex items-start gap-4">
                                <div class="bg-primary p-3 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold">Jam Kerja</h4>
                                    <p class="mt-1">Senin - Jum'at: 8:00 AM - 3:00 PM<br>Sabtu: 9:00 AM -
                                        12:00 PM<br>Minggu: Libur</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div>
                <div class="card bg-base-100 shadow-xl">
                    <div class="card-body p-0 overflow-hidden rounded-xl">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.2287275136086!2d110.39694929999999!3d-7.2147293999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7086c9492e61ef%3A0xb942b6f928ce5967!2sAl-Mas&#39;udiyyah%20Putri%202%20Blater!5e0!3m2!1sid!2sid!4v1749138011145!5m2!1sid!2sid"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
