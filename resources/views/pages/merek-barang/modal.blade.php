{{-- create --}}
<div class="modal fade" id="add-merek-barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Merek Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('merek_barang.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Masukan nama merek barang"
                            name="nama" value="{{ old('nama') }}">
                            <label for="exampleInputEmail1" class="form-label">Nama</label>
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
@foreach ($merek_barang as $data)
<div class="modal fade" id="edit-merek-barang-{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Jenis Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('merek_barang.update',$data->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" placeholder="Masukan nama jenis barang"
                            name="nama" value="{{ $data->nama }}">
                            <label for="exampleInputEmail1" class="form-label">Nama</label>
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
@foreach ($merek_barang as $data)
<div class="modal fade" id="delete-merek-barang-{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Merek Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('merek_barang.destroy',$data->id) }}" method="POST">
                @csrf
                @method('delete')
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="mb-3">
                            <p>Apakah kamu ingin menghapus jenis barang <b>{{$data->nama}}</b> ?</p>
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
