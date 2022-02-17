@extends('layouts.back')

@section('title', 'Profil Admin')

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

@section('subhead', 'Profil Admin')

@section('foto')
@include('layouts.foto_profil_admin')
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
                <div class="image-col col-md-2">
                    <img src="{{ asset('/foto_profil/admin/' . $admin->foto_admin) }}" alt=""><br><br>
                    @if($admin->foto_admin != 'default.jpg')
                    <form method="POST" action={{ route('adm_reset_foto', $admin->user_id) }}>
                    @method('PATCH')
                    @csrf
                        <button type="submit" class="btn btn-sm btn-danger col" href="#"><i class="fas fa-trash"></i>&ensp;Hapus foto profil</button>
                    </form>
                    @endif
                </div>
                <div class="detail-col col-md-8">
                    <h2 class="font-weight-bold">{{ $admin->nama_admin }}</h2>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Tanggal Lahir: {{ \Carbon\Carbon::parse($admin->tgl_lhr_admin)->format('d F Y') }}</li>
                                    <li>Tempat Lahir: {{ $admin->tempat_lhr_admin }}</li>
                                    <li>Alamat: {{ $admin->alamat_admin }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Umur: {{ $age }} tahun</li>
                                    <li>Phone: <span class="text-primary">{{ $admin->no_hp_admin}}</span></li>
                                    <li>Jenis Kelamin: {{ $admin->jk_admin }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('adm_edit_profil', $admin->user_id) }}" class="btn btn-primary btn-sm">
                        <span>
                            <i class="fas fa-edit"></i>
                        </span>    
                        <span class="text">Ubah profil</span>
                    </a>&nbsp;
                    <a href="{{ route('adm_edit_userpw', $admin->user_id) }}" class="btn btn-success btn-sm">
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