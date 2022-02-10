@extends('layouts.back')

@section('title', 'Ubah Profil Dokter')

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
    <li class="nav-item active">
        <a class="nav-link" href={{ route('nakes_profil', Auth::user()->id) }}>
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </a>
    </li>
@endsection

@section('subhead', 'Ubah Profil Dokter')

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
<img class="img-profile rounded-circle" src="{{ asset('foto_profil/' . $nakes->foto_tenkes) }}">
@endsection

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <!-- <div class="image-col col-md-2">
                    <hr><img src="{{ asset('/img/klinik.png') }}" alt=""><hr>
                </div> -->
                <div class="detail-col col-md-12">
                    <form method="POST" enctype="multipart/form-data" action={{ route('nakes_update_profil', $nakes->user_id) }}>
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="info-list">
                                <div class="form-group">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Nama</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $nakes->nama_tenkes }}" required>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Tanggal lahir</label>
                                        <input type="date" name="tgl_lhr" class="form-control" value="{{ $nakes->tgl_lhr_tenkes }}" required>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Tempat lahir</label>
                                        <input type="text" name="tempat_lhr" class="form-control" value="{{ $nakes->tempat_lhr_tenkes }}" required>
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
                                        <label class="font-weight-bold text-primary" for="">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" value="{{ $nakes->alamat_tenkes }}" required>
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">No. Hp</label>
                                        <input type="text" name="no_hp" class="form-control" value="{{ $nakes->nohp_tenkes }}" required>
                                        
                                    </li>
                                    <li>
                                        <label class="font-weight-bold text-primary" for="">Jenis Kelamin</label>
                                        <select class="form-control" name="jk" id="jk">
                                            <option value="{{ $nakes->jk_tenkes }}">{{ $nakes->jk_tenkes }}</option>
                                            @if($nakes->jk_tenkes == "Laki-laki")
                                            <option value="Perempuan">Perempuan</option>
                                            @elseif($nakes->jk_tenkes == "Perempuan")
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
                                            <img src="{{ asset('/foto_profil/' . $nakes->foto_tenkes) }}" alt="">
                                        </div>                                        
                                    </li>
                                    <br>
                                    <li>
                                        <div class="row container">
                                            <input type="file" name="foto_tenkes">
                                        </div>
                                    </li>
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">
                        <span>
                            <i class="fas fa-check"></i>&nbsp;
                        </span>    
                        <span class="text">Simpan</span>
                    </button>
                    <a href={{ route('nakes_profil', $nakes->user_id) }} class="btn btn-secondary btn-sm">
                        <span>
                            <i class="fas fa-times"></i>&nbsp;
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