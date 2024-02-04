@extends('base')

@section('roles', 'konsumen')
@section('title', 'pemesanan barang')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">

        <div class="bg-light rounded h-100 p-0 p-lg-4">
            <div class="row g-4">
                <h6 class="mb-4">list Barang</h6>
                @forelse ($data_barang as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card shadow-sm">
                            <img src="{{ asset(Str::replace(url('/') . '/img/barang/', '', '/img/barang/' . $item->data_barang->foto_barang)) }}"
                                width="100%" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->data_barang->nama_barang }}</h5>
                                <p class="card-text my-0">
                                    Rp.{{ number_format($item->data_barang->harga_barang, 0, ',', '.') }},00</p>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('pemesanan-barang-konsumen.order', $item->id) }}"
                                        class="btn btn-sm btn-primary text-white fw-semibold">Pesan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <h2 class="text-center">Data Kosong!</h2>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
