@extends('base')

@section('roles', 'konsumen')
<<<<<<< HEAD
@section('title', 'detail barang')
=======
@section('title', 'pemesanan barang')
>>>>>>> e7d66299ee13b67c18f0274731488a7d37000601

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Detail Barang</h6>
            <div class="row g-4">
<<<<<<< HEAD
                <div class="col-lg-4">
                    <img src="{{ asset(Str::replace(url('/') . '/img/barang/', '', '/img/barang/' . $barangMasuk->data_barang->foto_barang)) }}"
                        width="100%" style="aspect-ratio:9/16;object-fit:cover;" alt="">
                </div>
                <div class="col-12 col-lg-8">
                    <div class="top-text">
                        <h2 class="text-uppercase">{{ $barangMasuk->data_barang->nama_barang }}</h2>
                        <h4 class="text-danger">Rp.{{ number_format($barangMasuk->data_barang->harga_barang, 0, ',', '.') }},00</h4>
=======

                <div class="col-lg-4">

                    <img src="{{ asset(Str::replace(url('/') . '/img/barang/', '', '/img/barang/' . $data_barang->data_barang->foto_barang)) }}"
                        width="100%" style="aspect-ratio:9/16;object-fit:cover;" alt="">
                </div>

                <div class="col-12 col-lg-8">
                    <div class="top-text">
                        <h2 class="text-uppercase">{{ $data_barang->data_barang->nama_barang }}</h2>
                        <h4 class="text-danger">
                            Rp.{{ number_format($data_barang->data_barang->harga_barang, 0, ',', '.') }},00</h4>
>>>>>>> e7d66299ee13b67c18f0274731488a7d37000601
                    </div>

                    <div class="center-text my-3">
                        <h5 class="text-uppercase">Deskripsi</h5>
<<<<<<< HEAD
                        <p style="text-align: justify;">{{$barangMasuk->data_barang->deskripsi}}</p>
=======
                        <p style="text-align: justify;">{{ $data_barang->data_barang->deskripsi }}</p>
>>>>>>> e7d66299ee13b67c18f0274731488a7d37000601
                    </div>

                    <h5 class="text-uppercase">informasi detail</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th scope="col">Kode Barang</th>
<<<<<<< HEAD
                                    <th scope="col">{{ $barangMasuk->data_barang->kode_barang }}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Jenis Barang</th>
                                    <th scope="col">{{ $barangMasuk->data_barang->jenis_barang->nama }}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Merek Barang</th>
                                    <th scope="col">{{ $barangMasuk->data_barang->merek_barang->nama }}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Stok Barang</th>
                                    <th scope="col">{{ $barangMasuk->jumlah }}</th>
=======
                                    <th scope="col">{{ $data_barang->data_barang->kode_barang }}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Jenis Barang</th>
                                    <th scope="col">{{ $data_barang->data_barang->jenis_barang->nama }}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Merek Barang</th>
                                    <th scope="col">{{ $data_barang->data_barang->merek_barang->nama }}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Stok Barang</th>
                                    <th scope="col">{{ $data_barang->jumlah }}</th>
>>>>>>> e7d66299ee13b67c18f0274731488a7d37000601
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4 col-lg-4 mt-2 mt-lg-5 ms-auto">
                        <div class="d-flex">
<<<<<<< HEAD
                            <a href="{{route('pemesanan-barang-konsumen.create')}}" class="btn btn-secondary w-100 me-2">Kembali</a>
                            <button class="btn btn-danger text-white w-100" data-bs-toggle="modal"
                                data-bs-target="#pemesanan-barang-{{ $barangMasuk->id }}">Beli</button>
=======
                            <a href="{{ route('pemesanan-barang-konsumen.list') }}"
                                class="btn btn-secondary w-100 me-2">Kembali</a>
                            <button class="btn btn-danger text-white w-100" data-bs-toggle="modal"
                                data-bs-target="#pemesanan-barang-{{ $data_barang->id }}">Behli</button>
>>>>>>> e7d66299ee13b67c18f0274731488a7d37000601
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <div class="modal fade" id="pemesanan-barang-{{ $barangMasuk->id }}" tabindex="-1" aria-hidden="true">
=======
    <div class="modal fade" id="pemesanan-barang-{{ $data_barang->id }}" tabindex="-1" aria-hidden="true">
>>>>>>> e7d66299ee13b67c18f0274731488a7d37000601
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pemesanan Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
<<<<<<< HEAD
                <form action="{{route('pemesanan-barang-konsumen.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input class="form-control" type="hidden" name="id" value="{{$barangMasuk->id}}">
=======
                <form action="{{ route('pemesanan-barang-konsumen.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input class="form-control" type="hidden" name="id" value="{{ $data_barang->id }}">
>>>>>>> e7d66299ee13b67c18f0274731488a7d37000601
                        <div class="mb-3">
                            <label for="" class="form-label">Jumlah Pesanan</label>
                            <input class="form-control" type="number" name="jumlah" placeholder="masukan jumlah pesanan"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
