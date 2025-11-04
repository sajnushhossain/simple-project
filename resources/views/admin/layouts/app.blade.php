<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Simple News</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 bg-sidebar-blue text-black w-64 p-4 flex-col z-40 shadow-lg transform transition-transform duration-300 ease-in-out" style="transform: translateX(-100%);">
            <div class="flex items-center justify-between mb-8 px-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <span class="inline-flex items-center justify-center h-10 w-10 bg-white-600 rounded-xl text-black text-xl shadow-md">
                        <i class="fas fa-newspaper"></i>
                    </span>
                    <h1 class="text-2xl font-bold text-black">Admin Dashboard</h1>
                </a>
            </div>

            <nav class="flex-1 overflow-y-auto space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-3 px-4 rounded-xl transition-all duration-200 font-medium group
                    @if(request()->routeIs('admin.dashboard')) bg-blue-600 text-white shadow-md
                    @else text-black-300 hover:bg-gray-700 hover:text-white
                    @endif">
                    <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.posts.index') }}" class="flex items-center py-3 px-4 rounded-xl transition-all duration-200 font-medium group
                    @if(request()->routeIs('admin.posts.*')) bg-blue-600 text-white shadow-md
                    @else text-black-300 hover:bg-gray-700 hover:text-white
                    @endif">
                    <i class="fas fa-pencil-alt w-5 mr-3"></i>
                    <span>Posts</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center py-3 px-4 rounded-xl transition-all duration-200 font-medium group
                    @if(request()->routeIs('admin.categories.*')) bg-blue-600 text-white shadow-md
                    @else text-black-300 hover:bg-gray-700 hover:text-white
                    @endif">
                    <i class="fas fa-folder w-5 mr-3"></i>
                    <span>Categories</span>
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center py-3 px-4 rounded-xl transition-all duration-200 font-medium group
                    @if(request()->routeIs('admin.contacts.*')) bg-blue-600 text-white shadow-md
                    @else text-black-300 hover:bg-gray-700 hover:text-white
                    @endif">
                    <i class="fas fa-envelope w-5 mr-3"></i>
                    <span>Contacts</span>
                </a>
                <a href="{{ route('admin.subscriptions.index') }}" class="flex items-center py-3 px-4 rounded-xl transition-all duration-200 font-medium group
                    @if(request()->routeIs('admin.subscriptions.*')) bg-blue-600 text-white shadow-md
                    @else text-black-300 hover:bg-gray-700 hover:text-white
                    @endif">
                    <i class="fas fa-users w-5 mr-3"></i>
                    <span>Subscriptions</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div id="main-content" class="flex-1 flex flex-col overflow-hidden transition-all duration-300 ease-in-out">
            <header class="flex justify-between items-center p-4 bg-white border-b border-gray-200 shadow-sm">
                <div class="flex items-center">
                    <button id="sidebar-toggle" class="text-gray-500 focus:outline-none p-2 rounded-md hover:bg-gray-100 transition-colors">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center space-x-4">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                            <img class="h-8 w-8 rounded-full object-cover" src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=mp" alt="User Avatar">
                            <span class="hidden md:inline-block ml-2">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down w-3 h-3 ml-1"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 border-grey-200 
                        bg-white rounded-lg shadow-xl z-20" style="display: none;">
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left block px-4 py-4 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6 md:p-8">
                <div class="container mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            let sidebarOpen = false;

            sidebarToggle.addEventListener('click', function () {
                sidebarOpen = !sidebarOpen;
                if (sidebarOpen) {
                    sidebar.style.transform = 'translateX(0)';
                    mainContent.style.marginLeft = '16rem'; // 256px which is w-64
                } else {
                    sidebar.style.transform = 'translateX(-100%)';
                    mainContent.style.marginLeft = '0';
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>