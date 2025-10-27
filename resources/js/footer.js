document.addEventListener('DOMContentLoaded', function () {
    const accordions = document.querySelectorAll('.footer-accordion-toggle');

    accordions.forEach(accordion => {
        accordion.addEventListener('click', function () {
            const content = this.nextElementSibling;
            const icon = this.querySelector('i');

            if (content.style.maxHeight) {
                content.style.maxHeight = null;
                if (icon) {
                    icon.classList.remove('fa-minus');
                    icon.classList.add('fa-plus');
                }
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                if (icon) {
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-minus');
                }
            }
        });
    });
});
