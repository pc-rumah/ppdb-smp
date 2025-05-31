<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Sekolah</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('gambar/logo.jpg') }}">

    <!-- Tailwind CSS and DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Lightbox -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/css/lightgallery.min.css">
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.2/lightgallery.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('landing/styles.css') }}">

    <!-- Configure Tailwind with our color palette -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#9FB3DF',
                        'secondary': '#9EC6F3',
                        'accent': '#BDDDE4',
                        'neutral': '#FFF1D5',
                    }
                }
            }
        }
    </script>
</head>

<body>
    <!-- Header -->
    @include('layouts.welcomebagan.header')

    <!-- School Highlights with Carousel -->
    @include('layouts.welcomebagan.carousel')

    <!-- About Section -->
    @include('layouts.welcomebagan.about')

    <!-- Registration Process -->
    @include('layouts.welcomebagan.registration')

    <!-- Events & Announcements -->
    @include('layouts.welcomebagan.event')

    <!-- Contact Section -->
    @include('layouts.welcomebagan.kontak')

    <!-- Footer -->
    @include('layouts.welcomebagan.footer')

    <!-- Custom JavaScript -->
    <script src="{{ asset('landing/script.js') }}"></script>
</body>

</html>
