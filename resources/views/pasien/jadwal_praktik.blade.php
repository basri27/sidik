@extends('layouts.back')

@section('title', 'Profil Pasien')

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
        <a class="nav-link" href="#">
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
        <a class="nav-link" href="#">
            <i class="fas fa-id-card"></i>
            <span>Kartu Berobat</span>
        </a>
    </li>
@endsection

@section('subhead', 'Profil Pasien')

@section('foto')
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/pasien/' . $pasien->foto_pasien) }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-dark" style="text-align: center; font-size: 70%; color: white;">
                    
                    <thead>
                        <tr class="bg-dark">
                            @foreach($jadwal_praktek as $j)<th>{{ $j->hari }}</th>@endforeach
                        </tr>
                    </thead>
                    <tbody style="color: black">                        
                        <tr>
                        @foreach($jadwal_praktek as $jp)
                            <td>
                                {{ $jp->tenkesehatan->nama_tenkes}}<br>({{ $jp->pagi }})
                            </td>                        
                        @endforeach</tr>
                        <tr>
                            @foreach($jadwal_praktek as $jp)
                            <td>
                                {{ $jp->nakes_2}}<br>({{ $jp->siang }})
                            </td>                        
                            @endforeach
                        </tr>
                    </tbody>
                    
                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection