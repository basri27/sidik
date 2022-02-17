@extends('layouts.back')

@section('title', 'Manajemen Data Diagnosa')

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

@section('subhead', 'Manajemen Data Diagnosa')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Data Diagnosa
                <a href="#addDiagnosa" class="float-right btn btn-primary btn-sm" data-toggle="modal"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</a>
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
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1 ?>
                        @foreach ($diagnosa as $diag)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $diag->kode_diagnosa }}</td>
                            <td>{{ $diag->nama_diagnosa }}</td>
                            <td>
                                <center>
                                    <a class="btn btn-success btn-sm" href="#editDiagnosa{{$diag->id}}" data-toggle="modal">Edit</a> 
                                    <a class="btn btn-danger btn-sm" href="#deleteDiagnosa{{$diag->id}}" data-toggle="modal">Hapus</a> 
                                    <!-- <form action="{{ route('delete_dataapoteker', $diag->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-success btn-sm" href="{{ route('adm_man_dataapoteker_edit', $diag->id) }}">Edit</a> 
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form> -->
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
<div id="addDiagnosa" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title font-weight-bold float-left">Tambah Data Diagnosa</h4>
            </div>
            <form action={{ route('adm_add_diagnosa') }} method="post">
                @csrf
                <div class="modal-body">
                    <label class="font-weight-bold text-dark">Kode diagnosa:</label>
                    <input type="text" name="kode_diagnosa" class="form-control" required>
                    <label class="font-weight-bold text-dark">Nama diagnosa:</label>
                    <input type="text" name="diagnosa" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@foreach($diagnosa as $diag)
    <div id="editDiagnosa{{$diag->id}}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title font-weight-bold float-left">Ubah Data Diagnosa</h4>
                </div>
                <form action={{ route('adm_edit_diagnosa', $diag->id) }} method="post">
                    @method('PATCH')
                    @csrf
                    <div class="modal-body">
                        <label class="font-weight-bold text-dark">Kode diagnosa:</label>
                        <input type="text" name="kode_diagnosa" class="form-control" value="{{ $diag->kode_diagnosa}}" required>
                        <label class="font-weight-bold text-dark">Nama diagnosa:</label>
                        <input type="text" name="diagnosa" class="form-control" value="{{ $diag->nama_diagnosa }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="deleteDiagnosa{{$diag->id}}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title font-weight-bold float-left">Hapus Data Diagnosa</h4>
                </div>
                <form action={{ route('adm_delete_diagnosa', $diag->id) }} method="post">
                    @method('PATCH')
                    @csrf
                    <div class="modal-body">
                        <h5 class="font-weight-bold">Anda yakin ingin menghapus data ini?</h5>
                        <label class="font-weight-bold text-dark">Kode diagnosa:</label>
                        <input type="text" name="kode_diagnosa" class="form-control" value="{{ $diag->kode_diagnosa}}" readonly>
                        <label class="font-weight-bold text-dark">Nama diagnosa:</label>
                        <input type="text" name="diagnosa" class="form-control" value="{{ $diag->nama_diagnosa }}" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
</script>
@endsection