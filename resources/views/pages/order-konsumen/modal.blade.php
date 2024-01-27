@php
    use Carbon\Carbon;
@endphp

{{-- delete pemesanan barang --}}
@foreach ($pemesanan_konsumen as $data)
    <div class="modal fade" id="delete-pemesanan-barang-{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pemesanan Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pemesanan-barang.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="mb-3">
                                <p>Apakah kamu ingin menghapus pemesanan barang <b>{{ $data->kode_pemesanan }}</b> ?</p>
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
{{-- end delete pemesanan barang --}}

{{-- bayar barang  --}}
@foreach ($pemesanan_konsumen as $data)
    <div class="modal fade" id="bayar-pemesanan-barang-{{ $data->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Bayar Pemesanan Barang</h1>
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
                                                    class="ml-1"> Konsumen</span></div>
                                            <div class="billed"><span
                                                    class="fw-bold text-uppercase text-dark">Tanggal:</span><span
                                                    class="ml-1">
                                                    {{ Carbon::now()->isoFormat('dddd, DD MMMM YYYY') }}</span></div>
                                            <div class="billed"><span class="fw-bold text-uppercase text-dark">Kode
                                                    Bayar:</span><span class="ml-1" id="kode_pembayaran"></span></div>
                                        </div>
                                        <div class="col-md-6 text-right mt-3">
                                            <div class="mt-3">
                                                <label class="form-label">Metode pembayaran</label>
                                                <select class="form-select form-select mb-3" id="metode_pembayaran"
                                                    required>
                                                    <option value="" selected>Silahkan pilih</option>
                                                    <option value="transfer">Transfer</option>
                                                    <option value="tunai">Tunai</option>
                                                </select>
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
                                                        <td>{{ $data->nama_barang }}</td>
                                                        <td>{{ $data->jumlah }}</td>
                                                        <td>{{ $data->harga_barang }}</td>
                                                        <td>{{ $data->total }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <form action="{{ route('pembayaran-konsumen.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="tanggal"
                                            value="{{ Carbon::now()->format('Y-m-d') }}">
                                        <input type="hidden" name="kode_bayar" id="kode_bayar">
                                        <input type="hidden" name="pemesanan_konsumen_id" id="pemesanan_konsumen_id">

                                        <input type="hidden" name="metode_pembayaran" id="metode_bayar">

                                        <div class="text-right mb-3">
                                            <button class="btn btn-danger btn-sm mr-5" type="submit"
                                                id="bayar">Bayar</button>
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
{{-- end bayar barang  --}}
