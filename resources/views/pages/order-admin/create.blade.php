@extends('base')

@section('roles', 'Admin')
@section('title', 'pemesanan barang')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Supplier</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplier as $key => $item)
                                    <tr>
                                        <td>{{ $supplier->firstItem() + $key }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ Str::limit($item->lokasi, 50) }}</td>
                                        <td>
                                        <div class="d-flex">
                                            <a href="{{route('pemesanan-barang.list-item',$item->id)}}" class="btn btn-sm btn-info text-white me-2" >Show</a>
                                        </div>
                                        </td>
                                    </tr>
                                @endforeach
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
        {{-- <div class="row g-4">
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
                            <input type="number" class="form-control" name="stok_barang" id="stok_barang" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="text" class="form-control" name="harga" id="harga_barang" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah beli</label>
                            <input type="number" class="form-control" name="jumlah">
                        </div>

                        <button type="submit" class="btn btn-primary" id="simpan_pemesanan_admin">Simpan</button>
                        <a href="{{ route('pemesanan-barang.index') }}" class="btn btn-secondary">Tutup</a>

                    </form>
                </div>
            </div>
        </div> --}}
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
    @endpush
@endsection
