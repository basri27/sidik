@extends('layouts.back')

@section('title', 'Rekap Rekam Medik')

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

@section('subhead', 'Rekap Rekam Medik')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <a href="#collapseCardMedik" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Data Rekam Medik Pasien</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardMedik">
            <div class="card-body">
                <div class="col-12">
                    <div class="row">
                        <select class="form-control col-3" name="filter" id="filterRekamMedik">
                            <option value="">Pilih Filter</option>
                            <option value="1">Hari</option>
                            <option value="2">Bulan</option>
                            <option value="3">Tahun</option>
                        </select>&nbsp;
                        <input type="date" class="form-control col-4" name="tanggal" id="tanggalRekamMedik">&nbsp;
                        <div class="col-4">
                            <div class="row">
                                <button class="btn btn-info btn-3" onClick="filterRekamMedik()"><i class="fas fa-folder-open"></i></button>
                                <!-- <a class="btn btn-info btn-2" href="#"><i class="fas fa-print"></i>Cetak</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- <div class="row"><div class="col-2">
                        <input type="text" class="form-control" name="" id="" placeholder="Cari nama...">
                    </div>
                    <div class="col-1">
                        <button class="btn btn-info">Cari</button>
                    </div></div> -->
                
                <table class="table">
                    @foreach($pasien as $p)
                    <tr>
                        <th>
                            <a href="#collapseCardPasien{{ $p->id }}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                <h6 class="m-0 font-weight-bold text-primary">{{ $p->id }}. &emsp;{{ $p->nama }}</h6>
                            </a>
                            <div class="collapse" id="collapseCardPasien{{ $p->id }}">
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="row">No.</th>
                                                <th scope="row">Nama</th>
                                                <th scope="row">Tanggal dan Waktu Periksa</th>
                                                <th scope="row">Pemeriksa</th>
                                                <th scope="row">Suhu</th>
                                                <th scope="row">Tensi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            <?php $rekammedik = \App\Models\RekamMedik::where('pasien_id', $p->id)->latest()->take(5)->get(); ?>
                                            @foreach($rekammedik as $rkm)
                                            <tr>
                                                <td scope="row">{{ $i += 1 }}</td>
                                                <td>{{ $rkm->pasien->nama }}</td>
                                                <td>{{ \Carbon\Carbon::parse($rkm->created_at)->format('d-m-Y') }} | {{ \Carbon\Carbon::parse($rkm->created_at)->toTimeString() }}</td>
                                                <td>{{ $rkm->tenkesehatan->nama }}</td>
                                                <td>{{ $rkm->suhu }}</td>
                                                <td>{{ $rkm->tensi }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </th>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class=" col-lg-8">      
            <div class="card shadow mb-4">
                <a href="#collapseCardGrafik" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Jumlah Pasien Berobat Perbulan</h6>
                </a>
                <div class="collapse show" id="collapseCardGrafik">
                    <div class="card-body">
                        <div class="container row">
                        <input type="text" class="form-control col-5" name="" id="" placeholder="Masukkan tahun...">&nbsp;
                        <button class="btn btn-info btn-circle btn-2"><i class="fas fa-folder-open"></i></button>
                        </div>
                        <hr>
                        <div class="chart-area">
                            <canvas id="barChart"></canvas>
                        </div>
                        <hr>
                        <b>*Grafik di atas adalah data pasien tahun <span class="text-info">{{ \Carbon\Carbon::now()->format('Y') }}</span></b>
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
                        <?php 
                            $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'November', 'Desember'];
                            $i = 0;
                        ?>
                        <div class="container row">
                            <select class="form-control col-7" name="" id="">
                                <option value="">Pilih Bulan</option>
                                    @foreach($month as $m)
                                <option value="{{ $i += 1 }}">{{ $m }}</option>
                                    @endforeach
                            </select>
                            &ensp;
                            <button type="submit" class="btn btn-info btn-circle btn-4"><i class="fas fa-folder-open"></i></button>
                            <input type="text" class="form-control" name="" id="" placeholder="Masukkan tahun...">
                        </div>
                        <hr>
                        <div class="char-pie pt-4">
                            <canvas id="labelChart"></canvas>
                        </div>
                        <hr>
                        <b>*Grafik di atas adalah data pasien berdasarkan kategori <span class="text-info">Dosen, Karyawan, Mahasiswa, <span class="text-dark">dan</span> Umum</span></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function filterRekamMedik() {
        var filter = document.getElementById('filterRekamMedik');
        var tanggal = document.getElementById('tanggalRekamMedik').value;
        var table = document.getElementsByClassName('table');
        var rekammedik = $('.table');
        var create = [`{{ $created_at = \App\Models\RekamMedik::select('created_at')->get(); }}`]
        create.forEach(tampilData);
        function tampilData(data) {
            var year = `{{\Carbon\Carbon::parse(`+data+`)}}`;
            console.log(year);
        }
    }
</script>
<!-- MDB -->
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
<script>
    var ctxB = document.getElementById("barChart").getContext('2d');
    var myBarChart = new Chart(ctxB, {
        type: 'bar',
        data: {
            labels: ["Januari", "Februari", "Maret", "April", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
            datasets: [{
                label: 'Jumlah Pasien',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<script>
    var ctxP = document.getElementById("labelChart").getContext('2d');
    var myPieChart = new Chart(ctxP, {
    plugins: [ChartDataLabels],
    type: 'pie',
    data: {
        labels: ["Mahasiswa", "Dosen", "Karyawan", "Umum"],
        datasets: [{
        data: [210, 130, 120, 160],
        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#FF00FF"],
        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#fa64fa"]
        }]
    },
    options: {
        responsive: true,
        legend: {
        position: 'right',
        labels: {
            padding: 20,
            boxWidth: 10
        }
        },
        plugins: {
            datalabels: {
                formatter: (value, ctx) => {
                    let sum = 0;
                    let dataArr = ctx.chart.data.datasets[0].data;
                    dataArr.map(data => {
                        sum += data;
                    });
                    let percentage = (value * 100 / sum).toFixed(2) + "%";
                    return percentage;
                },
                color: 'white',
                labels: {
                title: {
                    font: {
                    size: '11'
                    }
                }
                }
            }
        }
    }
    });
</script>
@endsection