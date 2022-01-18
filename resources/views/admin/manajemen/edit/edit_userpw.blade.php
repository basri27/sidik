@extends('layouts.back')

@section('title', 'Ubah Username dan Password')

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

@section('subhead', 'Ubah Username dan Password')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    <form method="POST" action={{ route('adm_update_userpw', $admins->id) }}>
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <ul>
                                        <li>
                                            <label class="font-weight-bold text-primary">Username:</label>
                                            <input type="text" name="username" class="form-control" value="{{ $admins->username }}">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Password Lama:</label>
                                        <input id="password-lama" type="password" name="password" class="form-control">
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Password Baru:</label>
                                        <input id="password-baru" type="password" name="password" class="form-control">
                                        <input type="checkbox" class="form-control-input" onclick="showPassword()"> Tampilkan Password
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                        <span>
                            <i class="fas fa-check"></i>
                        </span>    
                        <span class="text">Simpan</span>
                    </button>&nbsp;
                    <a href="{{ route('adm_profil', $admins->id) }}" class="btn btn-secondary btn-icon-split btn-sm">
                        <span>
                            <i class="fas fa-times"></i>
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
        var x = document.getElementById('password-lama', 'password-baru');
        if (x.type === "password") {
            x.type = "text";
        }
        else {
            x.type = "password";
        }
    }
</script>
@endsection