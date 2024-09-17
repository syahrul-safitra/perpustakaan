<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo/tutwuri.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">{{ auth()->user()->name }}</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>


    @can('admin')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm"
                aria-expanded="true" aria-controls="collapseForm">
                <i class="fab fa-fw fa-wpforms"></i>
                <span>Data Master</span>
            </a>
            <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data</h6>
                    <a class="collapse-item" href="{{ url('category') }}">Kategori</a>
                    <a class="collapse-item" href="{{ url('book') }}">Buku</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('anggota') }}">
                <i class="fas fa-fw fa-palette"></i>
                <span>Data Anggota</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('petugas') }}">
                <i class="fas fa-fw fa-palette"></i>
                <span>Petugas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin') }}">
                <i class="fas fa-fw fa-palette"></i>
                <span>Admin</span>
            </a>
        </li>
    @endcan

    <li class="nav-item">
        <a class="nav-link" href="{{ url('pinjam') }}">
            <i class="fas fa-fw fa-palette"></i>
            <span>Data Peminjaman</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ url('kunjungan') }}">
            <i class="fas fa-fw fa-palette"></i>
            <span>Data Kunjungan</span>
        </a>
    </li>


</ul>
