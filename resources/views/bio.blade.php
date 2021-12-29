<!DOCTYPE html>
<html lang="en">
<head>
    <title>Biodata - LMMC Banjarmasin</title>
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
                    <form method="POST" id="signup-form" class="signup-form " action="{{ route('add_bio') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <h2 class="form-title">Isi Biodata</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="id_pasien" id="id_pasien" value="{{ $id_pasien->id }}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama">
						</div>
                        <div class="form-group">
                            <select class="form-input" name="jk" id="jk">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
				        </div>
                        <div class="form-group">
                            <select class="form-input" name="kategori" id="kategori">
                                @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-input" name="fakultas" id="fakultas">
                                @foreach ($fakultas as $fak)
                                <option value="{{ $fak->id }}">{{ $fak->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-input" name="prodi" id="prodi">
                                @foreach ($prodi as $pro)
                                <option value="{{ $pro->id }}">{{ $pro->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <diV class="form-group">
                            <input class="form-input" type="date" name="tgl_lhr" id="tgl_lhr">
                        </diV>
                        <div class="form-group">
                            <input class="form-input" type="text" name="nohp" id="nohp" placeholder="081234567899">
                        </div>
                        <div class="form-group">
                            <input class="form-input" type="text" name="alamat" id="alamat" placeholder="Alamat">
                        </div>
                        <!-- <div class="form-group">
                            <input type="file" class="form-input" name="foto" id="foto">
                        </div> -->
                        <div class="form-group">
                            <button type="submit" class="form-submit">Simpan</button>
                        </div>
                    </form>
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