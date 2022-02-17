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

@section('notif')
    <li class="nav-item dropdown no-arrow mx-1" id="list-notif">
        <a class="nav-link dropdown-toggle" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i data-count="{{ $notifCount }}" class="fas fa-bell fa-fw"></i>
            <!-- Counter - Alerts -->
            @if($notifCount > 0)
            <span class="badge badge-danger badge-counter">{{ $notifCount }}</span>
            @endif
        </a>
        <!-- Dropdown - Alerts -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                Notifikasi
            </h6>
            @if($notifCount <= 0)
            <a class="dropdown-item d-flex align-items-center" href="#">
                <div>
                    <span class="text-gray-500">Tidak ada pemberitahuan</span>
                </div>
            </a>
            @else
            @foreach($notifs as $n)
            <a class="dropdown-item d-flex align-items-center" href="{{ route('nakes_edit_rekammedik', $n->id) }}">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-notes-medical text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{ \Carbon\Carbon::parse($n->notif_created_at)->format('d F y') }} | {{ \Carbon\Carbon::parse($n->notif_created_at)->toTimeString() }}</div>
                    <span class="font-weight-bold">{{ $n->isi }}</span>
                </div>
            </a>
            @endforeach
            @endif
        </div>
    </li>
    <script type="text/javascript">
        var nakes_id = {{Auth::user()->id}};
        var pusher = new Pusher('c42b033cec5adc3b394c', {
            cluster: 'ap1'
        });
        var notificationWrap = $('#list-notif');
        var notificationToggle = notificationWrap.find('a[data-toggle]');
        var notificationCountElem = notificationToggle.find('i[data-count]');
        var notificationCount = parseInt(notificationCountElem.data('count'));
        var notification = notificationWrap.find('div.dropdown-list');

        var channel = pusher.subscribe('medical-record-sent');
        channel.bind('App\\Events\\MedicalRecordSent', function(data) {        
            var existingNotif = notification.html();
            var newNotif = `
            <h6 class="dropdown-header">
                Notifikasi
            </h6>
            <a class="dropdown-item d-flex align-items-center" href="{{url('nakes/data/edit/rekammedik/`+data.notif.id+`')}}">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-notes-medical text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{\Carbon\Carbon::parse(`+data.notif.notif_created_at+`)->format('d F y')}} | {{\Carbon\Carbon::parse(`+data.notif.notif_created_at+`)->toTimeString()}}</div>
                    <span class="font-weight-bold">`+data.notif.isi+`</span>
                </div>
            </a>
            @foreach($notifs as $notif)
            <a class="dropdown-item d-flex align-items-center" href="{{ route('nakes_edit_rekammedik', $notif->id) }}">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-notes-medical text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{ \Carbon\Carbon::parse($notif->notif_created_at)->format('d F y') }} | {{ \Carbon\Carbon::parse($notif->notif_created_at)->toTimeString() }}</div>
                    <span class="font-weight-bold">{{ $notif->isi }}</span>
                </div>
            </a>
            @endforeach
            `;
            if(data.notif.user_id == nakes_id) {
                notification.html(newNotif);
                notificationCount += 1;
                notificationCountElem.attr('data-count', notificationCount);
                notificationWrap.find('.badge-counter').text(notificationCount);
                alert("Pasien ingin berobat");
            }
        });
    </script>
@endsection

