@extends('base')

@section('roles', 'konsumen')
@section('title', 'pemesanan barang')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
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
                                @foreach ($barangMasuk as $item)
                                    <option value="{{ $item->id }}">{{ $item->kode_barang }}</option>
                                @endforeach
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
                            <br>

                        </div>

                        <button type="submit" class="btn btn-primary" id="simpan_pemesanan_admin">Simpan</button>
                        <a href="{{ route('pemesanan-barang-konsumen.index') }}" class="btn btn-secondary">Tutup</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- Nilai kode barang --}}
    <script>
        $(document).ready(function() {
            // Ketika pilihan kode barang berubah
            $('#barang_masuk_id').change(function(e) {
                e.preventDefault();

                // Ambil nilai kode barang yang dipilih
                var selectedBarangId = $(this).val();

                $.ajax({
                    url: '/konsumen/data-transaksi/barang-masuk/' + selectedBarangId,
                    type: 'GET',
                    success: function(data) {
                        $('#nama_barang').val(data.data_barang.nama_barang);
                        $('#stok_barang').val(data.data.jumlah);
                        $('#harga_barang').val(data.data_barang.harga_barang);
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
