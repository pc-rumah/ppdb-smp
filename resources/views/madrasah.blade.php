<!DOCTYPE html>
<html lang="id" data-theme="nord">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madrasah Al-Hikmah - Pendidikan Islam Terpadu</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset3landing/stylemadrasah.css') }}">
</head>

<body class="bg-base-100">
    <!-- Header -->
    @include('layouts.partial_madrasah.header')

    <!-- Hero Section -->
    @include('layouts.partial_madrasah.hero')

    <!-- Program Madrasah -->
    @include('layouts.partial_madrasah.program')

    <!-- Kegiatan Madrasah -->
    @include('layouts.partial_madrasah.kegiatan')

    <!-- Prestasi -->
    @include('layouts.partial_madrasah.prestasi')

    <!-- Footer -->
    @include('layouts.partial_madrasah.footer')

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to navbar
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('bg-opacity-95');
            } else {
                navbar.classList.remove('bg-opacity-95');
            }
        });
    </script>
</body>

</html>
