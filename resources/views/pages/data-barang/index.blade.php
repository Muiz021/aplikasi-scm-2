@extends('base')

@section('roles', 'Supplier')
@section('title', 'data barang')

@section('content')
    @include('sweetalert::alert')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Data Barang</h6>
                    @if (Auth::user()->roles == 'supplier')
                    <div class="text-end py-2 pt-md-0">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-data-barang"><i class="bi bi-plus"></i> Tambah Data Barang</button>
                    </div>
                @endif
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Supplier</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Merek</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data_barang as $key => $item)
                                    <tr>
                                        <td>{{ $data_barang->firstItem() + $key }}</td>
                                        <td>{{ $item->supplier->kode_supplier }}</td>
                                        <td>{{ $item->kode_barang }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->jenis_barang->nama }}</td>
                                        <td>{{ $item->merek_barang->nama }}</td>
                                        <td>Rp.{{ number_format($item->harga_barang, 0, ',', '.') }},00</td>
                                        <td>{{ $item->stok_barang }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-info text-white me-2" data-bs-toggle="modal"
                                                    data-bs-target="#show-data-barang-{{ $item->id }}">Show</button>
                                                @if (Auth::user()->roles == 'supplier')
                                                    <button class="btn btn-success me-2" data-bs-toggle="modal"
                                                        data-bs-target="#edit-data-barang-{{ $item->id }}">Edit</button>
                                                    <button class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#delete-data-barang-{{ $item->id }}">Delete</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Data Kosong!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="left">
                            Showing {{ $data_barang->firstItem() }} of {{ $data_barang->lastItem() }}
                        </div>
                        <div class="right">
                            {{ $data_barang->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('pages.data-barang.modal')
    </div>

    @push('script')
        {{-- kode barang --}}
        <script>
            $(document).ready(function() {
                // Ambil count kode_barang saat halaman dimuat
                $.get('/supplier/get-count', function(data) {
                    // Fungsi untuk menghitung jumlah elemen dalam array
                    function countArrayElements(array) {
                        return array.length;
                    }
                    var jumlah_data = countArrayElements(data.data);

                    if (data.count > 0) {
                        if (jumlah_data === data.count) {
                            $('#kode_barang').val('KB' + (data.count + 2));
                        } else {
                            $('#kode_barang').val('KB' + (data.count + 1));
                        }
                    } else {
                        $('#kode_barang').val('KB' + 1);
                    }
                });
            });
        </script>
        {{-- end kode barang --}}

        {{-- memunculkan gambar pada input --}}
        <script>
            function previewImage() {
                var input = document.getElementById('input-foto-barang');
                var img = document.getElementById('img-foto-barang');

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        img.src = e.target.result;
                        img.style.display = 'block';
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    img.src = '';
                    img.style.display = 'none';
                }
            }
        </script>
        {{-- end memunculkan gambar pada input --}}

        {{-- edit select jenis barang berdasarkan id  --}}
        <script>
            // Dapatkan elemen select berdasarkan ID-nya
            var jenisBarangSelect = document.getElementById('jenisBarangSelect');

            // Loop melalui opsi dan tetapkan atribut selected berdasarkan kondisi
            for (var i = 0; i < jenisBarangSelect.options.length; i++) {
                var currentOption = jenisBarangSelect.options[i];
                if (currentOption.value == currentOption.id) {
                    currentOption.selected = true;
                    break;
                }
            }
        </script>
        {{-- end edit select jenis barang berdasarkan id  --}}

        {{-- select edit merek barang berdasarkan id  --}}
        <script>
            // Dapatkan elemen select berdasarkan ID-nya
            var merekBarangSelect = document.getElementById('merekBarangSelect');

            // Loop melalui opsi dan tetapkan atribut selected berdasarkan kondisi
            for (var i = 0; i < merekBarangSelect.options.length; i++) {
                var currentOption = merekBarangSelect.options[i];
                if (currentOption.value == currentOption.id) {
                    currentOption.selected = true;
                    break;
                }
            }
        </script>
        {{-- end edit select merek barang berdasarkan id  --}}

        {{-- show select jenis barang berdasarkan id  --}}
        <script>
            // Dapatkan elemen select berdasarkan ID-nya
            var jenisBarangSelect = document.getElementById('jenisBarangSelectShow');

            // Loop melalui opsi dan tetapkan atribut selected berdasarkan kondisi
            for (var i = 0; i < jenisBarangSelect.options.length; i++) {
                var currentOption = jenisBarangSelect.options[i];
                if (currentOption.value == currentOption.id) {
                    currentOption.selected = true;
                    break;
                }
            }
        </script>
        {{-- end show select jenis barang berdasarkan id  --}}

        {{-- edit select merek barang berdasarkan id  --}}
        <script>
            // Dapatkan elemen select berdasarkan ID-nya
            var merekBarangSelect = document.getElementById('merekBarangSelect');

            // Loop melalui opsi dan tetapkan atribut selected berdasarkan kondisi
            for (var i = 0; i < merekBarangSelect.options.length; i++) {
                var currentOption = merekBarangSelect.options[i];
                if (currentOption.value == currentOption.id) {
                    currentOption.selected = true;
                    break;
                }
            }
        </script>
        {{-- end edit select merek barang berdasarkan id  --}}
    @endpush

@endsection
