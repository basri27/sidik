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

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Data Apoteker
                <a href="#addApoteker" class="float-right btn btn-primary btn-sm" data-toggle="modal"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</a>
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
                            <th></th>
                            <th></th>
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
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($apotekers as $apoteker)
                        <tr>
                            <td>{{ $apoteker->id }}</td>
                            <td>{{ $apoteker->nama_apoteker }}</td>
                            <td>{{ $apoteker->tempat_lhr_apoteker }}, {{ \Carbon\Carbon::parse($apoteker->tgl_lhr_apoteker)->format('d F Y') }}</td>
                            @if($apoteker->nohp_apoteker == "")
                            <td style="text-align: center">-</td>
                            @else
                            <td>{{ $apoteker->nohp_apoteker }}</td>
                            @endif
                            <td>{{ $apoteker->alamat_apoteker }}</td>
                            <td>{{ $apoteker->jk_apoteker }}</td>
                            <td>
                                <center>
                                    <a href="#editApoteker{{$apoteker->id}}" class="btn btn-sm btn-success" data-toggle="modal">Edit</a>
                                    <!-- <a href="#deleteApoteker{{$apoteker->id}}" class="btn btn-sm btn-danger col-12" data-toggle="modal">Hapus</a> -->
                                    <!-- <form action="{{ route('delete_dataapoteker', $apoteker->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-success btn-sm" href="{{ route('adm_man_dataapoteker_edit', $apoteker->id) }}"><i class="fas fa-edit"></i></a> 
                                        <button type="submit" class="btn btn-danger btn-sm" onClick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fas fa-trash"></i></button>
                                    </form> -->
                                </center>
                            </td>
                            <td>
                                <a href="#deleteApoteker{{$apoteker->id}}" class="btn btn-sm btn-danger" data-toggle="modal">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="addApoteker" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title font-weight-bold float-left">Tambah Data Apoteker</h4>
            </div>
            <?php
                $n=10;
                function getName($n) {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randomString = '';
                  
                    for ($i = 0; $i < $n; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }
                  
                    return $randomString;
                } 
            ?>
            <form action="{{ route('adm_man_dataapoteker_add') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="text" name="username" class="form-control" value="{{ getName($n) }}" hidden>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                        <label class="font-weight-bold text-primary">Nama</label>
                                        <input type="text" name="nama" class="form-control" required>
                                        <label class="font-weight-bold text-primary">Tempat lahir</label>
                                        <input type="text" name="tempat_lhr" class="form-control" required>
                                        <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                        <input type="date" name="tgl_lhr" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                        <label class="font-weight-bold text-primary">No. Hp</label>
                                        <input type="text" name="no_hp" class="form-control" required>
                                        <label class="font-weight-bold text-primary">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" required>
                                        <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                        <select class="form-control" name="jk" id="jk" required>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@foreach($apotekers as $apoteker)
<div id="editApoteker{{$apoteker->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title font-weight-bold float-left">Edit Data Apoteker</h4>
            </div>
            <form action="{{ route('adm_man_dataapoteker_update', $apoteker->id) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                        <label class="font-weight-bold text-primary">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $apoteker->nama_apoteker }}" required>
                                        <label class="font-weight-bold text-primary">Tempat lahir</label>
                                        <input type="text" name="tempat_lhr" class="form-control" value="{{ $apoteker->tempat_lhr_apoteker }}" required>
                                        <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                        <input type="date" name="tgl_lhr" class="form-control" value="{{ $apoteker->tgl_lhr_apoteker }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                        <label class="font-weight-bold text-primary">No. Hp</label>
                                        <input type="text" name="no_hp" class="form-control" value="{{ $apoteker->nohp_apoteker }}" required>
                                        <label class="font-weight-bold text-primary">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" value="{{ $apoteker->alamat_apoteker }}" required>
                                        <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                        <select class="form-control" name="jk" id="jk" required>
                                            <option value="{{ $apoteker->jk_apoteker }}">{{ $apoteker->jk_apoteker }}</option>
                                            @if($apoteker->jk_apoteker == 'Perempuan')
                                            <option value="Laki-laki">Laki-laki</option>
                                            @elseif($apoteker->jk_apoteker == 'Laki-laki')
                                            <option value="Perempuan">Perempuan</option>
                                            @else
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                            @endif
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="deleteApoteker{{$apoteker->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title font-weight-bold float-left">Hapus Data Apoteker</h4>
            </div>
            <form action="{{ route('delete_dataapoteker', $apoteker->id) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <h5 class="font-weight-bold">Anda yakin ingin menghapus data ini?</h5><hr>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Nama</label>
                                    <input type="text" class="form-control" value="{{ $apoteker->nama_apoteker }}" readonly>
                                    <label class="font-weight-bold text-primary">Tempat lahir</label>
                                    <input type="text" class="form-control" value="{{ $apoteker->tempat_lhr_apoteker }}" readonly>
                                    <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                    <input type="date" class="form-control" value="{{ $apoteker->tgl_lhr_apoteker }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">No. Hp</label>
                                    <input type="text" class="form-control" value="{{ $apoteker->nohp_apoteker }}" readonly>
                                    <label class="font-weight-bold text-primary">Alamat</label>
                                    <input type="text" class="form-control" value="{{ $apoteker->alamat_apoteker }}" readonly>
                                    <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                    <input type="text" class="form-control" value="{{ $apoteker->jk_apoteker }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
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
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script> -->
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
</script>
@endsection