<x-guest-layout>
    <style>
        body {
            background: #f2f4f7;
            font-family: Arial, Helvetica, sans-serif;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: #ffffff;
            width: 380px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 26px;
            font-weight: bold;
            color: #333;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover {
            background-color: #1e40af;
        }

        .bottom-links {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .bottom-links a {
            color: #2563eb;
            text-decoration: none;
        }

        .bottom-links a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="login-wrapper">
        <div class="login-card">
            <h2>Login</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        class="block mt-1 w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input
                        id="password"
                        class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="mt-6">
                    <button type="submit" class="login-btn">
                        Log in
                    </button>
                </div>

                <div class="bottom-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot password?</a><br>
                    @endif
                    <a href="{{ route('register') }}">Create an account</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
