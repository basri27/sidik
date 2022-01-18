<li class="nav-item">
    <a class="nav-link" href={{ route('adm_dashboard', Auth::user()->id) }}>
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href={{ route('adm_profil', Auth::user()->id) }}>
        <i class="fas fa-user"></i>
        <span>Profil</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('adm_jadwal') }}">
        <i class="fas fa-calendar-alt"></i>
        <span>Jadwal Praktek</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Manajemen Data</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pilih:</h6>
            <a class="collapse-item" href="{{ route('adm_man_datapasien') }}">Pasien</a>
            <a class="collapse-item" href="{{ route('adm_man_dataapoteker') }}">Apoteker</a>
            <a class="collapse-item" href="{{ route('adm_man_datanakes') }}">Tenaga Kesehatan</a>
            <a class="collapse-item" href="#">Dokumentasi Kegiatan</a>
            <a class="collapse-item" href="{{ route('adm_man_datarekammedik') }}">Rekam Medik</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('adm_rekap_rekam_medik') }}">
        <i class="fas fa-chart-bar"></i>
        <span>Rekap Rekam Medik</span>
    </a>
</li>