<li class="nav-item">
        <a class="nav-link" href="{{ route('profil_pasien', $pasien->id) }}">
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pasien_jadwal_praktik', $pasien->id)}}">
            <i class="fas fa-calendar-alt"></i>
            <span>Jadwal Praktik</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('riwayat_berobat', $pasien->id) }}">
            <i class="fas fa-history"></i>
            <span>Riwayat Berobat</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('kartu_berobat', $pasien->id) }}">
            <i class="fas fa-id-card"></i>
            <span>Kartu Berobat</span>
        </a>
    </li>
    @if ($pasien->pasien->category_id == 1 || $pasien->pasien->category_id == 2)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('keluarga_pasien', $pasien->id) }}">
            <i class="fas fa-users"></i>
            <span>Keluarga</span>
        </a>
    </li>
    @endif