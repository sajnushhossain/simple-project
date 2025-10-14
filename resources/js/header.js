// Mobile Menu Toggle
const hamburgerMenu = document.getElementById('hamburger-menu');
const mobileNav = document.getElementById('mobile-nav');
const closeMobileNav = document.getElementById('close-mobile-nav');

if (hamburgerMenu && mobileNav) {
    hamburgerMenu.addEventListener('click', function() {
        mobileNav.classList.toggle('hidden');
        document.body.style.overflow = mobileNav.classList.contains('hidden') ? 'auto' : 'hidden';
    });
}

if (closeMobileNav && mobileNav) {
    closeMobileNav.addEventListener('click', function() {
        mobileNav.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });
}

// Close mobile menu when clicking outside
if (mobileNav) {
    mobileNav.addEventListener('click', function(e) {
        if (e.target === mobileNav) {
            mobileNav.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    });
}

// Search Toggle
const searchIcon = document.getElementById('search-icon');
const searchInput = document.getElementById('search-input');

if (searchIcon && searchInput) {
    searchIcon.addEventListener('click', function(e) {
        e.stopPropagation();
        searchInput.classList.toggle('w-64');
        searchInput.focus();
    });

    document.addEventListener('click', function(e) {
        if (e.target !== searchInput && e.target !== searchIcon) {
            searchInput.classList.remove('w-64');
        }
    });
}

// Mobile Search Toggle
const mobileSearchIcon = document.getElementById('mobile-search-icon');
const mobileSearchForm = document.getElementById('mobile-search-form');

if (mobileSearchIcon && mobileSearchForm) {
    mobileSearchIcon.addEventListener('click', function() {
        mobileSearchForm.classList.toggle('hidden');
    });
}

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

// Theme Toggle
const themeToggle = document.getElementById('theme-toggle');
const themeIcon = themeToggle?.querySelector('i');

function updateThemeIcon(isDark) {
    if (themeIcon) {
        if (isDark) {
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        } else {
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
        }
    }
}

if (themeToggle) {
    themeToggle.addEventListener('click', function() {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        updateThemeIcon(isDark);
    });
}

// Initialize theme on page load
const savedTheme = localStorage.getItem('theme');
const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
const shouldBeDark = savedTheme === 'dark' || (!savedTheme && prefersDark);

if (shouldBeDark) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark');
}
updateThemeIcon(shouldBeDark);

// Smooth scroll for anchor links
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
