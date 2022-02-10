@extends('layouts.back')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
@endsection

@section('menu')
    <li class="nav-item active">
        <a class="nav-link" href={{ route('apoteker_dashboard', Auth::user()->id) }}>
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href=#>
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </a>
    </li>
@endsection

@section('subhead', 'Dashboard Apoteker')

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
            <div id="scroll">
                <h6 class="dropdown-header">
                    Notifikasi
                </h6>
                @if($notifCount <= 0)
                    <a class="dropdown-item d-flex align-items-center">
                        <div>
                            <span class="text-gray-500">Tidak ada pemberitahuan</span>
                        </div>
                    </a>
                @else
                    @foreach($notifications as $notif)
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('apoteker_obat_pasien', $notif->rekam_medik_id) }}">
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
        </div>
    </li>
    <script type="text/javascript">
        var apoteker_id = {{Auth::user()->id}};
        var pusher = new Pusher('c42b033cec5adc3b394c', {
            cluster: 'ap1'
        });
        var notificationWrap = $('#list-notif');
        var notificationToggle = notificationWrap.find('a[data-toggle]');
        var notificationCountElem = notificationToggle.find('i[data-count]');
        var notificationCount = parseInt(notificationCountElem.data('count'));
        var notification = notificationWrap.find('div.dropdown-list');

        var channel = pusher.subscribe('obat-sent');
        channel.bind('App\\Events\\ObatSent', function(data) {        
            var existingNotif = notification.html();
            var newNotif = `
            <div id="scroll">
                <h6 class="dropdown-header">
                    Notifikasi
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="{{url('apoteker/obat/`+data.rekammedik.id+`')}}">
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
                @foreach($notifications as $notif)
                <a class="dropdown-item d-flex align-items-center" href="{{ route('apoteker_obat_pasien', $notif->rekam_medik_id) }}">
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
            </div>
            `;
                notification.html(newNotif);
                notificationCount += 1;
                notificationCountElem.attr('data-count', notificationCount);
                notificationWrap.find('.badge-counter').text(notificationCount);
        });
    </script>
@endsection

@section('foto')
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/' . Auth::user()->apoteker->foto_apoteker) }}">
@endsection

@section('content')
    <div class="container-fluid">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="card shadow p-3">
            <div class="row">
                <p class="font-weight-bold text-primary col-3">Tanggal: <span class="text-success">{{ \Carbon\Carbon::now()->format('d F Y') }}</span></p>
                <p class="font-weight-bold text-primary col">Waktu: <span class="text-success">{{ \Carbon\Carbon::now()->toTimeString() }}</span></p>
            </div>
            <p class="font-weight-bold text-primary ">Jumlah pasien hari ini: <span class="text-success">{{ $pasienCount }} orang</span></p>
            <form action="{{ route('nakes_dashboard', Auth::user()->id) }}">
                <button class="btn btn-success btn-sm pl-2 pr-2" id="refresh"><i class="fas fa-sync-alt"></i> Refresh</button>
            </form><br>
            <h5 class="font-weight-bold text-primary">Daftar pasien hari ini:</h5>
            @if($pasienCount == 0)
                <center><br><h5 class="text-info">Belum ada pasien hari ini</h5><br></center>
            @else
                @foreach($pasiens as $p)
                    <div class="mb-2">
                        <div class="d-block card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">{{ $p->pasien->nama_pasien}}&emsp;<span class="text-primary">|&emsp;Resep obat:</span> <span class="text-dark">@foreach($resep as $r)({{ $r->obat->nama_obat }})&ensp;|&ensp;@endforeach</span></h6>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <script type="text/javascript">
        setTimeout(function(){
        location.reload();
        },30000);
    </script>
@endsection