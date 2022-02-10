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
@include('layouts.nav_admin')
@endsection

@section('subhead', 'Ubah Jadwal Praktek')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action={{ route('adm_jadwal_update', $jadwals->id) }} method="POST">
                @method('PATCH')
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered col-12" style="text-align: center; font-size: 70%; color: white;" width="100%" cellspacing="0">
                        <thead>   
                            <tr class="bg-dark">
                                <th scope="col sm-1">{{ $jadwals->hari}}</th>
                            </tr>
                            <tr class="bg-info">
                                <th>
                                    <label for="tenkes1">Pilih Dokter: </label>
                                    <select name="tenkes1" class="form-control">
                                        <option value="">Kosong</option>
                                        @foreach ($tenkes as $tks)
                                        <option value="{{ $tks->id }}">{{ $tks->nama_tenkes }}</option>
                                        @endforeach
                                    </select>
                                </th>
                            </tr>
                            <tr class="bg-info">
                                <th>
                                    <label for="tenkes2">Pilih Dokter: </label>
                                    <select name="tenkes2" class="form-control">
                                        <option value="">Kosong</option>
                                        @foreach ($tenkes as $tks)
                                        <option value="{{ $tks->id }}">{{ $tks->nama_tenkes }}</option>
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