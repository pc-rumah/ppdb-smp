<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header class="navbar bg-white shadow-sm px-4 lg:px-8">
        <div class="navbar-start">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-white text-lg"></i>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-gray-800">PPDB</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-blue-50 to-blue-100 py-16 px-4">
        <div class="container mx-auto text-center max-w-4xl">
            <div class="flex items-center justify-center gap-2 mb-8">
                <i class="far fa-clock text-blue-500"></i>
                <span class="text-sm text-gray-600">Pendaftaran Dibuka: 1 Januari - 31 Maret 2025</span>
            </div>

            <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-4">
                Penerimaan Peserta Didik Baru
            </h1>
            <h2 class="text-3xl lg:text-4xl font-bold text-blue-500 mb-6">
                Tahun Ajaran 2025/2026
            </h2>

            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                <button class="btn btn-primary btn-lg">
                    Daftar Sekarang
                    <i class="fas fa-arrow-right ml-2"></i>
                </button>
                <button class="btn btn-outline btn-lg">
                    <i class="fas fa-search mr-2"></i>
                    Status Pendaftaran
                </button>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 px-4 bg-white">
        <div class="container mx-auto max-w-6xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Mengapa Memilih Kami?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Fasilitas lengkap, tenaga pengajar berkualitas, dan program unggulan untuk masa
                    depan cerah
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book text-blue-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Kurikulum Terkini</h3>
                    <p class="text-gray-600">
                        Menerapkan kurikulum nasional yang disesuaikan dengan perkembangan zaman
                        dan teknologi
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-green-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Tenaga Pengajar Ahli</h3>
                    <p class="text-gray-600">
                        Didukung oleh guru-guru berpengalaman dan berkompetensi di bidangnya masing-masing
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-trophy text-purple-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Prestasi Gemilang</h3>
                    <p class="text-gray-600">
                        Konsisten meraih prestasi akademik dan non-akademik di tingkat regional dan
                        nasional
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Requirements Section -->
    <section class="py-16 px-4 bg-gray-50">
        <div class="container mx-auto max-w-6xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Syarat Pendaftaran</h2>
                <p class="text-gray-600">Pastikan dokumen lengkap sebelum mendaftar</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Documents Required -->
                <div class="bg-white p-8 rounded-lg shadow-sm">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Dokumen Wajib:</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700">Ijazah atau surat keterangan lulus</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700">Akta Kelahiran</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700">Kartu Keluarga</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700">Pas foto</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700">KTP Orang Tua</span>
                        </div>
                    </div>
                </div>

                <!-- Requirements -->
                <div class="bg-white p-8 rounded-lg shadow-sm">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6">Persyaratan:</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700">Sehat jasmani dan rohani</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500"></i>
                            <span class="text-gray-700">Tidak buta warna</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6 px-4">
        <div class="container mx-auto max-w-6xl">
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400 text-sm"><span id="tahun"></span> Al Mas`udiyyah. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById("tahun").innerHTML = new Date().getFullYear();
    </script>
</body>

</html>
