// Initialize Swiper
document.addEventListener('DOMContentLoaded', function() {
    // Highlights Swiper
    var heroSwiper = new Swiper('.heroSwiper', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
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

    // Initialize LightGallery
    const lightGallery = document.getElementById('lightgallery');
    if (lightGallery) {
        lightGallery.addEventListener('click', function(e) {
            if (e.target.closest('.gallery-item')) {
                e.preventDefault();
            }
        });

        window.lightGallery(lightGallery, {
            selector: '.gallery-item',
            plugins: [],
            speed: 500,
            download: false,
            counter: false
        });
    }

    document.getElementById('year').textContent = new Date().getFullYear();

    // Mobile Menu Toggle
    const mobileMenuButton = document.querySelector('.navbar .dropdown > div[role="button"]');
    const mobileMenu = document.querySelector('.navbar .dropdown > ul');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Smooth Scrolling for Navigation Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80, // Adjust for header height
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    });

    // Add scroll event listener for sticky header effects
    window.addEventListener('scroll', function() {
        const header = document.querySelector('header');
        if (window.scrollY > 50) {
            header.classList.add('bg-base-100/95', 'backdrop-blur-sm');
            header.classList.remove('bg-base-100');
        } else {
            header.classList.remove('bg-base-100/95', 'backdrop-blur-sm');
            header.classList.add('bg-base-100');
        }
    });

    // Modal Close Buttons
    document.querySelectorAll('.modal form button').forEach(button => {
        button.addEventListener('click', function() {
            const modal = this.closest('.modal');
            if (modal) {
                modal.close();
            }
        });
    });
});
