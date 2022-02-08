@extends('layouts.back')

@section('title', 'Kirim Data Rekam Medik')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
@endsection

@section('menu')
<li class="nav-item">
    <a class="nav-link" href={{ route('nakes_dashboard', Auth::user()->id) }}>
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href={{ route('nakes_profil', Auth::user()->id) }}>
        <i class="fas fa-user"></i>
        <span>Profil</span>
    </a>
</li>
@endsection

@section('subhead', 'Kirim Data Rekam Medik')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('nakes_kirim_datarekammedik', $notif->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Tanggal</label> 
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($rekammedik->rekammedik_created_at)->format('d F Y') }}" readonly>                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Waktu</label>
                                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($rekammedik->rekammedik_created_at)->toTimeString() }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <label class="font-weight-bold text-primary">Biodata Pasien&nbsp;
                                <a href="#collapse-Bio" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </label>
                            <div class="card shadow mb-4 collapse" id="collapse-Bio">
                                <div class="row p-3">
                                    <div class="col-md-4 col-12">
                                        <div class="info-list">
                                            <div class="form-group">
                                            <ul>
                                                <li>
                                                    <label class="font-weight-bold text-primary">Nama</label>
                                                    <input type="text" name="nama" class="form-control" value="{{ $rekammedik->pasien->nama_pasien }}" readonly>
                                                </li>
                                                <li>
                                                    <label class="font-weight-bold text-primary">Tempat lahir</label>
                                                    <input type="text" name="tempat_lhr" class="form-control" value="{{ $rekammedik->pasien->tempat_lhr_pasien }}" readonly>
                                                </li>
                                                <li>
                                                    <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                                    <input type="date" name="tgl_lhr" class="form-control" value="{{ $rekammedik->pasien->tgl_lhr_pasien }}" readonly>
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
                                                    <input type="text" name="no_hp" class="form-control" value="{{ $rekammedik->pasien->no_hp_pasien }}" readonly>
                                                </li>
                                                <li>
                                                    <label class="font-weight-bold text-primary">Alamat</label>
                                                    <input type="text" name="alamat" class="form-control" value="{{ $rekammedik->pasien->alamat_pasien }}" readonly>
                                                </li>
                                                <li>
                                                    <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                                    <input type="text" name="jk" class="form-control" value="{{ $rekammedik->pasien->jk_pasien }}" readonly>
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
                                                        <input type="text" name="category_id" class="form-control" value="{{ $rekammedik->pasien->category->nama_kategori }}" readonly>
                                                    </li>
                                                    @if ($rekammedik->pasien->category_id == '1' or $rekammedik->pasien->category_id == '3')
                                                    <li>
                                                        <label class="font-weight-bold text-primary" id="label_f">Fakultas</label>
                                                        <input type="text" name="fakulta_id" class="form-control" value="{{ $rekammedik->pasien->fakulta->nama_fakultas }}" readonly>
                                                    </li>
                                                    <li>
                                                        <label class="font-weight-bold text-primary" id="label_p">Program Studi</label>
                                                        <input type="text" name="prodi_id" class="form-control" value="{{ $rekammedik->pasien->prodi->nama_prodi }}" readonly>
                                                    </li>
                                                    @elseif ($rekammedik->pasien->category_id == '2')
                                                    <li>
                                                        <label class="font-weight-bold text-primary" id="label_f">Fakultas</label>
                                                        <input type="text" name="fakulta_id" class="form-control" value="{{ $rekammedik->pasien->fakulta->nama_fakultas }}" readonly>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>                                    
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Suhu</label>
                                    <input type="number" name="suhu" class="form-control" value="{{ $rekammedik->suhu }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Tensi</label>
                                    <input type="text" name="tensi" class="form-control" value="{{ $rekammedik->tensi }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Keluhan</label>
                                    <textarea class="form-control" name="keluhan" rows="1" placeholder="Keluhan">{{ $rekammedik->keluhan }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Diagnosa</label>
                                    <select class="form-control" name="diagnosa">
                                        <option value="">Pilih Diagnosa</option>
                                        @foreach($diagnosa as $d)
                                        <option value="{{ $d->id }}">{{ $d->kode_diagnosa }} - {{ $d->nama_diagnosa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Obat</label>
                                    <select class="form-control" name="obat">
                                        <option value="">Pilih Obat</option>
                                        @foreach($obat as $o)
                                        <option value="{{ $o->id }}">{{ $o->nama_obat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" rows="1" placeholder="Keterangan"></textarea>
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
                    <a href="{{ route('nakes_dashboard', Auth::user()->id) }}" class="btn btn-secondary btn-icon-split btn-sm">
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