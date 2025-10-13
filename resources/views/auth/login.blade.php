<x-layout :posts="[]">
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-sky-50 to-blue-100">
        <div class="w-full max-w-md p-8 space-y-8 bg-white shadow-2xl rounded-2xl border border-sky-200">
            <div class="text-center">
                <a href="/" class="text-4xl font-bold text-primary">Simple News</a>
                <p class="mt-2 text-muted">Welcome back! Please login to your account.</p>
            </div>
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-text">E-Mail Address</label>
                    <div class="mt-1">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                               class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-lg text-text focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                        @error('email')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-text">Password</label>
                    <div class="mt-1">
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                               class="w-full px-4 py-3 bg-white border-2 border-gray-300 rounded-lg text-text focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                        @error('password')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }} 
                               class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-text">Remember Me</label>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-primary hover:text-primary-700">
                                Forgot Your Password?
                            </a>
                        </div>
                    @endif
                </div>

                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-300">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>