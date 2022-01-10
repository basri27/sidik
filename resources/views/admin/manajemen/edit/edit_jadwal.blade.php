@extends('layouts.back')

@section('title', 'Ubah Jadwal Praktek')

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

@section('subhead', 'Ubah Jadwal Praktek')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action={{ route('adm_jadwal_update', $jadwals->id) }} method="POST">
                @method('PATCH')
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered col-12" style="text-align: center; font-size: 70%; color: white;" width="100%" cellspacing="0">
                        <thead class="bg-dark">   
                            <tr>
                                <th scope="col sm-1">{{ $jadwals->hari}}</th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="tenkes1">Pilih Dokter: </label>
                                    <select name="tenkes1" class="form-control">
                                        <option value="">Kosong</option>
                                        @foreach ($tenkes as $tks)
                                        <option value="{{ $tks->id }}">{{ $tks->nama }}</option>
                                        @endforeach
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for="tenkes2">Pilih Tenaga Kesehatan: </label>
                                    <select name="tenkes2" class="form-control">
                                        <option value="">Kosong</option>
                                        @foreach ($tenkes as $tks)
                                        <option value="{{ $tks->id }}">{{ $tks->nama }}</option>
                                        @endforeach
                                    </select>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <label style="color: black"><b>Pagi:</b></label><br>
                                    <input class="form-control-sm" type="time" name="pagi_s" value={{ $jadwals->pagi_s }}>
                                    <input class="form-control-sm" type="time" name="pagi_n" value={{ $jadwals->pagi_n }}>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label style="color: black"><b>Siang:</b></label><br>
                                    <input class="form-control-sm" type="time" name="siang_s" value={{ $jadwals->siang_s }}>
                                    <input class="form-control-sm" type="time" name="siang_n" value={{ $jadwals->siang_n }}>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                    <span>
                        <i class="fas fa-check"></i>
                    </span>    
                    <span class="text">Simpan</span>
                </button>&nbsp;
                <a href="{{ route('adm_jadwal') }}" class="btn btn-secondary btn-icon-split btn-sm">
                    <span>
                        <i class="fas fa-times"></i>
                    </span>    
                    <span class="text">Batal</span>
                </a>
            </form>
        </div>
    </div>
</div>
@endsection