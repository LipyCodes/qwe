@extends('maindesign')

@section('index')

<div class="contact_section">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Sign Up
            </h2>
        </div>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                
                @if($errors->any())
                    <div style="color: red; margin-bottom: 15px; text-align: center;">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" style="padding: 20px;">
                    @csrf

                    <div>
                        <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus />
                    </div>

                    <div>
                        <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required />
                    </div>

                    <div>
                        <input type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                    </div>

                    <div>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
                    </div>

                    <div class="d-flex flex-column align-items-center">
                        <button type="submit">
                            REGISTER
                        </button>

                        <div style="margin-top: 20px;">
                            <span style="color: #101010;">Already have an account?</span>
                            <a href="{{ route('login') }}" style="color: #FFD700; font-weight: bold;">
                                Login
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection