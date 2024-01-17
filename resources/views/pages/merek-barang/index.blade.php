@extends('base')

@section('roles', 'Supplier')
@section('title', 'merek barang')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Merek Barang</h6>
                    @if (Auth::user()->roles == 'supplier')
                    <div class="text-end py-2 pt-md-0">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-merek-barang"><i
                                class="bi bi-plus"></i> Tambah Merek Barang</button>
                            </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    @if (Auth::user()->roles == 'supplier')
                                    <th scope="col">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($merek_barang as $key => $item)
                                    <tr>
                                        <td>{{ $merek_barang->firstItem() + $key }}</td>
                                        <td>{{ $item->nama }}</td>
                                        @if (Auth::user()->roles == 'supplier')
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-success me-2" data-bs-toggle="modal"
                                                    data-bs-target="#edit-merek-barang-{{ $item->id }}">Edit</button>
                                                <button class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#delete-merek-barang-{{ $item->id }}">Delete</button>
                                            </div>
                                        </td>
                                        @endif
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
                            Showing {{$merek_barang->firstItem()}} of {{$merek_barang->lastItem()}}
                        </div>
                        <div class="right">
                            {{ $merek_barang->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages.merek-barang.modal')
    </div>
@endsection
