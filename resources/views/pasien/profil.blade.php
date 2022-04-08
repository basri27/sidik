@extends('layouts.back')

@section('title', 'Profil Pasien')

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

@section('subhead', 'Profil Pasien')

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
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="card shadow mb-4">         
        <div class="card-body">        
            <div class="about-row row">
                <div class="col-md-2">
                    @if ($p != null)
                    <img src="{{ asset('/foto_profil/pasien/' . $p->foto_pasien) }}" alt=""><br><br>
                    @else
                    <img src="{{ asset('/foto_profil/keluarga_pasien/' . $kp->foto_kel_pasien) }}" alt=""><br><br>
                    @endif
                </div>
                <div class="detail-col col-md-10">
                    <h3 class="font-weight-bold">
                        @if ($p != null)
                        {{ $p->nama_pasien }}
                        @else
                        {{ $kp->nama_kel_pasien }}
                        @endif
                        <br>
                        <small class="font-weight-bold">
                            @if ($p != null)
                                ( {{ $p->category->nama_kategori}}
                                @if ($p->category_id == 1)
                                    {{$dosen->fakulta->nama_fakultas}}
                                @elseif ($p->category_id == 2)
                                    {{$kary->bagian_kary}}
                                @elseif ($p->category_id == 3)
                                    {{$mhs->fakulta->nama_fakultas}} - {{$mhs->prodi->nama_prodi}}
                                @elseif ($p->category_id == 5)
                                    - {{$bpjs->no_bpjs}}
                                @endif)
                            @else
                                ( {{ $kp->kategori_kel_pasien }} )
                            @endif

                        </small>
                    </h3>
                    <div class="row">
                        @if ($p != null)
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Tanggal Lahir: <span class="font-weight-bold">{{ \Carbon\Carbon::parse($p->tgl_lhr_pasien)->format('d F Y') }}</span></li>
                                    <li>Tempat Lahir: <span class="font-weight-bold">{{ $p->tempat_lhr_pasien }}</span></li>
                                    <li>Alamat: <span class="font-weight-bold">{{ $p->alamat_pasien }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Umur: <span class="font-weight-bold text-dark">{{ \Carbon\Carbon::parse($p->tgl_lhr_pasien)->age }} tahun</span></li>
                                    <li>Phone: <span class="font-weight-boldl text-primary">{{ $p->no_hp_pasien}}</span></li>
                                    <li>Jenis Kelamin: <span class="font-weight-bold text-dark">{{ $p->jk_pasien }}</span></li>
                                </ul>
                            </div>
                        </div>
                        @else
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Tanggal Lahir: <span class="font-weight-bold">{{ \Carbon\Carbon::parse($kp->tgl_lhr_kel_pasien)->format('d F Y') }}</span></li>
                                    <li>Tempat Lahir: <span class="font-weight-bold">{{ $kp->tempat_lhr_kel_pasien }}</span></li>
                                    <li>Alamat: <span class="font-weight-bold">{{ $kp->alamat_kel_pasien }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Umur: <span class="font-weight-bold text-dark">{{ \Carbon\Carbon::parse($kp->tgl_lhr_kel_pasien)->age }} tahun</span></li>
                                    <li>Phone: <span class="font-weight-boldl text-primary">{{ $kp->no_hp_kel_pasien}}</span></li>
                                    <li>Jenis Kelamin: <span class="font-weight-bold text-dark">{{ $kp->jk_kel_pasien }}</span></li>
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                    <a href="{{ route('pasien_edit_profil', $pasien->id) }}" class="btn btn-primary btn-sm">
                        <span>
                            <i class="fas fa-edit"></i>
                        </span>    
                        <span class="text">Ubah profil</span>
                    </a>&nbsp;
                    <a href="#edit-username" class="btn btn-success btn-sm" data-toggle="modal">
                        <span>
                            <i class="fas fa-edit"></i>
                        </span>
                        Ubah username
                    </a>&nbsp;
                    <a href="#edit-password" class="btn btn-danger btn-sm" data-toggle="modal">
                        <span>
                            <i class="fas fa-edit"></i>    
                        </span>
                        Ubah password
                    </a>
                </div>                    
            </div>
        </div>
    </div>
</div>
<div id="edit-username" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title font-weight-bold float-left">Ubah username</h4>
            </div>
            <form method="POST" action="{{ route('pasien_update_username', $pasien->id) }}">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="info-list">
                            <ul>
                                <li>
                                    <label class="font-weight-bold text-primary">Username:</label>
                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ $pasien->username }}" required>
                                    <div class="invalid-feedback">
                                        @error('username')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="info-list">
                            <ul>
                                <li>
                                    <label class="font-weight-bold text-primary">Password:</label>
                                    <input id="password" type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" autocomplete="current_password" required>
                                    <div class="invalid-feedback" role="alert">
                                        @error('current_password')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </li>
                            </ul>
                                
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="checkbox" class="form-control-input" onclick="showPassword2()"> Tampilkan password
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
<div id="edit-password" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title font-weight-bold float-left">Ubah password</h4>
            </div>
            <form method="POST" action="{{ route('pasien_update_password', $pasien->id) }}">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="info-list">
                            <ul>
                                <li>
                                    <label class="font-weight-bold text-primary">Password Lama:</label>
                                    <input id="password-lama" type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" autocomplete="current_password" required>
                                    <div class="invalid-feedback" role="alert">
                                        @error('current_password')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </li>
                            </ul>
                                
                        </div>
                    </div>
                    <div class="col-md-12" id="new-password" >
                        <div class="info-list">
                            <ul>
                                <li>
                                    <label class="font-weight-bold text-primary">Password Baru:</label>
                                    <input id="password-baru" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                    <div class="invalid-feedback" role="alert">
                                        @error('password')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </li>
                            </ul>
                                
                        </div>
                    </div>
                    <div class="col-md-12" id="password-confirm" >
                        <div class="info-list">
                            <ul>
                                <li>
                                    <label class="font-weight-bold text-primary">Konfirmasi Password Baru:</label>
                                    <input id="password-baru-confirm" type="password" name="password_confirmation" class="form-control" required>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="checkbox" class="form-control-input" onclick="showPassword()"> Tampilkan password
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
<script>
    function showPassword() {
        var x = document.getElementById('password-lama');
        var y = document.getElementById('password-baru');
        var z = document.getElementById('password-baru-confirm');
        if (x.type == "password" || y.type == "password" || z.type == "password") {
            x.type = "text";
            y.type = "text";
            z.type = "text";
        }
        else if (x.type == "text" || y.type == "text" || z.type == "text") {
            x.type = "password";
            y.type = "password";
            z.type = "password";
        }
    }
    function showPassword2() {
        var p = document.getElementById('password');
        if (p.type == "password") {
            p.type = "text";
        }
        else if (p.type == "text") {
            p.type = "password";
        }
    }
</script>
@endsection