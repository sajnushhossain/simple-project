document.addEventListener('DOMContentLoaded', function () {
    // Mobile Menu Toggle
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const mobileNav = document.getElementById('mobile-nav');
    const closeMobileNav = document.getElementById('close-mobile-nav');
    const mobileSearchIcon = document.getElementById('mobile-search-icon');

    const openMobileNav = () => {
        mobileNav.classList.remove('invisible', 'opacity-0');
        mobileNav.classList.add('visible', 'opacity-100');
        document.body.style.overflow = 'hidden';
    }

    if (hamburgerMenu && mobileNav) {
        hamburgerMenu.addEventListener('click', openMobileNav);
    }

    if (mobileSearchIcon && mobileNav) {
        mobileSearchIcon.addEventListener('click', openMobileNav);
    }

    if (closeMobileNav && mobileNav) {
        closeMobileNav.addEventListener('click', function() {
            mobileNav.classList.remove('visible', 'opacity-100');
            mobileNav.classList.add('invisible', 'opacity-0');
            document.body.style.overflow = 'auto';
        });
    }

    // Search Toggle (Removed - search bar is now always visible)
    // The previous search toggle logic is removed as the search bar is now always visible.

    // Desktop Menu Toggle
    const desktopMenuToggle = document.getElementById('desktop-menu-toggle');
    const desktopMenu = document.getElementById('desktop-menu');

    if (desktopMenuToggle && desktopMenu) {
        desktopMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            desktopMenu.classList.toggle('hidden');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!desktopMenu.contains(e.target) && e.target !== desktopMenuToggle) {
                desktopMenu.classList.add('hidden');
            }
        });
    }

    // Theme Toggle (Removed as Prothom Alo is light-themed only)
    // The previous theme toggle logic is removed as the request is to match Prothom Alo exactly, which does not have a theme toggle.

    // Smooth scroll for anchor links
    // Keep smooth scroll if it's a general site feature, not specific to header.
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });
});
