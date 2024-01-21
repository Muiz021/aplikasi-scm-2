<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="@if (Auth::user()->roles == 'admin') {{ route('dashboard.admin') }}
            @elseif(Auth::user()->roles == 'supplier')
            {{ route('dashboard.supplier') }}
            @else
            {{ route('dashboard.konsumen') }} @endif"
            class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('img/user.jpg') }}" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">
                    @if (Auth::user()->roles == 'admin')
                        admin
                    @elseif(Auth::user()->roles == 'supplier')
                        {{ Auth::user()->supplier->nama }}
                    @else
                        {{ Auth::user()->konsumen->nama }}
                    @endif
                </h6>
                <span>{{ Auth::user()->roles }}</span>
            </div>
        </div>

        <div class="navbar-nav w-100">
            {{-- roles admin --}}
            @if (Auth::user()->roles === 'admin')
                <a href="{{ route('dashboard.admin') }}"
                    class="nav-item nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}"><i
                        class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <div class="nav-item dropdown">
                    <a href="#"
                        class="nav-link {{ request()->is('admin/master/data_barang', 'admin/master/jenis_barang', 'admin/master/merek_barang') ? 'active' : '' }} dropdown-toggle show"
                        data-bs-toggle="dropdown" aria-expanded="true"><i class="fa fa-th me-2"></i></i>Master</a>
                    <div class="dropdown-menu bg-transparent border-0 show" data-bs-popper="none">
                        <a href="{{ route('admin.data_barang.index') }}"
                            class="dropdown-item {{ request()->is('admin/master/data_barang*') ? 'active' : '' }}">Data
                            Barang</a>
                        <a href="{{ route('admin.jenis_barang.index') }}"
                            class="dropdown-item {{ request()->is('admin/master/jenis_barang*') ? 'active' : '' }}">Jenis
                            Barang</a>
                        <a href="{{ route('admin.merek_barang.index') }}"
                            class="dropdown-item {{ request()->is('admin/master/merek_barang*') ? 'active' : '' }}">Merek
                            Barang</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#"
                        class="nav-link {{ request()->is('admin/data-transaksi*') ? 'active' : '' }} dropdown-toggle show"
                        data-bs-toggle="dropdown" aria-expanded="true"><i class="fas fa-dollar-sign me-2"></i>Data
                        transaksi</a>
                    <div class="dropdown-menu bg-transparent border-0 show" data-bs-popper="none">
                        <a href="{{ route('pemesanan-barang.index') }}"
                            class="dropdown-item {{ request()->is('admin/data-transaksi/pemesanan-barang*') ? 'active' : '' }}">Pemesanan
                            ke supplier</a>
                        <a href="{{ route('pembayaran.index') }}"
                            class="dropdown-item {{ request()->is('admin/data-transaksi/pembayaran*') ? 'active' : '' }}">Pembayaran
                            ke supplier</a>
                        <a href="#" class="dropdown-item">Transaksi barang masuk</a>
                        <a href="#" class="dropdown-item">Transaksi barang keluar</a>
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#"
                        class="nav-link {{ request()->is('admin/pengguna*') ? 'active' : '' }} dropdown-toggle show"
                        data-bs-toggle="dropdown" aria-expanded="true"><i class="fas fa-user me-2"></i>Data
                        Pengguna</a>
                    <div class="dropdown-menu bg-transparent border-0 show" data-bs-popper="none">
                        <a href="{{ route('konsumen.index') }}"
                            class="dropdown-item {{ request()->is('admin/pengguna/konsumen*') ? 'active' : '' }}">Konsumen</a>
                        <a href="{{ route('supplier.index') }}"
                            class="dropdown-item {{ request()->is('admin/pengguna/supplier*') ? 'active' : '' }}">Supplier</a>
                    </div>
                </div>
            @endif
            {{-- end roles admin --}}


            {{-- roles supplier --}}
            @if (Auth::user()->roles === 'supplier')
                <a href="{{ route('dashboard.supplier') }}"
                    class="nav-item nav-link {{ request()->is('supplier/dashboard') ? 'active' : '' }}"><i
                        class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

                <div class="nav-item dropdown">
                    <a href="#"
                        class="nav-link {{ request()->is('supplier/data_barang', 'supplier/jenis_barang', 'supplier/merek_barang') ? 'active' : '' }} dropdown-toggle show"
                        data-bs-toggle="dropdown" aria-expanded="true"><i class="fa fa-th me-2"></i></i>Master</a>
                    <div class="dropdown-menu bg-transparent border-0 show" data-bs-popper="none">
                        <a href="{{ route('data_barang.index') }}"
                            class="dropdown-item {{ request()->is('supplier/data_barang*') ? 'active' : '' }}">Data
                            Barang</a>
                        <a href="{{ route('jenis_barang.index') }}"
                            class="dropdown-item {{ request()->is('supplier/jenis_barang*') ? 'active' : '' }}">Jenis
                            Barang</a>
                        <a href="{{ route('merek_barang.index') }}"
                            class="dropdown-item {{ request()->is('supplier/merek_barang*') ? 'active' : '' }}">Merek
                            Barang</a>
                    </div>
                </div>

                <a href="{{ route('admin.pembayaran.index') }}"
                    class="nav-item nav-link {{ request()->is('supplier/pembayaran*') ? 'active' : '' }}"><i
                        class="fas fa-dollar-sign me-2"></i>Pembayaran</a>
            @endif
            {{-- end roles supplier --}}

            {{-- roles konsumen --}}
            @if (Auth::user()->roles == 'konsumen')
                <a href="{{ route('dashboard.supplier') }}"
                    class="nav-item nav-link {{ request()->is('supplier/dashboard') ? 'active' : '' }}"><i
                        class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

                <div class="nav-item dropdown">
                    <a href="#"
                        class="nav-link {{ request()->is('konsumen/data-transaksi*') ? 'active' : '' }} dropdown-toggle show"
                        data-bs-toggle="dropdown" aria-expanded="true"><i class="fas fa-dollar-sign me-2"></i>Data
                        transaksi</a>
                    <div class="dropdown-menu bg-transparent border-0 show" data-bs-popper="none">
                        <a href="{{ route('pemesanan-barang-konsumen.index') }}"
                            class="dropdown-item {{ request()->is('konsumen/data-transaksi/pemesanan-barang-konsumen*') ? 'active' : '' }}">Pemesanan
                            ke admin</a>
                        <a href="{{ route('pembayaran.index') }}"
                            class="dropdown-item {{ request()->is('konsumen/data-transaksi/pembayaran*') ? 'active' : '' }}">Pembayaran
                            ke admin</a>
                        <a href="#" class="dropdown-item">Transaksi barang masuk</a>
                        <a href="#" class="dropdown-item">Transaksi barang keluar</a>
                    </div>
                </div>
            @endif
            {{-- end roles konsumen --}}
        </div>
    </nav>
</div>
