@extends('base')

@section('roles', 'Konsumen')
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
                        <a href="{{ route('pemesanan-barang-konsumen.create') }}" class="btn btn-primary"><i
                                class="bi bi-plus"></i>
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
                                @foreach ($pemesanan_konsumen as $key => $item)
                                    <tr>
                                        <td>{{ $pemesanan_konsumen->firstItem() + $key }}</td>
                                        <td>{{ Carbon::parse($item->waktu_pemesanan)->isoFormat('dddd, DD MMMM YYYY') }}
                                        </td>
                                        <td>Rp.{{ number_format($item->total, 0, ',', '.') }},00</td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#edit-merek-barang-{{ $item->id }}">Detail</button>
                                                <button class="btn btn-sm btn-danger mx-2" data-bs-toggle="modal"
                                                    data-bs-target="#delete-pemesanan-barang-{{ $item->id }}">Hapus</button>
                                                <button class="btn btn-sm btn-info text-white bayar-id"
                                                    data-bs-toggle="modal"
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
                            Showing {{ $pemesanan_konsumen->firstItem() }} of {{ $pemesanan_konsumen->lastItem() }}
                        </div>
                        <div class="right">
                            {{ $pemesanan_konsumen->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages.order-konsumen.modal')
    </div>
    @push('script')
        {{-- value kode pembayaran --}}
        <script>
            $(document).ready(function() {
                // Ambil count kode_barang saat halaman dimuat
                $.get('/konsumen/data-transaksi/get_kode_pembayaran', function(data) {

                    // Fungsi untuk menghitung jumlah elemen dalam array
                    function countArrayElements(array) {
                        return array.length;
                    }

                    var jumlah_data = countArrayElements(data.pembayaran);

                    if (data.jp > 0) {
                        if (jumlah_data == data.jp) {
                            $('#kode_pembayaran').text('KB' + (data.jp + 2).toString().padStart(3, '0'));
                        } else {
                            $('#kode_pembayaran').text('KB' + (data.jp + 1).toString().padStart(3, '0'));
                        }
                    } else {
                        $('#kode_pembayaran').text('KB001');
                    }
                });
            });
        </script>
        {{-- end value kode pembayaran --}}

        {{-- store pembayaran --}}
        <script>
            function ambilNilai(nilai) {
                $('#pemesanan_konsumen_id').val(nilai);
            }

            $(document).ready(function() {

                // Ambil count kode_barang saat halaman dimuat
                $.get('/konsumen/data-transaksi/get_kode_pembayaran', function(data) {

                    // Fungsi untuk menghitung jumlah elemen dalam array
                    function countArrayElements(array) {
                        return array.length;
                    }

                    var jumlah_data = countArrayElements(data.pembayaran);

                    if (data.jp > 0) {
                        if (jumlah_data === data.jp) {
                            $('#kode_bayar').val('KB' + (data.jp + 2).toString().padStart(3, '0'));
                        } else {
                            $('#kode_bayar').val('KB' + (data.jp + 1).toString().padStart(3, '0'));
                        }
                    } else {
                        $('#kode_bayar').val('KB' + '001');
                    }

                    // mengambil value metode pembayaran
                    $('#metode_pembayaran').change(function() {
                        var metode_pembayaran = $(this).val();
                        // memasukan value metode pembayaran
                        $('#metode_bayar').val(metode_pembayaran);
                        console.log('Metode Pembayaran:', $('#metode_bayar').val());
                    });

                    $('#bayar').on('click', function() {
                        $('#metode_pembayaran').trigger('change');
                        // Mendapatkan value metode_pembayaran dari input hidden
                        var metode_pembayaran = $('#metode_pembayaran').val();


                        $.ajax({
                            url: '{{ route('pembayaran-konsumen.store') }}',
                            type: 'POST',
                            data: {
                                pemesanan_konsumen_id: $('#pemesanan_konsumen_id').val(),
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
