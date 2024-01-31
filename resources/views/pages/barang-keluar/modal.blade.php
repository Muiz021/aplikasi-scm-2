@foreach ($barang as $data)
    <div class="modal fade" id="delete-barang-{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pemesanan Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('destroy.barang.keluar', $data->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="mb-3">
                                <p>Apakah kamu ingin menghapus pemesanan barang <b>{{ $data->kode_barang }}</b> ?</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@foreach ($barang as $data)
    <div class="modal fade" id="show-barang-{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Barang Keluar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-center row">
                            <div class="col-md-12">
                                <div class="p-3 bg-white rounded">

                                    <div class="text-center">
                                        <img src="{{ asset(Str::replace(url('/') . '/img/barang/', '', '/img/barang/' . $data->barang_masuk->data_barang->foto_barang)) }}"
                                            alt="" width="500">
                                    </div>

                                    <div class="row mt-3">

                                        <div class="col-md-6">
                                            <div class="mt-3">
                                                <label class="form-label">Kode Konsumen</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->konsumen->kode_konsumen }}" readonly>
                                            </div>

                                            <div class="mt-3">
                                                <label class="form-label">Nama Konsumen</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->konsumen->nama }}" readonly>
                                            </div>
                                            <div class="mt-3">
                                                <label class="form-label">Kode Barang</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->kode_barang }}" readonly>
                                            </div>
                                            <div class="mt-3">
                                                <label class="form-label">Nama Barang</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->barang_masuk->data_barang->nama_barang }}"
                                                    readonly>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <!-- Details on the Right -->
                                            <div class="mt-3">
                                                <label class="form-label">Jenis Barang</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->barang_masuk->data_barang->jenis_barang->nama }}"
                                                    readonly>
                                            </div>
                                            <div class="mt-3">
                                                <label class="form-label">Merek Barang</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->barang_masuk->data_barang->merek_barang->nama }}"
                                                    readonly>
                                            </div>
                                            <div class="mt-3">
                                                <label class="form-label">Jumlah Barang</label>
                                                <input type="text" class="form-control" value="{{ $data->jumlah }}"
                                                    readonly>
                                            </div>
                                            <div class="mt-3">
                                                <label class="form-label">Tanggal Keluar</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->tanggal_keluar }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <label class="form-label">Status</label>
                                            <input type="text" class="form-control" value="{{ $data->status }}"
                                                readonly>
                                        </div>
                                        <div class="text-right mt-4">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endforeach

{{-- edit --}}
@foreach ($barang as $data)
    <div class="modal fade" id="edit-barang-{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Barang Keluar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-center row">
                            <div class="col-md-12">
                                <div class="p-3 bg-white rounded">

                                    <div class="text-center">
                                        <img src="{{ asset(Str::replace(url('/') . '/img/profile/', '', '/img/profile/' . $data->barang_masuk->data_barang->foto_barang)) }}"
                                            alt="" width="500">
                                    </div>

                                    <div class="row mt-3">

                                        <div class="col-md-6">
                                            <div class="mt-3">
                                                <label class="form-label">Kode Konsumen</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->konsumen->kode_konsumen }}" readonly>
                                            </div>

                                            <div class="mt-3">
                                                <label class="form-label">Nama Konsumen</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->konsumen->nama }}" readonly>
                                            </div>
                                            <div class="mt-3">
                                                <label class="form-label">Kode Barang</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->kode_barang }}" readonly>
                                            </div>
                                            <div class="mt-3">
                                                <label class="form-label">Nama Barang</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->barang_masuk->data_barang->nama_barang }}"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Details on the Right -->
                                            <div class="mt-3">
                                                <label class="form-label">Jenis Barang</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->barang_masuk->data_barang->jenis_barang->nama }}"
                                                    readonly>
                                            </div>
                                            <div class="mt-3">
                                                <label class="form-label">Merek Barang</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->barang_masuk->data_barang->merek_barang->nama }}"
                                                    readonly>
                                            </div>
                                            <div class="mt-3">
                                                <label class="form-label">Jumlah Barang</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->jumlah }}" readonly>
                                            </div>
                                            <div class="mt-3">
                                                <label class="form-label">Tanggal Keluar</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $data->tanggal_keluar }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <form action="{{ route('update_status_barang_keluar', $data->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('put')
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status Pembayaran</label>
                                                    <select class="form-select form-select mb-3" name="status">
                                                        <option value="" selected>Silahkan pilih</option>
                                                        <option value="sampai">sampai</option>
                                                    </select>
                                                </div>


                                        </div>
                                        <div class="text-right mt-4">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button class="btn btn-primary" type="submit">Simpan</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endforeach
