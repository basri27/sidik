@extends('layouts.back')

@section('title', 'Ubah Jadwal Praktek')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
@endsection

@section('menu')
<li class="nav-item">
    <a class="nav-link" href="{{ route('adm_dashboard') }}">
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('adm_profil', Auth::user()->id) }}">
        <i class="fas fa-user"></i>
        <span>Profil</span>
    </a>
</li>
<li class="nav-item active">
    <a class="nav-link" href="{{ route('adm_jadwal') }}">
        <i class="fas fa-calendar-alt"></i>
        <span>Jadwal Praktek</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Manajemen Data</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pilih:</h6>
            <a class="collapse-item" href="{{ route('admin_man_datapasien') }}">Pasien</a>
            <a class="collapse-item" href="{{ route('admin_man_dataapoteker') }}">Apoteker</a>
            <a class="collapse-item" href="{{ route('admin_man_datanakes') }}">Tenaga Kesehatan</a>
            <a class="collapse-item" href="#">Dokumentasi Kegiatan</a>
            <a class="collapse-item" href="{{ route('admin_man_datarekammedik') }}">Rekam Medik</a>
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

@section('subhead', 'Ubah Jadwal Praktek')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="text-align: center; font-size: 70%; color: white;" width="100%" cellspacing="0">
                    <thead class="bg-dark">   
                        <tr>
                            <th scope="col sm-1">Senin</th>
                        </tr>
                        <tr>
                            <th>
                                <input type="checkbox" name="dokter1" id="dokter1" value="1">
                                <label for="dokter1">dr. Edyson, M.Kes</label><br>
                                <input type="checkbox" name="dokter2" id="dokter2" value="2">
                                <label for="dokter1">dr. Lena Rosida, M.Kes.PhD</label><br>
                                <input type="checkbox" name="dokter3" id="dokter3" value="3">
                                <label for="dokter1">dr. Alfi Yasmina, M.Kes.PhD</label><br>
                                <input type="checkbox" name="dokter4" id="dokter4" value="4">
                                <label for="dokter1">dr. Husnul Khatimah, M.Sc</label><br>
                                <input type="checkbox" name="dokter5" id="dokter5" value="5">
                                <label for="dokter1">dr. Farida Heriyani, M.PH.</label><br>
                                <input type="checkbox" name="dokter6" id="dokter6" value="6">
                                <label for="dokter1">dr. Tara</label>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input class="form-control-sm" type="time" name="time1" id="time1">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-control-sm" type="time" name="time2" id="time2">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered" style="text-align: center; font-size: 70%; color: white;" width="100%" cellspacing="0">
                    <thead class="bg-dark">   
                        <tr>
                            <th scope="col sm-1">Selasa</th>
                        </tr>
                        <tr>
                            <th>
                                <input type="checkbox" name="dokter1" id="dokter1" value="1">
                                <label for="dokter1">dr. Edyson, M.Kes</label><br>
                                <input type="checkbox" name="dokter2" id="dokter2" value="2">
                                <label for="dokter1">dr. Lena Rosida, M.Kes.PhD</label><br>
                                <input type="checkbox" name="dokter3" id="dokter3" value="3">
                                <label for="dokter1">dr. Alfi Yasmina, M.Kes.PhD</label><br>
                                <input type="checkbox" name="dokter4" id="dokter4" value="4">
                                <label for="dokter1">dr. Husnul Khatimah, M.Sc</label><br>
                                <input type="checkbox" name="dokter5" id="dokter5" value="5">
                                <label for="dokter1">dr. Farida Heriyani, M.PH.</label><br>
                                <input type="checkbox" name="dokter6" id="dokter6" value="6">
                                <label for="dokter1">dr. Tara</label>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input class="form-control-sm" type="time" name="time1" id="time1">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-control-sm" type="time" name="time2" id="time2">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered" style="text-align: center; font-size: 70%; color: white;" width="100%" cellspacing="0">
                    <thead class="bg-dark">   
                        <tr>
                            <th scope="col sm-1">Rabu</th>
                        </tr>
                        <tr>
                            <th>
                                <input type="checkbox" name="dokter1" id="dokter1" value="1">
                                <label for="dokter1">dr. Edyson, M.Kes</label><br>
                                <input type="checkbox" name="dokter2" id="dokter2" value="2">
                                <label for="dokter1">dr. Lena Rosida, M.Kes.PhD</label><br>
                                <input type="checkbox" name="dokter3" id="dokter3" value="3">
                                <label for="dokter1">dr. Alfi Yasmina, M.Kes.PhD</label><br>
                                <input type="checkbox" name="dokter4" id="dokter4" value="4">
                                <label for="dokter1">dr. Husnul Khatimah, M.Sc</label><br>
                                <input type="checkbox" name="dokter5" id="dokter5" value="5">
                                <label for="dokter1">dr. Farida Heriyani, M.PH.</label><br>
                                <input type="checkbox" name="dokter6" id="dokter6" value="6">
                                <label for="dokter1">dr. Tara</label>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input class="form-control-sm" type="time" name="time1" id="time1">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-control-sm" type="time" name="time2" id="time2">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered" style="text-align: center; font-size: 70%; color: white;" width="100%" cellspacing="0">
                    <thead class="bg-dark">   
                        <tr>
                            <th scope="col sm-1">Kamis</th>
                        </tr>
                        <tr>
                            <th>
                                <input type="checkbox" name="dokter1" id="dokter1" value="1">
                                <label for="dokter1">dr. Edyson, M.Kes</label><br>
                                <input type="checkbox" name="dokter2" id="dokter2" value="2">
                                <label for="dokter1">dr. Lena Rosida, M.Kes.PhD</label><br>
                                <input type="checkbox" name="dokter3" id="dokter3" value="3">
                                <label for="dokter1">dr. Alfi Yasmina, M.Kes.PhD</label><br>
                                <input type="checkbox" name="dokter4" id="dokter4" value="4">
                                <label for="dokter1">dr. Husnul Khatimah, M.Sc</label><br>
                                <input type="checkbox" name="dokter5" id="dokter5" value="5">
                                <label for="dokter1">dr. Farida Heriyani, M.PH.</label><br>
                                <input type="checkbox" name="dokter6" id="dokter6" value="6">
                                <label for="dokter1">dr. Tara</label>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input class="form-control-sm" type="time" name="time1" id="time1">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-control-sm" type="time" name="time2" id="time2">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered" style="text-align: center; font-size: 70%; color: white;" width="100%" cellspacing="0">
                    <thead class="bg-dark">   
                        <tr>
                            <th scope="col sm-1">Jum'at</th>
                        </tr>
                        <tr>
                            <th>
                                <input type="checkbox" name="dokter1" id="dokter1" value="1">
                                <label for="dokter1">dr. Edyson, M.Kes</label><br>
                                <input type="checkbox" name="dokter2" id="dokter2" value="2">
                                <label for="dokter1">dr. Lena Rosida, M.Kes.PhD</label><br>
                                <input type="checkbox" name="dokter3" id="dokter3" value="3">
                                <label for="dokter1">dr. Alfi Yasmina, M.Kes.PhD</label><br>
                                <input type="checkbox" name="dokter4" id="dokter4" value="4">
                                <label for="dokter1">dr. Husnul Khatimah, M.Sc</label><br>
                                <input type="checkbox" name="dokter5" id="dokter5" value="5">
                                <label for="dokter1">dr. Farida Heriyani, M.PH.</label><br>
                                <input type="checkbox" name="dokter6" id="dokter6" value="6">
                                <label for="dokter1">dr. Tara</label>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input class="form-control-sm" type="time" name="time1" id="time1">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="form-control-sm" type="time" name="time2" id="time2">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="#" class="btn btn-success btn-icon-split btn-sm">
                        <span>
                            <i class="fas fa-check"></i>
                        </span>    
                        <span class="text">Simpan</span>
                    </a>&nbsp;
            <a href="{{ route('adm_jadwal') }}" class="btn btn-secondary btn-icon-split btn-sm">
                <span>
                    <i class="fas fa-times"></i>
                </span>    
                <span class="text">Batal</span>
            </a>
        </div>
    </div>
</div>
@endsection