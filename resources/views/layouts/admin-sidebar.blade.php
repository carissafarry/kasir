<ul class="sidebar-menu">
    <li class="menu-header">MENU</li>
    <li>
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="far fa-square"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a class="nav-link" href="{{ route('admin.pengguna') }}">
            <i class="far fa-square"></i>
            <span>Pengguna</span>
        </a>
    </li>
    <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-columns"></i>
            <span>Laporan Barang</span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class="nav-link" href="{{ route('admin.laporan-barang.masuk') }}">Barang Masuk</a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('admin.laporan-barang.keluar') }}">Barang Keluar</a>
            </li>
        </ul>
    </li>
    <li>
        <a class="nav-link" href="{{ route('admin.laporan-penjualan') }}">
            <i class="far fa-square"></i>
            <span>Laporan Penjualan</span>
        </a>
    </li>
    <li>
        <a class="nav-link" href="{{ route('admin.metode_bayar') }}">
            <i class="far fa-square"></i>
            <span>Metode Pembayaran</span>
        </a>
    </li>
    <li>
        <a class="nav-link" href="{{ route('admin.paket-penjualan') }}">
            <i class="far fa-square"></i>
            <span>Paket Penjualan</span>
        </a>
    </li>
    <li>
        <a class="nav-link" href="{{ route('admin.laporan-labarugi') }}">
            <i class="far fa-square"></i>
            <span>Laporan Laba Rugi</span>
        </a>
    </li>
</ul>
