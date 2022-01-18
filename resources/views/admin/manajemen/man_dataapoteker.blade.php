@extends('layouts.back')

@section('title', 'Manajemen Data Apoteker')

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

@section('subhead', 'Manajemen Data Apoteker')

@section('content')
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Data Apoteker
                <a href="{{ route('adm_man_dataapoteker_tambah') }}" style="float: right; color: white;" class="btn btn-primary" type="button">Tambah</a>
            </h4>
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
                            <th>Tempat & Tanggal Lahir</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Index</th>
                            <th>Nama</th>
                            <th>Tempat & Tanggal Lahir</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($apotekers as $apoteker)
                        <tr>
                            <td>{{ $apoteker->id }}</td>
                            <td>{{ $apoteker->nama }}</td>
                            <td>{{ $apoteker->tempat_lhr }}, {{ \Carbon\Carbon::parse($apoteker->tgl_lhr)->format('d F Y') }}</td>
                            @if($apoteker->nohp == "")
                            <td style="text-align: center">-</td>
                            @else
                            <td>{{ $apoteker->nohp }}</td>
                            @endif
                            <td>{{ $apoteker->alamat }}</td>
                            <td>{{ $apoteker->jk }}</td>
                            <td>
                                <center>
                                    <form action="{{ route('delete_dataapoteker', $apoteker->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-success btn-sm" href="{{ route('adm_man_dataapoteker_edit', $apoteker->id) }}"><i class="fas fa-edit"></i></a> 
                                        <button type="submit" class="btn btn-danger btn-sm" onClick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fas fa-trash"></i></button>
                                    </form>
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