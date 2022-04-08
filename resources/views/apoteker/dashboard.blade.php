@extends('layouts.back')

@section('title', 'Dashboard Apoteker')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
@endsection

@section('menu')
    <li class="nav-item active">
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
    <li class="nav-item">
        <a class="nav-link" href={{ route('apoteker_data_obat', Auth::user()->id) }}>
            <i class="fas fa-capsules"></i>
            <span>Data Obat</span>
        </a>
    </li>
@endsection

@section('subhead', 'Dashboard Apoteker')

@section('notif')
    @include('layouts.notification.notif_apoteker')
@endsection

@section('foto')
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/apoteker/' . Auth::user()->apoteker->foto_apoteker) }}">
@endsection

@section('content')
    <!-- @foreach($notifications as $n)
    <div id="viewResep{{ $n->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title font-weight-bold float-left">Resep obat</h4>
                </div>
                <?php $resep = \App\Models\ResepObat::whereDate('resepobat_created_at', \Carbon\Carbon::parse($n->notif_created_at)->toDateString())->where('rekam_medik_id', $n->rekam_medik_id)->get() ?>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <thead class="text-info">
                            <tr>
                                <th>Nama Obat</th>
                                <th>Dosis</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resep as $r)
                            <tr>
                                <td>{{ $r->obat->nama_obat }}</td>
                                <td>{{ $r->keterangan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Selesai</button>
                    <button type="button" class="btn" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach -->
    <div class="container-fluid">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="card shadow p-3">
            <div class="row">
                <p class="font-weight-bold text-primary col-3">Tanggal: <span class="text-success">{{ \Carbon\Carbon::now()->format('d F Y') }}</span></p>
                <p class="font-weight-bold text-primary col">Waktu: <span class="text-success">{{ \Carbon\Carbon::now()->toTimeString() }}</span></p>
            </div>
            <p class="font-weight-bold text-primary ">Jumlah pasien hari ini: <span class="text-success">{{ $pasienCount }} orang</span></p>
            <form action="{{ route('apoteker_dashboard', Auth::user()->id) }}">
                <button class="btn btn-success btn-sm pl-2 pr-2" id="refresh"><i class="fas fa-sync-alt"></i> Refresh</button>
            </form><br>
            <h5 class="font-weight-bold text-primary">Daftar pasien hari ini:</h5>
            @if($pasienCount == 0)
                <center><br><h5 class="text-info">Belum ada pasien hari ini</h5><br></center>
            @else
                @foreach($pasiens as $p)
                    <div class="mb-2">
                        <a href="#collapseCardMedik{{$p->id}}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-primary">
                                @if ($p->pasien_id != null)
                                {{ $p->pasien->nama_pasien}}
                                @else
                                {{ $p->keluarga_pasien->nama_kel_pasien }}
                                @endif
                                 | {{ \Carbon\Carbon::parse($p->rekammedik_created_at)->toTimeString() }}
                            </h6>
                        </a>
                        <div class="collapse" id="collapseCardMedik{{$p->id}}">
                            <div class="card-body shadow">
                                <div class="row">
                                    <div class="col">
                                        <p class="font-weight-bold text-primary">Resep Obat: <span class="text-danger"></span></p>
                                        <ul>
                                            <?php $resep = \App\Models\ResepObat::where('rekam_medik_id', $p->id)->get(); ?>
                                            @foreach($resep as $rs)
                                            <li>
                                                {{ $rs->obat->nama_obat }} | {{ $rs->keterangan }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="viewResepObat{{ $p->id }}" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title font-weight-bold float-left">Resep Obat</h4>
                                </div>
                                <div class="modal-body">
                                    <ul>
                                        <?php $resep = \App\Models\ResepObat::where('rekam_medik_id', $p->id)->get(); ?>
                                        @foreach($resep as $rs)
                                        <li>
                                            {{ $rs->obat->nama_obat }} | {{ $rs->keterangan }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-dark" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    
    <!-- <script type="text/javascript">
        setTimeout(function(){
        location.reload();
        },30000);
    </script> -->
@endsection