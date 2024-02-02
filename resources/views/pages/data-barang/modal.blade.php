{{-- create --}}
<div class="modal fade" id="add-data-barang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Data Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('data_barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Masukan nama kode barang"
                            name="kode_barang" id="kode_barang" readonly>
                            <label class="form-label">Kode barang</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="file" class="form-control" placeholder="Masukan foto data barang"
                            name="foto_barang" id="input-foto-barang" onchange="previewImage()" value="{{old('foto_barang')}}" required>
                            <label class="form-label">Foto barang</label>
                        </div>
                        <img src="" alt="{{ old('foto_barang') }}" width="100%" id="img-foto-barang"
                            style="aspect-ratio:16/9;object-fit:cover; margin-top: 10px; display: none;">
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Masukan nama data barang"
                            name="nama_barang" value="{{ old('nama_barang') }}" required>
                            <label class="form-label">Nama barang</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" name="deskripsi"  placeholder="masukan deskripsi barang" style="height: 150px;"></textarea>
                            <label for="floatingTextarea">Deskripsi barang</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <select class="form-select form-select mb-3" name="jenis_barang_id" required>
                                <option disabled>Silahkan pilih</option>
                                @foreach ($jenis_barang as $jb)
                                <option value="{{ $jb->id }}">{{ $jb->nama }}</option>
                                @endforeach
                            </select>
                            <label class="form-label">Jenis barang</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <select class="form-select form-select mb-3" name="merek_barang_id" required>
                                <option disabled>Silahkan pilih</option>
                                @foreach ($merek_barang as $mb)
                                <option value="{{ $mb->id }}">{{ $mb->nama }}</option>
                                @endforeach
                            </select>
                            <label class="form-label">Merek barang</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="number" class="form-control" placeholder="Masukan harga data barang"
                            name="harga_barang" value="{{ old('harga_barang') }}" required>
                            <label class="form-label">Harga barang</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="number" class="form-control" placeholder="Masukan stok data barang"
                            name="stok_barang" value="{{ old('stok_barang') }}" required>
                            <label class="form-label">Stok barang</label>
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
{{-- end create --}}

{{-- edit --}}
@foreach ($data_barang as $data)
    <div class="modal fade" id="edit-data-barang-{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('data_barang.update', $data->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Foto barang sekarang</label>
                            <img src="{{ asset(Str::replace(url('/') . '/img/barang/', '', '/img/barang/' . $data->foto_barang)) }}"
                                alt="{{ $data->foto_barang }}" id="img-foto-barang" width="100%"
                                style="aspect-ratio:16/9;object-fit:cover; margin-top: 10px;">
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Masukan nama kode barang"
                                name="kode_barang" value="{{ $data->kode_barang }}" readonly>
                                <label class="form-label">Kode barang</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="file" class="form-control" placeholder="Masukan foto data barang"
                                name="foto_barang" id="input-foto-barang" onchange="previewImage()">
                                <label class="form-label">Foto barang</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Masukan nama data barang"
                                name="nama_barang" value="{{ $data->nama_barang }}">
                                <label class="form-label">Nama barang</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <div class="form-floating">
                                    <textarea class="form-control" name="deskripsi"  placeholder="masukan deskripsi barang" style="height: 150px;">{{$data->deskripsi}}</textarea>
                                    <label for="floatingTextarea">Deskripsi barang</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select form-select mb-3" name="jenis_barang_id"
                                id="jenisBarangSelect">
                                <option disabled>Silahkan pilih</option>
                                @foreach ($jenis_barang->unique('nama') as $jb)
                                        <option value="{{ $jb->id }}">{{ $jb->nama }}</option>
                                    @endforeach
                                </select>
                                <label class="form-label">Jenis barang</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select form-select mb-3" name="merek_barang_id"
                                id="merekBarangSelect">
                                <option disabled>Silahkan pilih</option>
                                @foreach ($merek_barang->unique('nama') as $mb)
                                        <option value="{{ $mb->id }}">{{ $mb->nama }}</option>
                                        @endforeach
                                    </select>
                                    <label class="form-label">Merek barang</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="number" class="form-control" placeholder="Masukan harga data barang"
                                name="harga_barang" value="{{ $data->harga_barang }}">
                                <label class="form-label">Harga barang</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="number" class="form-control" placeholder="Masukan stok data barang"
                                name="stok_barang" value="{{ $data->stok_barang }}">
                                <label class="form-label">Stok barang</label>
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

{{-- delete --}}
@foreach ($data_barang as $data)
    <div class="modal fade" id="delete-data-barang-{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('data_barang.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="mb-3">
                                <p>Apakah kamu ingin menghapus data barang <b>{{ $data->nama_barang }}</b> ?</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
{{-- end delete --}}

{{-- show --}}
@foreach ($data_barang as $data)
    <div class="modal fade" id="show-data-barang-{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Masukan nama kode barang"
                                name="kode_barang" value="{{ $data->kode_barang }}" readonly>
                            <label>Kode barang</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto barang</label>
                        <img class=""
                        src="{{ asset(Str::replace(url('/') . '/img/barang/', '', '/img/barang/' . $data->foto_barang)) }}"
                        alt="{{ $data->foto_barang }}" id="img-foto-barang" width="100%"
                        style="aspect-ratio:16/9;object-fit:cover; margin-top: 10px;">
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Masukan nama data barang"
                            name="nama_barang" value="{{ $data->nama_barang }}" readonly>
                            <label class="form-label">Nama barang</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" name="deskripsi"  placeholder="masukan deskripsi barang" style="height: 150px;" readonly>{{$data->deskripsi}}</textarea>
                            <label class="form-label">Deskripsi barang</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <select class="form-select form-select mb-3" name="merek_barang_id"
                            id="jenisBarangSelectShow" disabled>
                                <option disabled>Silahkan pilih</option>
                                @foreach ($jenis_barang->unique('nama') as $jb)
                                <option value="{{ $jb->id }}">{{ $jb->nama }}</option>
                                @endforeach
                            </select>
                            <label class="form-label">Jenis barang</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <select class="form-select form-select mb-3" name="merek_barang_id"
                            id="merekBarangSelectShow" disabled>
                            <option disabled>Silahkan pilih</option>
                            @foreach ($merek_barang->unique('nama') as $mb)
                            <option value="{{ $mb->id }}">{{ $mb->nama }}</option>
                            @endforeach
                        </select>
                        <label class="form-label">Merek barang</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="number" class="form-control" placeholder="Masukan harga data barang"
                            name="harga_barang" value="{{ $data->harga_barang }}" readonly>
                            <label class="form-label">Harga barang</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="number" class="form-control" placeholder="Masukan stok data barang"
                            name="stok_barang" value="{{ $data->stok_barang }}" readonly>
                            <label class="form-label">Stok barang</label>
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
