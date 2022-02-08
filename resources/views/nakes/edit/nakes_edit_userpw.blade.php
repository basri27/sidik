@extends('layouts.back')

@section('title', 'Ubah Username dan Password Dokter')

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

@section('subhead', 'Ubah Username dan Password Dokter')

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

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="about-row row">
                <div class="detail-col col-md-12">
                    <form method="POST" action={{ route('nakes_update_userpw', $nakes->id) }}>
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Username:</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ $nakes->username }}" required>
                                        <div class="invalid-feedback">
                                            @error('username')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Password Lama:</label>
                                        <input id="password-lama" type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" autocomplete="current_password" required>
                                        <div class="invalid-feedback" role="alert">
                                            @error('current_password')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Password Baru:</label>
                                        <input id="password-baru" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                        <div class="invalid-feedback" role="alert">
                                            @error('password')
                                            <strong>{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="info-list">
                                <ul>
                                    <li>
                                        <label class="font-weight-bold text-primary">Konfirmasi Password Baru:</label>
                                        <input id="password-baru-confirm" type="password" name="password_confirmation" class="form-control" required>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <input type="checkbox" class="form-control-input" onclick="showPassword()"> Tampilkan Password <br><br>
                    <button type="submit" class="btn btn-success btn-sm" data-toggle="modal" data-target="#contohModal">
                        <span>
                            <i class="fas fa-check"></i>&nbsp;
                        </span>    
                        <span class="text">Simpan</span>
                    </button>&nbsp;
                    <a href="{{ route('nakes_profil', $nakes->id) }}" class="btn btn-secondary btn-sm">
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
<script>
    function showPassword() {
        var x = document.getElementById('password-lama');
        var y = document.getElementById('password-baru');
        var z = document.getElementById('password-baru-confirm');
        if (x.type == "password" || y.type == "password" || z.type == "password") {
            x.type = "text";
            y.type = "text";
            z.type = "text";
        }
        else {
            x.type = "password";
            y.type = "password";
            z.type = "password";
        }
    }
</script>
@endsection