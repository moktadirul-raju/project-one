<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title',config('app.name'))</title>
  <meta name="base-url" base_url="{!! url('/') !!}" />
  <!-- Favicons -->
  <link href="{{ asset('assets/img/fav.png') }}" rel="icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('assets/css/tailwind.min.css') }}">
   <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  @stack('css')
</head>

<body class="d-flex flex-column min-vh-100">
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto">
          @auth
              <a href="{{ route('to-do-list.index') }}">{{ config('app.name') }}</a>
          @else
            <a href="{{ route('home') }}">{{ config('app.name') }}</a>
          @endif
      </h1>
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
            @auth
              <li class="dropdown"><a href="#"><span>{{ Auth::user()->name ?? 'Profile' }}</span> <i class="bi bi-chevron-down"></i></a>
                <ul>
                  <li><a href="{{ route('change-profile') }}">Change Profile</a></li>
                  <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
              </li>
            @endauth
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
        @guest
      <a href="{{ route('login') }}" class="get-started-btn">Login</a>
      <a href="{{ route('register') }}" class="get-started-btn">Register</a>
        @endguest
    </div>
  </header>
  <main id="main" >
    <!-- ======= Main Section ======= -->
    <section id="contact" class="contact mt-5">
      <div class="container" data-aos="fade-up">
          @yield('content')
          <!-- Dynamic page -->
      </div>
    </section> <!-- End Main Section -->
  </main>
  <!-- ======= Footer ======= -->
  <footer id="footer" class="mt-auto">
    <div class="container d-md-flex py-4">
      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js" integrity="sha512-LUKzDoJKOLqnxGWWIBM4lzRBlxcva2ZTztO8bTcWPmDSpkErWx0bSP4pdsjNH8kiHAUPaT06UXcb+vOEZH+HpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>
  <script src="{{ asset('assets/js/helper.js') }}"></script>
  @stack('js')

</body>

</html>
