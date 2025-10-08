<x-layout>
    <div class="container">
        <div style="max-width: 500px; margin: 0 auto;">
            <div class="login-card">
                <div style="text-align: center; margin-bottom: 40px;">
                    <a href="/" style="font-size: 32px; font-weight: bold; color: #2fa4e7; text-decoration: none;">Simple Blog</a>
                </div>
                <h2 class="card-title" style="text-align: center; margin-bottom: 40px;">Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div style="margin-bottom: 20px;">
                        <label for="email" style="display: block; font-weight: bold; margin-bottom: 5px;">E-Mail Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        @error('email')
                            <p style="color: #c71c22; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="password" style="display: block; font-weight: bold; margin-bottom: 5px;">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                        @error('password')
                            <p style="color: #c71c22; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div style="margin-bottom: 20px;">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Remember Me</label>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 15px; font-size: 18px;">Login</button>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="display: block; text-align: center; margin-top: 20px; color: #2fa4e7; text-decoration: none;">
                            Forgot Your Password?
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-layout>
