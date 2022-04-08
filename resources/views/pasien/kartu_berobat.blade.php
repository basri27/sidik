@extends('layouts.back')

@section('title', 'Kartu Berobat')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
@endsection

@section('menu')
    @include('layouts.nav_pasien')
@endsection

@section('subhead', 'Kartu Berobat Pasien')

@section('foto')
    <?php 
        $p = \App\Models\Pasien::where('user_id', $pasien->id)->first();
        $kp = \App\Models\KeluargaPasien::where('user_id', $pasien->id)->first();
        if ($p != null) {
            $dosen = \App\Models\Dosen::where('pasien_id', $p->id)->first();
            $kary = \App\Models\Karyawan::where('pasien_id', $p->id)->first();
            $mhs = \App\Models\Mahasiswa::where('pasien_id', $p->id)->first();
            $bpjs = \App\Models\Bpjs::where('pasien_id', $p->id)->first();
        }
    ?>
    @if ($p != null)
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/pasien/' . $p->foto_pasien) }}">
    @else
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/keluarga_pasien/' . $kp->foto_kel_pasien) }}">
    @endif
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-body">
                @if ($p != null)
                <a href="{{ route('print_kartu_berobat', $p->user_id) }}" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-print"></i>&nbsp;Cetak Kartu Berobat</a><br><br>
                <div class="table-responsive">
                    <center>
                        <table class="table table-borderless col-8">
                            <thead>
                                <tr class="text-center border border-dark">
                                    <th><img src="{{ asset('img/logo-ulm1.png') }}"></th>
                                    <th>
                                        <h4 class="font-weight-bold">KARTU BEROBAT</h4>
                                        <h5 class="font-weight-bold">KLINIK PRATAMA</h5>
                                        <h6 class="font-weight-bold">LAMBUNG MANGKURAT MEDICAL CENTER (LMMC)</h6>
                                    </th>
                                    <th><img src="{{ asset('img/logo-klinik1.png') }}"></th>
                                </tr>
                            </thead>
                            <tbody class="border border-dark text-uppercase">
                                <tr>
                                    <td></td>
                                    <td>nama<span class="text-center">:</span>&nbsp;{{ $p->nama_pasien }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>indeks<span class="text-center">:</span>&nbsp;{{ $p->id }} / {{ $p->category->nama_kategori }} @if($p->category_id != 4) ULM @endif</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>umur<span class="text-center">:</span>&nbsp;{{ \Carbon\Carbon::parse($p->tgl_lhr_pasien)->age }} tahun</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>alamat<span class="text-center">:</span>&nbsp;{{ $p->alamat_pasien }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </center>
                </div>
                @else
                <a href="{{ route('print_kartu_berobat', $kp->user_id) }}" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-print"></i>&nbsp;Cetak Kartu Berobat</a><br><br>
                <div class="table-responsive">
                    <center>
                        <table class="table table-borderless col-8">
                            <thead>
                                <tr class="text-center border border-dark">
                                    <th><img src="{{ asset('img/logo-ulm1.png') }}"></th>
                                    <th>
                                        <h4 class="font-weight-bold">KARTU BEROBAT</h4>
                                        <h5 class="font-weight-bold">KLINIK PRATAMA</h5>
                                        <h6 class="font-weight-bold">LAMBUNG MANGKURAT MEDICAL CENTER (LMMC)</h6>
                                    </th>
                                    <th><img src="{{ asset('img/logo-klinik1.png') }}"></th>
                                </tr>
                            </thead>
                            <tbody class="border border-dark text-uppercase">
                                <tr>
                                    <td></td>
                                    <td>nama<span class="text-center">:</span>&nbsp;{{ $kp->nama_kel_pasien }}</td>
                                </tr>
                                <tr>
                                    <?php
                                        $dosen = \App\Models\Dosen::where('pasien_id', $kp->pasien->id)->first();
                                        $kary = \App\Models\Karyawan::where('pasien_id', $kp->pasien->id)->first();
                                    ?>
                                    <td></td>
                                    <td>indeks<span class="text-center">:</span>&nbsp;{{ $kp->id }} / {{ $kp->kategori_kel_pasien }}
                                        dari {{ $kp->pasien->nama_pasien }} ({{ $kp->pasien->category->nama_kategori }}
                                            @if ($kp->pasien->category_id == 1)
                                                {{ $dosen->fakulta->nama_fakultas }})
                                            @elseif ($kp->pasien->category_id == 2)
                                                {{ $kary->fakulta->nama_fakultas }})
                                            @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>umur<span class="text-center">:</span>&nbsp;{{ \Carbon\Carbon::parse($kp->tgl_lhr_kel_pasien)->age }} tahun</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>alamat<span class="text-center">:</span>&nbsp;{{ $kp->alamat_kel_pasien }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </center>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection