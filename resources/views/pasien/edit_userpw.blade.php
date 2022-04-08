@extends('layouts.back')

@section('title', 'Edit Username dan Password Pasien')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
@endsection

@section('menu')
    <li class="nav-item active">
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
    <li class="nav-item">
        <a class="nav-link" href="{{ route('keluarga_pasien', $pasien->user_id) }}">
            <i class="fas fa-users"></i>
            <span>Keluarga</span>
        </a>
    </li>
@endsection

@section('subhead', 'Edit Username dan Password Pasien')

@section('foto')
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/pasien/' . $pasien->pasien->foto_pasien) }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    <form method="POST" action={{ route('pasien_update_userpw', $pasien->id) }}>
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-md-3 col-12">
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
                        <div class="col-md-3 col-12">
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
                        <div class="col-md-3 col-12">
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
                        <div class="col-md-3 col-12">
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Konfirmasi Password Baru:</label>
                                        <input id="password-baru-confirm" type="password" name="password_confirmation" class="form-control" required>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="checkbox" class="form-control-input" onclick="showPassword()"> Tampilkan Password
                        </div>
                        <div class="col-md-3">
                            <input type="checkbox" class="form-control-input" onclick="updateOnlyUsername()"> Hanya ganti username
                        </div>
                    </div><br>
                    <button type="submit" class="btn btn-success btn-sm">
                        <span>
                            <i class="fas fa-check"></i>&nbsp;
                        </span>    
                        <span class="text">Simpan</span>
                    </button>&nbsp;
                    <a href="{{ route('profil_pasien', $pasien->id) }}" class="btn btn-secondary btn-sm">
                        <span>
                            <i class="fas fa-times"></i>&nbsp;
                        </span>    
                        <span class="text">Batal</span>
                    </a>
                    </form>
                </div>                    
            </div>
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
        else {
            x.type = "password";
            y.type = "password";
            z.type = "password";
        }
    }

    function updateOnlyUsername() {
        var y = document.getElementById('password-baru');
        var z = document.getElementById('password-baru-confirm');
        
        if(y.disabled == false) {
            y.disabled = true;
            z.disabled = true;
        }
        else {
            y.disabled = false;
            z.disabled = false;
        }
        
    }
</script>
@endsection