@extends('layouts.back')

@section('title', 'Manajemen Data Pasien')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/dashboard/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dashboard/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('menu')
@include('layouts.nav_admin')
@endsection

@section('subhead', 'Manajemen Data Pasien')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Data Pasien
                <!-- <a href="{{ route('adm_man_datapasien_tambah') }}" style="float: right; color: white;" class="btn btn-primary" type="button">Tambah</a> -->
                <a href="#addPasien" class="float-right btn btn-primary btn-sm" data-toggle="modal"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</a>
            </h4>
            <hr>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
                    <thead id="dataTable">
                        <tr>
                            <th>Index</th>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Kategori</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Username</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Index</th>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Kategori</th>
                            <th>Alamat</th>
                            <th>No. HP</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Hapus</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($pasiens as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>{{ $p->nama_pasien }}</td>
                            <td>{{ $p->tempat_lhr_pasien }}, {{ \Carbon\Carbon::parse($p->tgl_lhr_pasien)->format('d F Y') }}</td>
                            <td>
                                {{ $p->category->nama_kategori }}
                                @if ($p->category_id == 1)
                                    @foreach($dosen as $d)
                                        {{ ($d->pasien_id == $p->id) ? $d->fakulta->nama_fakultas : '' }}
                                    @endforeach
                                @elseif ($p->category_id == 2)
                                    @foreach($kary as $k)
                                        {{ ($k->pasien_id == $p->id) ? $k->fakulta->nama_fakultas : '' }}
                                    @endforeach
                                @elseif ($p->category_id == 3)
                                    @foreach($mhs as $m)
                                        {{ ($m->pasien_id == $p->id) ? $m->fakulta->nama_fakultas." - ".$m->prodi->nama_prodi : '' }}
                                    @endforeach
                                @elseif ($p->category_id == 5)
                                    @foreach($bpjs as $b)
                                        ({{ ($b->pasien_id == $p->id) ? $b->no_bpjs : '' }})
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $p->alamat_pasien }}</td>
                            <td>{{ $p->no_hp_pasien }}</td>
                            <td class="font-weight-bold text-primary">{{ $p->user->username }}</td>
                            <td>
                                <a href="{{ route('adm_man_datapasien_edit', $p->id) }}" class="btn btn-sm btn-success">Edit</a>
                            </td>
                            <td>
                                <a href="#deletePasien{{$p->id}}" class="btn btn-sm btn-danger" data-toggle="modal">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="addPasien" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title font-weight-bold float-left">Tambah Data Pasien</h4>
            </div>
            <?php
                $n=10;
                function getName($n) {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randomString = '';
                  
                    for ($i = 0; $i < $n; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }
                  
                    return $randomString;
                } 
            ?>
            <form action="{{ route('adm_man_datapasien_add') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="text" name="username" class="form-control" value="{{ getName($n) }}" hidden>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Tempat lahir</label>
                                    <input type="text" name="tempat_lhr" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                    <input type="date" name="tgl_lhr" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">No. Hp</label>
                                    <input type="text" name="no_hp" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                    <select class="form-control" name="jk" id="jk" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Kategori</label>
                                    <select data-width="100%" class="form-control" name="category_id" id="kategori" onchange="ktg(this)" required>
                                        <option>Pilih Kategori</option>
                                        @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-12"id="fklt">
                            <div class="info-list">
                                <div class="form-group" >
                                    <label class="font-weight-bold text-primary" id="label_f">Fakultas</label>
                                    <select data-width="100%" class="form-control" name="fakulta_id" id="fakulta_id" required>
                                        <option value="1">Pilih Fakultas</option>
                                        @foreach ($fakultas as $fak)
                                        <option value="{{ $fak->id }}">{{ $fak->nama_fakultas }}</option>
                                        @endforeach
                                    </select>    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12"id="no-bpjs" style="display: none;">
                            <div class="info-list">
                                <div class="form-group" >
                                    <label class="font-weight-bold text-primary">No. BPJS</label>
                                    <input type="text" name="no_bpjs" class="form-control" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12"id="prd">
                            <div class="info-list">
                                <div class="form-group" >
                                    <label class="font-weight-bold text-primary" id="label_p">Program Studi</label>
                                    <select data-width="100%" class="form-control text-center col-6" name="prodi_id" id="prodi_id" >
                                        <option value="1">Pilih Program Studi</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
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
@foreach($pasiens as $pasien)
<div id="deletePasien{{$pasien->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h4 class="modal-title font-weight-bold float-left">Hapus Data Pasien</h4>
            </div>
            <form action="{{ route('delete_datapasien', $pasien->id) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <h5 class="font-weight-bold">Anda yakin ingin menghapus data ini?</h5><hr>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $pasien->nama_pasien }}" readonly>
                                    <label class="font-weight-bold text-primary">Tempat lahir</label>
                                    <input type="text" name="tempat_lhr" class="form-control" value="{{ $pasien->tempat_lhr_pasien }}" readonly>
                                    <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                    <input type="date" name="tgl_lhr" class="form-control" value="{{ $pasien->tgl_lhr_pasien }}" readonly>
                                    <label class="font-weight-bold text-primary">Kategori</label>
                                    <input type="text" class="form-control" value="{{ $pasien->category->nama_kategori }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                    <label class="font-weight-bold text-primary">No. Hp</label>
                                    <input type="text" name="no_hp" class="form-control" value="{{ $pasien->no_hp_pasien }}" readonly>
                                    <label class="font-weight-bold text-primary">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="{{ $pasien->alamat_pasien }}" readonly>
                                    <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                    <input type="text" class="form-control" value="{{ $pasien->jk_pasien }}" readonly>
                                    @if($pasien->category_id != 4)
                                        <label class="font-weight-bold text-primary">Fakultas</label>
                                        @if($pasien->category_id == 1)
                                            @foreach($dosen as $d)
                                                @if($d->pasien_id == $pasien->id)
                                                    <input type="text" class="form-control" value="{{ $d->fakulta->nama_fakultas }}" readonly>
                                                @endif
                                            @endforeach
                                        @elseif($pasien->category_id == 2)
                                            @foreach($kary as $k)
                                                @if($k->pasien_id == $pasien->id)
                                                    <input type="text" class="form-control" value="{{ $k->fakulta->nama_fakultas }}" readonly>
                                                @endif
                                            @endforeach
                                        @elseif($pasien->category_id == 3)
                                            @foreach($mhs as $m)
                                                @if($m->pasien_id == $pasien->id)
                                                    <input type="text" class="form-control" value="{{ $m->fakulta->nama_fakultas }}" readonly>
                                                @endif
                                            @endforeach
                                        @endif
                                    @elseif($pasien->category_id == 5)
                                        <label class="font-weight-bold text-primary">No. BPJS</label>
                                        @foreach($bpjs as $b)
                                            @if($b->pasien_id == $pasien->id)
                                                <input type="text" class="form-control" value="{{ $b->no_bpjs }}" readonly>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if($pasien->category_id == 3)
                            <div class="col-md col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <center>
                                            <label class="font-weight-bold text-primary">Program Studi</label>
                                            @foreach($mhs as $m)
                                                @if($m->pasien_id == $pasien->id)
                                                    <input type="text" class="form-control text-center" value="{{ $m->prodi->nama_prodi }}" readonly>
                                                @endif
                                            @endforeach
                                        </center>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/dashboard/select2.min.js') }}" defer></script>
