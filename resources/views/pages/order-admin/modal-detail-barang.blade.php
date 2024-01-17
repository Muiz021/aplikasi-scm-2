{{-- create --}}
<div class="modal fade" id="add-detail-pemesanan-barang" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pemesanan Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('detail_pemesanan_barang.store') }}" method="POST">
                @csrf
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end create --}}
