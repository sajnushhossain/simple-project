<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white p-4 flex flex-col">
            <div class="flex items-center mb-8">
                <!-- <svg class="h-8 w-8 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"> -->
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <h1 class="text-2xl font-bold">Admin Panel</h1>
            </div>


            <nav class="flex-1 overflow-y-auto mb-4 flex flex-col ">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 @if(request()->routeIs('admin.dashboard')) bg-gray-700 @endif mb-2">
                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.posts.index') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 @if(request()->routeIs('admin.posts.index')) bg-gray-700 @endif mb-2">
                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Posts
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 @if(request()->routeIs('admin.categories.index')) bg-gray-700 @endif mb-2">
                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Categories
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 @if(request()->routeIs('admin.contacts.index')) bg-gray-700 @endif mb-2">
                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Contacts
                </a>
                <a href="{{ route('admin.subscriptions.index') }}" class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 @if(request()->routeIs('admin.subscriptions.index')) bg-gray-700 @endif mb-2">
                    <svg class="h-5 w-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Subscriptions
                </a>
            </nav>

            <!-- User Profile Section -->
            <!-- <div class="mt-auto border-t border-gray-700 pt-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img class="h-10 w-10 rounded-full mr-3" src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?d=mp" alt="User Avatar">
                        <div>
                            <p class="font-semibold text-white">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <a href="#" class="text-gray-400 hover:text-white mr-4">

                        </a>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-white">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div> -->
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <header class="flex justify-between items-center p-4 bg-white border-b">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-800">@yield('title')</h1>
                </div>
                <div>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-600 border broder-grey-300 py-2 px-2 rounded-full hover:text-gray-800 flex items-center cursor-pointer flex items-center">
                            <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>