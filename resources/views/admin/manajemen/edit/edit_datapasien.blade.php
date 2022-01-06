@extends('layouts.back')

@section('title', 'Ubah Data Pasien')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
@endsection

@section('menu')
<li class="nav-item">
    <a class="nav-link" href="{{ route('adm_dashboard') }}">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('adm_profil', Auth::user()->id) }}">
        <i class="fas fa-user"></i>
        <span>Profil</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('adm_jadwal') }}">
        <i class="fas fa-calendar-alt"></i>
        <span>Jadwal Praktek</span>
    </a>
</li>
<li class="nav-item active">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-wrench"></i>
        <span>Manajemen Data</span>
    </a>
    <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pilih:</h6>
            <a class="collapse-item active" href="{{ route('adm_man_datapasien') }}">Pasien</a>
            <a class="collapse-item" href="{{ route('adm_man_dataapoteker') }}">Apoteker</a>
            <a class="collapse-item" href="{{ route('adm_man_datanakes') }}">Tenaga Kesehatan</a>
            <a class="collapse-item" href="#">Dokumentasi Kegiatan</a>
            <a class="collapse-item" href="{{ route('adm_man_datarekammedik') }}#">Rekam Medik</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-tasks"></i>
        <span>Rekap Rekam Medik</span>
    </a>
</li>
@endsection

@section('subhead', 'Ubah Data Pasien')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('adm_man_datapasien_update', $pasiens->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $pasiens->nama }}">
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Tempat lahir</label>
                                        <input type="text" name="tempat_lhr" class="form-control" value="{{ $pasiens->tempat_lhr }}">
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                        <input type="date" name="tgl_lhr" class="form-control" value="{{ $pasiens->tgl_lhr }}">
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">No. Hp</label>
                                        <input type="text" name="no_hp" class="form-control" value="{{ $pasiens->no_hp }}">
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" value="{{ $pasiens->alamat }}">
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                        <select class="form-control" name="jk" id="jk">
                                            <option value="{{ $pasiens->jk }}" selected>{{ $pasiens->jk }}</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Kategori</label>
                                        <select class="form-control" name="category_id" onChange="kategori(this)">
                                            <option value="{{ $pasiens->category_id }}" selected>{{ $pasiens->category->nama }}</option>
                                            @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    @if ($pasiens->category_id == '1' or $pasiens->category_id == '3')
                                    <li>
                                        <label class="font-weight-bold text-primary" id="label_f">Fakultas</label>
                                        <select class="form-control" name="fakulta_id" id="fakulta_id">
                                            <option value="{{ $pasiens->fakulta_id }}" selected>{{ $pasiens->fakulta->nama }}</option>
                                            @foreach ($fakultas as $fak)
                                            <option value="{{ $fak->id }}">{{ $fak->nama }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" id="label_p">Program Studi</label>
                                        <select class="form-control" name="prodi_id" id="prodi_id">
                                            <option value="{{ $pasiens->prodi_id }}" selected>{{ $pasiens->prodi->nama }}</option>
                                            @foreach ($prodis as $prodi)
                                            <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    @elseif ($pasiens->category_id == '2')
                                    <li>
                                        <label class="font-weight-bold text-primary" id="label_f">Fakultas</label>
                                        <select class="form-control" name="fakulta_id" id="fakulta_id">
                                            <option value="{{ $pasiens->fakulta_id }}" selected>{{ $pasiens->fakulta->nama }}</option>
                                            @foreach ($fakultas as $fak)
                                            <option value="{{ $fak->id }}">{{ $fak->nama }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" id="label_p">Program Studi</label>
                                        <select class="form-control" name="prodi_id" id="prodi_id" disabled>
                                            <option value="{{ $pasiens->prodi_id }}" selected>{{ $pasiens->prodi->nama }}</option>
                                            @foreach ($prodis as $prodi)
                                            <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    @else
                                    <li>
                                        <label class="font-weight-bold text-primary" id="label_f">Fakultas</label>
                                        <select class="form-control" name="fakulta_id" id="fakulta_id" disabled>
                                            <option value="{{ $pasiens->fakulta_id }}" selected>{{ $pasiens->fakulta->nama }}</option>
                                            @foreach ($fakultas as $fak)
                                            <option value="{{ $fak->id }}">{{ $fak->nama }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" id="label_p">Program Studi</label>
                                        <select class="form-control" name="prodi_id" id="prodi_id" disabled>
                                            <option value="{{ $pasiens->prodi_id }}" selected>{{ $pasiens->prodi->nama }}</option>
                                            @foreach ($prodis as $prodi)
                                            <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    @endif
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                        <span>
                            <i class="fas fa-check"></i>
                        </span>    
                        <span class="text">Simpan</span>
                    </button>&nbsp;
                    <a href="{{ route('adm_man_datapasien') }}" class="btn btn-secondary btn-icon-split btn-sm">
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
<script>
    function kategori(select)
    {
        var f = document.getElementById('fakulta_id');
        var p = document.getElementById('prodi_id');
        var lf = document.getElementById('label_f');
        var lp = document.getElementById('label_p');

        if(select.value == '4') {
            f.disabled = true;
            f.value = '1';
            p.disabled = true;
            p.value = '1';
        }
        else if (select.value == '2') {
            f.disabled = false;
            p.disabled = true;
            p.value = '1';
        }
        else {
            f.disabled = false;
            p.disabled = false;
        }
    }
</script>
@endsection