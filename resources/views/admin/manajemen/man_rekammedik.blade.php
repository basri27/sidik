@extends('layouts.back')

@section('title', 'Manajemen Data Rekam Medik')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dashboard/datatables/dataTables.bootstrap4.css') }}">
    <style type="text/css">
        .modal-dialog {
            max-width: 65%;
        }
    </style>
@endsection

@section('menu')
@include('layouts.nav_admin')
@endsection

@section('subhead', 'Manajemen Data Rekam Medik')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

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
                            <td>{{ $p->nama_pasien }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tgl_lhr_pasien)->age }} tahun</td>
                            <td>
                                {{ $p->category->nama_kategori }}
                                @if ($p->category_id == 1)
                                    @foreach($dosen as $d)
                                        {{ ($d->pasien_id == $p->id) ? $d->fakulta->nama_fakultas : '' }}
                                    @endforeach
                                @elseif ($p->category_id == 2)
                                    @foreach($kary as $k)
                                        {{ ($k->pasien_id == $p->id) ? $k->fakulta->nama_fakultas : '' }}
                                    @endforeach
                                @elseif ($p->category_id == 3)
                                    @foreach($mhs as $m)
                                        {{ ($m->pasien_id == $p->id) ? $m->fakulta->nama_fakultas." - ".$m->prodi->nama_prodi : '' }}
                                    @endforeach
                                @elseif ($p->category_id == 5)
                                    @foreach($bpjs as $b)
                                        ({{ ($b->pasien_id == $p->id) ? $b->no_bpjs : '' }})
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $p->jk_pasien }}</td>
                            <td>
                                <a class="btn btn-success btn-sm" href="{{ route('detail_datarekammedik', $p->user_id) }}"><i class="fas fa-info-circle"></i></a> 
                                <a class="btn btn-primary btn-sm" href="{{ route('edit_datarekammedik', $p->id) }}"><i class="fas fa-plus-circle"></i></a>
                                @if ($p->category_id == 1 or $p->category_id == 2)
                                <a class="btn btn-secondary btn-sm" href="#viewKeluarga{{ $p->id }}" data-toggle="modal"><i class="fas fa-users"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@foreach($pasiens as $p)
    <div id="viewKeluarga{{ $p->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header bg-light">
                    <h4 class="modal-title font-weight-bold float-left">Daftar Keluarga</h4>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <?php $keluarga = \App\Models\KeluargaPasien::where('pasien_id', $p->id)->get(); ?>
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Hubungan</th>
                                    <th>Umur</th>
                                    <!-- <th>Jenis Kelamin</th> -->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($keluarga as $kp)
                                <tr>
                                    <td>{{ $kp->nama_kel_pasien }}</td>
                                    <td>{{ $kp->kategori_kel_pasien }}</td>
                                    <td>{{ \Carbon\Carbon::parse($kp->tgl_lhr_kel_pasien)->age }} tahun</td>
                                    <!-- <td>{{ $kp->jk_kel_pasien }}</td> -->
                                    <td>
                                        <center>
                                            <a class="btn btn-success btn-sm" href="#"><i class="fas fa-info-circle"></i></a>
                                            <a class="btn btn-primary btn-sm" href="{{ route('edit_datarekammedikkeluarga', $kp->id) }}"><i class="fas fa-plus-circle"></i></a>
                                        </center>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
                </div>
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