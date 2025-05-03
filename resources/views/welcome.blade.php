<!DOCTYPE html>
<html lang="en" data-theme="lofi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB - SMP</title>
    <!-- Tailwind CSS and DaisyUI -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <style>
        /* Custom styles for the timeline */
        .timeline-container {
            position: relative;
        }

        .timeline-container::after {
            content: '';
            position: absolute;
            width: 4px;
            background: linear-gradient(to bottom, #a78bfa, #60a5fa);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
        }

        .timeline-item {
            position: relative;
            width: 50%;
            padding: 10px 40px;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: white;
            border: 4px solid #8b5cf6;
            border-radius: 50%;
            top: 15px;
            z-index: 1;
        }

        .timeline-left {
            left: 0;
        }

        .timeline-right {
            left: 50%;
        }

        .timeline-left::after {
            right: -10px;
        }

        .timeline-right::after {
            left: -10px;
        }

        @media screen and (max-width: 768px) {
            .timeline-container::after {
                left: 31px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            .timeline-item::after {
                left: 21px;
            }

            .timeline-right {
                left: 0;
            }
        }

        /* Soft gradient backgrounds */
        .gradient-primary {
            background: linear-gradient(135deg, #c7d2fe, #ddd6fe);
        }

        .gradient-secondary {
            background: linear-gradient(135deg, #dbeafe, #e0e7ff);
        }

        .gradient-accent {
            background: linear-gradient(135deg, #fae8ff, #ede9fe);
        }

        .gradient-header {
            background: linear-gradient(135deg, #818cf8, #a78bfa);
        }

        .gradient-footer {
            background: linear-gradient(135deg, #6b7280, #4b5563);
        }

        .gradient-card {
            background: linear-gradient(135deg, #f9fafb, #f3f4f6);
            transition: all 0.3s ease;
        }

        .gradient-card:hover {
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            transform: translateY(-5px);
        }

        .gradient-timeline-1 {
            background: linear-gradient(135deg, #c7d2fe, #ddd6fe);
        }

        .gradient-timeline-2 {
            background: linear-gradient(135deg, #dbeafe, #e0e7ff);
        }

        .gradient-timeline-3 {
            background: linear-gradient(135deg, #fae8ff, #ede9fe);
        }

        /* Soft shadows */
        .soft-shadow {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
        }
    </style>
</head>

<body class="bg-gray-50">
    @include('layouts.welcomebagan.header')

    @include('layouts.welcomebagan.mobilenav')

    @include('layouts.welcomebagan.hero')

    @include('layouts.welcomebagan.about')

    @include('layouts.welcomebagan.teacher')

    @include('layouts.welcomebagan.galeri')

    @include('layouts.welcomebagan.registimeline')

    @include('layouts.welcomebagan.kontak')

    @include('layouts.welcomebagan.footer')

    <!-- JavaScript -->
    <script>
        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Initialize Swiper
        const swiper = new Swiper('.mySwiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        // Contact Form Submission
        const contactForm = document.getElementById('contactForm');

        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Get form values
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;

            // Here you would typically send the form data to a server
            // For this example, we'll just show an alert
            alert(`Thank you, ${name}! Your message has been received. We will contact you shortly.`);

            // Reset the form
            contactForm.reset();
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80, // Adjust for header height
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    if (!mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                    }
                }
            });
        });
    </script>
</body>

</html>
