document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            const filterButtons = document.querySelectorAll('.filter-btn');
            const staffCards = document.querySelectorAll('.staff-card');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));

                    // Add active class to clicked button
                    this.classList.add('active');

                    const filter = this.getAttribute('data-filter');

                    staffCards.forEach(card => {
                        if (filter === 'all') {
                            card.style.display = 'block';
                        } else {
                            const categories = card.getAttribute('data-category').split(
                                ' ');
                            if (categories.includes(filter)) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        }
                    });
                });
            });

            // Mobile Menu Toggle
            const mobileMenuButton = document.querySelector('.navbar .dropdown > div[role="button"]');
            const mobileMenu = document.querySelector('.navbar .dropdown > ul');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

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
        });
