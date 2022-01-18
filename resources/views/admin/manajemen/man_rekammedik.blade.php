@extends('layouts.back')

@section('title', 'Manajemen Data Rekam Medik')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dashboard/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('menu')
@include('layouts.nav_admin')
@endsection

@section('subhead', 'Manajemen Data Rekam Medik')

@section('content')
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Data Rekam Medik
            <hr>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead id="dataTable">
                        <tr>
                            <th>Index</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Umur</th>
                            <th>Kategori</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Index</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Umur</th>
                            <th>Kategori</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($pasiens as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tgl_lhr)->diff(\Carbon\Carbon::now())->y}}</td>
                            <td>{{ $p->category->nama }}</td>
                            <td>{{ $p->jk }}</td>
                            <td>
                                <center>
                                    <a class="btn btn-success btn-sm" href="{{ route('detail_datarekammedik', $p->id) }}"><i class="fas fa-info-circle"></i></a> 
                                    <a class="btn btn-primary btn-sm" href="{{ route('edit_datarekammedik', $p->id) }}"><i class="fas fa-plus-circle"></i></a>
                                </center>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
</script>
@endsection