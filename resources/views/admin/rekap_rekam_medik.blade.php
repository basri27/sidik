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
        <div class="collapse " id="collapseCardMedik">
            <div class="card-body">
            
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="row">No.</th>
                            <th scope="row">Nama</th>
                            <th scope="row">Tanggal Periksa</th>
                            <th scope="row">Pemeriksa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">1</td>
                            <td>Muhammad Basri</td>
                            <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }} | {{ \Carbon\Carbon::now()->toTimeString() }}</td>
                            <td>dr. Lena</td>
                        </tr>
                        <tr>
                            <td scope="row">2</td>
                            <td>Muhammad Basri</td>
                            <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }} | {{ \Carbon\Carbon::now()->toTimeString() }}</td>
                            <td>dr. Lena</td>
                        </tr>
                        <tr>
                            <td scope="row">3</td>
                            <td>Muhammad Basri</td>
                            <td>{{ \Carbon\Carbon::now()->format('d-m-Y') }} | {{ \Carbon\Carbon::now()->toTimeString() }}</td>
                            <td>dr. Lena</td>
                        </tr>
                    </tbody>
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
                        <div class="row">
                            <div class="col-1"></div>
                            <select class="col-8" name="" id="">
                                <option value="">Pilih Bulan</option>
                                    @foreach($month as $m)
                                <option value="{{ $i += 1 }}">{{ $m }}</option>
                                    @endforeach
                            </select>
                            &ensp;
                            <button type="submit" class="btn btn-secondary btn-circle "><i class="fas fa-filter"></i></button>
                        </div><hr>
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
                label: 'Data Pasien',
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