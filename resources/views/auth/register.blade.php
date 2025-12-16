<x-guest-layout>
    <style>
        body {
            background: #f2f4f7;
            font-family: Arial, Helvetica, sans-serif;
        }

        .register-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-card {
            background: #ffffff;
            width: 400px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .register-card h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 26px;
            font-weight: bold;
            color: #333;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .register-btn {
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

        .register-btn:hover {
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

    <div class="register-wrapper">
        <div class="register-card">
            <h2>Create Account</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input
                        id="name"
                        class="block mt-1 w-full"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        class="block mt-1 w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required />
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

                <!-- Confirm Password -->
                <div class="form-group">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input
                        id="password_confirmation"
                        class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation"
                        required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <button type="submit" class="register-btn">
                        Register
                    </button>
                </div>

                <div class="bottom-links">
                    <a href="{{ route('login') }}">Already registered?</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
