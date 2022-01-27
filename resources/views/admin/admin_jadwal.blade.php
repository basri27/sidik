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

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="text-align: center; font-size: 70%; color: white;">
                    <thead>
                        <tr class="bg-dark">
                            @foreach ($jadwals as $jadwal)
                            <th scope="col sm-1">{{ $jadwal->hari }}</th>
                            @endforeach
                        </tr>
                        <tr class="bg-info">
                            @foreach ($jadwals as $j)
                                <th>
                                @foreach ($j->tenkesehatan as $t)
                                    ({{ $t->nama_tenkes }}) <br>
                                @endforeach
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody style="color: black">
                        <tr>
                            @foreach ($jadwals as $jadwal)
                            <td>{{ \Carbon\Carbon::parse($jadwal->pagi_s)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->pagi_n)->format('H:i') }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($jadwals as $jadwal)
                            <td>{{ \Carbon\Carbon::parse($jadwal->siang_s)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->siang_n)->format('H:i') }}</td>
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