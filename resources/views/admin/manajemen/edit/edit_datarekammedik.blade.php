@extends('layouts.back')

@section('title', 'Data Rekam Medik')

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

@section('subhead', 'Data Rekam Medik')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('kirim_datarekammedik', $pasien->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Tanggal</label> 
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::now()->format('d F Y') }}" disabled>                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Waktu</label>
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::now()->toTimeString() }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $pasien->nama }}" disabled>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Tempat lahir</label>
                                        <input type="text" name="tempat_lhr" class="form-control" value="{{ $pasien->tempat_lhr }}" disabled>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                        <input type="date" name="tgl_lhr" class="form-control" value="{{ $pasien->tgl_lhr }}" disabled>
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
                                        <input type="text" name="no_hp" class="form-control" value="{{ $pasien->no_hp }}" disabled>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" value="{{ $pasien->alamat }}" disabled>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                        <input type="text" name="jk" class="form-control" value="{{ $pasien->jk }}" disabled>
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
                                            <label class="font-weight-bold text-primary">Kategori</label>
                                            <input type="text" name="category_id" class="form-control" value="{{ $pasien->category->nama }}" disabled>
                                        </li>
                                        @if ($pasien->category_id == '1' or $pasien->category_id == '3')
                                        <li>
                                            <label class="font-weight-bold text-primary" id="label_f">Fakultas</label>
                                            <input type="text" name="fakulta_id" class="form-control" value="{{ $pasien->fakulta->nama }}" disabled>
                                        </li>
                                        <li>
                                            <label class="font-weight-bold text-primary" id="label_p">Program Studi</label>
                                            <input type="text" name="prodi_id" class="form-control" value="{{ $pasien->prodi->nama }}" disabled>
                                        </li>
                                        @elseif ($pasien->category_id == '2')
                                        <li>
                                            <label class="font-weight-bold text-primary" id="label_f">Fakultas</label>
                                            <input type="text" name="fakulta_id" class="form-control" value="{{ $pasien->fakulta->nama }}" disabled>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>                                    
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <ul>
                                        <li>
                                            <label class="font-weight-bold text-primary" id="label_f">Suhu</label>
                                            <input type="text" name="suhu" class="form-control">
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
                                            <label class="font-weight-bold text-primary" id="label_f">Tensi</label>
                                            <input type="text" name="tensi" class="form-control">
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
                                            <label class="font-weight-bold text-primary" id="label_f">Tenaga Kesehatan</label>
                                            <select name="nakes_id" class="form-control">
                                                <option value="">Pilih Tenaga Kesehatan</option>
                                                @foreach($nakes as $n)
                                                <option value="{{ $n->id }}">{{ $n->nama }}</option>
                                                @endforeach
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
                    <a href="{{ route('adm_man_datarekammedik') }}" class="btn btn-secondary btn-icon-split btn-sm">
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