@extends('layouts.back')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <style>
        #container {
            min-width: 310px;
            max-width: 100%;
            height: 400px;
            margin: 0 auto;
        }
        .buttons {
            min-width: 310px;
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 0;
        }

        .buttons button {
            cursor: pointer;
            border: 1px solid silver;
            border-right-width: 0;
            background-color: #f8f8f8;
            font-size: 1rem;
            padding: 0.5rem;
            outline: none;
            transition-duration: 0.3s;
            margin: 0;
        }

        .buttons button:first-child {
            border-top-left-radius: 0.3em;
            border-bottom-left-radius: 0.3em;
        }

        .buttons button:last-child {
            border-top-right-radius: 0.3em;
            border-bottom-right-radius: 0.3em;
            border-right-width: 1px;
        }

        .buttons button:hover {
            color: white;
            background-color: rgb(158 159 163);
            outline: none;
        }

        .buttons button.active {
            background-color: #0051b4;
            color: white;
        }
    </style>
@endsection

@section('menu')
@include('layouts.nav_admin')
@endsection

@section('subhead', 'Dashboard')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pasien</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pasienCount }}</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $nakesCount }}</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rekammedikCount }}</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $apotekerCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-capsules fa-2x text-gray-500"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <a href="#collapseCardHighChart" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanderd="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Grafik jumlah pasien per tahun</h6>
                    </a>
                    <div class="collapse show" id="collapseCardHighChart">
                        <div class="card-body">
                            <div class="buttons">
                                <button id="2018">2018</button>
                                <button id="2019">2019</button>
                                <button id="2020">2020</button>
                                <button id="2021">2021</button>
                                <button id="2022" class="active">2022</button>
                                <button id="2023">2023</button>
                            </div>
                            <div id="container"></div>            
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <a href="#collapseCardData" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pasien berdasarkan Kategori</h6>
                    </a>
                    <div class="collapse show" id="collapseCardData">
                        <div class="card-body">
                            <div id="pie-grafik"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="card shadow p-3">
            <div class="row">
                <p class="font-weight-bold text-primary col-3">Tanggal: <span class="text-success">{{ \Carbon\Carbon::now()->format('d F Y') }}</span></p>
                <p class="font-weight-bold text-primary col">Waktu: <span class="text-success">{{ \Carbon\Carbon::now()->toTimeString() }}</span></p>
            </div>
            <p class="font-weight-bold text-primary ">Jumlah pasien hari ini: <span class="text-success">{{ $pCount }} orang</span></p>
            <form action="{{ route('adm_dashboard') }}">
                <button class="btn btn-success btn-sm pl-2 pr-2" id="refresh"><i class="fas fa-sync-alt"></i> Refresh</button>
            </form><br>
            <h5 class="font-weight-bold text-primary">Daftar pasien hari ini:</h5>
            @if($pCount == 0)
                <center><br><h5 class="text-info">Belum ada pasien hari ini</h5><br></center>
            @else
                @foreach($pasiens as $p)
                    <div class="mb-2">
                        <a href="#collapseCardMedik{{$p->id}}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $p->pasien->nama_pasien}}</h6>
                        </a>
                        <div class="collapse" id="collapseCardMedik{{$p->id}}">
                            <div class="card-body shadow">
                                <div class="row">
                                    <div class="col">
                                        <p class="font-weight-bold text-primary">Suhu: <span class="text-danger">{{ $p->suhu }} </span>&#8451;</p>
                                        <p class="font-weight-bold text-primary">Tensi: <span class="text-danger">{{ $p->tensi }}</span> mmHg</p>
                                        <p class="font-weight-bold text-primary">Keluhan: <span class="text-danger">{{ $p->keluhan }}</span> </p>
                                    </div>
                                    <div class="col">
                                        <p class="font-weight-bold text-primary">Jam: <span class="text-danger">{{ \Carbon\Carbon::parse($p->rekammedik_created_at)->toTimeString() }}</span></p>
                                        <p class="font-weight-bold text-primary">Diagnosa: <span class="text-danger">{{ $p->diagnosa->nama_diagnosa }}</span></p>
                                        <p class="font-weight-bold text-primary">Resep Obat: <span class="text-danger"><a class="btn btn-sm border border-dark" href="#viewResepObat{{ $p->id }}" data-toggle="modal"><i class="fas fa-eye"></i>&nbsp;Lihat</a></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="viewResepObat{{ $p->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    
                                    <h4 class="modal-title font-weight-bold float-left">Resep Obat</h4>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-borderless">
                                        <?php $resep = \App\Models\ResepObat::where('rekam_medik_id', $p->id)->whereDate('resepobat_created_at', \Carbon\Carbon::parse($p->rekammedik_created_at)->toDateString())->get(); ?>
                                        @foreach($resep as $rs)
                                            <tr>
                                                <td>{{ $rs->obat->nama_obat }} | {{ $rs->keterangan }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-dark" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection