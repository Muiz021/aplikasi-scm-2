@extends('base')

@section('roles', 'konsumen')
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
                    <form action="{{ route('pemesanan-barang-konsumen.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kode_pesan" id="kode-pesan">
                        <div class="mb-3">
                            <label class="form-label">Kode barang</label>
                            <select class="form-select form-select mb-3" name="barang_masuk_id" id="barang_masuk_id">
                                <option value="">Silahkan pilih</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" readonly>
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
                        <a href="{{ route('pemesanan-barang.index') }}" class="btn btn-secondary">Tutup</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- Ambil data barang masuk saat halaman dimuat --}}
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/konsumen/data-transaksi/get_barang_masuk',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Bersihkan opsi sebelum menambahkan yang baru
                    $('#barang_masuk_id').empty();
                    $('#barang_masuk_id').append('<option value="">Silahkan pilih</option>');
                    // Tambahkan opsi berdasarkan data yang diterima dari server
                    $.each(data, function(index, barangMasuk) {
                        $('#barang_masuk_id').append('<option value="' + barangMasuk.id +
                            '">' +
                            barangMasuk.kode_barang + '</option>'
                        );
                    });
                },

                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>

    {{-- Nilai kode barang --}}
    <script>
        $(document).ready(function() {
            // Ketika pilihan kode barang berubah
            $('#barang_masuk_id').change(function(e) {
                e.preventDefault();

                // Ambil nilai kode barang yang dipilih
                var selectedBarangId = $(this).val();
                console.log('Kode Barang yang Dipilih:', selectedBarangId);

                $.ajax({
                    url: '/konsumen/data-transaksi/data-barang/' + selectedBarangId,
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

    {{-- kode pemesanan --}}
    <script>
        $(document).ready(function() {
            // Ambil count kode_barang saat halaman dimuat
            $.get('/konsumen/data-transaksi/get_pemesanan_konsumen', function(data) {

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
@endpush
