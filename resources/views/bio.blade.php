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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                                        <select class="form-control" data-width="100%" name="kategori" id="ktg" onChange="category(this)" required>
                                            @foreach ($kategori as $kat)
                                            <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>            
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Fakultas:</label>
                                        <select class="form-control" data-width="100%" name="fakultas" id="fakultas_id" required>
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
                                        <select class="form-control" data-width="100%" name="prodi" id="prodi_id" required>
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
                                        <input class="form-control-file" type="file" name="foto_pasien" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#ktg').select2()
            $('#fakultas_id').select2()
            $('#prodi_id').select2()
        });
        function category(select)
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
                f.disabled = false
            }
            else {
                f.disabled = false;
                p.disabled = false;
            }
        }
    </script>
    <script src="{{ asset('/vendor/jquery/regist.min.js') }}"></script>
    <script src="{{ asset('/js/register.js') }}"></script>

    
    
</body>
</html>