@extends('base')

@section('roles', 'Admin')
@section('title', 'konsumen')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Konsumen</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($supplier as $key => $item)
                                    <tr>
                                        <td>{{ $supplier->firstItem() + $key }}</td>
                                        <td>{{ $item->supplier->nama }}</td>
                                        <td>{{ $item->supplier->email }}</td>
                                        <td>
                                            @if ($item->status == true)
                                           <span class="text-success fw-bold">Konfirmasi</span>
                                           @else
                                           <span class="text-warning fw-bold">Belum konfirmasi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-sm btn-info text-white me-2" data-bs-toggle="modal"
                                                    data-bs-target="#show-supplier-{{ $item->id }}">Show</button>
                                                <button class="btn btn-sm btn-success me-2" data-bs-toggle="modal"
                                                    data-bs-target="#edit-supplier-{{ $item->id }}">Edit</button>
                                                <button class="btn btn-sm btn-danger me-2" data-bs-toggle="modal"
                                                    data-bs-target="#delete-supplier-{{ $item->id }}">Delete</button>
                                                    @if ($item->status != true)
                                                    <form action="{{route('konfirmasi_supplier',$item->id)}}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <button type="submit" class="btn btn-sm btn-secondary">Konfirmasi</button>
                                                    </form>
                                                    @endif
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
                            Showing {{ $supplier->firstItem() }} of {{ $supplier->lastItem() }}
                        </div>
                        <div class="right">
                            {{ $supplier->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages.supplier.modal')
    </div>
@endsection
