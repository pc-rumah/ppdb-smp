<!DOCTYPE html>
<html lang="id" data-theme="nord">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $cover->judul_pondok ?? 'ini judul' }}</title>
    <link rel="icon" type="image/x-icon"
        href="{{ $cover?->logo_madrasah ? asset('storage/' . $cover->logo_pondok) : '#' }}">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.24/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset3landing/stylepondok.css') }}">
</head>

<body class="bg-base-100">
    <!-- Header -->
    @include('layouts.partial_pondok.header')

    <!-- Hero Section -->
    @include('layouts.partial_pondok.hero')

    <!-- Pengasuh Pondok -->
    @include('layouts.partial_pondok.pengasuh')

    <!-- Program Pondok -->
    @include('layouts.partial_pondok.program')

    <!-- Kegiatan Pondok -->
    @include('layouts.partial_pondok.kegiatan')

    {{-- event --}}
    @include('layouts.partial_pondok.event')

    {{-- kontak --}}
    @include('components.kontak')

    <!-- Footer -->
    @include('layouts.partial_pondok.footer')

    <script>
        // Smooth scrolling
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

        // Animate timeline on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.timeline > div').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s ease';
            observer.observe(el);
        });
    </script>
</body>

</html>
