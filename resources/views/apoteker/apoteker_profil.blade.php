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
    <a class="nav-link" href={{ route('apoteker_dashboard', Auth::user()->id) }}>
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="nav-item active">
    <a class="nav-link" href=#>
        <i class="fas fa-user"></i>
        <span>Profil</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="">
        <i class="fas fa-capsules"></i>
        <span>Data Obat</span>
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
                    <h2>{{ Auth::user()->apoteker->nama_admin }}</h2>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul>
                                    <li><span>Tanggal Lahir: </span>{{ \Carbon\Carbon::parse(Auth::user()->apoteker->tgl_lhr_admin)->format('d F Y') }}</li>
                                    <li><span>Tempat Lahir: </span>{{ Auth::user()->apoteker->tempat_lhr_admin }}</li>
                                    <li><span>Alamat: </span>{{ Auth::user()->apoteker->alamat_admin }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul>
                                    <li><span>Umur: </span>{{ $age }}</li>
                                    <li><span>Phone: </span>{{ Auth::user()->apoteker->no_hp_admin}}</li>
                                    <li><span>Jenis Kelamin: </span>{{ Auth::user()->apoteker->jk_admin }}</li>
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