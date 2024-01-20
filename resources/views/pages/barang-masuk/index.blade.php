@extends('base')

@section('roles', 'Admin')
@section('title', 'barang masuk')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Barang Masuk</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Supplier</th>
                                    <th scope="col">Nama Supplier</th>
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
                                @forelse ($barang_masuk as $key => $item)
                                    <tr>
                                        <td>{{ $barang_masuk->firstItem() + $key }}</td>
                                        <td>{{ $item->supplier->kode_supplier }}</td>
                                        <td>{{ $item->supplier->nama }}</td>
                                        <td>{{ $item->data_barang->kode_barang }}</td>
                                        <td>{{ $item->data_barang->nama_barang }}</td>
                                        <td>{{ $item->data_barang->jenis_barang->nama }}</td>
                                        <td>{{ $item->data_barang->merek_barang->nama }}</td>
                                        <td>{{ $item->jumlah }}</td>
                                        <td>@if ($item->status == 'sampai')
                                            <span class="text-success">Sampai</span>
                                            @else
                                            <span class="text-warning">Perjalanan</span>
                                        @endif</td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-info text-white me-2" data-bs-toggle="modal"
                                                    data-bs-target="#show-barang-masuk-{{ $item->id }}">Show</button>
                                                    <button class="btn btn-success me-2" data-bs-toggle="modal"
                                                        data-bs-target="#edit-barang-masuk-{{ $item->id }}">Edit</button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#delete-barang-masuk-{{ $item->id }}">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Data Kosong!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="left">
                            Showing {{ $barang_masuk->firstItem() }} of {{ $barang_masuk->lastItem() }}
                        </div>
                        <div class="right">
                            {{ $barang_masuk->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages.barang-masuk.modal')
    </div>
@endsection
