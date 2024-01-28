@php
    use Carbon\Carbon;
@endphp
<style>
    .upload-input {
        border: 2px dashed #ccc;
        border-radius: 5px;
        padding: 10px;
        width: 200px;
    }

    .upload-input:hover {
        border-color: #aaa;
    }
</style>


{{-- upload struk pembayaran  --}}
@foreach ($pemesanan_admin as $data)
    <div class="modal fade" id="upload-struk-{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Struk Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-center row">
                            <div class="col-md-12">
                                <div class="p-3 bg-white rounded">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h1 class="text-uppercase">Invoice</h1>
                                            <div class="billed"><span
                                                    class="fw-bold text-uppercase text-dark">Tagihan:</span><span
                                                    class="ml-1"> Admin</span></div>
                                            <div class="billed"><span
                                                    class="fw-bold text-uppercase text-dark">Tanggal:</span><span
                                                    class="ml-1">
                                                    {{ Carbon::now()->isoFormat('dddd, DD MMMM YYYY') }}</span></div>
                                            <div class="billed"><span class="fw-bold text-uppercase text-dark">Kode
                                                    Bayar:</span>{{ $data->pembayaran->kode_pembayaran }}</div>
                                        </div>
                                        <div class="col-md-6 text-right mt-3">
                                            <h4 class="text-danger mb-0 text-uppercase">Supplier</h4>
                                            <span class="fw-bold text-dark">{{ $data->supplier->nama }}</span>
                                            <div class="mt-3">
                                                <label class="form-label">Metode pembayaran</label>
                                                <input type="text" class="form-control text-uppercase"
                                                    value="{{ $data->pembayaran->metode_pembayaran }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nama barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- @php
                                                        $total = 0;
                                                    @endphp
                                                    @forelse ($data->pemesanan_admin_detail as $item)
                                                        <tr>
                                                            <td>{{ $item->data_barang->nama_barang }}</td>
                                                            <td>{{ $item->jumlah }}</td>
                                                            <td>Rp.{{ number_format($item->harga, 0, ',', '.') }},00
                                                            </td>
                                                            <td>Rp.{{ number_format($item->harga * $item->jumlah, 0, ',', '.') }},00
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $total += $item->harga * $item->jumlah;
                                                        @endphp
                                                    @empty
                                                    @endforelse
                                                    <tr>
                                                        <th colspan="3">Total</th>
                                                        <th>
                                                            Rp.{{ number_format($total, 0, ',', '.') }},00</th>
                                                    </tr> --}}

                                                    <tr>
                                                        <td>{{ $data->data_barang->nama_barang }}</td>
                                                        <td>{{ $data->jumlah }}</td>
                                                        <td>{{ $data->data_barang->harga_barang }}</td>
                                                        <td>{{ $data->total }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <form action="{{ route('upload_struk_pembayaran', $data->pembayaran->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="upload-input w-50 text-center mx-auto my-3">
                                            <h4 for="gambar" class="w-100 text-uppercase">Upload Struk</h4>
                                            <input type="file" name="gambar" class="form-control">
                                        </div>
                                        <div class="text-right mb-3">
                                            <button class="btn btn-primary btn-sm mr-5" type="submit"
                                                id="bayar">Upload</button>
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
@endforeach
{{-- end upload struk pembayaran --}}

{{-- edit --}}
@foreach ($pemesanan_admin as $data)
    <div class="modal fade" id="edit-struk-{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Struk Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-center row">
                            <div class="col-md-12">
                                <div class="p-3 bg-white rounded">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h1 class="text-uppercase">Invoice</h1>
                                            <div class="billed"><span
                                                    class="fw-bold text-uppercase text-dark">Tagihan:</span><span
                                                    class="ml-1"> Admin</span></div>
                                            <div class="billed"><span
                                                    class="fw-bold text-uppercase text-dark">Tanggal:</span><span
                                                    class="ml-1">
                                                    {{ Carbon::now()->isoFormat('dddd, DD MMMM YYYY') }}</span></div>
                                            <div class="billed"><span class="fw-bold text-uppercase text-dark">Kode
                                                    Bayar:</span>{{ $data->pembayaran->kode_pembayaran }}</div>
                                        </div>
                                        <div class="col-md-6 text-right mt-3">
                                            <h4 class="text-danger mb-0 text-uppercase">Supplier</h4>
                                            <span class="fw-bold text-dark">{{ $data->supplier->nama }}</span>
                                            <div class="mt-3">
                                                <label class="form-label">Metode pembayaran</label>
                                                <input type="text" class="form-control text-uppercase"
                                                    value="{{ $data->pembayaran->metode_pembayaran }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nama barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $data->data_barang->nama_barang }}</td>
                                                        <td>{{ $data->jumlah }}</td>
                                                        <td>{{ $data->data_barang->harga_barang }}</td>
                                                        <td>{{ $data->total }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="upload-input text-center my-3 w-100">
                                        <h4 for="gambar" class="w-100 text-uppercase">Struk Pembayaran</h4>
                                        <img src="{{asset(Str::replace(url('/') . '/img/struk/', '', '/img/struk/' . $data->pembayaran->gambar))}}" alt="" class="w-100" >
                                    </div>

                                    <form action="{{ route('update_status_pembayaran', $data->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status Pembayaran</label>
                                            <select class="form-select form-select mb-3" name="status">
                                            <option value="" selected>Silahkan pilih</option>
                                            <option value="selesai">Selesai</option>
                                            <option value="gagal">gagal</option>
                                        </select>
                                        </div>
                                        <div class="text-right mb-3">
                                            <button class="btn btn-primary btn-sm mr-5" type="submit"
                                                >Kirim</button>
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
@endforeach
{{-- end edit --}}

{{-- show --}}
@foreach ($pemesanan_admin as $data)
    <div class="modal fade" id="show-struk-{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Struk Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="d-flex justify-content-center row">
                            <div class="col-md-12">
                                <div class="p-3 bg-white rounded">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h1 class="text-uppercase">Invoice</h1>
                                            <div class="billed"><span
                                                    class="fw-bold text-uppercase text-dark">Tagihan:</span><span
                                                    class="ml-1"> Admin</span></div>
                                            <div class="billed"><span
                                                    class="fw-bold text-uppercase text-dark">Tanggal:</span><span
                                                    class="ml-1">
                                                    {{ Carbon::now()->isoFormat('dddd, DD MMMM YYYY') }}</span></div>
                                            <div class="billed"><span class="fw-bold text-uppercase text-dark">Kode
                                                    Bayar:</span>{{ $data->pembayaran->kode_pembayaran }}</div>
                                        </div>
                                        <div class="col-md-6 text-right mt-3">
                                            <h4 class="text-danger mb-0 text-uppercase">Supplier</h4>
                                            <span class="fw-bold text-dark">{{ $data->supplier->nama }}</span>
                                            <div class="mt-3">
                                                <label class="form-label">Metode pembayaran</label>
                                                <input type="text" class="form-control text-uppercase"
                                                    value="{{ $data->pembayaran->metode_pembayaran }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nama barang</th>
                                                        <th>Jumlah</th>
                                                        <th>Harga</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $data->data_barang->nama_barang }}</td>
                                                        <td>{{ $data->jumlah }}</td>
                                                        <td>{{ $data->data_barang->harga_barang }}</td>
                                                        <td>{{ $data->total }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="upload-input text-center my-3 w-100">
                                        <h4 for="gambar" class="w-100 text-uppercase">Struk Pembayaran</h4>
                                        <img src="{{asset(Str::replace(url('/') . '/img/struk/', '', '/img/struk/' . $data->pembayaran->gambar))}}" alt="" class="w-100" >
                                    </div>
                                    <div class="text-right mb-3">
                                        <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
{{-- end show --}}
