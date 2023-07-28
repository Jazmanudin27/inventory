@extends('layout.admin')
@section('titlepage', 'Tambah Data Pemasukan')
@section('admin')
    <div class="container">
        <div class="element-heading">
            <h6 style="text-align: center">Input Data Pemasukan</h6>
        </div>
    </div>
    <div class="container">
        <form method="POST" action="{{ route('pemasukan.store') }}" autocomplete="off">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Tanggal</label>
                        <input class="form-control form-control-sm" type="date" name="tanggal" placeholder="Tanggal">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Pemasukan</label>
                        <select class="form-select form-select-sm" id="jenis_pemasukan" name="jenis_pemasukan">
                            <option value="">Jenis Pemasukan</option>
                            <option value="Pembelian">Pembelian</option>
                            <option value="Ganti Barang">Ganti Barang</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Diserahkan Oleh</label>
                        <input class="form-control form-control-sm" type="text" name="diserahkan"
                            placeholder="Diserahkan Oleh">
                    </div>
                </div>
                <h6 style="text-align: center">Data Barang</h6>
                <div class="card-body">
                    <div class="input-group mb-3" hidden>
                        <input class="form-control form-control-sm" name="kode_barang" id="kode_barang" type="text"
                            placeholder="Nama Barang">
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control form-control-sm" name="nama_barang" id="nama_barang" type="text"
                            placeholder="Nama Barang">
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control form-control-sm" name="qty" id="qty" type="text"
                            placeholder="QTY">
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control form-control-sm" name="keterangan" id="keterangan" type="text"
                            placeholder="Keterangan">
                        <a href="#" class="btn btn-sm btn-success" id="tambah"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0" style="width: 200%">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="viewTemp">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-body">
                    <div class="input-group mb-3">
                        <button class="btn btn-md btn-success" type="submit"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal fade" id="modalBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false"
        style="opacity: 1;zoom:80%">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Data Barang</h6>
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0" id="dataTable" style="width: 100%">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $key => $b)
                                    <tr>
                                        <th scope="col">{{ $key + 1 }}</th>
                                        <th scope="col">{{ $b->nama_barang }}</th>
                                        <th scope="col">{{ $b->satuan }}</th>
                                        <th scope="col">
                                            <a href="#" data-kode="{{ $b->kode_barang }}"
                                                data-nama="{{ $b->nama_barang }}"
                                                class="btn btn-sm btn-success waves-effect waves-light pilihbarang"><i
                                                    class="fa fa-check"></i></a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function($) {

            viewTemp();

            function viewTemp() {
                $.ajax({
                    type: "POST",
                    url: "{{ route('pemasukan.ViewTemp') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    cache: false,
                    success: function(respond) {

                        $("#viewTemp").html(respond);
                    }

                });
            }

            $('#nama_barang').click(function(e) {
                e.preventDefault();
                $('#modalBarang').modal('show');
            });

            $('.pilihbarang').click(function(e) {
                e.preventDefault();
                $('#modalBarang').modal('hide');
                var kode = $(this).attr("data-kode");
                var nama = $(this).attr("data-nama");
                $('#kode_barang').val(kode);
                $('#nama_barang').val(nama);
                $('#qty').focus();
            });

            $('#tambah').click(function(e) {
                e.preventDefault();
                var kode_barang = $('#kode_barang').val();
                var qty = $('#qty').val();
                var keterangan = $('#keterangan').val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('pemasukan.StoreTemp') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        kode_barang: kode_barang,
                        qty: qty,
                        keterangan: keterangan
                    },
                    cache: false,
                    success: function(respond) {

                        viewTemp();
                        $('#kode_barang').val("");
                        $('#nama_barang').val("");
                        $('#qty').val("");
                        $('#keterangan').val("");
                    }

                });
            });

        });
    </script>
@endsection
