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
                    <a class="dropdown-item d-flex align-items-center" href="#viewResep{{$notif->id}}" data-toggle="modal">
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
    @foreach($notifications as $notif)
    <div id="viewResep{{ $notif->id }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title font-weight-bold float-left">Resep Obat</h4>
                </div>
                <div class="modal-body">
                    @if ($notif->rekam_medik->pasien_id != null)
                    <h5 class="font-weight-bold">{{ $notif->rekam_medik->pasien->nama_pasien }}</h5>
                    @else
                    <h5 class="font-weight-bold">{{ $notif->rekam_medik->keluarga_pasien->nama_kel_pasien }}</h5>
                    @endif
                    <ul>
                        <?php $resep = \App\Models\ResepObat::where('rekam_medik_id', $notif->rekam_medik_id)->get(); ?>
                        @foreach($resep as $rs)
                        <li>
                            {{ $rs->obat->nama_obat }} | {{ $rs->keterangan }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('pengobatan_selesai', [$notif->rekam_medik_id, Auth::user()->id]) }}">
                        @method('PATCH')
                        @csrf
                        <button class="btn btn-dark" type="submit">Selesai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
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
                <a class="dropdown-item d-flex align-items-center" href="#viewResep`+data.notif.id+`" data-toggle="modal">
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
                <a class="dropdown-item d-flex align-items-center" href="#viewResep{{$notif->id}}" data-toggle="modal">
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
            
            if(!alert('Resep obat pasien diterima!')){window.location.reload();}
            
            // notification.html(newNotif);
            // notificationCount += 1;
            // notificationCountElem.attr('data-count', notificationCount);
            // notificationWrap.find('.badge-counter').text(notificationCount);
            // resepObat.html(newResep);

        });
    </script>