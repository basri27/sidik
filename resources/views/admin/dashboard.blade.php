@extends('layouts.back')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
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
        <div class=" col-lg-8">      
            <div class="card shadow mb-4">
                <a href="#collapseCardGrafik" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Jumlah Pasien Berobat Pertahun</h6>
                </a>
                <div class="collapse show" id="collapseCardGrafik">
                    <div class="card-body">
                        <div class="container row">
                            <input type="number" class="form-control col-5" id="tahun-grafik" placeholder="Masukkan tahun..." required>&nbsp;
                            <button class="btn btn-info btn-2 tombol-grafik"><i class="fas fa-folder-open"></i>&nbsp;Lihat</button>
                        </div>
                        <hr>
                        <div id="chart" style="height: 300px;"></div>
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
                            <select class="form-control col" name="" id="">
                                <option value="">Pilih Bulan</option>
                                    @foreach($month as $m)
                                <option value="{{ $i += 1 }}">{{ $m }}</option>
                                    @endforeach
                            </select>
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
<!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>

<script>
      const chart = new Chartisan({
        el: '#chart',
        url: "{{ route('adm_dashboard') }}",
        hooks: new ChartisanHooks()
            .colors(['#4299E1'])
            
            .axis(true)
      });
</script>
@endsection