@extends('base')

@section('roles', 'konsumen')
@section('title', 'pemesanan barang')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-0 p-lg-4">
        <div class="row g-4">
                <h6 class="mb-4">Barang Supplier</h6>
                @forelse ($barangMasuk as $item)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow-sm">
                        <img src="{{asset(Str::replace(url('/') . '/img/barang/', '', '/img/barang/' . $item->data_barang->foto_barang))}}" width="100%" style="aspect-ratio:16/9;object-fit:cover;" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->data_barang->nama_barang}}</h5>
                            <p class="card-text text-justify my-2">{{Str::limit($item->data_barang->deskripsi,100)}}</p>
                            <div class="d-flex justify-content-between">
                                <span class="text-danger">Rp.{{ number_format($item->data_barang->harga_barang, 0, ',', '.') }},00</span>
                                <a href="{{route('detail_item.konsumen',$item->id)}}" class="btn btn-sm btn-primary text-white fw-semibold">Pesan</a>
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

