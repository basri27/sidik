@extends('layouts.front')

@section('title', 'Beranda')

@section('navbar')
<li class="nav-item active">
    <a class="nav-link" href="{{ route('home') }}">Home</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('jadwal') }}">Jadwal Praktek</a>
</li>
@endsection

@section('awal')
    <span class="subhead">Selamat Datang di</span>
    <h1 class="display-4"><b>LMMC Banjarmasin</b></h1>
@endsection

@section('content')
<div class="bg-light">
    <div class="page-section pb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 py-3 wow fadeInUp">
                    <h1>LMMC (Lambung Mangkurat Medical Center)<br>Banjarmasin</h1>
                    <h4 class="text-grey">Visi:</h4>
                    <p class="text-grey mb-4">
                        Menjadi pusat layanan kesehatan yang unggul dan komprehensif memenuhi harapan civitas akademika dan warga kampus serta masyarakat.
                    </p>
                    <h4 class="text-grey">Misi:</h4>
                    <ul>
                        <li style="color: grey">
                            <p class="text-grey">Memberikan layanan kesehatan dasar mengikuti standar pelayanan medis dan pendidikan.</p>
                        </li>
                        <li style="color: grey">
                            <p class="text-grey">Memberikan layanan pencegahan, pemerikasaan kesehatan, psikologi dan gangguan belajar, pemerikasaan dan pencegahan nafza.</p>
                        </li>
                        <li style="color: grey">
                            <p class="text-grey">Memberikan layanan kesehatan luar gedung dan lapangan serta pengabdian masyarakat.</p>
                        </li>
                        <li style="color: grey">
                            <p class="text-grey">Menjalin berbagai kerjasama dan kemitraan antar universitas, penyedia dan pengguna jaminan kesehatan.</p>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
                    <div class="img-place custom-img-1">
                        <img src=" {{ asset('/img/klinik.jpeg') }} " alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- .bg-light -->
</div> <!-- .bg-light -->

<div class="page-section">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp">Our Doctors</h1>

        <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">
            @foreach ($tenkes as $tks)
            <div class="item">
                <div class="card-doctor">
                    <img src=" {{ asset('/img/doctors/doctor_1.jpg') }} " alt="">
                    <div class="body">
                        <p class="text-xl mb-0">{{ $tks->nama_tenkes }}</p>
                        <span class="text-sm text-grey">{{ $tks->kategori_tenkesehatan->nama_kategori_tenkes }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="page-section bg-light">
    <div class="container">
    <h1 class="text-center wow fadeInUp">Pelayanan</h1>
    <div class="row mt-5">
        <div class="col-lg-4 py-2 wow zoomIn">
        <div class="card-blog">
            <div class="header">
            <div class="post-thumb">
                <img src="{{ asset('/img/blog/blog_1.jpg') }}" alt="">
            </div>
            </div>
            <div class="body">
            <h5 class="post-title">Dokter Umum</h5>
            </div>
        </div>
        </div>
        <div class="col-lg-4 py-2 wow zoomIn">
        <div class="card-blog">
            <div class="header">
            <div class="post-thumb">
                <img src="{{ asset('/img/blog/blog_1.jpg') }}" alt="">
            </div>
            </div>
            <div class="body">
            <h5 class="post-title">Dokter Gigi</h5>
            </div>
        </div>
        </div>
        <div class="col-lg-4 py-2 wow zoomIn">
        <div class="card-blog">
            <div class="header">
            <div class="post-thumb">
                <img src="{{ asset('/img/blog/blog_1.jpg') }}" alt="">
            </div>
            </div>
            <div class="body">
            <h5 class="post-title">Apotek</h5>
            </div>
        </div>
        </div>
        <div class="col-lg-4 py-2 wow zoomIn">
        <div class="card-blog">
            <div class="header">
            <div class="post-thumb">
                <img src="{{ asset('/img/blog/blog_1.jpg') }}" alt="">
            </div>
            </div>
            <div class="body">
            <h5 class="post-title">Gawat Darurat</h5>
            </div>
        </div>
        </div>
        <div class="col-lg-4 py-2 wow zoomIn">
        <div class="card-blog">
            <div class="header">
            <div class="post-thumb">
                <img src="{{ asset('/img/blog/blog_1.jpg') }}" alt="">
            </div>
            </div>
            <div class="body">
            <h5 class="post-title">Laboratorium</h5>
            </div>
        </div>
        </div>
        <div class="col-lg-4 py-2 wow zoomIn">
        <div class="card-blog">
            <div class="header">
            <div class="post-thumb">
                <img src="{{ asset('/img/blog/blog_1.jpg') }}" alt="">
            </div>
            </div>
            <div class="body">
            <h5 class="post-title">Psikologi</h5>
            </div>
        </div>
        </div>
        <div class="col-lg-4 py-2 wow zoomIn">
        <div class="card-blog">
            <div class="header">
            <div class="post-thumb">
                <img src="{{ asset('/img/blog/blog_1.jpg') }}" alt="">
            </div>
            </div>
            <div class="body">
            <h5 class="post-title">Medical Checkup</h5>
            </div>
        </div>
        </div>
    </div>
    </div>
</div> <!-- .page-section -->
@endsection
@section('js')
  <script src="{{ asset('/js/jquery-3.5.1.min.js') }}"></script>
  <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('/vendor/wow/wow.min.js') }}"></script>
  <script src="{{ asset('/js/theme.js') }}"></script>
@endsection