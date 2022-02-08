@extends('layouts.back')

@section('title', 'Profil Dokter')

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
        <a class="nav-link" href={{ route('nakes_profil', Auth::user()->id)}}>
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </a>
    </li>
@endsection

@section('subhead', 'Profil Dokter')

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
                alert("Pasien ingin berobat");
                notification.html(newNotif);
                notificationCount += 1;
                notificationCountElem.attr('data-count', notificationCount);
                notificationWrap.find('.badge-counter').text(notificationCount);
            }
        });
    </script>
@endsection

@section('foto')
<img class="img-profile rounded-circle" src="{{ asset('foto_profil/' . $nakes->foto_tenkes) }}">
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
                <div class="col-md-2">
                    <img src="{{ asset('/foto_profil/' . $nakes->foto_tenkes) }}" alt=""><br><br>
                    @if($nakes->foto_tenkes != 'default.jpg')
                    <form method="POST" action={{ route('nakes_reset_foto', $nakes->user_id) }}>
                    @method('PATCH')
                    @csrf
                        <button type="submit" class="btn btn-sm btn-danger col" href="#"><i class="fas fa-trash"></i>&ensp;Hapus foto profil</button>
                    </form>
                    @endif
                </div>
                <div class="detail-col col-md-8">
                    <h3 class="font-weight-bold">{{ $nakes->nama_tenkes }}</h3 class="font-weight-bold">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Tanggal Lahir: <span class="font-weight-bold">{{ \Carbon\Carbon::parse($nakes->tgl_lhr_tenkes)->format('d F Y') }}</span></li>
                                    <li>Tempat Lahir: <span class="font-weight-bold">{{ $nakes->tempat_lhr_tenkes }}</span></li>
                                    <li>Alamat: <span class="font-weight-bold">{{ $nakes->alamat_tenkes }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="info-list">
                                <ul class="font-weight-bold">
                                    <li>Umur: <span class="font-weight-bold text-dark">{{ $age }} tahun</span></li>
                                    <li>Phone: <span class="font-weight-boldl text-primary">{{ $nakes->nohp_tenkes}}</span></li>
                                    <li>Jenis Kelamin: <span class="font-weight-bold text-dark">{{ $nakes->jk_tenkes }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('nakes_edit_profil', Auth::user()->id) }}" class="btn btn-primary btn-sm">
                        <span>
                            <i class="fas fa-edit"></i>
                        </span>    
                        <span class="text">Ubah profil</span>
                    </a>&nbsp;
                    <a href="{{ route('nakes_edit_userpw', Auth::user()->id) }}" class="btn btn-success btn-sm">
                        <span>
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Ubah username dan password</span>    
                    </a>
                </div>                    
            </div>
        </div>
    </div>
</div>
@endsection