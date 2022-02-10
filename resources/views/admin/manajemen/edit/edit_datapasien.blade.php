@extends('layouts.back')

@section('title', 'Ubah Data Pasien')

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

@section('subhead', 'Ubah Data Pasien')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('adm_man_datapasien_update', $pasiens->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $pasiens->nama_pasien }}">
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Tempat lahir</label>
                                        <input type="text" name="tempat_lhr" class="form-control" value="{{ $pasiens->tempat_lhr_pasien }}">
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                        <input type="date" name="tgl_lhr" class="form-control" value="{{ $pasiens->tgl_lhr_pasien }}">
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
                                        <input type="text" name="no_hp" class="form-control" value="{{ $pasiens->no_hp_pasien }}">
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" value="{{ $pasiens->alamat_pasien }}">
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                        <select class="form-control" name="jk" id="jk">
                                            <option value="{{ $pasiens->jk_pasien }}" selected>{{ $pasiens->jk_pasien }}</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
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
                                        <label class="font-weight-bold text-primary">Kategori</label>
                                        <select class="form-control" name="category_id" onChange="kategori(this)">
                                            <option value="{{ $pasiens->category_id }}" selected>{{ $pasiens->category->nama_kategori }}</option>
                                            @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    @if ($pasiens->category_id == '1' or $pasiens->category_id == '3')
                                    <li>
                                        <label class="font-weight-bold text-primary" id="label_f">Fakultas</label>
                                        <select class="form-control" name="fakulta_id" id="fakulta_id">
                                            <option value="{{ $pasiens->fakulta_id }}" selected>{{ $pasiens->fakulta->nama_fakultas }}</option>
                                            @foreach ($fakultas as $fak)
                                            <option value="{{ $fak->id }}">{{ $fak->nama_fakultas }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" id="label_p">Program Studi</label>
                                        <select class="form-control" name="prodi_id" id="prodi_id">
                                            <option value="{{ $pasiens->prodi_id }}" selected>{{ $pasiens->prodi->nama_prodi }}</option>
                                            @foreach ($prodis as $prodi)
                                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    @elseif ($pasiens->category_id == '2')
                                    <li>
                                        <label class="font-weight-bold text-primary" id="label_f">Fakultas</label>
                                        <select class="form-control" name="fakulta_id" id="fakulta_id">
                                            <option value="{{ $pasiens->fakulta_id }}" selected>{{ $pasiens->fakulta->nama_fakultas }}</option>
                                            @foreach ($fakultas as $fak)
                                            <option value="{{ $fak->id }}">{{ $fak->nama_fakultas }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" id="label_p">Program Studi</label>
                                        <select class="form-control" name="prodi_id" id="prodi_id" disabled>
                                            <option value="{{ $pasiens->prodi_id }}" selected>{{ $pasiens->prodi->nama_prodi }}</option>
                                            @foreach ($prodis as $prodi)
                                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    @else
                                    <li>
                                        <label class="font-weight-bold text-primary" id="label_f">Fakultas</label>
                                        <select class="form-control" name="fakulta_id" id="fakulta_id" disabled>
                                            <option value="{{ $pasiens->fakulta_id }}" selected>{{ $pasiens->fakulta->nama_fakultas }}</option>
                                            @foreach ($fakultas as $fak)
                                            <option value="{{ $fak->id }}">{{ $fak->nama_fakultas }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" id="label_p">Program Studi</label>
                                        <select class="form-control" name="prodi_id" id="prodi_id" disabled>
                                            <option value="{{ $pasiens->prodi_id }}" selected>{{ $pasiens->prodi->nama_prodi }}</option>
                                            @foreach ($prodis as $prodi)
                                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                    @endif
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
                    <a href="{{ route('adm_man_datapasien') }}" class="btn btn-secondary btn-icon-split btn-sm">
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
    function kategori(select)
    {
        var f = document.getElementById('fakulta_id');
        var p = document.getElementById('prodi_id');
        var lf = document.getElementById('label_f');
        var lp = document.getElementById('label_p');

        if(select.value == '4') {
            f.disabled = true;
            f.value = '1';
            p.disabled = true;
            p.value = '1';
        }
        else if (select.value == '2') {
            f.disabled = false;
            p.disabled = true;
            p.value = '1';
        }
        else {
            f.disabled = false;
            p.disabled = false;
        }
    }
</script>
@endsection