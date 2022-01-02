@extends('layouts.back')

@section('title', 'Profil')

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
<li class="nav-item active">
    <a class="nav-link" href={{ route('adm_profil', Auth::user()->id) }}>
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
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Manajemen Data</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pilih:</h6>
            <a class="collapse-item" href="{{ route('admin_man_datapasien') }}">Pasien</a>
            <a class="collapse-item" href="{{ route('admin_man_dataapoteker') }}">Apoteker</a>
            <a class="collapse-item" href="{{ route('admin_man_datanakes') }}">Tenaga Kesehatan</a>
            <a class="collapse-item" href="#">Dokumentasi Kegiatan</a>
            <a class="collapse-item" href="{{ route('admin_man_datarekammedik') }}">Rekam Medik</a>
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

@section('subhead', 'Profil')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="image-col col-md-2">
                    <img src="{{ asset('/img/klinik.png') }}" alt="">
                </div>
                <div class="detail-col col-md-8">
                    <h2>{{ Auth::user()->admin->nama }}</h2>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul>
                                    <li><span>Tanggal Lahir: </span>{{ Auth::user()->admin->tgl_lhr }}</li>
                                    <li><span>Tempat Lahir: </span>{{ Auth::user()->admin->tempat_lhr }}</li>
                                    <li><span>Alamat: </span>{{ Auth::user()->admin->alamat }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul>
                                    <li><span>Umur: </span>{{ $age }}</li>
                                    <li><span>Phone: </span>{{ Auth::user()->admin->no_hp}}</li>
                                    <li><span>Jenis Kelamin: </span>{{ Auth::user()->admin->jk }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('adm_edit_profil', Auth::user()->id) }}" class="btn btn-primary btn-icon-split btn-sm">
                        <span>
                            <i class="fas fa-edit"></i>
                        </span>    
                        <span class="text">Ubah profil</span>
                    </a>&nbsp;
                    <a href="{{ route('adm_edit_userpw', Auth::user()->id) }}" class="btn btn-success btn-icon-split btn-sm">
                        <span>
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Ubah username dan password</span>    
                    </a>
                </div>                    
            </div>
        </div>
    </div>
</div>
@endsection