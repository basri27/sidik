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
            <div class="container">
                <div class="signup-content">
                    <form method="POST" action="{{ route('add_bio') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <h2>Isi Biodata</h2>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Nama:</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Tempat lahir:</label>
                                        <input class="form-control" type="text" name="tempat_lhr" placeholder="Tempat Lahir" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="info-list">
                                    <diV class="form-group">
                                        <label class="font-weight-bold text-primary">Tanggal lahir:</label>
                                        <input class="form-control" type="date" name="tgl_lhr" required>
                                    </diV>        
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">No. HP:</label>
                                        <input class="form-control" type="text" name="nohp" placeholder="No. HP" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Alamat:</label>
                                        <input class="form-control" type="text" name="alamat" placeholder="Alamat" required>
                                    </div>        
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Jenis kelamin:</label><br>
                                        <select class="form-control" name="jk" required>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>            
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Kategori:</label>
                                        <select class="form-control" name="kategori" onChange="kategori(this)" required>
                                            @foreach ($kategori as $kat)
                                            <option value="{{ $kat->id }}">{{ $kat->id }}</option>
                                            @endforeach
                                        </select>
                                    </div>            
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Fakultas:</label>
                                        <select class="form-control" name="fakultas" id="fakultas_id">
                                            <option value="">Fakultas</option>
                                            @foreach ($fakultas as $fak)
                                            <option value="{{ $fak->id }}">{{ $fak->nama_fakultas }}</option>
                                            @endforeach
                                        </select>
                                    </div>            
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Program studi:</label>
                                        <select class="form-control" name="prodi" id="prodi_id">
                                            <option value="">Program Studi</option>
                                            @foreach ($prodi as $pro)
                                            <option value="{{ $pro->id }}">{{ $pro->nama_prodi }}</option>
                                            @endforeach
                                        </select>
                                    </div>            
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Upload foto</label>
                                        <input type="file" name="foto">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <input type="file" class="form-control" name="foto" id="foto">
                        </div> -->
                        <div class="form-group">
                            <button type="submit" class="form-submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <script>
        function kategori(select)
        {
            var f = document.getElementById('fakultas_id');
            var p = document.getElementById('prodi_id');

            if(select.value == '4') {
                f.disabled = true;
                f.value = '1';
                p.disabled = true;
                p.value = '1';
            }
            else if (select.value == '2') {
                p.disabled = true;
                p.value = '1';
            }
            else {
                f.disabled = "false";
                p.disabled = "false";
            }
        }
    </script>
    <script src="{{ asset('/vendor/jquery/regist.min.js') }}"></script>
    <script src="{{ asset('/js/register.js') }}"></script>

    
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js" data-cf-beacon='{"rayId":"68f0132ccea7140e","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.8.1","si":10}'></script>
</body>
</html>