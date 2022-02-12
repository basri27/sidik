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
        <a class="nav-link" href={{ route('apoteker_profil', Auth::user()->id) }}>
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href={{ route('apoteker_data_obat', Auth::user()->id) }}>
            <i class="fas fa-capsules"></i>
            <span>Data Obat</span>
        </a>
    </li>
@endsection

@section('subhead', 'Profil Apoteker')

@section('notif')
    @include('layouts.notification.notif_apoteker')
@endsection

@section('foto')
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/' . Auth::user()->apoteker->foto_apoteker) }}">
@endsection

@section('content')
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="card shadow mb-4">         
        <div class="card-body">        
            <div class="about-row row">
                <div class="col-md-2">
                    <img src="{{ asset('/foto_profil/' . $apoteker->foto_apoteker) }}" alt=""><br><br>
                    @if($apoteker->foto_apoteker != 'default.jpg')
                    <form method="POST" action={{ route('apoteker_reset_foto', $apoteker->user_id) }}>
                    @method('PATCH')
                    @csrf
                        <button type="submit" class="btn btn-sm btn-danger col" href="#"><i class="fas fa-trash"></i>&ensp;Hapus foto profil</button>
                    </form>
                    @endif
                </div>
                <div class="detail-col col-md-8">
                    <h3 class="font-weight-bold">{{ $apoteker->nama_apoteker }}</h3 class="font-weight-bold">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Tanggal Lahir: <span class="font-weight-bold">{{ \Carbon\Carbon::parse($apoteker->tgl_lhr_apoteker)->format('d F Y') }}</span></li>
                                    <li>Tempat Lahir: <span class="font-weight-bold">{{ $apoteker->tempat_lhr_apoteker }}</span></li>
                                    <li>Alamat: <span class="font-weight-bold">{{ $apoteker->alamat_apoteker }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Umur: <span class="font-weight-bold text-dark">{{ $age }} tahun</span></li>
                                    <li>Phone: <span class="font-weight-boldl text-primary">{{ $apoteker->nohp_apoteker}}</span></li>
                                    <li>Jenis Kelamin: <span class="font-weight-bold text-dark">{{ $apoteker->jk_apoteker }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('apoteker_edit_profil', Auth::user()->id) }}" class="btn btn-primary btn-sm">
                        <span>
                            <i class="fas fa-edit"></i>
                        </span>    
                        <span class="text">Ubah profil</span>
                    </a>&nbsp;
                    <a href="{{ route('apoteker_edit_userpw', Auth::user()->id) }}" class="btn btn-success btn-sm">
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