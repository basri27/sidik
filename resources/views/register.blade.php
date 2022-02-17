<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar - LMMC Banjarmasin</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('/img/klinik.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/regist.css') }}">
    <meta name="robots" content="noindex, follow">
</head>
<body>
    <div class="main">
        <section class="signup">

            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form " action="{{ route('register') }}">
                        @csrf
                        <h2 class="form-title">Daftar Akun</h2>
                            <div class="row">
                                <div class="col-6">
                                    <img class="float-left" src="{{ asset('img/klinik.png') }}">
                                </div>
                                <div class="float-right col-6">
                                    <div class="form-group">
                                        <input type="text" name="role_id" value="2" hidden>
                                        <input type="text" class="form-input @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="{{ old('username') }}"/>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>Username telah digunakan</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-input @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password"/>
                                        <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>Password konfirmasi tidak sesuai</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-input" name="password_confirmation" id="password-confirmation" placeholder="Konfirmasi Password"/>
                                        <span toggle="#password-confirmation" class="zmdi zmdi-eye field-icon toggle-password"></span>
                                    </div>
                                </div>
                            </div><br>
                        <div class="form-group">
                            <button type="submit" class="form-submit">Daftar</button>
                        </div>
                    </form>
                    <center><h class="loginhere">
                        Sudah punya akun? <a href="{{ route('login') }}" class="loginhere-link">Login di sini</a>
                    </h></center>
                    <hr>
                    <p>Kembali ke <a href="{{ route('home') }}" class="loginhere-link">Beranda</a></p>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('/vendor/jquery/regist.min.js') }}"></script>
    <script src="{{ asset('/js/register.js') }}"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"68f0132ccea7140e","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.8.1","si":10}'></script>
</body>
</html>