@section('foto')
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/' . $rekammedik->tenkesehatan->foto_tenkes) }}">
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
                            <div class="col-2"></div>
                            <div class="col-md-2 col-12">
                                <div class="info-list">
                                    <div class="form-group">
                                        <label class="font-weight-bold text-primary">Biodata pasien</label>
                                        <a href="#pasienBio" class="btn btn-sm bg-light" data-toggle="modal"><i class="fas fa-info-circle"></i>&nbsp;Detail</a href="#">
                                    </div>
                                </div>
                                <div id="pasienBio" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light">
                                                <h4 class="modal-title font-weight-bold float-left">Biodata pasien</h4>
                                            </div>
                                            <div class="modal-body">
                                                <ul>
                                                    <div class="container row">
                                                        <li class="col-6">
                                                            <label class="font-weight-bold text-primary">Nama</label>
                                                            <input type="text" name="nama" class="form-control" value="{{ $rekammedik->pasien->nama_pasien }}" readonly>
                                                        </li>
                                                        <li class="col-6">
                                                            <label class="font-weight-bold text-primary">Tempat lahir</label>
                                                            <input type="text" name="tempat_lhr" class="form-control" value="{{ $rekammedik->pasien->tempat_lhr_pasien }}" readonly>
                                                        </li>
                                                        <li class="col-6">
                                                            <label class="font-weight-bold text-primary">Tanggal lahir</label>
                                                            <input type="date" name="tgl_lhr" class="form-control" value="{{ $rekammedik->pasien->tgl_lhr_pasien }}" readonly>
                                                        </li>
                                                        <li class="col-6">
                                                            <label class="font-weight-bold text-primary">No. Hp</label>
                                                            <input type="text" name="no_hp" class="form-control" value="{{ $rekammedik->pasien->no_hp_pasien }}" readonly>
                                                        </li>
                                                        <li class="col-6">
                                                            <label class="font-weight-bold text-primary">Alamat</label>
                                                            <input type="text" name="alamat" class="form-control" value="{{ $rekammedik->pasien->alamat_pasien }}" readonly>
                                                        </li>
                                                        <li class="col-6">
                                                            <label class="font-weight-bold text-primary">Jenis Kelamin</label>
                                                            <input type="text" name="jk" class="form-control" value="{{ $rekammedik->pasien->jk_pasien }}" readonly>
                                                        </li>
                                                        <li class="col-6">
                                                            <label class="font-weight-bold text-primary">Kategori</label>
                                                            <input type="text" name="category_id" class="form-control" value="{{ $rekammedik->pasien->category->nama_kategori }}" readonly>
                                                        </li>
                                                        @if ($rekammedik->pasien->category_id == '1' or $rekammedik->pasien->category_id == '3')
                                                        <li class="col-6">
                                                            <label class="font-weight-bold text-primary" id="label_f">Fakultas</label>
                                                            <input type="text" name="fakulta_id" class="form-control" value="{{ $rekammedik->pasien->fakulta->nama_fakultas }}" readonly>
                                                        </li>
                                                        <li class="col"><center>
                                                            <label class="font-weight-bold text-primary" id="label_p">Program Studi</label>
                                                            <input type="text" name="prodi_id" class="form-control col-5" value="{{ $rekammedik->pasien->prodi->nama_prodi }}" readonly>
                                                        </center></li>
                                                        @elseif ($rekammedik->pasien->category_id == '2')
                                                        <li class="col-6">
                                                            <label class="font-weight-bold text-primary" id="label_f">Fakultas</label>
                                                            <input type="text" name="fakulta_id" class="form-control" value="{{ $rekammedik->pasien->fakulta->nama_fakultas }}" readonly>
                                                        </li>
                                                        @endif
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn" data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                            
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">
                            <span>
                                <i class="fas fa-check"></i>
                            </span>    
                            <span class="text">Simpan</span>
                        </button>&nbsp;
                        <a href="{{ route('nakes_dashboard', Auth::user()->id) }}" class="btn btn-secondary btn-sm">
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
    <div id="addResep" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header bg-light">
                    <h4 class="modal-title font-weight-bold float-left">Tambah resep obat</h4>
                </div>
                <form method="POST" action={{ route('add_resep_obat', $notif->id) }}>
                    @csrf
                    <!-- body modal -->
                    <div class="modal-body">        
                        <input type="text" name="rekammedik_id" value={{ $rekammedik->id }} hidden>
                        <label class="font-weight-bold text-dark">Pilih obat:</label>
                        <select class="form-control" name="obat_id">
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
                    <h4 class="modal-title font-weight-bold float-left">Daftar resep obat</h4>
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
@endsection