@extends('layouts.back')

@section('title', 'Edit Profil Pasien')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
@endsection

@section('menu')
    @include('layouts.nav_pasien')
@endsection

@section('subhead', 'Edit Profil Pasien')

@section('foto')
    <?php 
        $p = \App\Models\Pasien::where('user_id', $pasien->id)->first();
        $kp = \App\Models\KeluargaPasien::where('user_id', $pasien->id)->first();
        if ($p != null) {
            $dosen = \App\Models\Dosen::where('pasien_id', $p->id)->first();
            $kary = \App\Models\Karyawan::where('pasien_id', $p->id)->first();
            $mhs = \App\Models\Mahasiswa::where('pasien_id', $p->id)->first();
            $bpjs = \App\Models\Bpjs::where('pasien_id', $p->id)->first();
        }
    ?>
    @if ($p != null)
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/pasien/' . $p->foto_pasien) }}">
    @else
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/keluarga_pasien/' . $kp->foto_kel_pasien) }}">
    @endif
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    @if ($p != null)
                    <form method="POST" enctype="multipart/form-data" action={{ route('pasien_update_profil', $pasien->id) }}>
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $p->nama_pasien }}" required>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Tanggal lahir</label>
                                        <input type="date" name="tgl_lhr" class="form-control" value="{{ $p->tgl_lhr_pasien }}" required>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Tempat lahir</label>
                                        <input type="text" name="tempat_lhr" class="form-control" value="{{ $p->tempat_lhr_pasien }}" required>
                                    </li>
                                    
                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" value="{{ $p->alamat_pasien }}" required>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">No. Hp</label>
                                        <input type="text" name="no_hp" class="form-control" value="{{ $p->no_hp_pasien }}" required>
                                        
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Jenis Kelamin</label>
                                        <select class="form-control" name="jk" id="jk">
                                            <option value="{{ $p->jk_pasien }}">{{ $p->jk_pasien }}</option>
                                            @if($p->jk_pasien == "Laki-laki")
                                            <option value="Perempuan">Perempuan</option>
                                            @elseif($p->jk_pasien == "Perempuan")
                                            <option value="Laki-laki">Laki-laki</option>
                                            @else
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                            @endif
                                        </select>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Foto Profil</label>
                                        <div class="image-col col-md-7">
                                            <img src="{{ asset('/foto_profil/pasien/' . $p->foto_pasien) }}" alt="">
                                        </div>                                        
                                    </li>
                                    <br>
                                    <li>
                                        <div class="row container">
                                            <input type="file" name="foto_pasien">
                                        </div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <span>
                            <i class="fas fa-check"></i>&nbsp;
                        </span>    
                        <span class="text">Simpan</span>
                    </button>
                    <a href={{ route('profil_pasien', $pasien->id) }} class="btn btn-secondary btn-sm">
                        <span>
                            <i class="fas fa-times"></i>&nbsp;
                        </span>    
                        <span class="text">Batal</span>
                    </a>
                    </form>
                    @else
                    <form method="POST" enctype="multipart/form-data" action={{ route('pasien_update_profil', $pasien->id) }}>
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $kp->nama_kel_pasien }}" required>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Tanggal lahir</label>
                                        <input type="date" name="tgl_lhr" class="form-control" value="{{ $kp->tgl_lhr_kel_pasien }}" required>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Tempat lahir</label>
                                        <input type="text" name="tempat_lhr" class="form-control" value="{{ $kp->tempat_lhr_kel_pasien }}" required>
                                    </li>
                                    
                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" value="{{ $kp->alamat_kel_pasien }}" required>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">No. Hp</label>
                                        <input type="text" name="no_hp" class="form-control" value="{{ $kp->no_hp_kel_pasien }}" required>
                                        
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Jenis Kelamin</label>
                                        <select class="form-control" name="jk" id="jk">
                                            <option value="{{ $kp->jk_kel_pasien }}">{{ $kp->jk_kel_pasien }}</option>
                                            @if($kp->jk_kel_pasien == "Laki-laki")
                                            <option value="Perempuan">Perempuan</option>
                                            @elseif($kp->jk_kel_pasien == "Perempuan")
                                            <option value="Laki-laki">Laki-laki</option>
                                            @else
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                            @endif
                                        </select>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Foto Profil</label>
                                        <div class="image-col col-md-7">
                                            <img src="{{ asset('/foto_profil/keluarga_pasien/' . $kp->foto_kel_pasien) }}" alt="">
                                        </div>                                        
                                    </li>
                                    <br>
                                    <li>
                                        <div class="row container">
                                            <input type="file" name="foto_pasien">
                                        </div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <span>
                            <i class="fas fa-check"></i>&nbsp;
                        </span>    
                        <span class="text">Simpan</span>
                    </button>
                    <a href={{ route('profil_pasien', $kp->user_id) }} class="btn btn-secondary btn-sm">
                        <span>
                            <i class="fas fa-times"></i>&nbsp;
                        </span>    
                        <span class="text">Batal</span>
                    </a>
                    </form>
                    @endif
                </div>                    
            </div>
        </div>
    </div>
</div>
@endsection