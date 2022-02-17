<!doctype html>
<html lang="en">
<head>
  	<title>Login - LMMC Banjarmasin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="{{ asset('/img/klinik.png') }}" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ asset('/css/login.css') }}">

</head>
<body class="bg-primary">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="login-wrap p-4 p-md-5">
        			      	<div class="d-flex">
		        	      		<div class="w-100">
			          		    	<h3 class="mb-4">Login</h3>
			      	        	</div>
								<div>
									<img class="float-right col-4" src="{{ asset('img/klinik.png') }}" alt="">
								</div>
			      	        </div>
							<form action="{{ route('login') }}" method="POST" class="signin-form">
								@csrf
			      		        <div class="form-group mt-3">
			      			        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>
			      			        <label class="form-control-placeholder" for="username">Username</label>
									<div class="invalid-feedback">
                                        @error('username')
                                        	<strong>Username atau password salah!</strong>
                                        @enderror
                                    </div>
			      		        </div>
		                        <div class="form-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
		                            <label class="form-control-placeholder" for="password">Password</label>
		                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		                        </div>
		                        <div class="form-group">
		                        	<button type="submit" class="form-control btn btn-primary">Login</button>
		                        </div>
                            </form>
		                    <p class="text-center">Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
                            <hr>
                            <p>Kembali ke <a href="{{ route('home') }}">Beranda</a></p>
		                </div>
		            </div>
				</div>
			</div>
		</div>
	</section>
	<script src="{{ asset('/js/login/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/login/popper.js') }}"></script>
    <script src="{{ asset('/js/login/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/login/main.js') }}"></script>
</body>
</html>