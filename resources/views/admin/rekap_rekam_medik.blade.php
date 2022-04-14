@extends('layouts.back')

@section('title', 'Rekap Rekam Medik')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/dashboard/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/responsive.dataTables.min.css') }}">
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
        .modal-dialog {
            max-width: 75%;
        }

        
    </style>
@endsection

@section('menu')
@include('layouts.nav_admin')
@endsection

@section('subhead', 'Rekap Rekam Medik')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <a href="#collapseCardMedik" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Data Rekam Medik Pasien</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardMedik">
            <div class="card-body">
                <div class="row pl-3">
                    <h5 class="font-weight-bold text-primary">Filter Tanggal Rekam Medik</h5>
                </div>
                <hr>
                <div class="row pl-2">
                    <label class="font-weight-bold text-secondary col-3">Start</label>
                    <label class="font-weight-bold text-secondary col-3">End</label>
                </div>
                <form method="GET" action="{{ route('filter_rekammedik') }}">
                    <div class="row pl-3">
                        <input type="date" class="form-control col-3" id="date-start" name="date-start">
                        &nbsp;
                        <input type="date" class="form-control col-3" id="date-end" name="date-end" max="{{ \Carbon\Carbon::now()->toDateString() }}" value="{{ \Carbon\Carbon::now()->toDateString() }}">&nbsp;
                        <button class="btn btn-info tombol btn-2"><i class="fas fa-folder-open"></i>&nbsp;Lihat</button>&nbsp;
                        <a class="btn btn-info btn-2" href="{{ route('adm_rekap_rekam_medik') }}"><i class="fas fa-window-close"></i>&nbsp;Reset Filter</a>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal Periksa</th>
                                <th>Pemeriksa</th>
                                <!-- <th>Kategori</th> -->
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rekammedik as $rk)
                            <tr>
                                @if ($rk->pasien_id != null)
                                <td>{{ $rk->pasien->nama_pasien }}</td>
                                <td>{{ $rk->rekammedik_created_at }}</td>
                                <td>{{ $rk->tenkesehatan->nama_tenkes }}</td>
                                <!-- <td>{{ $rk->pasien->category->nama_kategori }}</td> -->
                                @else
                                <td>{{ $rk->keluarga_pasien->nama_kel_pasien }}</td>
                                <td>{{ $rk->rekammedik_created_at }}</td>
                                <td>{{ $rk->tenkesehatan->nama_tenkes }}</td>
                                <!-- <td>{{ $rk->keluarga_pasien->kategori_kel_pasien }}</td> -->
                                @endif
                                <td>
                                    <a href="#info-rekam-medik{{$rk->id}}" class="btn btn-info btn-sm" data-toggle="modal">Info</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <a href="#collapseCardHighChart" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanderd="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik jumlah pasien per tahun</h6>
                </a>
                <div class="collapse show" id="collapseCardHighChart">
                    <div class="card-body">
                        <div class="buttons">
                            <button id="2020">2020</button>
                            <button id="2021">2021</button>
                            <button id="2022" class="active">2022</button>
                            <button id="2023">2023</button>
                            <button id="2024">2024</button>
                            <button id="2025">2025</button>
                        </div>
                        <div id="container"></div>            
                    </div>
                </div>   
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <a href="#collapseCardData" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Diagram kategori pasien per tahun</h6>
                </a>
                <div class="collapse show" id="collapseCardData">
                    <div class="card-body">
                        <div class="buttons">
                            <button id="Januari" class="active">Januari</button>
                            <button id="Februari">Februari</button>
                            <button id="Maret">Maret</button>
                            <button id="April">April</button>
                            <button id="Mei">Mei</button>
                            <button id="Juni">Juni</button>
                            <button id="Juli">Juli</button>
                            <button id="Agustus">Agustus</button>
                            <button id="September">September</button>
                            <button id="Oktober">Oktober</button>
                            <button id="November">November</button>
                            <button id="Desember">Desember</button>
                        </div>
                        <div class="row">
                            <div id="pie-grafik" class="col-6"></div>
                            <div id="barChart" class="col-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div id="pie-grafik-penyakit" class="col-6"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- <body onload="diag()">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <a href="#grafikPenyakit" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik penyakit</h6>
                </a>
                <div class="collapse show" id="grafikPenyakit">
                    <div class="card-body">
                        <h5 class="m-0 font-weight-bold text-dark text-center" id="label_penyakit">Daftar 5 penyakit terbanyak di tahun 2022</h5><br>
                        <?php $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']; ?>
                        <div id="diag20">
                            <?php $i = -1; ?>
                            @foreach ($diagCount20 as $dc)
                                <?php $i += 1; ?>
                                <?php $k = 0; ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-info">
                                            <th colspan="3" class="font-weight-bold text-white text-center">{{$month[$i]}}</th>
                                        </tr>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Penyakit</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dc as $d)
                                        <?php $dg = \App\Models\Diagnosa::where('id', $d['diagnosa_id'])->first() ?>
                                        <?php $k += 1; ?>
                                            <tr>
                                                <td>{{$k}}</td>
                                                <td>{{$dg->nama_diagnosa}}</td>
                                                <td>{{$d['freq']}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                        <div id="diag21">
                            <?php $i = -1; ?>
                            @foreach ($diagCount21 as $dc)
                                <?php $i += 1; ?>
                                <?php $k = 0; ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-info">
                                            <th colspan="3" class="font-weight-bold text-white text-center">{{$month[$i]}}</th>
                                        </tr>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Penyakit</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dc as $d)
                                        <?php $dg = \App\Models\Diagnosa::where('id', $d['diagnosa_id'])->first() ?>
                                        <?php $k += 1; ?>
                                            <tr>
                                                <td>{{$k}}</td>
                                                <td>{{$dg->nama_diagnosa}}</td>
                                                <td>{{$d['freq']}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                        <div id="diag22">
                            <?php $i = -1; ?>
                            @foreach ($diagCount22 as $dc)
                                <?php $i += 1; ?>
                                <?php $k = 0; ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-info">
                                            <th colspan="3" class="font-weight-bold text-white text-center">{{$month[$i]}}</th>
                                        </tr>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Penyakit</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dc as $d)
                                        <?php $dg = \App\Models\Diagnosa::where('id', $d['diagnosa_id'])->first() ?>
                                        <?php $k += 1; ?>
                                            <tr>
                                                <td>{{$k}}</td>
                                                <td>{{$dg->nama_diagnosa}}</td>
                                                <td>{{$d['freq']}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                        <div id="diag23">
                            <?php $i = -1; ?>
                            @foreach ($diagCount23 as $dc)
                                <?php $i += 1; ?>
                                <?php $k = 0; ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-info">
                                            <th colspan="3" class="font-weight-bold text-white text-center">{{$month[$i]}}</th>
                                        </tr>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Penyakit</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dc as $d)
                                        <?php $dg = \App\Models\Diagnosa::where('id', $d['diagnosa_id'])->first() ?>
                                        <?php $k += 1; ?>
                                            <tr>
                                                <td>{{$k}}</td>
                                                <td>{{$dg->nama_diagnosa}}</td>
                                                <td>{{$d['freq']}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                        <div id="diag24">
                            <?php $i = -1; ?>
                            @foreach ($diagCount24 as $dc)
                                <?php $i += 1; ?>
                                <?php $k = 0; ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-info">
                                            <th colspan="3" class="font-weight-bold text-white text-center">{{$month[$i]}}</th>
                                        </tr>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Penyakit</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dc as $d)
                                        <?php $dg = \App\Models\Diagnosa::where('id', $d['diagnosa_id'])->first() ?>
                                        <?php $k += 1; ?>
                                            <tr>
                                                <td>{{$k}}</td>
                                                <td>{{$dg->nama_diagnosa}}</td>
                                                <td>{{$d['freq']}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                        <div id="diag25">
                            <?php $i = -1; ?>
                            @foreach ($diagCount25 as $dc)
                                <?php $i += 1; ?>
                                <?php $k = 0; ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-info">
                                            <th colspan="3" class="font-weight-bold text-white text-center">{{$month[$i]}}</th>
                                        </tr>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Penyakit</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dc as $d)
                                        <?php $dg = \App\Models\Diagnosa::where('id', $d['diagnosa_id'])->first() ?>
                                        <?php $k += 1; ?>
                                            <tr>
                                                <td>{{$k}}</td>
                                                <td>{{$dg->nama_diagnosa}}</td>
                                                <td>{{$d['freq']}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body> -->
</div>
@foreach($rekammedik as $rk)
    <div id="info-rekam-medik{{$rk->id}}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title font-weight-bold float-left">Info rekam medik pasien</h4>
                </div>
                <div class="modal-body">
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
                                    @if ($rk->pasien_id != null)
                                    <table class="font-weight-bold">
                                        <tr>
                                            <td>No. Indeks</td>
                                            <td>&emsp;: {{ $rk->pasien->id }}</td>
                                        </tr>
                                        <tr style="padding: 2px;">
                                            <td>Nama</td>
                                            <td>&emsp;: {{ $rk->pasien->nama_pasien }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>&emsp;: {{ $rk->pasien->jk_pasien }}</td>
                                        </tr>
                                        <tr>
                                            <td>TTL</td>
                                            <td>&emsp;: {{ $rk->pasien->tempat_lhr_pasien }}, {{ \Carbon\Carbon::parse($rk->pasien->tgl_lhr_pasien)->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kategori</td>
                                            <td>
                                                &emsp;: {{ $rk->pasien->category->nama_kategori }}
                                                @if ($rk->pasien->category_id == 1)
                                                    @foreach($dosen as $d)
                                                        {{ ($d->pasien_id == $rk->pasien->id) ? $d->fakulta->nama_fakultas : '' }}
                                                    @endforeach
                                                @elseif ($rk->pasien->category_id == 2)
                                                    @foreach($kary as $k)
                                                        {{ ($k->pasien_id == $rk->pasien->id) ? $k->fakulta->nama_fakultas : '' }}
                                                    @endforeach
                                                @elseif ($rk->pasien->category_id == 3)
                                                    @foreach($mhs as $m)
                                                        {{ ($m->pasien_id == $rk->pasien->id) ? $m->fakulta->nama_fakultas." - ".$m->prodi->nama_prodi : '' }}
                                                    @endforeach
                                                @elseif ($rk->pasien->category_id == 5)
                                                <br>
                                                ({{ $bpjs->no_bpjs }})
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>&emsp;: {{ $rk->pasien->alamat_pasien }}</td>
                                        </tr>
                                        <tr>
                                            <td>No. HP</td>
                                            <td>&emsp;: {{ $rk->pasien->no_hp_pasien }}</td>
                                        </tr>
                                    </table>
                                    @else
                                    <table class="font-weight-bold">
                                        <tr>
                                            <td>No. Indeks</td>
                                            <td>&emsp;: {{ $rk->keluarga_pasien->id }}</td>
                                        </tr>
                                        <tr style="padding: 2px;">
                                            <td>Nama</td>
                                            <td>&emsp;: {{ $rk->keluarga_pasien->nama_kel_pasien }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>&emsp;: {{ $rk->keluarga_pasien->jk_kel_pasien }}</td>
                                        </tr>
                                        <tr>
                                            <td>TTL</td>
                                            <td>&emsp;: {{ $rk->keluarga_pasien->tempat_lhr_kel_pasien }}, {{ \Carbon\Carbon::parse($rk->keluarga_pasien->tgl_lhr_kel_pasien)->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <?php
                                                $dosen = \App\Models\Dosen::where('pasien_id', $rk->keluarga_pasien->pasien->id)->first();
                                                $kary = \App\Models\Karyawan::where('pasien_id', $rk->keluarga_pasien->pasien->id)->first();
                                            ?>
                                            <td>Kategori</td>
                                            <td>
                                                &emsp;: {{ $rk->keluarga_pasien->kategori_kel_pasien }} dari {{ $rk->keluarga_pasien->pasien->nama_pasien }} ({{ $rk->keluarga_pasien->pasien->category->nama_kategori }}
                                                @if ($rk->keluarga_pasien->pasien->category_id == 1)
                                                {{ $dosen->fakulta->nama_fakultas }})
                                                @elseif ($rk->keluarga_pasien->pasien->category_id == 2)
                                                {{ $kary->fakulta->nama_fakultas }})
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>&emsp;: {{ $rk->keluarga_pasien->alamat_kel_pasien }}</td>
                                        </tr>
                                        <tr>
                                            <td>No. HP</td>
                                            <td>&emsp;: {{ $rk->keluarga_pasien->no_hp_kel_pasien }}</td>
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
                                            
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($rk->rekammedik_created_at)->format('d-m-Y') }}</td>
                                                <td>
                                                    Suhu: {{ $rk->suhu }} &#8451; <br>
                                                    Tensi: {{ $rk->siastol }}/{{ $rk->diastol }} mmHg <br>
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
                                            
                                        </tbody>
                                    </table>
                                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div id="viewResep{{ $rk->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header bg-light">
                    <h4 class="modal-title font-weight-bold float-left">Daftar resep obat</h4>
                </div>
                <!-- body modal -->
                <div class="modal-body">        
                    <table class="table table-borderless">
                        <?php $resep = \App\Models\ResepObat::where('rekam_medik_id', $rk->id)->whereDate('resepobat_created_at', \Carbon\Carbon::parse($rk->rekammedik_created_at)->toDateString())->get(); ?>
                        @foreach($resep as $rs)
                            <tr>
                                <td>{{ $rs->obat->nama_obat }} | {{ $rs->keterangan }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
    <!-- Moment js -->
    <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

    <!--Data Table-->
    <script type="text/javascript"  src=" https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript"  src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <!-- Table rekam medik -->
    <!-- <script>
        let start = $('#date-start').val();
        let end = $('#date-end').val();

        const table_pasien = $("#tabel-pasien").DataTable({
            "pageLength": 25,
            "lengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
            "bLengthChange": true,
            "bFilter": true,
            "bInfo": true,
            "processing": true,
            "bServerSide": true,
            "order": [[ 0, "asc" ]],
            "ajax":{
                url:"{{url('filterrekammedik')}}",
                type:"POST",
                data:function(d){
                    d._token = "{{csrf_token()}}";
                    d.mulai = start;
                    d.habis = end;
                }
            },
            columns:[
                {
                    data: 'nama_pasien',
                },
                {
                    "render": function(data, type, row, meta){
                        moment.locale('id');
                        return moment(row.rekammedik_created_at).format('LL');
                    }
                },
                {
                    data: 'nama_tenkes',
                    orderable: false,
                },
                {
                    data: 'nama_kategori',
                    orderable: false,
                },
                {
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                }
            ]
        });

        function format ( d ) {
        // `d` is the original data object for the row
        return '<table class="table table-striped table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<thead class="thead-dark">'+
                    '<tr>'+
                        '<th>Tensi</th>'+
                        '<th>Suhu</th>'+
                        '<th>Keluhan</th>'+
                        '<th>Diagnosa</th>'+
                        '<th>Obat</th>'+
                        '<th>Keterangan</th>'+
                    '</tr>'+
                '</thead>'+
                '<tbody>'+
                    '<tr>'+
                        '<td>'+d.tensi+'</td>'+
                        '<td>'+d.suhu+'</td>'+
                        '<td>'+d.keluhan+'</td>'+
                        '<td>'+d.kode_diagnosa+' - '+d.nama_diagnosa+'</td>'+
                        '<td><a href="#viewResep'+d.id+'" class="btn btn-sm border border-dark" data-toggle="modal"><small><i class="fas fa-eye"></i>&nbsp;Lihat</small></a></td>'+
                        '<td>'+d.keterangan+'</td>'+
                    '</tr>'+
                '</tbody>'+
            '</table>';
        }

        $('.tombol').on('click', function() {
            start = $('#date-start').val();
            end = $('#date-end').val();
            table_pasien.ajax.reload(null,false)
        });
    </script> -->
    <!-- <script>
        $('#datatable tbody').on('click', 'td.dt-control', function () {
            var tr = $(this).closest('tr');
            var row = table_pasien.row( tr );
      
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.find('svg').attr('data-icon', 'plus-circle');    // FontAwesome 5
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
              tr.find('svg').attr('data-icon', 'minus-circle'); // FontAwesome 5
            }
        });

        function format ( d ) {
        // `d` is the original data object for the row
        return '<table class="table table-striped table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<thead class="thead-dark">'+
                    '<tr>'+
                        '<th>Tensi</th>'+
                        '<th>Suhu</th>'+
                        '<th>Keluhan</th>'+
                        '<th>Diagnosa</th>'+
                        '<th>Obat</th>'+
                        '<th>Keterangan</th>'+
                    '</tr>'+
                '</thead>'+
                '<tbody>'+
                    '<tr>'+
                        '<td>'+d.tensi+'</td>'+
                        '<td>'+d.suhu+'</td>'+
                        '<td>'+d.keluhan+'</td>'+
                        '<td>'+d.kode_diagnosa+' - '+d.nama_diagnosa+'</td>'+
                        '<td><a href="#viewResep'+d.id+'" class="btn btn-sm border border-dark" data-toggle="modal"><small><i class="fas fa-eye"></i>&nbsp;Lihat</small></a></td>'+
                        '<td>'+d.keterangan+'</td>'+
                    '</tr>'+
                '</tbody>'+
            '</table>';
        }
    </script> -->
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.2/umd/popper.min.js" integrity="sha512-aDciVjp+txtxTJWsp8aRwttA0vR2sJMk/73ZT7ExuEHv7I5E6iyyobpFOlEFkq59mWW8ToYGuVZFnwhwIUisKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
    <!-- High Chart -->
    <script src="{{ asset('js/high-chart/highchart.js') }}"></script>
    <script src="{{ asset('js/high-chart/exporting.js') }}"></script>
    <script src="{{ asset('js/high-chart/export-data.js') }}"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript">

        function diag() {
            $('#diag20').hide()
            $('#diag21').hide()
            $('#diag22').show()
            $('#diag23').hide()
            $('#diag24').hide()
            $('#diag25').hide()
        }
        
        var data = {
            2024: <?php echo json_encode($y2024) ?>,
            2025: <?php echo json_encode($y2025) ?>,
            2020: <?php echo json_encode($y2020) ?>,
            2021: <?php echo json_encode($y2021) ?>,
            2022: <?php echo json_encode($y2022) ?>,
            2023: <?php echo json_encode($y2023) ?>,
        };

        var mhs = {
            2024: <?php echo json_encode($mhs24) ?>,
            2025: <?php echo json_encode($mhs25) ?>,
            2020: <?php echo json_encode($mhs20) ?>,
            2021: <?php echo json_encode($mhs21) ?>,
            2022: <?php echo json_encode($mhs22) ?>,
            2023: <?php echo json_encode($mhs23) ?>,
        }

        var dosen = {
            2024: <?php echo json_encode($dosen24) ?>,
            2025: <?php echo json_encode($dosen25) ?>,
            2020: <?php echo json_encode($dosen20) ?>,
            2021: <?php echo json_encode($dosen21) ?>,
            2022: <?php echo json_encode($dosen22) ?>,
            2023: <?php echo json_encode($dosen23) ?>,
        }

        var kary = {
            2024: <?php echo json_encode($kary24) ?>,
            2025: <?php echo json_encode($kary25) ?>,
            2020: <?php echo json_encode($kary20) ?>,
            2021: <?php echo json_encode($kary21) ?>,
            2022: <?php echo json_encode($kary22) ?>,
            2023: <?php echo json_encode($kary23) ?>,
        }

        var umum = {
            2024: <?php echo json_encode($umum24) ?>,
            2025: <?php echo json_encode($umum25) ?>,
            2020: <?php echo json_encode($umum20) ?>,
            2021: <?php echo json_encode($umum21) ?>,
            2022: <?php echo json_encode($umum22) ?>,
            2023: <?php echo json_encode($umum23) ?>,
        }

        var data_name = []
        var data_freq = []
        var data_temp =  <?php echo(json_encode($diagCount21[1])); ?>;
        if(data_temp != null){
            for (let i = 0; i < data_temp.length; i++) {
                data_name[i] = data_temp[i]['nama_diagnosa']
                data_freq[i] = data_temp[i]['freq']
            }
        }

        
        var chart = Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Jumlah Pasien Tahun 2022'
            },
            plotOptions: {
                series: {
                    grouping: false,
                    borderWidth: 0
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                shared: true,
                pointFormat: '<span>\u25CF</span> Jumlah: <b>{point.y} pasien</b><br/>'
            },
            xAxis:{
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des']
            },
            yAxis: [{
                title: {
                    text: 'Jumlah Pasien'
                },
                showFirstLabel: false
            }],
            series: [{
                color: 'rgb(101, 163, 247)',
                pointPlacement: -0.2,
                data: <?php echo json_encode($y2022) ?>,
            }],
            exporting: {
                allowHTML: true
            }
        });
        var pieChart = Highcharts.chart('pie-grafik', {
            chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Jumlah kategori pasien di bulan Januari 2022'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y:1f} pasien</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b><br>{point.y:1f} pasien ({point.percentage:.1f} %)',
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Jumlah',
                    colorByPoint: true,
                    data: [{
                        name: 'Mahasiswa',
                        y: {{$mhs22}},
                        sliced: true,
                        selected: true
                    }, {
                        name: 'Dosen',
                        y: {{$dosen22}}
                    }, {
                        name: 'Karyawan',
                        y: {{$kary22}}
                    }, {
                        name: 'Umum',
                        y: {{$umum22}}
                    }]
                }]
            });
        var barChart = Highcharts.chart('barChart', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Grafik Jumlah Penyakit yang Banyak Diderita Pasien Bulan Januari 2022'
            },
            xAxis: {
                categories: data_name,
                title: {
                    text: 'Nama Penyakit'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah Penyakit',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' kasus'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Jumlah',
                data: data_freq
            }]
        });
        var pieChartPenyakit = Highcharts.chart('pie-grafik-penyakit', {
            chart: {
                    type: 'pie'
                },
                title: {
                    text: '5 penyakit terbanyak di bulan Januari 2022'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y:1f} pasien</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b><br>{point.y:1f} kasus ({point.percentage:.1f} %)',
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Jumlah',
                    colorByPoint: true,
                    keys: ['name', 'y', 'selected', 'sliced'],
                    data: data,
                }]
            });

        var years = [2024, 2025, 2020, 2021, 2022, 2023];
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        

        years.forEach(function (year) {
            var btn = document.getElementById(year);

            btn.addEventListener('click', function () {

                document.querySelectorAll('.buttons button.active').forEach(function (active) {
                    active.className = '';
                });

                btn.className = 'active';

                chart.update({
                    title:{
                        text:"Grafik jumlah pasien tahun " + year
                    },
                    series: [{
                        data: data[year]
                    }]
                }, true, false, {
                    duration: 800
                });

                pieChart.update({
                    title:{
                        text:"Kategori pasien tahun " + year
                    },
                    series:[{
                        data:[{
                            y: mhs[year]
                        }, {
                            y: dosen[year]
                        }, {
                            y: kary[year]
                        }, {
                            y: umum[year]
                        }]
                    }]
                });

                document.getElementById('label_penyakit').innerText = 'Daftar 5 penyakit terbanyak di tahun ' + year
                
                if(year == 2020) {
                    $('#diag20').show()
                    $('#diag21').hide()
                    $('#diag22').hide()
                    $('#diag23').hide()
                    $('#diag24').hide()
                    $('#diag25').hide()
                }
                else if(year == 2021) {
                    $('#diag20').hide()
                    $('#diag21').show()
                    $('#diag22').hide()
                    $('#diag23').hide()
                    $('#diag24').hide()
                    $('#diag25').hide()
                }
                else if(year == 2022) {
                    $('#diag20').hide()
                    $('#diag21').hide()
                    $('#diag22').show()
                    $('#diag23').hide()
                    $('#diag24').hide()
                    $('#diag25').hide()
                }
                else if(year == 2023) {
                    $('#diag20').hide()
                    $('#diag21').hide()
                    $('#diag22').hide()
                    $('#diag23').show()
                    $('#diag24').hide()
                    $('#diag25').hide()
                }
                else if(year == 2024) {
                    $('#diag20').hide()
                    $('#diag21').hide()
                    $('#diag22').hide()
                    $('#diag23').hide()
                    $('#diag24').show()
                    $('#diag25').hide()
                }
                else if(year == 2025) {
                    $('#diag20').hide()
                    $('#diag21').hide()
                    $('#diag22').hide()
                    $('#diag23').hide()
                    $('#diag24').hide()
                    $('#diag25').show()
                }
            });
        });
    </script>
@endsection