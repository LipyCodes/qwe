@extends('maindesign')

@section('index')

<div class="contact_section">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Login
            </h2>
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                @if(session('status'))
                    <div style="color: green; margin-bottom: 15px; text-align: center;">
                        {{ session('status') }}
                    </div>
                @endif

                @if($errors->any())
                    <div style="color: red; margin-bottom: 15px; text-align: center;">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" style="padding: 20px;">
                    @csrf

                    <div>
                        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus />
                    </div>

                    <div>
                        <input type="password" name="password" placeholder="Password" required autocomplete="current-password" />
                    </div>

                    <div style="display: flex; align-items: center; margin-bottom: 20px;">
                        <input id="remember_me" type="checkbox" name="remember" style="width: auto; height: auto; margin-right: 10px; margin-bottom: 0;">
                        <label for="remember_me" style="margin: 0; color: #101010;">Remember me</label>
                    </div>

                    <div class="d-flex flex-column align-items-center">
                        <button type="submit">
                            LOG IN
                        </button>

                        <div style="margin-top: 20px;">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" style="color: #101010; font-size: 14px;">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>
                        
                        <div style="margin-top: 10px;">
                            <span style="color: #101010;">Don't have an account?</span>
                            <a href="{{ route('register') }}" style="color: #FFD700; font-weight: bold;">
                                Sign Up
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection