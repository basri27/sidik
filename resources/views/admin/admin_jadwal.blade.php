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
@include('layouts.nav_admin')
@endsection

@section('subhead', 'Jadwal Praktek')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="text-align: center; font-size: 70%; color: white;">
                    <thead>
                        <tr class="bg-dark">
                            @foreach ($jadwals as $jadwal)
                            <th scope="col sm-1">{{ $jadwal->hari_jadwal }}</th>
                            @endforeach
                        </tr>
                    </thead>
                        <tr class="bg-info">
                            @foreach ($jadwals as $jadwal)
                                <th>
                                    @foreach ($tenkes as $tks)
                                        {{ ($tks->id == $jadwal->tenkes1) ?  $tks->nama_tenkes : '' }}
                                    @endforeach
                                </th>
                            @endforeach
                        </tr>
                    <tbody style="color: black">
                        <tr>
                            @foreach ($jadwals as $jadwal)
                            {{-- <td>{{ \Carbon\Carbon::parse($jadwal->pagi_s)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->pagi_n)->format('H:i') }}</td> --}}
                            <td>{{ $jadwal->waktu1 }}</td>
                            @endforeach
                        </tr>
                        <tr class="bg-info" style="color: white">
                            @foreach ($jadwals as $jadwal)
                                <th>
                                    @foreach ($tenkes as $tks)
                                    {{ ($tks->id == $jadwal->tenkes2) ?  $tks->nama_tenkes : '' }}
                                    @endforeach
                                </th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($jadwals as $jadwal)
                            <td>{{ $jadwal->waktu2 }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($jadwals as $jadwal)
                            <td>
                                <a href="{{ route('adm_jadwal_edit', $jadwal->id) }}">
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