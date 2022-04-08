@extends('layouts.back')

@section('title', 'Ubah Profil')

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

@section('subhead', 'Ubah Profil')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    <form method="POST" enctype="multipart/form-data" action={{ route('adm_update_profil', $admins->id) }}>
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                    <ul>
                                        <li>
                                            <label class="font-weight-bold text-primary" for="">Nama</label>
                                            <input type="text" name="nama" class="form-control" value="{{ $admins->nama_admin }}">
                                        </li>
                                        <li>
                                            <label class="font-weight-bold text-primary" for="">Tanggal lahir</label>
                                            <input type="date" name="tgl_lhr" class="form-control" value="{{ $admins->tgl_lhr_admin }}">
                                        </li>
                                        <li>
                                            <label class="font-weight-bold text-primary" for="">Tempat lahir</label>
                                            <input type="text" name="tempat_lhr" class="form-control" value="{{ $admins->tempat_lhr_admin }}">
                                        </li>
                                        <li>
                                            <label class="font-weight-bold text-primary" for="">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" value="{{ $admins->alamat_admin }}">
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
                                            <label class="font-weight-bold text-primary" for="">Umur</label>
                                            <input type="text" class="form-control" value="{{ $age }}" disabled>
                                        </li>
                                        <li>
                                            <label class="font-weight-bold text-primary" for="">No. Hp</label>
                                            <input type="text" name="no_hp" class="form-control" value="{{ $admins->no_hp_admin }}">
                                        </li>
                                        <li>
                                            <label class="font-weight-bold text-primary" for="">Jenis Kelamin</label>
                                            <select class="form-control" name="jk" id="jk">
                                                <option value="{{ $admins->jk_admin }}">{{ $admins->jk_admin }}</option>
                                                @if($admins->jk_admin == "Laki-laki")
                                                <option value="Perempuan">Perempuan</option>
                                                @elseif($admins->jk_admin == "Perempuan")
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
                                                    <img src="{{ asset('/foto_profil/admin/' . $admins->foto_admin) }}" alt="">
                                                </div>

                                            </li>
                                            <br>
                                            <li>
                                                <div class="row container">
                                                    <input type="file" name="foto_admin" accept="image/*">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">
                            <span>
                                <i class="fas fa-check"></i>
                            </span>    
                            <span class="text">Simpan</span>
                        </button>&nbsp;
                        <a href={{ route('adm_profil', $admins->id) }} class="btn btn-secondary btn-sm">
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
@endsection