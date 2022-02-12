@extends('layouts.back')

@section('title', 'Ubah Profil Apoteker')

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

@section('subhead', 'Ubah Profil Apoteker')

@section('notif')
    @include('layouts.notification.notif_apoteker')
@endsection

@section('foto')
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/' . Auth::user()->apoteker->foto_apoteker) }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <!-- <div class="image-col col-md-2">
                    <hr><img src="{{ asset('/img/klinik.png') }}" alt=""><hr>
                </div> -->
                <div class="detail-col col-md-12">
                    <form method="POST" enctype="multipart/form-data" action={{ route('apoteker_update_profil', $apoteker->user_id) }}>
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $apoteker->nama_apoteker }}" required>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Tanggal lahir</label>
                                        <input type="date" name="tgl_lhr" class="form-control" value="{{ $apoteker->tgl_lhr_apoteker }}" required>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Tempat lahir</label>
                                        <input type="text" name="tempat_lhr" class="form-control" value="{{ $apoteker->tempat_lhr_apoteker }}" required>
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
                                        <label class="font-weight-bold text-primary" for="">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" value="{{ $apoteker->alamat_apoteker }}" required>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">No. Hp</label>
                                        <input type="text" name="no_hp" class="form-control" value="{{ $apoteker->nohp_apoteker }}" required>
                                        
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Jenis Kelamin</label>
                                        <select class="form-control" name="jk" id="jk">
                                            <option value="{{ $apoteker->jk_apoteker }}">{{ $apoteker->jk_apoteker }}</option>
                                            @if($apoteker->jk_apoteker == "Laki-laki")
                                            <option value="Perempuan">Perempuan</option>
                                            @elseif($apoteker->jk_apoteker == "Perempuan")
                                            <option value="Laki-laki">Laki-laki</option>
                                            @else
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                            @endif
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
                                        <label class="font-weight-bold text-primary">Foto Profil</label>
                                        <div class="image-col col-md-7">
                                            <img src="{{ asset('/foto_profil/' . $apoteker->foto_apoteker) }}" alt="">
                                        </div>                                        
                                    </li>
                                    <br>
                                    <li>
                                        <div class="row container">
                                            <input type="file" name="foto_apoteker">
                                        </div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <span>
                            <i class="fas fa-check"></i>&nbsp;
                        </span>    
                        <span class="text">Simpan</span>
                    </button>
                    <a href={{ route('apoteker_profil', $apoteker->user_id) }} class="btn btn-secondary btn-sm">
                        <span>
                            <i class="fas fa-times"></i>&nbsp;
                        </span>    
                        <span class="text">Batal</span>
                    </a>
                    </form>
                </div>                    
            </div>
        </div>
    </div>
</div>
@endsection