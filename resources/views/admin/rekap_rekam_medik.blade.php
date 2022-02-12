@extends('layouts.back')

@section('title', 'Rekap Rekam Medik')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard/sb-admin-2.min.css') }}"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@endsection

@section('menu')
@include('layouts.nav_admin')
@endsection

@section('subhead', 'Rekap Rekam Medik')

@section('foto')
@include('layouts.foto_profil_admin')
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <a href="#collapseCardMedik" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Data Rekam Medik Pasien</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardMedik">
            <div class="card-body">
                <div class="row pl-3">
                    <h5 class="font-weight-bold text-primary">Filter Tanggal Rekam Medik</h5>
                </div>
                <hr>
                <div class="row pl-2">
                    <label class="font-weight-bold text-secondary col-3">Start</label>
                    <label class="font-weight-bold text-secondary col-3">End</label>
                </div>
                <div class="row pl-3">
                    <input type="date" class="form-control col-3" id="date-start">
                    &nbsp;
                    <input type="date" class="form-control col-3" id="date-end" max="{{ \Carbon\Carbon::now()->toDateString() }}" value="{{ \Carbon\Carbon::now()->toDateString() }}">&nbsp;
                    <button class="btn btn-info tombol btn-2"><i class="fas fa-folder-open">&nbsp;Lihat</i></button>
                    <!-- <a class="btn btn-info btn-2" href="#"><i class="fas fa-print"></i>Cetak</a> -->
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table" id="tabel-pasien" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal Periksa</th>
                                <th>Pemeriksa</th>
                                <th>Kategori</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class=" col-lg-8">      
            <div class="card shadow mb-4">
                <a href="#collapseCardGrafik" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Jumlah Pasien Berobat Pertahun</h6>
                </a>
                <div class="collapse show" id="collapseCardGrafik">
                    <div class="card-body">
                        <div class="container row">
                            <input type="number" class="form-control col-5" id="tahun-grafik" placeholder="Masukkan tahun..." required>&nbsp;
                            <button class="btn btn-info btn-2 tombol-grafik"><i class="fas fa-folder-open"></i>&nbsp;Lihat</button>
                        </div>
                        <hr>
                        <div class="chart-area">
                            <canvas id="barChart"></canvas>
                        </div>
                        <hr>
                        <b>*Grafik di atas adalah data pasien tahun <span class="text-info">{{ \Carbon\Carbon::now()->format('Y') }}</span></b>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <a href="#collapseCardData" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pasien berdasarkan Kategori</h6>
                </a>
                <div class="collapse show" id="collapseCardData">
                    <div class="card-body">
                        <?php 
                            $month = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'November', 'Desember'];
                            $i = 0;
                        ?>
                        <div class="container row">
                            <select class="form-control col-7" name="" id="">
                                <option value="">Pilih Bulan</option>
                                    @foreach($month as $m)
                                <option value="{{ $i += 1 }}">{{ $m }}</option>
                                    @endforeach
                            </select>
                            &ensp;
                            <button type="submit" class="btn btn-info btn-circle btn-4"><i class="fas fa-folder-open"></i></button>
                            <input type="text" class="form-control" name="" id="" placeholder="Masukkan tahun...">
                        </div>
                        <hr>
                        <div class="char-pie pt-4">
                            <canvas id="labelChart"></canvas>
                        </div>
                        <hr>
                        <b>*Grafik di atas adalah data pasien berdasarkan kategori <span class="text-info">Dosen, Karyawan, Mahasiswa, <span class="text-dark">dan</span> Umum</span></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach($rekammedik as $rk)
    <div id="viewResep{{ $rk->id }}" class="modal fade" role="dialog">
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
                        <?php $resep = \App\Models\ResepObat::where('rekam_medik_id', $rk->id)->whereDate('resepobat_created_at', \Carbon\Carbon::parse($rk->rekammedik_created_at)->toDateString())->get(); ?>
                        @foreach($resep as $rs)
                            <tr>
                                <td>{{ $rs->obat->nama_obat }} | {{ $rs->keterangan }}</td>
                            </tr>
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
@endforeach
<!--Import jQuery before export.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

