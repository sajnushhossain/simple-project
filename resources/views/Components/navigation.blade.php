<nav class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-8">
    <a href="/"
        class="text-text hover:text-primary transition-colors duration-200 font-medium px-3 py-1 rounded-md <?php echo e(request()->is('/') ? 'bg-primary-100 text-primary font-bold' : ''); ?>">Home</a>
    <a href="/blog"
        class="text-text hover:text-primary transition-colors duration-200 font-medium px-3 py-1 rounded-md <?php echo e(request()->is('blog') ? 'bg-primary-100 text-primary font-bold' : ''); ?>">Blog</a>

    <a href="/about"
        class="text-text hover:text-primary transition-colors duration-200 font-medium px-3 py-1 rounded-md <?php echo e(request()->is('about') ? 'bg-primary-100 text-primary font-bold' : ''); ?>">About</a>
    <a href="/contact"
        class="text-text hover:text-primary transition-colors duration-200 font-medium px-3 py-1 rounded-md <?php echo e(request()->is('contact') ? 'bg-primary-100 text-primary font-bold' : ''); ?>">Contact</a>
</nav>