<script>
    $(document).ready(function () {
        // $('#kategori').select2()
        $('#fakulta_id').select2()
        $('#prodi_id').select2()
        $('#fakulta_id').on('change', function() {
            var fakultasID = $(this).val();
            if(fakultasID) {
                $.ajax({
                    url: '/getProdi/'+fakultasID,
                    type: "GET",
                    data: {"_token":"{{ csrf_token() }}"},
                    dataType: "json",
                    success: function(data)
                    {
                        if(data){
                            $('#prodi_id').empty();
                            $.each(data, function(key, prodi){
                                $('select[name="prodi_id"]').append('<option value="'+ prodi.id +'">' + prodi.nama_prodi + '</option>');
                            });
                        } else {
                            $('#prodi_id').empty();
                        }
                    }
                });
            }
        });
    });

    function ktg(select) {
        var lf = document.getElementById('label_f');
        if (select.value == '1') {
            $('#fklt').show();
            $('#prd').hide();
            $('#no-bpjs').hide();
            lf.innerHTML = "Fakultas"
        }
        else if (select.value == '2') {
            $('#fklt').show();
            $('#prd').hide();
            $('#no-bpjs').hide();
            lf.innerHTML = "Fakultas/Sub-bagian"
        }
        else if (select.value == '3') {
            $('#fklt').show();
            $('#prd').show();
            $('#no-bpjs').hide();
            lf.innerHTML = "Fakultas"
        }
        else if (select.value == '4') {
            $('#fklt').hide();
            $('#prd').hide();
            $('#no-bpjs').hide();
        }
        else {
            $('#fklt').hide();
            $('#prd').hide();
            $('#no-bpjs').show();
        }
    }
</script>
@endsection