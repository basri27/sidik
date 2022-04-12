<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>LMMC Banjarmasin - @yield('title')</title>

  <link rel="shortcut icon" href="{{ asset('/img/klinik.png') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('/css/maicons.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('/vendor/owl-carousel/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ asset('/vendor/animate/animate.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/theme.css') }}">
  <link rel="stylesheet" href="{{ asset('/fonts/icomoon/style.css') }}">
  @yield('css')
  <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

</head>
<body>
  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
          <img src=" {{ asset('/img/bg-1.jpg') }} " style="width:4em">
          <a class="navbar-brand" href="{{ route('home') }}"><span class="text-primary">LMMC</span>-Banjarmasin</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupport">
			<ul class="navbar-nav ml-auto">
			@yield('navbar')
			@if (Auth::guest())
				<li class="nav-item">
				  <a class="btn btn-primary ml-lg-3" href="/login">Login</a>
				</li>
			@else
        <li class="nav-item">
        @if (Auth::user()->role_id == 1)
					<a class="btn btn-info" href={{ route('adm_dashboard', Auth::user()->admin->id) }}>Dashboard</a>
        @elseif(Auth::user()->role->id == 2)
          <a class="btn btn-info" href={{ route('profil_pasien', Auth::user()->id) }}>Dashboard</a>
        @elseif (Auth::user()->role_id == 3)
          <a class="btn btn-info" href={{ route('nakes_dashboard', Auth::user()->id) }}>Dashboard</a>
        @elseif (Auth::user()->role_id == 4)
          <a class="btn btn-info" href={{ route('apoteker_dashboard', Auth::user()->id) }}>Dashboard</a>        
        @endif
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST">
          @csrf
            <button class="btn btn-info" type="submit">
                Logout
            </button>
          </form>
        </li>
			@endif
			</ul>
        </div>
      </div> <!-- .container -->
    </nav>
  </header>

  <div class="page-hero bg-image overlay-dark" style="background-image: url( {{ asset('/img/bg_image_1.jpg') }} );">
    <div class="hero-section">
      <div class="container text-center wow zoomIn">
        @yield('awal')
      </div>
    </div>
  </div>

  @yield('content')

  <footer class="page-footer">
    <div class="container">
      <h4>Kontak kami:</h4>
      <p href="#"><i class="fa-solid fa-house-chimney-medical"></i>&ensp;Jl. Brigjen H. Hasan Basri, Pangeran, Kec. Banjarmasin Utara, Kota Banjarmasin, Kalimantan Selatan 70123</p>
      <p><a href="https://goo.gl/maps/RiJCCKqAJxgu7U5Z6" target="_blank"><i class="fa-solid fa-location-dot"></i>&ensp;LMMC Banjarmasin</a>&emsp;|&emsp;
      <a href="https://www.instagram.com/kliniklmmc_ulm" target="_blank"><i class="fa-brands fa-instagram"></i>&ensp;LMMC Banjarmasin</a>&emsp;|&emsp;
      <a href="http://wa.me/+6282175757549" target="_blank"><i class="fa-brands fa-whatsapp"></i>&ensp;LMMC Banjarmasin</a></p>
      <p id="copyright">Copyright &copy; 2022 <a href="{{ route('home') }}">SIDIK</a>. All right reserved</p>
    </div>
  </footer>

  @yield('js')
  <script src="https://kit.fontawesome.com/0a4cdb924d.js" crossorigin="anonymous"></script>
  <!-- <script src="{{ asset('/js/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('/vendor/wow/wow.min.js') }}"></script>
  <script src="{{ asset('/js/theme.js') }}"></script> -->

  <!-- <script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('/js/popper.min.js') }}"></script>
  <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('/js/main.js') }}"></script> -->

</body>
</html>