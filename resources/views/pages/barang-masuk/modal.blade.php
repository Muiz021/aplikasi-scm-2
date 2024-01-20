{{-- edit --}}
@foreach ($barang_masuk as $item)
    <div class="modal fade" id="edit-barang-masuk-{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Barang Masuk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('barang_masuk.update', $item->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <img src="{{ asset(Str::replace(url('/') . '/img/barang/', '', '/img/barang/' .  $item->data_barang->foto_barang)) }}"
                                    alt="" class="w-100">
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Kode Supplier</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->supplier->kode_supplier }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Supplier</label>
                                    <input type="text" class="form-control" value="{{ $item->supplier->nama }}"
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kode barang</label>
                                    <input type="text" class="form-control" value="{{ $item->kode_barang }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama barang</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->data_barang->nama_barang }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis barang</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->data_barang->jenis_barang->nama }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Merek barang</label>
                                    <input type="text" class="form-control"
                                        value="{{ $item->data_barang->merek_barang->nama }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal masuk</label>
                                        <input type="date" class="form-control" value="{{ $item->tanggal_masuk }}" name="tanggal_masuk">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah barang</label>
                                        <input type="text" class="form-control" value="{{ $item->jumlah }}" name="jumlah">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select form-select mb-3" name="status" required>
                                        <option value="perjalanan" {{$item->status == 'perjalanan' ? 'selected' : ''}}>Perjalanan</option>
                                        <option value="sampai" {{$item->status == 'sampai' ? 'selected' : ''}}>Sampai</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
{{-- end edit --}}

{{-- show --}}
@foreach ($barang_masuk as $item)
    <div class="modal fade" id="show-barang-masuk-{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Barang Masuk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <img src="{{ asset(Str::replace(url('/') . '/img/barang/', '', '/img/barang/' .  $item->data_barang->foto_barang)) }}"
                                alt="" class="w-100">
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Kode Supplier</label>
                                <input type="text" class="form-control" value="{{ $item->supplier->kode_supplier }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Supplier</label>
                                <input type="text" class="form-control" value="{{ $item->supplier->nama }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kode barang</label>
                                <input type="text" class="form-control" value="{{ $item->kode_barang }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama barang</label>
                                <input type="text" class="form-control"
                                    value="{{ $item->data_barang->nama_barang }}" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis barang</label>
                                <input type="text" class="form-control"
                                    value="{{ $item->data_barang->jenis_barang->nama }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Merek barang</label>
                                <input type="text" class="form-control"
                                    value="{{ $item->data_barang->merek_barang->nama }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah barang</label>
                                <input type="text" class="form-control" value="{{ $item->jumlah }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal masuk</label>
                                <input type="text" class="form-control" value="{{ $item->tanggal_masuk }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <input type="text" class="form-control" value="{{ $item->status }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
{{-- end show --}}

{{-- delete --}}
@foreach ($barang_masuk as $item)
<div class="modal fade" id="delete-barang-masuk-{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Barang Masuk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('barang_masuk.destroy', $item->id) }}" method="POST">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="mb-3">
                            <p>Apakah kamu ingin menghapus data barang masuk <b>{{ $item->data_barang->nama_barang }}</b> ?</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
{{-- end delete --}}
