@extends('layouts.back')

@section('title', 'Keluarga Pasien')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
@endsection

@section('menu')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profil_pasien', Auth::user()->id) }}">
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pasien_jadwal_praktik', $pasien->user_id)}}">
            <i class="fas fa-calendar-alt"></i>
            <span>Jadwal Praktik</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('riwayat_berobat', $pasien->id) }}">
            <i class="fas fa-history"></i>
            <span>Riwayat Berobat</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kartu_berobat', $pasien->user_id) }}">
            <i class="fas fa-id-card"></i>
            <span>Kartu Berobat</span>
        </a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('keluarga_pasien', $pasien->user_id) }}">
            <i class="fas fa-users"></i>
            <span>Keluarga</span>
        </a>
    </li>
@endsection

@section('subhead', 'Keluarga Pasien')

@section('foto')
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/pasien/' . $pasien->foto_pasien) }}">
@endsection

@section('content')
<div class="container-fluid">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="card shadow mb-4">         
        <div class="card-body">        
            <a href="#addKeluarga" class="btn btn-success btn-sm" data-toggle="modal"><i class="fas fa-plus-circle"></i>&nbsp;Tambah Keluarga</a><br><br>
            @foreach($kelpasien as $kp)
            <div class="card shadow">
                <a href="#collapseKeluarga{{$kp->id}}" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $kp->nama_kel_pasien}} ({{ $kp->kategori_kel_pasien }})</h6>
                </a>
                <div class="collapse show" id="collapseKeluarga{{$kp->id}}">
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                                <tr class="font-weight-bold">
                                    <td width="15%"><img class="img-thumbnail" src="{{ asset('foto_profil/keluarga_pasien/' . $kp->foto_kel_pasien) }}"></td>
                                    <td>
                                        Umur: {{ \Carbon\Carbon::parse($kp->tgl_lhr_kel_pasien)->age }} tahun <br>
                                        Username: <span class="text-primary">{{ $kp->user->username }}</span> <br>
                                        Alamat: {{ $kp->alamat_kel_pasien }} <br>
                                        TTL: {{ $kp->tempat_lhr_kel_pasien }}, {{ \Carbon\Carbon::parse($kp->tgl_lhr_kel_pasien)->format('d F Y') }} <br>
                                        No. HP: {{ $kp->no_hp_kel_pasien }} <br>
                                        Jenis Kelamin: {{ $kp->jk_kel_pasien }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
<!--                         <div class="row">    
                            <img class="img-thumbnail col-6" src="{{ asset('foto_profil/keluarga_pasien/' . $kp->foto_kel_pasien) }}">
                            <div class="col-6">
                                <label class="font-weight-bold text-primary">{{ $kp->nama_kel_pasien }}</label>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div><br>
            @endforeach
        </div>
    </div>
</div>
<div class="modal fade" role="dialog" id="addKeluarga">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title font-weight-bold float-left">Tambah Data Keluarga</h4>
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
            <form action="{{ route('add_keluarga', $pasien->user_id) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="text" name="username" class="form-control" value="{{ getName($n) }}" hidden>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Tempat lahir</label>
                                    <input type="text" name="tempat_lhr" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                    <input type="date" name="tgl_lhr" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">No. Hp</label>
                                    <input type="text" name="no_hp" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                    <select class="form-control" name="jk" id="jk" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Kategori</label>
                                    <select data-width="100%" class="form-control" name="kategori" id="kategori" required>
                                        @if($pasangan < 1)
                                        @if($pasien->jk_pasien == "Laki-laki")
                                        <option value="Istri">Istri</option>
                                        @elseif($pasien->jk_pasien == "Perempuan")
                                        <option value="Suami">Suami</option>
                                        @endif
                                        @endif
                                        <option value="Anak">Anak</option>
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
@endsection