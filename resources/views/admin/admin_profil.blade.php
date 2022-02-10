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
@include('layouts.nav_admin')
@endsection

@section('subhead', 'Profil')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="image-col col-md-2">
                    <img src="{{ asset('/img/klinik.png') }}" alt="">
                </div>
                <div class="detail-col col-md-8">
                    <h2>{{ Auth::user()->admin->nama_admin }}</h2>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul>
                                    <li><span>Tanggal Lahir: </span>{{ \Carbon\Carbon::parse(Auth::user()->admin->tgl_lhr_admin)->format('d F Y') }}</li>
                                    <li><span>Tempat Lahir: </span>{{ Auth::user()->admin->tempat_lhr_admin }}</li>
                                    <li><span>Alamat: </span>{{ Auth::user()->admin->alamat_admin }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul>
                                    <li><span>Umur: </span>{{ $age }}</li>
                                    <li><span>Phone: </span>{{ Auth::user()->admin->no_hp_admin}}</li>
                                    <li><span>Jenis Kelamin: </span>{{ Auth::user()->admin->jk_admin }}</li>
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