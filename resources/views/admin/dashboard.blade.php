@extends('layouts.back')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
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
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <a href="#collapseCardHighChart" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanderd="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-primary">Grafik jumlah pasien per tahun</h6>
                    </a>
                    <div class="collapse show" id="collapseCardHighChart">
                        <div class="card-body">
                                <!-- <div class="buttons">
                                    <button id="2000">2000</button>
                                    <button id="2004">2004</button>
                                    <button id="2008">2008</button>
                                    <button id="2012">2012</button>
                                    <button id="2016" class="active">2016</button>
                                </div> -->
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
                            <!-- <b>*Grafik di atas adalah data pasien berdasarkan kategori <span class="text-info">Dosen, Karyawan, Mahasiswa, <span class="text-dark">dan</span> Umum</span></b> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- High Chart -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script>
        var _ydata = <?php echo json_encode($months) ?>;
        var y2022 = <?php echo json_encode($y2022) ?>;
        var y2021 = <?php echo json_encode($y2021) ?>;
        var userArr = <?php echo json_encode($userArr) ?>;
        
        Highcharts.chart('container', {
            chart:{
                type:'column'
            },
            title:{
                text:"Grafik Pasien Tahun 2022"
            },
            xAxis:{
                categories: _ydata
            },
            yAxis:{
                title:{
                    text:"Jumlah pasien"
                }
            },
            series:[{
                name:"Jumlah Pasien",
                data:y2022
            }],
        });
        Highcharts.chart('pie-grafik', {
            chart: {
                
                type: 'pie'
            },
            title: {
                text: 'Kategori pasien tahun 2022'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Jumlah pasien',
                colorByPoint: true,
                data: [{
                    name: 'Chrome',
                    y: 61.41,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Internet Explorer',
                    y: 11.84
                }, {
                    name: 'Firefox',
                    y: 10.85
                }, {
                    name: 'Edge',
                    y: 4.67
                }, {
                    name: 'Safari',
                    y: 4.18
                }, {
                    name: 'Other',
                    y: 7.05
                }]
            }]
        });
    </script>

    <!-- /**Tidak terpakai */ -->

<!-- Charting library
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
<script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>

<script>
      const chart = new Chartisan({
        el: '#chart',
        url: "{{ route('adm_dashboard') }}",
        hooks: new ChartisanHooks()
            .colors(['#4299E1'])
            
            .axis(true)
      });
</script> -->
@endsection