@extends('layouts.back')

@section('title', 'Dashboard')

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

@section('subhead', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pasien</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pasiens }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-md fa-2x text-gray-500"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Tenaga Kesehatan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nakes }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-nurse fa-2x text-gray-500"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Data Rekam Medik</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rekammedik }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-notes-medical fa-2x text-gray-500"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Apoteker</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $apoteker }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-capsules fa-2x text-gray-500"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection