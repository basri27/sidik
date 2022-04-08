@extends('layouts.back')

@section('title', 'Manajemen Data Tenaga Kesehatan')

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

@section('subhead', 'Manajemen Data Tenaga Kesehatan')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Data Tenaga Kesehatan
                <a href="#addNakes" class="float-right btn btn-primary btn-sm" data-toggle="modal"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</a>
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
                            <th>Kategori</th>
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
                            <th>Kategori</th>
                            <th>Tempat & Tanggal Lahir</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($tenkes as $nakes)
                        <tr>
                            <td>{{ $nakes->id }}</td>
                            <td>{{ $nakes->nama_tenkes }}</td>
                            <td>{{ $nakes->kategori_tenkesehatan->nama_kategori_tenkes }}</td>
                            <td>{{ $nakes->tempat_lhr_tenkes }}, {{ \Carbon\Carbon::parse($nakes->tgl_lhr_tenkes)->format('d F Y') }}</td>
                            <td>{{ $nakes->nohp_tenkes }}</td>
                            <td>{{ $nakes->alamat_tenkes }}</td>
                            <td>{{ $nakes->jk_tenkes }}</td>
                            <td>
                                <a href="#editNakes{{$nakes->id}}" class="btn btn-sm btn-success" data-toggle="modal">Edit</a>
                                    <!-- <form action="{{ route('delete_datanakes', $nakes->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <a class="btn btn-success btn-sm" href="{{ route('adm_man_datanakes_edit', $nakes->id) }}"><i class="fas fa-edit"></i></a> 
                                        <button type="submit" class="btn btn-danger btn-sm" onClick="return confirm('Apakah Anda yakin akan menghapus data ini?')"><i class="fas fa-trash"></i></button>
                                    </form> -->
                            </td>
                            <td>
                                <a href="#deleteNakes{{$nakes->id}}" class="btn btn-sm btn-danger" data-toggle="modal">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="addNakes" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title font-weight-bold float-left">Tambah Data Tenaga Kesehatan</h4>
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
            <form action="{{ route('adm_man_datanakes_add') }}" method="post">
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
                        <div class="col">
                            <center>
                                <label class="font-weight-bold text-primary">Kategori Tenaga Kesehatan</label>
                                    <select class="form-control col-6" name="kakes">
                                    @foreach($kakes as $kt)
                                        <option value="{{ $kt->id }}">{{ $kt->nama_kategori_tenkes }}</option>
                                    @endforeach
                                    </select>
                            </center>
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
@foreach($tenkes as $nakes)
<div id="editNakes{{$nakes->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title font-weight-bold float-left">Edit Data Tenaga Kesehatan</h4>
            </div>
            <form action="{{ route('adm_man_datanakes_update', $nakes->id) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                        <label class="font-weight-bold text-primary">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $nakes->nama_tenkes }}" required>
                                        <label class="font-weight-bold text-primary">Tempat lahir</label>
                                        <input type="text" name="tempat_lhr" class="form-control" value="{{ $nakes->tempat_lhr_tenkes }}" required>
                                        <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                        <input type="date" name="tgl_lhr" class="form-control" value="{{ $nakes->tgl_lhr_tenkes }}" required>
                                        
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                        <label class="font-weight-bold text-primary">No. Hp</label>
                                        <input type="text" name="no_hp" class="form-control" value="{{ $nakes->nohp_tenkes }}" required>
                                        <label class="font-weight-bold text-primary">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" value="{{ $nakes->alamat_tenkes }}" required>
                                        <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                        <select class="form-control" name="jk" id="jk" required>
                                            <option value="{{ $nakes->jk_tenkes }}">{{ $nakes->jk_tenkes }}</option>
                                            @if($nakes->jk_tenkes == 'Perempuan')
                                            <option value="Laki-laki">Laki-laki</option>
                                            @elseif($nakes->jk_tenkes == 'Laki-laki')
                                            <option value="Perempuan">Perempuan</option>
                                            @else
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                            @endif
                                        </select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <center>
                                <label class="font-weight-bold text-primary">Kategori Tenaga Kesehatan</label>
                                    <select class="form-control col-6" name="kakes">
                                        <option value="{{ $nakes->kategori_tenkesehatan_id }}">{{ $nakes->kategori_tenkesehatan->nama_kategori_tenkes }}</option>
                                    @foreach($kakes as $kt)
                                        <option value="{{ $kt->id }}">{{ $kt->nama_kategori_tenkes }}</option>
                                    @endforeach
                                    </select>
                            </center>
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
<div id="deleteNakes{{$nakes->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title font-weight-bold float-left">Delete Data Tenaga Kesehatan</h4>
            </div>
            <form action="{{ route('delete_datanakes', $nakes->id) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <h5 class="font-weight-bold">Anda yakin ingin menghapus data ini?</h5><hr>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                        <label class="font-weight-bold text-primary">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $nakes->nama_tenkes }}" readonly>
                                        <label class="font-weight-bold text-primary">Tempat lahir</label>
                                        <input type="text" name="tempat_lhr" class="form-control" value="{{ $nakes->tempat_lhr_tenkes }}" readonly>
                                        <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                        <input type="date" name="tgl_lhr" class="form-control" value="{{ $nakes->tgl_lhr_tenkes }}" readonly>
                                        
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                        <label class="font-weight-bold text-primary">No. Hp</label>
                                        <input type="text" name="no_hp" class="form-control" value="{{ $nakes->nohp_tenkes }}" readonly>
                                        <label class="font-weight-bold text-primary">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" value="{{ $nakes->alamat_tenkes }}" readonly>
                                        <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                        <input type="text" class="form-control" value="{{ $nakes->jk_tenkes }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <center>
                                <label class="font-weight-bold text-primary">Kategori Tenaga Kesehatan</label>
                                <input type="text" class="form-control col-6 text-center" value="{{ $nakes->kategori_tenkesehatan->nama_kategori_tenkes }}" readonly>
                            </center>
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
@endsection