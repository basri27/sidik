<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('img/klinik.png') }}" type="image/x-icon">
    	<title>Cetak Kartu Berobat</title>
    	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    </head>
    <body onload="window.print()"  class="m-3">
    	<div class="table-responsive">
            <center>
                <table class="table table-borderless col-8">
                    <thead>
                        <tr class="text-center border border-dark">
                            <th><img src="{{ asset('img/logo-ulm1.png') }}"></th>
                            <th>
                                <h4 class="font-weight-bold">KARTU BEROBAT</h4>
                                <h5 class="font-weight-bold">KLINIK PRATAMA</h5>
                                <h6 class="font-weight-bold">LAMBUNG MANGKURAT MEDICAL CENTER (LMMC)</h6>
                            </th>
                            <th><img src="{{ asset('img/logo-klinik1.png') }}"></th>
                        </tr>
                    </thead>
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
                    <tbody class="border border-dark text-uppercase">
                        <tr>
                            <td></td>
                            <td>nama <span class="text-center">:</span>{{ $p->nama_pasien }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>indeks <span class="text-center">:</span>{{ $p->id }} / {{ $p->category->nama_kategori }} @if($p->category_id != 4) ULM @endif</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>umur <span class="text-center">:</span>{{ \Carbon\Carbon::parse($p->tgl_lhr_pasien)->age }} tahun</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>alamat <span class="text-center">:</span>{{ $p->alamat_pasien }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                    @else
                    <tbody class="border border-dark text-uppercase">
                        <tr>
                            <td></td>
                            <td>nama <span class="text-center">:</span>{{ $kp->nama_keluarga_pasien }}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <?php
                                $dosen = \App\Models\Dosen::where('pasien_id', $kp->pasien->id)->first();
                                $kary = \App\Models\Karyawan::where('pasien_id', $kp->pasien->id)->first();
                            ?>
                            <td></td>
                            <td>indeks <span class="text-center">:</span>{{ $kp->id }} / {{ $kp->kategori_kel_pasien }}
                                dari {{ $kp->pasien->nama_pasien }} ({{ $kp->pasien->category->nama_kategori }}
                                @if ($kp->pasien->category_id == 1)
                                    {{ $dosen->fakulta->nama_fakultas }})
                                @elseif ($kp->pasien->category_id == 2)
                                    {{ $kary->fakulta->nama_fakultas }})
                                @endif
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>umur <span class="text-center">:</span>{{ \Carbon\Carbon::parse($kp->tgl_lhr_kel_pasien)->age }} tahun</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>alamat <span class="text-center">:</span>{{ $kp->alamat_kel_pasien }}</td>
                            <td></td>
                        </tr>
                    </tbody>
                    @endif
                </table>
            </center>
        </div>
    </body>
</html>