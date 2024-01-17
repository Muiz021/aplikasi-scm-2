@extends('base')

@section('roles', 'Admin')
@section('title', 'pemesanan barang')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Tambah Pemesanan Barang</h6>
                    <div class="mb-3">
                        <label class="form-label">Kode pemesanan</label>
                        <input type="text" class="form-control" placeholder="Masukan nama merek barang" id="kode-pemesanan"
                            readonly>
                    </div>
                    <form action="{{ route('pemesanan-barang.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kode_pesan" id="kode-pesan">
                        <div class="mb-3">
                            <label class="form-label">Supplier</label>
                            <select class="form-select form-select mb-3" name="supplier_id" id="supplier_id">
                                <option value="">Silahkan pilih</option>
                                @foreach ($supplier as $db)
                                    <option value="{{ $db->id }}">{{ $db->nama }}</option>
                                @endforeach
                            </select>
                            <label class="form-label">Kode barang</label>
                            <select class="form-select form-select mb-3" name="data_barang_id" id="data_barang_id">
                                <option value="">Silahkan pilih</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok Barang</label>
                            <input type="text" class="form-control" id="stok_barang" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="text" class="form-control" name="harga" id="harga_barang" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah beli</label>
                            <input type="text" class="form-control" name="jumlah">
                        </div>

                        <button type="submit" class="btn btn-primary" id="simpan_pemesanan_admin">Simpan</button>
                        <a href="{{route('pemesanan-barang.index')}}" class="btn btn-secondary">Tutup</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('pages.order-admin.modal-detail-barang') --}}
    </div>
    @push('script')
        {{-- nilai supplier --}}
        <script>
            $(document).ready(function() {
                $('#supplier_id').on('change', function() {
                    var supplierId = $(this).val(); // Mendapatkan nilai supplier_id yang dipilih

                    $.ajax({
                        url: '/admin/data-transaksi/get_supplier_data_barang',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            supplier_id: supplierId, // Menggunakan objek untuk menyampaikan data
                        },
                        success: function(data) {
                            // Mengosongkan dan menambahkan opsi baru ke dalam select data_barang_id
                            $('#data_barang_id').empty();
                            $('#data_barang_id').append('<option value="">Silahkan pilih</option>');

                            // Menambahkan opsi berdasarkan data yang diterima dari server
                            $.each(data, function(index, barang) {
                                $('#data_barang_id').append('<option value="' + barang.id +
                                    '">' +
                                    barang.kode_barang + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>
        {{-- end nilai supplier --}}

        {{-- nilai kode barang  --}}
        <script>
            $(document).ready(function() {
                // Ketika pilihan kode barang berubah
                $('#data_barang_id').change(function(e) {
                    e.preventDefault();

                    // Ambil nilai kode barang yang dipilih
                    var selectedBarangId = $(this).val();

                    $.ajax({
                        url: '/admin/data-transaksi/data-barang/' + selectedBarangId,
                        type: 'GET',
                        success: function(data) {
                            // Set nilai stok tersedia, harga, dan jumlah beli di dalam input
                            $('#nama_barang').val(data.nama_barang);
                            $('#stok_barang').val(data.stok_barang);
                            $('#harga_barang').val(data.harga_barang);
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                });
            });
        </script>
        {{-- end nilai kode barang  --}}


        {{-- kode pemesanan --}}
        <script>
            $(document).ready(function() {
                // Ambil count kode_barang saat halaman dimuat
                $.get('/admin/data-transaksi/get_pemesanan_admin', function(data) {

                    // Fungsi untuk menghitung jumlah elemen dalam array
                    function countArrayElements(array) {
                        return array.length;
                    }
                    var jumlah_data = countArrayElements(data.pa);

                    if (data.jpa > 0) {
                        if (jumlah_data === data.jpa) {
                            $('#kode-pemesanan').val('KP' + (data.jpa + 2));
                            $('#kode-pesan').val('KP' + (data.jpa + 2));
                        } else {
                            $('#kode-pemesanan').val('KP' + (data.jpa + 1));
                            $('#kode-pesan').val('KP' + (data.jpa + 1));
                        }
                    } else {
                        $('#kode-pemesanan').val('KP' + 1);
                        $('#kode-pesan').val('KP' + 1);
                    }
                });
            });
        </script>
        {{-- end kode pemesanan --}}

        {{-- update kode pemesanan dan status detail pemesanan barang --}}
        {{-- <script>
            $(document).ready(function() {
                $.get('/admin/data-transaksi/get_pemesanan_admin', function(data) {

                    // Fungsi untuk menghitung jumlah elemen dalam array
                    function countArrayElements(array) {
                        return array.length;
                    }

                    var jumlah_data = countArrayElements(data.pa);
                    var kode_pemesanan;

                    if (data.jpa > 0) {
                        if (jumlah_data === data.jpa) {
                            kode_pemesanan = 'KP' + (data.jpa + 2);
                            $('#kode-pesan').val(kode_pemesanan);
                        } else {
                            kode_pemesanan = 'KP' + (data.jpa + 1);
                            $('#kode-pesan').val(kode_pemesanan);
                        }
                    } else {
                        kode_pemesanan = 'KP' + 1;
                        $('#kode-pesan').val(kode_pemesanan);
                    }

                    $('#simpan_pemesanan_admin').on('click', function() {
                        $.ajax({
                            url: '{{ route('pemesanan-barang.store') }}',
                            type: 'POST',
                            data: {
                                kode_pesan: $('#kode-pesan').val(),
                                // Add other data parameters if needed
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
        </script> --}}
        {{-- end update kode pemesanan dan status detail pemesanan barang --}}
    @endpush
@endsection
