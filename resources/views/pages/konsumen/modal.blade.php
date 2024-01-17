{{-- edit --}}
@foreach ($konsumen as $item)
    <div class="modal fade" id="edit-konsumen-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Konsumen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">nama</label>
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ $item->konsumen->nama }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">status</label>
                                    <select class="form-select form-select mb-3" name="status" id="statusSelect">
                                        <option value="" selected>Silahkan pilih</option>
                                        <option value="1" {{$item->status == 1 ? 'selected' : ''}} >konfirmasi</option>
                                        <option value="0" {{$item->status == 0 ? 'selected' : ''}}>belum konfirmasi</option>

                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">email</label>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ $item->konsumen->email }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">nomor ponsel</label>
                                    <input type="text" class="form-control" name="nomor_ponsel"
                                        value="{{ $item->konsumen->nomor_ponsel }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">gambar sekarang</label>
                                    <img src="{{$item->konsumen->gambar}}" alt="">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">upload gambar</label>
                                    <input type="file" class="form-control" name="nomor_ponsel"
                                        value="{{ $item->konsumen->nomor_ponsel }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">alamat</label>
                                    <textarea rows="5" class="form-control">
                                        {{ $item->konsumen->alamat }}
                                    </textarea>
                                </div>
                            </div>
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
@endforeach
{{-- end edit --}}

{{-- show --}}
@foreach ($konsumen as $item)
    <div class="modal fade" id="show-konsumen-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Konsumen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">nama</label>
                                <input type="text" class="form-control" value="{{ $item->konsumen->nama }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">status</label>
                                <input type="text" class="form-control"
                                    value="{{ $item->status == 1 ? 'konfirmasi' : 'belum konfirmasi' }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">email</label>
                                <input type="text" class="form-control" value="{{ $item->konsumen->email }}"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">nomor ponsel</label>
                                <input type="text" class="form-control" value="{{ $item->konsumen->nomor_ponsel }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">gambar</label>
                                <a href="#" target="_BLANK"
                                    class="form-control btn btn-sm btn-primary bg-primary">
                                    gambar
                                </a>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">alamat</label>
                                <textarea rows="5" class="form-control" readonly>
                                    {{ $item->konsumen->alamat }}
                                </textarea>
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
@foreach ($konsumen as $data)
    <div class="modal fade" id="delete-konsumen-{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Data Konsumen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('konsumen.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="mb-3">
                                <p>Apakah kamu ingin menghapus data konsumen <b>{{ $data->konsumen->nama }}</b> ?</p>
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
{{-- end delete --}}
