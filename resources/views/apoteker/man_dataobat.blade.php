@extends('layouts.back')

@section('title', 'Data Obat')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dashboard/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('menu')
    <li class="nav-item">
        <a class="nav-link" href={{ route('apoteker_dashboard', Auth::user()->id) }}>
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href={{ route('apoteker_profil', Auth::user()->id) }}>
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href={{ route('apoteker_data_obat', Auth::user()->id) }}>
            <i class="fas fa-capsules"></i>
            <span>Data Obat</span>
        </a>
    </li>
@endsection

@section('subhead', 'Data Obat')

@section('notif')
    @include('layouts.notification.notif_apoteker')
@endsection

@section('foto')
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/apoteker/' . $apoteker->foto_apoteker) }}">
@endsection

@section('content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Data Obat
                <a href="#addObat" class="btn btn-primary btn-sm float-right" data-toggle="modal"><i class="fa fa-plus-circle"></i>&nbsp;Tambah</a>
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
                    <thead id="dataTable" class="text-center">
                        <tr>
                            <th>No.</th>
                            <th>Nama obat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot class="text-center">
                        <tr>
                            <th class="col-1">No.</th>
                            <th class="col-9">Nama obat</th>
                            <th class="col-2">Aksi</th>
                        </tr>
                    </tfoot>
                    <?php $i = 1 ?>
                    <tbody>
                        @foreach ($obats as $obat)
                        <tr>
                            <th class="text-center">{{ $i++ }}</th>
                            <td class="">{{ $obat->nama_obat }}</td>
                            <td class="text-center">
                                <a class="btn btn-success" href="#editObat{{ $obat->id }}" data-toggle="modal"><i class="fas fa-edit"></i></a> 
                                <a class="btn btn-danger" href="#deleteObat{{ $obat->id }}" data-toggle="modal"><i class="fas fa-trash"></i></a>
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
<div id="addObat" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title font-weight-bold float-left">Tambah Obat</h4>
            </div>
            <form action={{ route('apoteker_add_obat', Auth::user()->id) }} method="post">
                @csrf
                <div class="modal-body">
                    <label class="font-weight-bold text-dark">Nama obat:</label>
                    <input type="text" name="obat" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@foreach($obats as $obat)
    <div id="editObat{{ $obat->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title font-weight-bold float-left">Edit Obat</h4>
                </div>
                <form action={{ route('apoteker_edit_obat', [$obat->id, Auth::user()->id]) }} method="post">
                    @method('PATCH')
                    @csrf
                    <div class="modal-body">
                        <label class="font-weight-bold">Nama obat:</label>
                        <input type="text" name="obat" class="form-control" value="{{ $obat->nama_obat }}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="deleteObat{{ $obat->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title font-weight-bold float-left">Hapus Obat</h4>
                </div>
                <form action={{ route('apoteker_delete_obat', [$obat->id, Auth::user()->id]) }} method="post">
                    @method('PATCH')
                    @csrf
                    <div class="modal-body">
                        <h5 class="font-weight-bold">Anda yakin ingin menghapus obat ini?</h5>
                        <label>Nama obat:</label>
                        <input type="text" name="obat" class="form-control" value="{{ $obat->nama_obat }}" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Ya</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Tidak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection