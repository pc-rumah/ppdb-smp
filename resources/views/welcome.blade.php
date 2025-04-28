<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excellence Academy</title>

    <!-- Tailwind CSS and DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50%;
            height: 3px;
            background-color: #3b82f6;
        }

        .gallery-item {
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .timeline-container {
            position: relative;
        }

        .timeline-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 100%;
            background-color: #3b82f6;
        }

        @media (max-width: 768px) {
            .timeline-container::before {
                left: 30px;
            }
        }
    </style>
</head>

<body>
    @include('layouts.welcomebagan.navbar')

    @include('layouts.welcomebagan.hero')

    @include('layouts.welcomebagan.about')

    @include('layouts.welcomebagan.staff')

    @include('layouts.welcomebagan.pengumuman')

    @include('layouts.welcomebagan.galeri')

    @include('layouts.welcomebagan.ppdb')

    @include('layouts.welcomebagan.kontak')

    <div class="footer footer-center p-4 bg-base-300 text-base-content">
        <div>
            <p>Copyright © 2025 - All rights reserved by Excellence Academy</p>
        </div>
    </div>

    <!-- JavaScript for Gallery Modal -->
    <script>
        function openModal(title, description, imageUrl) {
            const modal = document.getElementById('gallery_modal');
            const modalTitle = document.getElementById('modal_title');
            const modalImage = document.getElementById('modal_image');
            const modalDescription = document.getElementById('modal_description');

            modalTitle.textContent = title;
            modalImage.src = imageUrl;
            modalImage.alt = title;
            modalDescription.textContent = description;

            modal.showModal();
        }
    </script>
</body>

</html>
