@extends('layouts.back')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <style>
        .dropdown-list {
            height: 50vh;
        }
        #scroll {
            height: 100%;
            overflow: auto;
        }
    </style>
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

@section('subhead', 'Dashboard')

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