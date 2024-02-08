@extends('base')

@section('roles', 'Admin')
@section('title', 'barang supplier')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-0 p-lg-4">
        <div class="row g-4">
                <h6 class="mb-4">Barang Supplier</h6>
                @forelse ($data_barang as $item)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow-sm">
                        <img src="{{asset(Str::replace(url('/') . '/img/barang/', '', '/img/barang/' . $item->foto_barang))}}" width="100%" style="aspect-ratio:16/9;object-fit:cover;" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->nama_barang}}</h5>
                            <p class="card-text text-justify my-2">{{Str::limit($item->deskripsi,100)}}</p>
                            <div class="d-flex justify-content-between">
                                <span class="text-danger">Rp.{{ number_format($item->harga_barang, 0, ',', '.') }},00</span>
                                <a href="{{route('pemesanan-barang.order',$item->id)}}" class="btn btn-sm btn-primary text-white fw-semibold">Pesan</a>
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
