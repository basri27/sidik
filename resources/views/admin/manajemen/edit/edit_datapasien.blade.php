@extends('layouts.back')

@section('title', 'Ubah Data Pasien')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/dashboard/select2.min.css') }}">
@endsection

@section('menu')
@include('layouts.nav_admin')
@endsection

@section('subhead', 'Ubah Data Pasien')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('adm_man_datapasien_update', $pasien->id) }}">
                    @method('PATCH')
                    @csrf
                    <body onload="editPasien()">
                        <table class="table table-borderless">
                            <tr>
                                <td><img src="{{ asset('img/logo-ulm1.png') }}"></td>
                                <td class="text-center">
                                    <h6>KLINIK PRATAMA LAMBUNG MANGKURAT MEDICAL CENTER (LMMC)</h6>
                                    <h6>UNIVERSITAS LAMBUNG MANGKURAT</h6>
                                </td>
                                <td><img src="{{ asset('img/logo-klinik1.png') }}"></td>
                            </tr>
                        </table>
                        <center><h5><u>BIODATA PASIEN</u></h5></center>
                        <table class="table table-borderless">
                            <tr>
                                <td>No. Indeks</td>
                                <td>:</td>
                                <td>{{ $pasien->id }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><input type="text" name="nama" class="form-control" value="{{ $pasien->nama_pasien }}"></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td> 
                                    <select name="jk" class="form-control">
                                        <option value="{{ $pasien->jk_pasien }}">{{ $pasien->jk_pasien }}</option>
                                        @if ($pasien->jk_pasien == "Laki-laki")
                                        <option value="Perempuan">Perempuan</option>
                                        @elseif ($pasien->jk_pasien == "Perempuan")
                                        <option value="Laki-laki">Laki-laki</option>
                                        @else
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>TTL</td>
                                <td>:</td>
                                <td>
                                    <div class="row pl-3">
                                        <input type="text" class="form-control col-5" name="tempat_lhr" value="{{ $pasien->tempat_lhr_pasien }}">&ensp;
                                        <input type="date" class="form-control col-5" name="tgl_lhr" value="{{ $pasien->tgl_lhr_pasien }}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <?php
                                    $dosen = \App\Models\Dosen::where('pasien_id', $pasien->id)->first();
                                    $mhs = \App\Models\Mahasiswa::where('pasien_id', $pasien->id)->first();
                                    $kary = \App\Models\Karyawan::where('pasien_id', $pasien->id)->first();
                                    $bpjs = \App\Models\Bpjs::where('pasien_id', $pasien->id)->first();
                                ?>
                                <td>Kategori</td>
                                <td>:</td>
                                <td>
                                    <div class="row pl-3">
                                        <select class="form-control col-3" name="category_id" id="category_id" onchange="ktg(this)" required>
                                            <option value="{{ $pasien->category_id }}">{{ $pasien->category->nama_kategori }}</option>
                                            <?php $kategori = \App\Models\Category::where('id', '!=', $pasien->category_id)->get() ?>
                                            @foreach ($kategori as $ct)
                                            <option value="{{ $ct->id }}">{{ $ct->nama_kategori }}</option>
                                            @endforeach
                                        </select>&ensp;
                                        <select class="form-control col-3" name="fakulta_id" id="fakulta_id">
                                            @if ($pasien->category_id == 1)
                                            <option value="{{ $dosen->fakulta_id }}">{{ $dosen->fakulta->nama_fakultas }}</option>
                                            @elseif ($pasien->category_id == 2)
                                            <option value="{{ $kary->fakulta_id }}">{{ $kary->fakulta->nama_fakultas }}</option>
                                            @elseif ($pasien->category_id == 3)
                                            <option value="{{ $mhs->fakulta_id }}">{{ $mhs->fakulta->nama_fakultas }}</option>
                                            @endif
                                            @foreach ($fakultas as $fak)
                                            <option value="{{ $fak->id }}">{{ $fak->nama_fakultas }}</option>
                                            @endforeach
                                        </select>&ensp;
                                        <select class="form-control col-3" name="prodi_id" id="prodi_id">
                                            @if ($pasien->category_id == 3)
                                            <option value="{{ $mhs->prodi_id }}">{{ $mhs->prodi->nama_prodi }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr id="bpjs" style="display: none;">
                                <td>No. BPJS</td>
                                <td>:</td>
                                <td>
                                    @if ($pasien->category_id == 5)
                                    <input type="text" name="no_bpjs" class="form-control" value="{{ $bpjs->no_bpjs }}">
                                    @else
                                    <input type="text" name="no_bpjs" class="form-control">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" name="alamat" value="{{ $pasien->alamat_pasien }}"></td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" name="no_hp" value="{{ $pasien->no_hp_pasien }}"></td>
                            </tr>
                        </table>
                    </body>
                    <button type="submit" class="btn btn-success btn-sm">
                        <span>
                            <i class="fas fa-check"></i>
                        </span>    
                        <span class="text">Simpan</span>
                    </button>&nbsp;
                    <a href="{{ route('adm_man_datapasien') }}" class="btn btn-secondary btn-sm">
                        <span>
                            <i class="fas fa-times"></i>
                        </span>    
                        <span class="text">Batal</span>
                    </a>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/dashboard/select2.min.js') }}" defer></script>
<script>
    

    function ktg(select)
    {
        var f = document.getElementById('fakulta_id');
        var p = document.getElementById('prodi_id')

        if (select.value == 1 || select.value == 2) {
            f.disabled = false
            p.disabled = true;
            $('#fakulta_id').select2()
            $('#bpjs').hide()
        }   
        else if (select.value == 3) {
            f.disabled = false
            p.disabled = false
            $('#fakulta_id').select2()
            $('#prodi_id').select2()
            $('#bpjs').hide()
        }
        else if (select.value == 4) {
            f.disabled = true
            p.disabled = true
            $('#bpjs').hide()
        }
        else if (select.value == 5) {
            $('#bpjs').show()
            f.disabled = true
            p.disabled = true
        }
    }
    function editPasien() {
        var k = document.getElementById('category_id');
        var f = document.getElementById('fakulta_id');
        var p = document.getElementById('prodi_id')

        $('#category_id').select2()
        $('#fakulta_id').select2()
        $('#prodi_id').select2()

        if (k.value == 1 || k.value == 2) {
            p.disabled = true;
        }   
        else if (k.value == 4) {
            f.disabled = true
            p.disabled = true
        }
        else if (k.value == 5) {
            $('#bpjs').show()
            f.disabled = true
            p.disabled = true
        }

        $('#fakulta_id').on('change', function() {
            var fakultasID = $(this).val();
            if(fakultasID) {
                $.ajax({
                    url: '/getProdi/'+fakultasID,
                    type: "GET",
                    data: {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success: function(data)
                    {
                        if(data){
                            $('#prodi_id').empty();
                            $.each(data, function(key, prodi){
                                $('select[name="prodi_id"]').append('<option value="'+ prodi.id +'">' + prodi.nama_prodi + '</option>');
                            });
                        } else {
                            $('#prodi_id').empty();
                        }
                    }
                });
            }
        });
    }
</script>
@endsection