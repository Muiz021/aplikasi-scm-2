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
                    <h6 class="mb-4">Pembayaran Barang</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Waktu pembayaran</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemesanan_konsumen as $key => $item)
                                    <tr>
                                        <td>{{ $pemesanan_konsumen->firstItem() + $key }}</td>
                                        <td>{{ Carbon::parse($item->waktu_pemesanan)->isoFormat('dddd, DD MMMM YYYY') }}
                                        </td>
                                        <td>Rp.{{ number_format($item->total, 0, ',', '.') }},00</td>
                                        @if ($item->status == 'selesai')
                                            <td class="text-success fw-bold">Selesai</td>
                                        @elseif ($item->status == 'proses')
                                            <td class="text-warning fw-bold">Proses</td>
                                        @else
                                            <td class="text-danger fw-bold">Gagal</td>
                                        @endif
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-sm btn-info text-white me-2" data-bs-toggle="modal"
                                                    data-bs-target="#show-struk-{{ $item->id }}">Show</button>
                                                @if (Auth::user()->roles == 'konsumen')
                                                    <button class="btn btn-sm btn-danger me-2" data-bs-toggle="modal"
                                                        data-bs-target="#delete-pemesanan-barang-{{ $item->id }}">Hapus</button>
                                                @endif
                                                @if (Auth::user()->roles == 'konsumen' && $item->pembayaran === null)
                                                    <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
                                                        data-bs-target="#upload-struk-{{ $item->id }}">Upload
                                                        Struk</button>
                                                @endif
                                                @if (Auth::user()->roles == 'admin' && $item->status == 'proses')
                                                    <button class="btn btn-sm btn-success text-white" data-bs-toggle="modal"
                                                        data-bs-target="#edit-struk-{{ $item->id }}">Edit</button>
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
                            Showing {{ $pemesanan_konsumen->firstItem() }} of {{ $pemesanan_konsumen->lastItem() }}
                        </div>
                        <div class="right">
                            {{ $pemesanan_konsumen->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages.pembayaran-konsumen.modal')
    </div>
@endsection