<!-- Moment js -->
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<!--Data Table-->
<script type="text/javascript"  src=" https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript"  src=" https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script>
    let start = $('#date-start').val();
    let end = $('#date-end').val();

    const table_pasien = $("#tabel-pasien").DataTable({
        "pageLength": 25,
        "lengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        "processing": true,
        "bServerSide": true,
        "order": [[ 0, "asc" ]],
        "ajax":{
            url:"{{url('filterrekammedik')}}",
            type:"POST",
            data:function(d){
                d._token = "{{csrf_token()}}";
                d.mulai = start;
                d.habis = end;
            }
        },
        columns:[
            {
                data: 'nama_pasien',
            },
            {
                "render": function(data, type, row, meta){
                    moment.locale('id');
                    return moment(row.rekammedik_created_at).format('LL');
                }
            },
            {
                data: 'nama_tenkes',
                orderable: false,
            },
            {
                data: 'nama_kategori',
                orderable: false,
            },
            {
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: ''
            }
        ]
    });

    function format ( d ) {
    // `d` is the original data object for the row
    return '<table class="table table-striped table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<thead class="thead-dark">'+
                '<tr>'+
                    '<th>Tensi</th>'+
                    '<th>Suhu</th>'+
                    '<th>Keluhan</th>'+
                    '<th>Diagnosa</th>'+
                    '<th>Obat</th>'+
                    '<th>Keterangan</th>'+
                '</tr>'+
            '</thead>'+
            '<tbody>'+
                '<tr>'+
                    '<td>'+d.tensi+'</td>'+
                    '<td>'+d.suhu+'</td>'+
                    '<td>'+d.keluhan+'</td>'+
                    '<td>'+d.kode_diagnosa+' - '+d.nama_diagnosa+'</td>'+
                    '<td><a href="#viewResep'+d.id+'" class="btn btn-sm border border-dark" data-toggle="modal"><small><i class="fas fa-eye"></i>&nbsp;Lihat</small></a></td>'+
                    '<td>'+d.keterangan+'</td>'+
                '</tr>'+
            '</tbody>'+
        '</table>';
    }

    $('#tabel-pasien tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table_pasien.row( tr );
  
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.find('svg').attr('data-icon', 'plus-circle');    // FontAwesome 5
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
          tr.find('svg').attr('data-icon', 'minus-circle'); // FontAwesome 5
        }
    });

    $('.tombol').on('click', function() {
        start = $('#date-start').val();
        end = $('#date-end').val();
        table_pasien.ajax.reload(null,false)
    });
</script>
<!-- MDB -->
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.2/umd/popper.min.js" integrity="sha512-aDciVjp+txtxTJWsp8aRwttA0vR2sJMk/73ZT7ExuEHv7I5E6iyyobpFOlEFkq59mWW8ToYGuVZFnwhwIUisKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
<script>
    let tahun = $('tahun-grafik').val();
    
    $(document).ready(function() {
        $.ajax({
            url: "{{url('filtergrafikbar')}}",
            type: "post",
            data: {
                _token: "{{csrf_token()}}",
                tahun: moment().format('YYYY')
            },
            success: function(d) {
                var ctxB = document.getElementById("barChart").getContext('2d');
                var myBarChart = new Chart(ctxB, {
                    type: 'bar',
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec"],
                        datasets: [{
                            label: 'Jumlah Pasien',
                            data: [
                                '100', '90', '78', '112', '76', '31'
                            ],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        });
    });

    $('.tombol-grafik').on('click', function() {
        tahun = $('#tahun-grafik').val();
        $.ajax({
            url: "{{url('filtergrafikbar')}}",
            type: "post",
            data: {
                _token: "{{csrf_token()}}",
                tahun: tahun
            },
            success: function() {

                var ctxB = document.getElementById("barChart").getContext('2d');
                var myBarChart = new Chart(ctxB, {
                    type: 'bar',
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dec"],
                        datasets: [{
                            label: 'Jumlah Pasien',
                            data: ['userArr.count'],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        });
    });
</script>
<script>
    var ctxP = document.getElementById("labelChart").getContext('2d');
    var myPieChart = new Chart(ctxP, {
    plugins: [ChartDataLabels],
    type: 'pie',
    data: {
        labels: ["Mahasiswa", "Dosen", "Karyawan", "Umum"],
        datasets: [{
            data: [210, 130, 120, 160],
            backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#FF00FF"],
            hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#fa64fa"]
        }]
    },
    options: {
        responsive: true,
        legend: {
        position: 'right',
        labels: {
            padding: 20,
            boxWidth: 10
        }
        },
        plugins: {
            datalabels: {
                formatter: (value, ctx) => {
                    let sum = 0;
                    let dataArr = ctx.chart.data.datasets[0].data;
                    dataArr.map(data => {
                        sum += data;
                    });
                    let percentage = (value * 100 / sum).toFixed(2) + "%";
                    return percentage;
                },
                color: 'white',
                labels: {
                title: {
                    font: {
                    size: '11'
                    }
                }
                }
            }
        }
    }
    });
</script>
@endsection