<nav class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-8">
    <a href="/"
        class="text-text hover:text-primary transition-colors duration-200 font-medium px-3 py-1 rounded-md <?php echo e(request()->is('/') ? 'bg-primary-100 text-primary font-bold' : ''); ?>">Home</a>
    <a href="/blog"
        class="text-text hover:text-primary transition-colors duration-200 font-medium px-3 py-1 rounded-md <?php echo e(request()->is('blog') ? 'bg-primary-100 text-primary font-bold' : ''); ?>">Blog</a>
    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
        <button
            class="text-text hover:text-primary transition-colors duration-200 font-medium flex items-center px-3 py-1 rounded-md"
            :class="{ 'bg-primary-100 text-primary': open }">
            Categories <i class="fa-solid fa-chevron-down ml-2 text-xs"></i>
        </button>
        <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="absolute top-full left-0 mt-2 bg-white shadow-lg rounded-lg p-6 z-50 border w-max">
            <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Browse Categories</h3>
            <div class="grid grid-cols-4 gap-3">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="/blog?category=<?php echo e($category->slug); ?>"
                    class="group flex items-center justify-center p-2 rounded-full hover:bg-gray-100 transition-all duration-200 text-gray-700 font-medium">
                    <i class="fa-solid fa-tag text-primary text-xs mr-2"></i>
                    <span><?php echo e($category->name); ?></span>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="mt-6 pt-4 border-t text-center">
                <a href="/blog" class="text-primary hover:underline font-semibold">View All Categories</a>
            </div>
        </div>
    </div>
    <a href="/about"
        class="text-text hover:text-primary transition-colors duration-200 font-medium px-3 py-1 rounded-md <?php echo e(request()->is('about') ? 'bg-primary-100 text-primary font-bold' : ''); ?>">About</a>
    <a href="/contact"
        class="text-text hover:text-primary transition-colors duration-200 font-medium px-3 py-1 rounded-md <?php echo e(request()->is('contact') ? 'bg-primary-100 text-primary font-bold' : ''); ?>">Contact</a>
</nav>