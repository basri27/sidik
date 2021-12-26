@extends('layouts.front')

@section('title', 'Jadwal Praktek')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
@endsection

@section('navbar')
<li class="nav-item">
    <a class="nav-link" href="{{ route('home') }}">Home</a>
</li>
<li class="nav-item active">
    <a class="nav-link" href="{{ route('jadwal') }}">Jadwal Praktek</a>
</li>
@endsection

@section('awal')
    <h1 class="display-4"><b>Jadwal Praktek</b></h1>
@endsection

@section('content')
<div class="container">
    <h2 class="my-5 text-center">Jadwal Praktek</h2>
    <div class="table-responsive">
        <table class="table table-bordered" style="text-align: center; font-size: 80%; color: white;">
            <thead class="bg-dark">   
                <tr>
                    <th scope="col sm-1">Senin</th>
                    <th scope="col sm-1">Selasa</th>
                    <th scope="col sm-1">Rabu</th>
                    <th scope="col sm-1">Kamis</th>
                    <th scope="col sm-1">Jum'at</th>
                </tr>
                <tr>
                    <th>(dr. Edyson, M.Kes) - (dr. Tara)</th>
                    <th>(dr. Lena Rosida, M.Kes.PhD - (dr. Tara)</th>
                    <th>(dr. Alfi Yasmina, M.Kes.PhD) - (dr. Tara)</th>
                    <th>(dr. Husnul Khatimah, M.Sc.) - (dr. Tara)</th>
                    <th>(dr. Farida Heriyani, M.PH.) - (dr. Tara)</th>
                </tr>
            </thead>
            <tbody style="color: black">
                <tr>
                    <td>10.00 - 12.00</td>
                    <td>10.00 - 12.00</td>
                    <td>10.00 - 12.00</td>
                    <td>10.00 - 12.00</td>
                    <td>10.00 - 12.00</td>
                </tr>
                <tr>
                    <td>13.00 - 16.00</td>
                    <td>13.00 - 16.00</td>
                    <td>13.00 - 16.00</td>
                    <td>13.00 - 16.00</td>
                    <td>13.00 - 16.00</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br><br><br>
</div>
@endsection
@section('js')
<script src="{{ asset('/js/jadwal/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('/js/jadwal/popper.min.js') }}"></script>
<script src="{{ asset('/js/jadwal/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/jadwal/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/js/jadwal/main.js') }}"></script>
<script src="{{ asset('/js/jadwal/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('/js/jadwal/theme.js') }}"></script>
@endsection
