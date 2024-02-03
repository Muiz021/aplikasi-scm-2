@extends('base')

@section('roles', 'Admin')
@section('title', 'pemesanan barang')

@section('content')
    @php
        use Carbon\Carbon;
    @endphp
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Pemesanan Barang</h6>
                    <div class="text-end py-2 pt-md-0">
                        <a href="{{ route('pemesanan-barang.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i>
                            Tambah Pemesanan Barang</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Waktu pemesanan</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemesanan_admin as $key => $item)
                                    <tr>
                                        <td>{{ $pemesanan_admin->firstItem() + $key }}</td>
                                        <td>{{ Carbon::parse($item->waktu_pemesanan)->isoFormat('dddd, DD MMMM YYYY') }}
                                        </td>
                                        <td>Rp.{{ number_format($item->total, 0, ',', '.') }},00</td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#show-pemesanan-barang-{{ $item->id }}">Detail</button>
                                                <button class="btn btn-sm btn-danger mx-2" data-bs-toggle="modal"
                                                    data-bs-target="#delete-pemesanan-barang-{{ $item->id }}">Hapus</button>
                                                <button class="btn btn-sm btn-info text-white bayar-id" data-bs-toggle="modal"
                                                    data-bs-target="#bayar-pemesanan-barang-{{ $item->id }}"
                                                    onclick="ambilNilai('{{ $item->id }}')">Bayar</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="left">
                            Showing {{ $pemesanan_admin->firstItem() }} of {{ $pemesanan_admin->lastItem() }}
                        </div>
                        <div class="right">
                            {{ $pemesanan_admin->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages.order-admin.modal')
    </div>
    @push('script')

        {{-- store pembayaran --}}
        <script>
              function ambilNilai(nilai) {
                $('#pemesanan_admin_id').val(nilai);
                }

            $(document).ready(function() {

                // Ambil count kode_barang saat halaman dimuat
                $.get('/admin/data-transaksi/get_kode_pembayaran', function(data) {

                    $('#kode_bayar').val(data.kode_pembayaran);

                    // mengambil value metode pembayaran
                    $('#metode_pembayaran').change(function() {
                        var metode_pembayaran = $(this).val();
                        // memasukan value metode pembayaran
                        $('#metode_bayar').val(metode_pembayaran);
                    });

                    $('#bayar').on('click', function() {
                        $('#metode_pembayaran').trigger('change');
                        // Mendapatkan value metode_pembayaran dari input hidden
                        var metode_pembayaran = $('#metode_bayar').val();

                        $.ajax({
                            url: '{{ route('pembayaran.store') }}',
                            type: 'POST',
                            data: {
                                pemesanan_admin_id:$('#pemesanan_admin_id').val(),
                                metode_pembayaran: metode_pembayaran,
                                kode_bayar: $('#kode_bayar').val(),
                            },
                            dataType: 'json', // Specify the expected data type of the response
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content') // Add CSRF token
                            },
                            success: function(response) {
                                console.log(response);
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        });
                    });
                });
            });
        </script>
        {{-- end store pembayaran --}}
    @endpush
@endsection
