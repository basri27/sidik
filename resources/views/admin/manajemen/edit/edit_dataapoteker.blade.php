@extends('layouts.back')

@section('title', 'Ubah Data Apoteker')

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

@section('subhead', 'Ubah Data Apoteker')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('adm_man_dataapoteker_update', $apoteker->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $apoteker->nama }}">
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Tempat lahir</label>
                                        <input type="text" name="tempat_lhr" class="form-control" value="{{ $apoteker->tempat_lhr }}">
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                        <input type="date" name="tgl_lhr" class="form-control" value="{{ $apoteker->tgl_lhr }}">
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
                                        <label class="font-weight-bold text-primary">No. Hp</label>
                                        <input type="text" name="no_hp" class="form-control" value="{{ $apoteker->nohp }}">
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" value="{{ $apoteker->alamat }}">
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                        <select class="form-control" name="jk" id="jk">
                                            <option value="{{ $apoteker->jk }}" selected>{{ $apoteker->jk }}</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                        <span>
                            <i class="fas fa-check"></i>
                        </span>    
                        <span class="text">Simpan</span>
                    </button>&nbsp;
                    <a href="{{ route('adm_man_dataapoteker') }}" class="btn btn-secondary btn-icon-split btn-sm">
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