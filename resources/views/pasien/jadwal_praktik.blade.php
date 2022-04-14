@extends('layouts.back')

@section('title', 'Profil Pasien')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
@endsection

@section('menu')
    @include('layouts.nav_pasien')
@endsection

@section('subhead', 'Profil Pasien')

@section('foto')
    <?php 
        $p = \App\Models\Pasien::where('user_id', $pasien->id)->first();
        $kp = \App\Models\KeluargaPasien::where('user_id', $pasien->id)->first();
        if ($p != null) {
            $dosen = \App\Models\Dosen::where('pasien_id', $p->id)->first();
            $kary = \App\Models\Karyawan::where('pasien_id', $p->id)->first();
            $mhs = \App\Models\Mahasiswa::where('pasien_id', $p->id)->first();
            $bpjs = \App\Models\Bpjs::where('pasien_id', $p->id)->first();
        }
    ?>
    @if ($p != null)
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/pasien/' . $p->foto_pasien) }}">
    @else
    <img class="img-profile rounded-circle" src="{{ asset('foto_profil/keluarga_pasien/' . $kp->foto_kel_pasien) }}">
    @endif
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="text-align: center; font-size: 70%; color: white;">
                    <thead>
                        <tr class="bg-dark">
                            @foreach ($jadwals as $jadwal)
                            <th scope="col sm-1">{{ $jadwal->hari_jadwal }}</th>
                            @endforeach
                        </tr>
                    </thead>
                        <tr class="bg-info">
                            @foreach ($jadwals as $jadwal)
                                <th>
                                    @foreach ($tenkes as $tks)
                                        {{ ($tks->id == $jadwal->tenkes1) ?  $tks->nama_tenkes : '' }}
                                    @endforeach
                                </th>
                            @endforeach
                        </tr>
                    <tbody style="color: black">
                        <tr>
                            @foreach ($jadwals as $jadwal)
                            {{-- <td>{{ \Carbon\Carbon::parse($jadwal->pagi_s)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->pagi_n)->format('H:i') }}</td> --}}
                            <td>{{ $jadwal->waktu1 }}</td>
                            @endforeach
                        </tr>
                        <tr class="bg-info" style="color: white">
                            @foreach ($jadwals as $jadwal)
                                <th>
                                    @foreach ($tenkes as $tks)
                                    {{ ($tks->id == $jadwal->tenkes2) ?  $tks->nama_tenkes : '' }}
                                    @endforeach
                                </th>
                            @endforeach
                        </tr>
                        <tr>
                            @foreach ($jadwals as $jadwal)
                            <td>{{ $jadwal->waktu2 }}</td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection