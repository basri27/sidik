@extends('layouts.back')

@section('title', 'Profil Admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
@endsection

@section('menu')
@include('layouts.nav_admin')
@endsection

@section('subhead', 'Profil Admin')

@section('foto')
@include('layouts.foto_profil_admin')
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
                <div class="image-col col-md-2">
                    <img src="{{ asset('/foto_profil/admin/' . $admin->foto_admin) }}" alt=""><br><br>
                    @if($admin->foto_admin != 'default.jpg')
                    <form method="POST" action={{ route('adm_reset_foto', $admin->user_id) }}>
                    @method('PATCH')
                    @csrf
                        <button type="submit" class="btn btn-sm btn-warning" href="#"><i class="fas fa-trash"></i>&ensp;Hapus foto</button>
                    </form>
                    @endif
                </div>
                <div class="detail-col col-md-8">
                    <h2 class="font-weight-bold">{{ $admin->nama_admin }}</h2>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Tanggal Lahir: {{ \Carbon\Carbon::parse($admin->tgl_lhr_admin)->format('d F Y') }}</li>
                                    <li>Tempat Lahir: {{ $admin->tempat_lhr_admin }}</li>
                                    <li>Alamat: {{ $admin->alamat_admin }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Umur: {{ $age }} tahun</li>
                                    <li>Phone: <span class="text-primary">{{ $admin->no_hp_admin}}</span></li>
                                    <li>Jenis Kelamin: {{ $admin->jk_admin }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('adm_edit_profil', $admin->user_id) }}" class="btn btn-primary btn-sm">
                        <span>
                            <i class="fas fa-edit"></i>
                        </span>    
                        <span class="text">Ubah profil</span>
                    </a>&nbsp;
                    <!-- <a href="{{ route('adm_edit_userpw', $admin->user_id) }}" class="btn btn-success btn-sm">
                        <span>
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Ubah username dan password</span>    
                    </a> -->
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
            <form method="POST" action="{{ route('adm_update_username', $admin->user_id) }}">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="info-list">
                            <ul>
                                <li>
                                    <label class="font-weight-bold text-primary">Username:</label>
                                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ $admin->user->username }}" required>
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
            <form method="POST" action="{{ route('adm_update_password', $admin->user_id) }}">
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
                                    <input id="password-baru" type="password" name="password" class="form-control" required>
                                    <!-- <div class="invalid-feedback" role="alert">
                                        @error('password')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div> -->
                                </li>
                            </ul>
                                
                        </div>
                    </div>
                    <div class="col-md-12" id="password-confirm" >
                        <div class="info-list">
                            <ul>
                                <li>
                                    <label class="font-weight-bold text-primary">Konfirmasi Password Baru:</label>
                                    <input id="password-baru-confirm" type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" required>
                                    <div class="invalid-feedback" role="alert">
                                        @error('password')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </div>
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