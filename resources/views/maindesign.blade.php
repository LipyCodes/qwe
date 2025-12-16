<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="fitness, gym, supplements, gear, protein" />
  <meta name="description" content="Fuel your fitness journey with high-quality gear and supplements." />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}" type="image/x-icon">

  <title>
    💪 JAL's GYM APPAREL
  </title>

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.css') }}" />
  <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="hero_area">
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="{{ route('index') }}">
          <span>
            🏋️ JAL's GYM APPAREL
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('viewallproducts') }}">
                Nutrition & Gear
              </a>
            </li>
          </ul>
          <div class="user_option">
            
            @if(Auth::check())
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        <span>Log Out</span>
                    </a>
                </form>
            @else 
                <a href="{{ route('login') }}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>Login</span>
                </a>
                <a href="{{ route('register') }}">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                    <span>Sign Up</span>
                </a>
            @endif

            @php
              $cartCount = 0;
              if (Auth::check()) {
                  $cartCount = \App\Models\ProductCart::where('user_id', Auth::id())->count();
              }
            @endphp

            <a href="{{ route('cart') }}">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              @if($cartCount > 0)
                <span style="background:red;color:white;border-radius:50%;padding:2px 7px;font-size:12px;margin-left:4px;">
                  {{ $cartCount }}
                </span>
              @endif
            </a>
          </div>
        </div>
      </nav>
    </header>

    @if(request()->routeIs('index'))
    <section class="slider_section">
      <div class="slider_container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-7">
                    <div class="detail-box"> 
                      <h1>
                        Fuel Your <br>
                        Fitness Journey
                      </h1>
                      <p>
                        Breathable, physique-enhancing, and designed to make you look and feel like a champion. It’s time to elevate your workout wardrobe with our premium gym apparel.
                      </p>
                    </div>
                  </div>
                  <div class="col-md-5 ">
                    <div class="img-box">
                        <img style="width:600px" src="{{ asset('frontend/images/muscle.jpg') }}" alt="Gym Gear and Supplements" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif
  </div>

  <section class="shop_section layout_padding">
    @yield('index') 
    @yield('product_details')
    @yield('all_products')
  </section>

  <section class="contact_section">
     </section>
  <br><br><br>
  <section class="info_section layout_padding2-top">

  <!-- SOCIAL ICONS -->
  <div class="social_container text-center mb-4">
    <div class="social_box">
      <a href=""><i class="fa fa-facebook"></i></a>
      <a href=""><i class="fa fa-twitter"></i></a>
      <a href=""><i class="fa fa-instagram"></i></a>
      <a href=""><i class="fa fa-youtube"></i></a>
    </div>
  </div>

  <!-- INFO CONTENT -->
  <div class="info_container">
    <div class="container">
      <div class="row justify-content-center text-center">

        <!-- ABOUT US -->
        <div class="col-md-6 col-lg-3">
          <h6>ABOUT US</h6>
          <p>
            We are a dedicated team focused on building reliable and
            user-friendly applications that deliver real-world solutions.
          </p>
        </div>

        <!-- DEVELOPERS -->
        <div class="col-md-6 col-lg-3">
          <h6>DEVELOPERS</h6>
          <p>LLOYD S. HYATTE</p>
          <p>JOHN CHRIS DIOSO</p>
          <p>ADRIAN MATHEW CORTES</p>
          <p>LAURENT COLIFLORES</p>
          <p>JOHN FRANCIS YPIL</p>
        </div>

        <!-- CONTACT US -->
        <div class="col-md-6 col-lg-3">
          <h6>CONTACT US</h6>
          <p><i class="fa fa-map-marker"></i> UCLM- University of Cebu Lapu-Lapu Mandaue</p>
          <p><i class="fa fa-phone"></i>091243566</p>
          <p><i class="fa fa-envelope"></i> uclm@gmail.com</p>
        </div>

      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="footer_section">
    <div class="container text-center">
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <a href="https://html.design/">JAL'S CO.</a>
      </p>
    </div>
  </footer>

</section>

  <script src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="{{ asset('frontend/js/custom.js') }}"></script>

  @if(session('order_success'))
  <script>
      Swal.fire({
          title: 'Order Placed!',
          text: "{{ session('order_success') }}",
          icon: 'success',
          confirmButtonColor: '#28a745',
          confirmButtonText: 'Great!'
      });
  </script>
  @endif

</body>
</html>