@extends('layouts.back')

@section('title', 'Jadwal Praktek')

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
<li class="nav-item active">
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

@section('subhead', 'Jadwal Praktek')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="text-align: center; font-size: 70%; color: white;">
                    <thead class="bg-dark">
                        <tr>
                            @foreach ($jadwals as $jadwal)
                            <th scope="col sm-1">{{ $jadwal->hari }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($tenkes1 as $tks1)
                            <th>
                                ({{ $tks1->nama }})
                            </th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($tenkes2 as $tks2)
                            <th>
                                ({{ $tks2->nama }})
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody style="color: black">
                        <tr>
                            @foreach ($jadwals as $jadwal)
                            <td>{{ $jadwal->pagi_s }} - {{ $jadwal->pagi_n }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($jadwals as $jadwal)
                            <td>{{ $jadwal->siang_s }} - {{ $jadwal->siang_n }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($jadwals as $jadwal)
                            <td>
                                <a href="{{ route('adm_jadwal_edit', $jadwal->id) }}" class="btn btn-primary btn-icon-split btn-sm">
                                    <span><i class="fas fa-edit"></i></span>    
                                    <span class="text">Edit</span>
                                </a>
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