@extends('layouts.back')

@section('title', 'Profil Keluarga Pasien')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
@endsection

@section('menu')
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('profil_pasien', Auth::user()->id) }}">
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pasien_jadwal_praktik', $pasien->user_id)}}">
            <i class="fas fa-calendar-alt"></i>
            <span>Jadwal Praktik</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-history"></i>
            <span>Riwayat Berobat</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kartu_berobat', $pasien->user_id) }}">
            <i class="fas fa-id-card"></i>
            <span>Kartu Berobat</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-users"></i>
            <span>Keluarga</span>
        </a>
    </li>
@endsection

@section('subhead', 'Profil Keluarga Pasien')

@section('foto')
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/pasien/' . $pasien->foto_pasien) }}">
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
                    <img src="{{ asset('/foto_profil/pasien/' . $pasien->foto_pasien) }}" alt=""><br><br>
                    @if(!empty($pasien->foto_pasien and $pasien->foto_pasien != 'default.jpg'))
                    <form method="POST" action={{ route('pasien_reset_foto', $pasien->user_id) }}>
                    @method('PATCH')
                    @csrf
                        <button type="submit" class="btn btn-sm btn-danger col" href="#"><i class="fas fa-trash"></i>&ensp;Hapus foto profil</button>
                    </form>
                    @endif
                </div>
                <div class="detail-col col-md-10">
                    <h3 class="font-weight-bold">
                        {{ $pasien->nama_pasien }}
                        <small class="font-weight-bold">({{ $pasien->category->nama_kategori }}@if($pasien->category_id != 4) ULM | {{ $pasien->fakulta->nama_fakultas }} | {{ $pasien->prodi->nama_prodi }} @endif)</small>
                        
                        
                        
                    </h3>
                    <!-- <h5 class="font-weight-bold">{{ $pasien->category->nama_kategori }}</h5> -->
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Tanggal Lahir: <span class="font-weight-bold">{{ \Carbon\Carbon::parse($pasien->tgl_lhr_pasien)->format('d F Y') }}</span></li>
                                    <li>Tempat Lahir: <span class="font-weight-bold">{{ $pasien->tempat_lhr_pasien }}</span></li>
                                    <li>Alamat: <span class="font-weight-bold">{{ $pasien->alamat_pasien }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Umur: <span class="font-weight-bold text-dark">{{ $age }} tahun</span></li>
                                    <li>Phone: <span class="font-weight-boldl text-primary">{{ $pasien->no_hp_pasien}}</span></li>
                                    <li>Jenis Kelamin: <span class="font-weight-bold text-dark">{{ $pasien->jk_pasien }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('pasien_edit_profil', Auth::user()->id) }}" class="btn btn-primary btn-sm">
                        <span>
                            <i class="fas fa-edit"></i>
                        </span>    
                        <span class="text">Ubah profil</span>
                    </a>&nbsp;
                    <a href="{{ route('pasien_edit_userpw', Auth::user()->id) }}" class="btn btn-success btn-sm">
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