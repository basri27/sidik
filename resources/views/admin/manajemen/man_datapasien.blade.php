@extends('layouts.back')

@section('title', 'Manajemen Data Pasien')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dashboard/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('menu')
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin_profil') }}">
        <i class="fas fa-user"></i>
        <span>Profil</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin_jadwal') }}">
        <i class="fas fa-calendar-alt"></i>
        <span>Jadwal Praktek</span>
    </a>
</li>
<li class="nav-item active">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-wrench"></i>
        <span>Manajemen Data</span>
    </a>
    <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pilih:</h6>
            <a class="collapse-item active" href="{{ route('admin_man_datapasien') }}">Pasien</a>
            <a class="collapse-item" href="{{ route('admin_man_dataapoteker') }}">Apoteker</a>
            <a class="collapse-item" href="{{ route('admin_man_datanakes') }}">Tenaga Kesehatan</a>
            <a class="collapse-item" href="#">Dokumentasi Kegiatan</a>
            <a class="collapse-item" href="{{ route('admin_man_datarekammedik') }}#">Rekam Medik</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">
        <i class="fas fa-tasks"></i>
        <span>Rekap Rekam Medik</span>
    </a>
</li>
@endsection

@section('subhead', 'Manajemen Data Pasien')

@section('content')
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Data Pasien
            <input style="float: right" class="btn btn-primary" type="button" value="Tambah"></h4>
            <hr>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead id="dataTable">
                        <tr>
                            <th>Index</th>
                            <th>Nama</th>
                            <th>Tempat & Tanggal Lahir</th>
                            <th>Kategori</th>
                            <th>Alamat</th>
                            <th>Umur</th>
                            <th>Pekerjaan</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Index</th>
                            <th>Nama</th>
                            <th>Tempat & Tanggal Lahir</th>
                            <th>Kategori</th>
                            <th>Alamat</th>
                            <th>Umur</th>
                            <th>Pekerjaan</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>M. Basri</td>
                            <td>Banjarmasin, 27 September 2000</td>
                            <td>ULM</td>
                            <td>Jl. Kayutangi</td>
                            <td>21</td>
                            <td>Mahasiswa</td>
                            <td>Laki-laki</td>
                            <td>
                                <center>
                                    <a href=""><i class="fas fa-edit"></i></a>
                                    <a href=""><i class="fas fa-trash"></i></a>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection