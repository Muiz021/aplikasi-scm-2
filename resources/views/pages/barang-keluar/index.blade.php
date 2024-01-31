@extends('base')

@if (Auth::user()->roles == 'konsumen')
    @section('roles', 'konsumen')
@else
    @section('roles', 'admin')
@endif

@section('title', 'pembayaran barang')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Barang Keluar</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Konsumen</th>
                                    <th scope="col">Nama Konsumen</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Jenis Barang</th>
                                    <th scope="col">Merek Barang</th>
                                    <th scope="col">Jumlah Barang</th>
                                    <th scope="col">Status Barang</th>
                                    <th scope="col">Aksi Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $key => $item)
                                    <tr>
                                        <td>{{ $barang->firstItem() + $key }}</td>
                                        <td>{{ $item->konsumen->kode_konsumen }}</td>
                                        <td>{{ $item->konsumen->nama }}</td>
                                        <td>{{ $item->kode_barang }}</td>
                                        <td>{{ $item->barang_masuk->data_barang->nama_barang }}
                                        </td>
                                        <td>{{ $item->barang_masuk->data_barang->jenis_barang->nama }}</td>
                                        <td>{{ $item->barang_masuk->data_barang->merek_barang->nama }}</td>
                                        <td>{{ $item->jumlah }}
                                        </td>
                                        @if ($item->status == 'sampai')
                                            <td class="text-success fw-bold">sampai</td>
                                        @elseif ($item->status == 'perjalanan')
                                            <td class="text-warning fw-bold">perjalanan</td>
                                        @endif
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-sm btn-info text-white me-2" data-bs-toggle="modal"
                                                    data-bs-target="#show-barang-{{ $item->id }}">Show</button>
                                                @if (Auth::user()->roles == 'konsumen' && $item->status == 'perjalanan')
                                                    <button class="btn btn-sm btn-danger me-2" data-bs-toggle="modal"
                                                        data-bs-target="#delete-barang-{{ $item->id }}">Hapus</button>
                                                @endif
                                                @if (Auth::user()->roles == 'konsumen' && $item->status == 'perjalanan')
                                                    <button class="btn btn-sm btn-success text-white" data-bs-toggle="modal"
                                                        data-bs-target="#edit-barang-{{ $item->id }}">Edit</button>
                                                @endif


                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="left">
                            Showing {{ $barang->firstItem() }} of {{ $barang->lastItem() }}
                        </div>
                        <div class="right">
                            {{ $barang->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages.barang-keluar.modal')
    </div>
@endsection
