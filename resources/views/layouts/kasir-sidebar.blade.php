<ul class="sidebar-menu">
    <li class="menu-header">MENU</li>
    <li>
        <a class="nav-link" href="{{ route('kasir.dashboard') }}">
            <i class="far fa-square"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-columns"></i>
            <span>Transaksi</span>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a class="nav-link" href="{{route('kasir.transaksi')}}">Data Transaksi</a>
            </li>
            <li>
                <a class="nav-link" href="{{route('kasir.transaksi.riwayat')}}">Riwayat Transaksi</a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-columns"></i>
            <span>Kelola Barang</span>
        </a>
        <ul class="dropdown-menu">
            {{-- <li>
                <a class="nav-link" href="{{route('kasir.kelola-barang.masuk')}}">Barang Masuk</a>
            </li> --}}
            <li>
                <a class="nav-link" href="{{route('kasir.kelola-barang.stok')}}">Jumlah Stok Tersedia</a>
            </li>
        </ul>
    </li>
</ul>