@extends('layouts.back')

@section('title', 'Ubah Username dan Password')

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
            <a class="collapse-item" href="{{ route('adm_man_datapasien') }}">Pasien</a>
            <a class="collapse-item" href="{{ route('adm_man_dataapoteker') }}">Apoteker</a>
            <a class="collapse-item" href="{{ route('adm_man_datanakes') }}">Tenaga Kesehatan</a>
            <a class="collapse-item" href="#">Dokumentasi Kegiatan</a>
            <a class="collapse-item" href="{{ route('adm_man_datarekammedik') }}">Rekam Medik</a>
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

@section('subhead', 'Ubah Username dan Password')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    <form method="POST" action={{ route('adm_update_userpw', $admins->id) }}>
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <ul>
                                        <li>
                                            <label class="font-weight-bold text-primary">Username:</label>
                                            <input type="text" name="username" class="form-control" value="{{ $admins->username }}">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Password Lama:</label>
                                        <input id="password-lama" type="password" name="password" class="form-control">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Password Baru:</label>
                                        <input id="password-baru" type="password" name="password" class="form-control">
                                        <input type="checkbox" class="form-control-input" onclick="showPassword()"> Tampilkan Password
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                        <span>
                            <i class="fas fa-check"></i>
                        </span>    
                        <span class="text">Simpan</span>
                    </button>&nbsp;
                    <a href="{{ route('adm_profil', $admins->id) }}" class="btn btn-secondary btn-icon-split btn-sm">
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
    function showPassword() {
        var x = document.getElementById('password-lama', 'password-baru');
        if (x.type === "password") {
            x.type = "text";
        }
        else {
            x.type = "password";
        }
    }
</script>
@endsection