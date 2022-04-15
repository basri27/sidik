{{-- @dd($mhs, $mhs[2022], $mhs[2022][$monthParam-1], $mhs[$yearParam][3]); --}}


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

        .highcharts-figure,
.highcharts-data-table table {
  min-width: 310px;
  max-width: 800px;
  margin: 1em auto;
}

#container {
  height: 400px;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #ebebeb;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}

.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}

.highcharts-data-table th {
  font-weight: 600;
  padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
  padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}

.highcharts-data-table tr:hover {
  background: #261514;
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
                {{-- <form method="GET" action="{{ route('filter_rekammedik') }}"> --}}
                <form method="GET" action="">
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
                            @forEach($listOfYears as $year)
                            <button id="{{ $year }}"
                                @if ($year == $yearParam)
                                    class="active"
                                @endif
                            >{{ $year }}</button>
                            @endforeach
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
                            @forEach($listOfMonths[$yearParam] as $month)
                            {{-- @if($yearParam == $thisYear && $month == (Carbon\Carbon::createFromFormat('!m', $thisMonth + 1)->format('F')))
                                @break
                            @else --}}
                                <button id="{{ $month }}"
                                    @if ($month == (Carbon\Carbon::createFromFormat('!m', $monthParam)->format('F')))
                                    class="active"
                                    @endif
                                >{{ $month }}</button>
                            {{-- @endif --}}
                            @endforeach
                        </div>
                        <div class="row">
                            <div id="pie-grafik" class="col-6"></div>
                            <div id="barChart" class="col-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </body>
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
                                                    @foreach($dosenAll as $d)
                                                        {{ ($d->pasien_id == $rk->pasien->id) ? $d->fakulta->nama_fakultas : '' }}
                                                    @endforeach
                                                @elseif ($rk->pasien->category_id == 2)
                                                    @foreach($karyAll as $k)
                                                        {{ ($k->pasien_id == $rk->pasien->id) ? $k->fakulta->nama_fakultas : '' }}
                                                    @endforeach
                                                @elseif ($rk->pasien->category_id == 3)
                                                    @foreach($mhsAll as $m)
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
    
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.2/umd/popper.min.js" integrity="sha512-aDciVjp+txtxTJWsp8aRwttA0vR2sJMk/73ZT7ExuEHv7I5E6iyyobpFOlEFkq59mWW8ToYGuVZFnwhwIUisKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
    <!-- High Chart -->
    <script src="{{ asset('js/high-chart/highchart.js') }}"></script>
    <script src="{{ asset('js/high-chart/exporting.js') }}"></script>
    <script src="{{ asset('js/high-chart/export-data.js') }}"></script>

<script src="https://code.highcharts.com/modules/accessibility.js" type="text/javascript"></script>
    <script >
        

        

        const listOfYears = <?php echo(json_encode($listOfYears)); ?>;
        const listOfMonths = <?php echo(json_encode($listOfMonths)); ?>;
        

        var getAllData = <?php echo(json_encode($getAllData)); ?>;
        var getFinishedData = <?php echo(json_encode($getFinishedData)); ?>;
        var getFinishedDataYearly = <?php echo(json_encode($getFinishedDataYearly)); ?>;
        var listOfMhs = <?php echo(json_encode($mhsAll)); ?>;
        var listOfDosen = <?php echo(json_encode($dosenAll)); ?>;
        var listOfKary = <?php echo(json_encode($karyAll)); ?>;

        var getListOfYears = <?php echo(json_encode($getListOfYears)); ?>;


        var thisYear =  <?php echo(json_encode($thisYear)); ?>;
        var yearParam = <?php echo(json_encode($yearParam)); ?>;
        var monthParam = <?php echo(json_encode($monthParam)); ?> - 1;
        var constraintOfMonth = <?php echo(json_encode($constraintOfMonth)); ?>;

        var mhs = <?php echo(json_encode($mhs)); ?>;
        var mhsThisYear = mhs[2022];
        var monthly = <?php echo(json_encode($monthly)); ?>;
        var dosen = <?php echo(json_encode($dosen)); ?>;
        var kary = <?php echo(json_encode($kary)); ?>;
        var umum = <?php echo(json_encode($umum)); ?>;


        var data_name = [];
        var data_freq = [];
        var data_temp =  <?php echo(json_encode($monthly)); ?>;
        var data_name_freq = [];
        if(data_temp != null){
            for (let i = 0; i < data_temp.length; i++) {
                data_name[i] = data_temp[i]['nama_diagnosa'];
                data_freq[i] = data_temp[i]['freq'];

                if(i == 0){
                    data_name_freq[i] = [data_name[i], data_freq[i], true, true];
                }
                else {
                    data_name_freq[i] = [data_name[i], data_freq[i], false];
                }
            }
        }

    
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        var chart = Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Jumlah Pasien Tahun ' + yearParam
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
                categories: months
            },
            yAxis: [{
                title: {
                    text: 'Jumlah Pasien'
                },
                showFirstLabel: false
            }],
            series: [{
                color: 'rgb(101, 163, 247)',
                pointPlacement: 0,
                data: getFinishedData[yearParam]
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
                    text: 'Jumlah kategori pasien di bulan ' + listOfMonths[yearParam][monthParam] + ' ' + yearParam
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
                        y: mhs[yearParam][monthParam],
                        sliced: true,
                        selected: true
                    }, {
                        name: 'Dosen',
                        y: dosen[yearParam][monthParam],
                    }, {
                        name: 'Karyawan',
                        y: kary[yearParam][monthParam],
                    }, {
                        name: 'Umum',
                        y: umum[yearParam][monthParam]
                    }]
                }]
            });

            
        var barChart = Highcharts.chart('barChart', {
            chart: {
                type: 'bar'
            },
            title: {
                text: '5 Penyakit Terbanyak ' + listOfMonths[yearParam][monthParam] + ' ' + yearParam
            },
            xAxis: {
                categories: data_name,
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah (kasus)',
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
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 100,
                floating: true,
                borderWidth: 1,
                backgroundColor:
                    Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: listOfMonths[yearParam][monthParam] + ' ' + yearParam,
                data: data_freq
            }]
        });


        //function untuk click listener button bulan
        function button_of_months(year){
                var index_of_months = -1;
                
                var months = listOfMonths[year];
                
                months.forEach( function (month){
                    index_of_months++;

                    var data_temp_bar_this_month = getAllData[year][index_of_months];
                    var data_name_bar_this_month = [];
                    var data_freq_bar_this_month = [];

                    if(data_temp_bar_this_month != null){
                        for (let i = 0; i < data_temp_bar_this_month.length; i++) {
                            data_name_bar_this_month[i] = data_temp_bar_this_month[i]['nama_diagnosa'];
                            data_freq_bar_this_month[i] = data_temp_bar_this_month[i]['freq'];
                        }
                    }

                    var btn_month = document.getElementById(month);
                    
                    btn_month.addEventListener('click', function () {


                        document.querySelectorAll('.buttons button.active').forEach(function (active) {
                            active.className = '';
                        });

                        btn_month.className = 'active';

                        pieChart.update({
                            title:{
                                text:'Kategori pasien ' + month + ' ' + year
                            },
                            series:[{
                                data:[{
                                    y: mhs[year][listOfMonths[year].indexOf(month)],
                                }, {
                                    y: dosen[year][listOfMonths[year].indexOf(month)]
                                }, {
                                    y: kary[year][listOfMonths[year].indexOf(month)]
                                }, {
                                    y: umum[year][listOfMonths[year].indexOf(month)]
                                }]
                            }]
                        });

                        barChart.update({
                            title: {
                                text: '5 Penyakit Terbanyak ' + month + ' ' + year
                            },
                            xAxis: {
                                categories: data_name_bar_this_month
                            },
                            series: [{
                                name: month + ' ' + year,
                                data: data_freq_bar_this_month
                            }]
                        });
                    });
                });
            }

        

        listOfYears.forEach(function (year) {

            // const index_of_year = year;
            // variable untuk menampilkan column chart tahunan rekam medik yang status nya selesai
            var dataChart = getFinishedData[year];

            // variable untuk generate 5 daftar penyakit terbanyak bulanan
            var data_temp_bar = getAllData[year][0];
            var data_name_bar = [];
            var data_freq_bar = [];

            button_of_months(year)

            if(data_temp_bar != null){
                for (let i = 0; i < data_temp_bar.length; i++) {
                    data_name_bar[i] = data_temp_bar[i]['nama_diagnosa'];
                    data_freq_bar[i] = data_temp_bar[i]['freq'];
                }
            }
            if(year == yearParam){
                    dataChart = getFinishedDataYearly;
            } 

            var btn = document.getElementById(year);

            btn.addEventListener('click', function () {

                button_of_months(year)

                document.querySelectorAll('.buttons button.active').forEach(function (active) {
                    active.className = '';
                });

                btn.className = 'active';


                chart.update({
                    title:{
                        text:"Grafik jumlah pasien tahun " + year
                    },
                    series: [{
                        data: dataChart
                    }]
                }, true, false, {
                    duration: 800
                });

                pieChart.update({
                    title:{
                        text:'Kategori pasien tahun January ' + year
                    },
                    series:[{
                        data:[{
                            y: mhs[year][0],
                        }, {
                            y: dosen[year][0],
                        }, {
                            y: kary[year][0],
                        }, {
                            y: umum[year][0],
                        }]
                    }]
                });

                barChart.update({
                    title: {
                        text: '5 Penyakit Terbanyak January ' + year
                    },
                    xAxis: {
                        categories: data_name_bar
                    },
                    series: [{
                        name: 'January ' + year,
                        data: data_freq_bar
                    }]
                });
            });
        });
    </script>
@endsection
