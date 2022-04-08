@extends('layouts.back')

@section('title', 'Kirim Data Rekam Medik')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/dashboard/select2.min.css') }}">
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

@section('foto')
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/nakes/' . $rekammedik->tenkesehatan->foto_tenkes) }}">
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
                    <div class="detail-col col-md-12">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('nakes_kirim_datarekammedik', $notif->id) }}">
                        @csrf
                        <!-- <div class="row">
                            <div class="col-md-2 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Resep obat</label>
                                        <a href="#addResep" class="btn btn-sm btn-light" data-toggle="modal"><i class="fas fa-plus-circle"></i>&nbsp;Resep obat</a href="#">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Daftar resep obat</label>
                                        <a href="#viewResep" class="btn btn-sm btn-light" data-toggle="modal"><i class="fas fa-eye"></i>&nbsp;Lihat</a href="#">
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
                                        <div class="container row">
                                            <input type="number" step="0.01" name="suhu" class="form-control col-7" value="{{ $rekammedik->suhu }}">
                                            &nbsp;<p class="form-control col-4" readonly>&#8451;</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Tensi</label>
                                        <div class="container row">
                                            <input type="text" name="tensi" class="form-control col-6" value="{{ $rekammedik->tensi }}">
                                            &nbsp;<p class="form-control col-5" readonly>mmHg</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Keluhan</label>
                                        <textarea class="form-control" name="keluhan" rows="1" placeholder="Keluhan" value="{{ old('keluhan') }}">{{ $rekammedik->keluhan }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Diagnosa</label>
                                        <select class="form-control" name="diagnosa">
                                            <option value="">Pilih diagnosa</option>
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
                                        <label class="font-weight-bold text-primary">Keterangan</label>
                                        <textarea class="form-control" name="keterangan" rows="1" placeholder="Keterangan" value="{{ old('keterangan') }}"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            
                        </div> -->
                        <div class="table-responsive">
                        <table class="table table-borderless">
                            <tr>
                                <td><img src="{{ asset('img/logo-ulm1.png') }}"></td>
                                <td class="text-center">
                                    <h6>KLINIK PRATAMA LAMBUNG MANGKURAT MEDICAL CENTER (LMMC)</h6>
                                    <h6>UNIVERSITAS LAMBUNG MANGKURAT</h6>
                                </td>
                                <td class="float-right"><img src="{{ asset('img/logo-klinik1.png') }}"></td>
                            </tr>
                        </table>
                        <center><h5><u>KARTU RAWAT JALAN</u></h5></center>
                        <table class="font-weight-bold">
                            @if ($rekammedik->pasien_id != null)
                            <tr>
                                <td>No. Indeks</td>
                                <td>&emsp;: {{ $rekammedik->pasien->id }}</td>
                            </tr>
                            <tr style="padding: 2px;">
                                <td>Nama</td>
                                <td>&emsp;: {{ $rekammedik->pasien->nama_pasien }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>&emsp;: {{ $rekammedik->pasien->jk_pasien }}</td>
                            </tr>
                            <tr>
                                <td>TTL</td>
                                <td>&emsp;: {{ $rekammedik->pasien->tempat_lhr_pasien }}, {{ \Carbon\Carbon::parse($rekammedik->pasien->tgl_lhr_pasien)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <?php
                                    $dosen = \App\Models\Dosen::where('pasien_id', $rekammedik->pasien->id)->first();
                                    $mhs = \App\Models\Mahasiswa::where('pasien_id', $rekammedik->pasien->id)->first();
                                    $kary = \App\Models\Karyawan::where('pasien_id', $rekammedik->pasien->id)->first();
                                    $bpjs = \App\Models\Bpjs::where('pasien_id', $rekammedik->pasien->id)->first();
                                ?>
                                <td>Kategori</td>
                                <td>
                                    &emsp;: {{ $rekammedik->pasien->category->nama_kategori }}
                                    @if ($rekammedik->pasien->category_id == 1)
                                    {{ $dosen->fakulta->nama_fakultas }}
                                    @elseif ($rekammedik->pasien->category_id == 2)
                                    {{ $kary->fakulta->nama_fakultas }}
                                    @elseif ($rekammedik->pasien->category_id == 3)
                                    ({{ $mhs->fakulta->nama_fakultas }} - {{ $mhs->prodi->nama_prodi }})
                                    @elseif ($rekammedik->pasien->category_id == 5)
                                    ({{ $bpjs->no_bpjs }})
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>&emsp;: {{ $rekammedik->pasien->alamat_pasien }}</td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>&emsp;: {{ $rekammedik->pasien->no_hp_pasien }}</td>
                            </tr></b>
                            @else
                            <tr>
                                <td>No. Indeks</td>
                                <td>&emsp;: {{ $rekammedik->keluarga_pasien->id }}</td>
                            </tr>
                            <tr style="padding: 2px;">
                                <td>Nama</td>
                                <td>&emsp;: {{ $rekammedik->keluarga_pasien->nama_kel_pasien }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>&emsp;: {{ $rekammedik->keluarga_pasien->jk_kel_pasien }}</td>
                            </tr>
                            <tr>
                                <td>TTL</td>
                                <td>&emsp;: {{ $rekammedik->keluarga_pasien->tempat_lhr_kel_pasien }}, {{ \Carbon\Carbon::parse($rekammedik->keluarga_pasien->tgl_lhr_kel_pasien)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <?php
                                    $dosen = \App\Models\Dosen::where('pasien_id', $rekammedik->keluarga_pasien->pasien->id)->first();
                                    $kary = \App\Models\Karyawan::where('pasien_id', $rekammedik->keluarga_pasien->pasien->id)->first();
                                ?>
                                <td>Kategori</td>
                                <td>
                                    &emsp;: {{ $rekammedik->keluarga_pasien->kategori_kel_pasien }} dari {{ $rekammedik->keluarga_pasien->pasien->nama_pasien }} ({{ $rekammedik->keluarga_pasien->pasien->category->nama_kategori }}
                                    @if ($rekammedik->keluarga_pasien->pasien->category_id == 1)
                                    {{ $dosen->fakulta->nama_fakultas }})
                                    @elseif ($rekammedik->keluarga_pasien->pasien->category_id == 2)
                                    {{ $kary->fakulta->nama_fakultas }})
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>&emsp;: {{ $rekammedik->keluarga_pasien->alamat_kel_pasien }}</td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>&emsp;: {{ $rekammedik->keluarga_pasien->no_hp_kel_pasien }}</td>
                            </tr></b>
                            @endif
                        </table>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>TANGGAL</th>
                                    <th>PEMERIKSAAN/DIAGNOSA</th>
                                    <th>KETERANGAN</th>
                                    <th>TENAGA KESEHATAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>{{ \Carbon\Carbon::parse(\Carbon\Carbon::now())->format('d-m-Y') }}</b></td>
                                    <td>
                                        <b>Suhu: <br><input class="form-control-sm col-8" type="number" min="0" max="40" step="0.01" name="suhu" value="{{ $rekammedik->suhu }}"> <small>&#8451;</small> <br>
                                        Tensi: <br><input class="form-control-sm col-4" type="number" name="tensi1" min="0" max="300" value="{{ $rekammedik->siastol }}">&nbsp;/&nbsp;<input class="form-control-sm col-4" type="number" name="tensi2" min="0" max="300" value="{{ $rekammedik->diastol }}"> <small>mmHg</small><br>
                                        Pemeriksaan: <br><textarea class="form-control-sm col-12" name="keluhan" placeholder="Keluhan dan lain-lain">{{ $rekammedik->keluhan }}</textarea> <br>
                                        Diagnosa: <br>
                                        <select class="form-control-sm col-12" name="diagnosa">
                                            @if ($rekammedik->diagnosa_id != null)
                                            <option value="{{ $rekammedik->diagnosa_id }}">{{ $rekammedik->diagnosa->nama_diagnosa }}</option>
                                            @else
                                            <option>Pilih Diagnosa</option>
                                            @foreach($diagnosa as $d)
                                            <option value="{{ $d->id }}">{{ $d->nama_diagnosa }}</option>
                                            @endforeach
                                            @endif
                                        </select></b>
                                    </td>
                                    <td>
                                        <textarea class="form-control-sm col-12" name="keterangan" placeholder="Keterangan">{{ $rekammedik->keterangan }}</textarea>
                                    </td>
                                    <td>
                                        <b>{{ $rekammedik->tenkesehatan->nama_tenkes }}</b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                        <button type="submit" class="btn btn-success">Lanjut</button>&nbsp;
                        <a href="{{ route('nakes_dashboard', Auth::user()->id) }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <div id="addResep" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header bg-light">
                    <h4 class="modal-title font-weight-bold float-left">Tambah Resep Obat</h4>
                </div>
                <form method="POST" action={{ route('add_resep_obat', $notif->id) }}>
                    @csrf
                    <!-- body modal -->
                    <div class="modal-body">        
                        <input type="text" name="rekammedik_id" value={{ $rekammedik->id }} hidden>
                        <label class="font-weight-bold text-dark">Pilih obat:</label>
                        <select data-width="100%" class="form-control" id="obat_id" name="obat_id">
                            <option value="1">Pilih obat</option>
                            @foreach($obat as $o)
                            <option value={{ $o->id }}>{{ $o->nama_obat }}</option>
                            @endforeach
                        </select>
                        <label class="font-weight-bold text-dark">Resep:</label>
                        <div class="container row">
                            <input class="form-control col-2" type="number" name="resep" min="1">&nbsp;
                            <input class="form-control col-1" type="text" value="x" disabled>&nbsp;
                            <input class="form-control col-2" type="number" name="hari" min="1">&nbsp;
                            <input class="form-control col-2" type="text" value="Hari" disabled>
                        </div>
                        <label class="font-weight-bold text-dark">Takaran:</label>
                        <div class="container row">
                            <input class="form-control col-2" type="number" step="0.001" name="takaran" min="1">&nbsp;
                            <select class="form-control col-3" name="kuantitas">
                                <option value="tablet">Tablet</option>
                                <option value="kapsul">Kapsul</option>
                                <option value="tetes">Tetes</option>
                                <option value="miligram">Miligram</option>
                                <option value="mililiter">Mililiter</option>
                                <option value="sendok makan">Sendok makan (15 mL)</option>
                                <option value="sendok teh">Sendok teh (5 mL)</option>
                            </select>&nbsp;
                            <select class="form-control col-5" name="waktu">
                                <option value="sebelum makan">Sebelum makan</option>
                                <option value="sesudah makan">Sesudah makan</option>
                                <option value="di antara waktu makan">Di antara waktu makan</option>
                                <option value="saat tidur">Saat tidur</option>
                            </select>
                        </div>
                        <label class="font-weight-bold">Keterangan resep obat:</label>
                        <textarea class="form-control" name="keterangan_resep" placeholder="Keterangan resep obat"></textarea>
                    </div>
                    <!-- footer modal -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="viewResep" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header bg-light">
                    <h4 class="modal-title font-weight-bold float-left">Daftar Resep Obat</h4>
                </div>
                <!-- body modal -->
                <div class="modal-body">        
                    <table class="table table-borderless">
                        @foreach($resep as $rs)
                        <form method="POST" action={{ route('delete_resep_obat', [$rs->id, $notif->id]) }}>
                            @method('DELETE')
                            @csrf
                            <tr>
                                <td>{{ $rs->obat->nama_obat }} | {{ $rs->keterangan }}</td>
                                <td><button type="submit" class="btn border border-danger float-right" onclick()="return confirm(Anda yakin ingin menghapus resep obat ini?)"><i class="fas fa-trash"></i></button></td>
                            </tr>
                        </form>
                        @endforeach
                    </table>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/dashboard/select2.min.js') }}" defer></script>
    <script>
        $(document).ready(function () {
            $('#obat_id').select2()
        });
    </script>
@endsection