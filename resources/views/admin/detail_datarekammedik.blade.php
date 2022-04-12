@extends('layouts.back')

@section('title', 'Manajemen Data Rekam Medik')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dashboard/datatables/dataTables.bootstrap4.css') }}">
    <style type="text/css">
        .modal-dialog {
            max-width: 65%;
        }
    </style>
@endsection

@section('menu')
@include('layouts.nav_admin')
@endsection

@section('subhead', 'Manajemen Data Rekam Medik')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<?php 
        $p = \App\Models\Pasien::where('user_id', $user->id)->first();
        $kp = \App\Models\KeluargaPasien::where('user_id', $user->id)->first();
        if ($p != null) {
            $dosen = \App\Models\Dosen::where('pasien_id', $p->id)->first();
            $kary = \App\Models\Karyawan::where('pasien_id', $p->id)->first();
            $mhs = \App\Models\Mahasiswa::where('pasien_id', $p->id)->first();
            $bpjs = \App\Models\Bpjs::where('pasien_id', $p->id)->first();
        }
    ?>
<div class="container-fluid">
    <a href="{{ route('adm_man_datarekammedik') }}" class="btn btn-primary btn-sm">Kembali</a><br><br>
    <div class="card shadow mb-4">         
        <div class="card-body">            
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
                                    @if ($p != null)
                                    <table class="font-weight-bold">
                                        <tr>
                                            <td>No. Indeks</td>
                                            <td>&emsp;: {{ $p->id }}</td>
                                        </tr>
                                        <tr style="padding: 2px;">
                                            <td>Nama</td>
                                            <td>&emsp;: {{ $p->nama_pasien }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>&emsp;: {{ $p->jk_pasien }}</td>
                                        </tr>
                                        <tr>
                                            <td>TTL</td>
                                            <td>&emsp;: {{ $p->tempat_lhr_pasien }}, {{ \Carbon\Carbon::parse($p->tgl_lhr_pasien)->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kategori</td>
                                            <td>
                                                &emsp;: {{ $p->category->nama_kategori }}
                                                @if ($p->category_id == 1)
                                                {{ $dosen->fakulta->nama_fakultas }}
                                                @elseif ($p->category_id == 2)
                                                {{ $kary->fakulta->nama_fakultas }}
                                                @elseif ($p->category_id == 3)
                                                ({{ $mhs->fakulta->nama_fakultas }} - {{ $mhs->prodi->nama_prodi }})
                                                @elseif ($p->category_id == 5)
                                                ({{ $bpjs->no_bpjs }})
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>&emsp;: {{ $p->alamat_pasien }}</td>
                                        </tr>
                                        <tr>
                                            <td>No. HP</td>
                                            <td>&emsp;: {{ $p->no_hp_pasien }}</td>
                                        </tr>
                                    </table>
                                    @else
                                    <table class="font-weight-bold">
                                        <tr>
                                            <td>No. Indeks</td>
                                            <td>&emsp;: {{ $kp->id }}</td>
                                        </tr>
                                        <tr style="padding: 2px;">
                                            <td>Nama</td>
                                            <td>&emsp;: {{ $kp->nama_kel_pasien }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>&emsp;: {{ $kp->jk_kel_pasien }}</td>
                                        </tr>
                                        <tr>
                                            <td>TTL</td>
                                            <td>&emsp;: {{ $kp->tempat_lhr_kel_pasien }}, {{ \Carbon\Carbon::parse($kp->tgl_lhr_kel_pasien)->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <?php
                                                $dosen = \App\Models\Dosen::where('pasien_id', $kp->pasien->id)->first();
                                                $kary = \App\Models\Karyawan::where('pasien_id', $kp->pasien->id)->first();
                                            ?>
                                            <td>Kategori</td>
                                            <td>
                                                &emsp;: {{ $kp->kategori_kel_pasien }} dari {{ $kp->pasien->nama_pasien }} ({{ $kp->pasien->category->nama_kategori }}
                                                @if ($kp->pasien->category_id == 1)
                                                {{ $dosen->fakulta->nama_fakultas }})
                                                @elseif ($kp->pasien->category_id == 2)
                                                {{ $kary->fakulta->nama_fakultas }})
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>&emsp;: {{ $kp->alamat_kel_pasien }}</td>
                                        </tr>
                                        <tr>
                                            <td>No. HP</td>
                                            <td>&emsp;: {{ $kp->no_hp_kel_pasien }}</td>
                                        </tr>
                                    </table>
                                    @endif
                                    <br>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>TANGGAL PEMERIKSAAN</th>
                                                <th>PEMERIKSAAN/DIAGNOSA</th>
                                                <th>PENGOBATAN</th>
                                                <th>KETERANGAN</th>
                                                <th>PARAF</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($p != null) {
                                                $rekammedik = \App\Models\RekamMedik::where('pasien_id', $p->id)->where('status_rekam_medik', 'selesai')->orderBy('rekammedik_created_at', 'DESC')->take(5)->get();
                                            }
                                            else {
                                                $rekammedik = \App\Models\RekamMedik::where('keluarga_pasien_id', $kp->id)->where('status_rekam_medik', 'selesai')->orderBy('rekammedik_created_at', 'DESC')->take(5)->get();
                                            }
                                            ?>
                                            @foreach($rekammedik as $rk)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($rk->rekammedik_created_at)->format('d-m-Y') }}</td>
                                                <td>
                                                    Suhu: {{ $rk->suhu }} &#8451; <br>
                                                    Tensi: {{ $rk->siastol }}/{{$rk->diastol}} mmHg <br>
                                                    Pemeriksaan: {{ $rk->keluhan }} <br>
                                                    Diagnosa: {{ $rk->diagnosa->nama_diagnosa }}

                                                </td>
                                                <td>
                                                    <ul>
                                                        <?php $resep = \App\Models\ResepObat::where('rekam_medik_id', $rk->id)->get(); ?>
                                                        @foreach($resep as $rs)
                                                        <li>
                                                            {{ $rs->obat->nama_obat }} | {{ $rs->keterangan }}
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>
                                                    {{ $rk->keterangan }}
                                                </td>
                                                <td>
                                                    {{ $rk->tenkesehatan->nama_tenkes}}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
        </div>
    </div>
</div>
@endsection