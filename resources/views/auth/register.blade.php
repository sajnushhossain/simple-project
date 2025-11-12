<x-layout :posts="[]">
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-sky-50 to-blue-100">
        <div class="w-full max-w-md p-8 space-y-8 bg-white shadow-2xl rounded-2xl border border-sky-200">
            <div class="text-center">
                <a href="/" class="text-4xl font-bold text-primary">Simple News</a>
                <p class="mt-2 text-muted">Create a new account.</p>
            </div>
            <form method="POST" action="/register" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-text">Name</label>
                    <div class="mt-1">
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            autocomplete="name" autofocus
                            class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-lg text-text focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                        @error('name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-text">E-Mail Address</label>
                    <div class="mt-1">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="email"
                            class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-lg text-text focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                        @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-text">Password</label>
                    <div class="mt-1">
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-lg text-text focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                        @error('password')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-text">Confirm Password</label>
                    <div class="mt-1">
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-lg text-text focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 transition-colors duration-300 cursor-pointer" style="background-color: #E62020; !important;">
                        Register
                    </button>
                </div>
                <div class="text-center">
                    <a href="/login" class="font-medium text-primary hover:text-primary-700">
                        Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>