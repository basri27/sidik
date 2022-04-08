@extends('layouts.back')

@section('title', 'Kirim Data Rekam Medik')

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

@section('subhead', 'Kirim Data Rekam Medik')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('kirim_datarekammedikkeluarga', $pasien->id) }}">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <td><img src="{{ asset('img/logo-ulm1.png') }}"></td>
                                <td class="text-center">
                                    <h6>KLINIK PRATAMA LAMBUNG MANGKURAT MEDICAL CENTER (LMMC)</h6>
                                    <h6>UNIVERSITAS LAMBUNG MANGKURAT</h6>
                                </td>
                                <td class="float-right"><img src="{{ asset('img/logo-klinik1.png') }}"></td>
                            </tr>
                        </table>
                        <center><h5><u>KARTU RAWAT JALAN</u></h5></center>
                        <table class="font-weight-bold">
                            <tr>
                                <td>No. Indeks</td>
                                <td>&emsp;: {{ $pasien->id }}</td>
                            </tr>
                            <tr style="padding: 2px;">
                                <td>Nama</td>
                                <td>&emsp;: {{ $pasien->nama_kel_pasien }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>&emsp;: {{ $pasien->jk_kel_pasien }}</td>
                            </tr>
                            <tr>
                                <td>TTL</td>
                                <td>&emsp;: {{ $pasien->tempat_lhr_kel_pasien }}, {{ \Carbon\Carbon::parse($pasien->tgl_lhr_kel_pasien)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <?php
                                    $dosen = \App\Models\Dosen::where('pasien_id', $pasien->pasien->id)->first();
                                    $kary = \App\Models\Karyawan::where('pasien_id', $pasien->pasien->id)->first();
                                ?>
                                <td>Kategori</td>
                                <td>
                                    &emsp;: {{ $pasien->kategori_kel_pasien }} dari {{ $pasien->pasien->nama_pasien }} ({{ $pasien->pasien->category->nama_kategori }}
                                    @if ($pasien->pasien->category_id == 1)
                                    {{ $dosen->fakulta->nama_fakultas }})
                                    @elseif ($pasien->pasien->category_id == 2)
                                    {{ $kary->fakulta->nama_fakultas }})
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>&emsp;: {{ $pasien->alamat_kel_pasien }}</td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>&emsp;: {{ $pasien->no_hp_kel_pasien }}</td>
                            </tr></b>
                        </table>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>TGL PEMERIKSAAN</th>
                                    <th>PEMERIKSAAN/DIAGNOSA</th>
                                    <th>KETERANGAN</th>
                                    <th>TENAGA KESEHATAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>{{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('d-m-Y') }}</b></td>
                                    <td>
                                        <b>Suhu: <br><input class="form-control-sm col-8" type="number" min="25" max="40" step="0.01" name="suhu"> <small>&#8451;</small> <br>
                                        Tensi: <br><input class="form-control-sm col-4" type="number" name="tensi1">&nbsp;/&nbsp;<input class="form-control-sm col-4" type="number" name="tensi2"> <small>mmHg</small><br>
                                        Pemeriksaan: <br><textarea class="form-control-sm col-12" placeholder="Keluhan dan lain-lain" disabled></textarea> <br>
                                        Diagnosa: <br>
                                        <select class="form-control-sm col-12" disabled>
                                            <option>Pilih Diagnosa</option>
                                            @foreach($diagnosas as $d)
                                            <option value="{{ $d->id }}">{{ $d->nama_diagnosa }}</option>
                                            @endforeach
                                        </select></b>
                                    </td>
                                    <td>
                                        <textarea class="form-control-sm col-12" placeholder="Keterangan" disabled></textarea>
                                    </td>
                                    <td>
                                        <select class="form-control-sm col-12" name="nakes_id">
                                            <option>Pilih Tenaga Kesehatan</option>
                                            @foreach($tenkes as $t)
                                            <option value="{{ $t->id }}">{{ $t->nama_tenkes }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <span>
                            <i class="fas fa-check"></i>
                        </span>    
                        <span class="text">Simpan</span>
                    </button>&nbsp;
                    <a href="{{ route('adm_man_datarekammedik') }}" class="btn btn-secondary btn-sm">
                        <span>
                            <i class="fas fa-times"></i>
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