@extends('base')

@section('roles', 'Admin')
@section('title', 'dashboard')

@section('content')

    {{-- profil --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <div class="col-12">
                    <h6 class="text-uppercase">Profil Admin</h6>
                    <div class="d-flex">
                        <div class="col-6 me-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold">username</label>
                                <input type="text" class="form-control" value="{{ $user->username }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">email</label>
                                <input type="text" class="form-control" value="admin@gmail.com" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">nomor ponsel</label>
                                <input type="text" class="form-control" value="081122334455" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">alamat</label>
                                <textarea name="alamat" id="" cols="30" rows="8" class="form-control" readonly>
                                Jl. Alauddin Makassar no 20
                            </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end profil --}}

    {{-- barang masuk dan keluar --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-sort-amount-up-alt fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"> Barang masuk</p>
                        <h6 class="mb-0">{{ $barang_masuk }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-sort-amount-down-alt fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"> Barang Keluar</p>
                        <h6 class="mb-0">{{ $barang_keluar }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end barang masuk dan keluar --}}

    {{-- data pengguna --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-user fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"> Konsumen</p>
                        <h6 class="mb-0">{{ $konsumen }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-user-tie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"> Supplier</p>
                        <h6 class="mb-0">{{ $supplier }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end data pengguna --}}

    {{-- data barang supplier --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-database fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Jenis Barang</p>
                        <h6 class="mb-0">{{ $jumlah_jenis_barang }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-database fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Merek Barang</p>
                        <h6 class="mb-0">{{ $jumlah_merek_barang }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-database fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Data Barang</p>
                        <h6 class="mb-0">{{ $jumlah_data_barang }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end data barang supplier --}}

    {{-- data transaksi --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"> Pemesanan Barang Admin</p>
                        <h6 class="mb-0">{{ $pemesanan_barang }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"> Pemesanan Barang Konsumen</p>
                        <h6 class="mb-0">{{ $pemesanan_barang }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end data transaksi --}}

    {{-- pembayaran --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"> Pembayaran Total</p>
                        <h6 class="mb-0">{{ $jumlah_pembayaran_total }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"> Pembayaran Selesai</p>
                        <h6 class="mb-0">{{ $jumlah_pembayaran_selesai }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"> Pembayaran Proses</p>
                        <h6 class="mb-0">{{ $jumlah_pembayaran_proses }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2"> Pembayaran Gagal</p>
                        <h6 class="mb-0">{{ $jumlah_pembayaran_gagal }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end pembayaran --}}
@endsection
