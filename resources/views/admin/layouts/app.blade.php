<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white shadow-lg">
            <div class="p-5 bg-gray-800">
                <h1 class="text-2xl font-bold text-white">Admin Panel<p class="text-sm text-gray-400">Simple News </p> </h1>
            </div>
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-3 px-5 text-gray-300 hover:bg-gray-700 hover:text-white transition duration-300 active:bg-gray-300 active:text-white">
                    <i class="h-6 w-6 mr-3" data-feather="home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.posts.index') }}" class="flex items-center py-3 px-5 text-gray-300 hover:bg-gray-700 hover:text-white transition duration-300 active:bg-gray-300 active:text-white">
                    <i class="h-6 w-6 mr-3" data-feather="file-text"></i>
                    <span>Posts</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center py-3 px-5 text-gray-300 hover:bg-gray-700 hover:text-white transition duration-300 active:bg-gray-300 active:text-white">
                    <i class="h-6 w-6 mr-3" data-feather="folder"></i>
                    <span>Categories</span>
                </a>
                <a href="{{ route('admin.contacts.index') }}" class="flex items-center py-3 px-5 text-gray-300 hover:bg-gray-700 hover:text-white transition duration-300 active:bg-gray-300 active:text-white">
                    <i class="h-6 w-6 mr-3" data-feather="users"></i>
                    <span>Contacts</span>
                </a>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar -->
            <div class="bg-white shadow-md p-4 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700">@yield('title', 'Dashboard')</h2>
                </div>
                <div>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class=" flex gap-2 text-gray-600 hover:text-gray-800 cursor-pointer items-center border border-gray-300 rounded-md px-4 py-2 hover:bg-gray-100 transition duration-300 ">
                            <span>logout</span>
                            <i class="h-6 w-6" data-feather="log-out"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Page content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
    @stack('scripts')
</body>
</html>