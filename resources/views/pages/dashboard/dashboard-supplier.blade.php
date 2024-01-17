@extends('base')

@section('roles', 'Supplier')
@section('title', 'dashboard')

@section('content')
@include('sweetalert::alert')

    {{-- profil --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <div class="col-12">
                    <h6 class="text-uppercase">Profil {{ $user->supplier->nama }}</h6>
                    <div class="d-flex">
                        <div class="col-6 me-3">
                            <div class="mb-3">
                                <label class="form-label fw-bold">username</label>
                                <input type="text" class="form-control" value="{{ $user->username }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">kode supplier</label>
                                <input type="text" class="form-control" value="{{ $user->supplier->kode_supplier }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">nama</label>
                                <input type="text" class="form-control" value="{{ $user->supplier->nama }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">email</label>
                                <input type="text" class="form-control" value="{{ $user->supplier->email }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">nomor ponsel</label>
                                <input type="text" class="form-control" value="{{ $user->supplier->nomor_ponsel }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">alamat</label>
                                <textarea name="alamat" id="" cols="30" rows="8" class="form-control" readonly>
                                    {{ $user->supplier->alamat }}
                                </textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#edit-profil-{{ $user->id }}">edit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end profil --}}

    <!-- data master -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Jenis Barang</p>
                        <h6 class="mb-0">{{ $jumlah_jenis_barang }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Merek Barang</p>
                        <h6 class="mb-0">{{ $jumlah_merek_barang }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Data Barang</p>
                        <h6 class="mb-0">{{ $jumlah_data_barang }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end data master -->

    {{-- modal profil --}}
    {{-- create --}}
<div class="modal fade" id="edit-profil-{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('profil-supplier.update',$user->id)}}" method="post">
                @csrf
                @method('put')
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <div class="col-12">
                        <h6 class="text-uppercase">Profil {{ $user->supplier->nama }}</h6>
                        <div class="d-flex">
                            <div class="col-6 me-3">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">username</label>
                                    <input type="text" class="form-control" value="{{ $user->username }}" name="username">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">password</label>
                                    <input type="text" class="form-control" name="password">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">kode supplier</label>
                                    <input type="text" class="form-control" value="{{ $user->supplier->kode_supplier }}"
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">nama</label>
                                    <input type="text" class="form-control" value="{{ $user->supplier->nama }}" name="nama">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">email</label>
                                    <input type="text" class="form-control" value="{{ $user->supplier->email }}"
                                        name="email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">nomor ponsel</label>
                                    <input type="text" class="form-control" value="{{ $user->supplier->nomor_ponsel }}"
                                       name="nomor_ponsel" >
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">alamat</label>
                                    <textarea name="alamat" id="" cols="30" rows="5" class="form-control" >
                                        {{ $user->supplier->alamat }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end create --}}
    {{-- end modal profil --}}
@endsection
