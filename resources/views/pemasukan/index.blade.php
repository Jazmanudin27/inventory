@extends('layout.admin')
@section('titlepage', 'Data Pemasukan')
@section('admin')
    <div class="container">
        <div class="element-heading mt-3">
            <h6 style="text-align: center">Data Pemasukan Barang</h6>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('pemasukan.cari') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="input-group mb-3">
                        <input class="form-control form-control-clicked form-control-sm" name="nobukti" id="nobukti"
                            type="text" placeholder="No Bukti" value="{{ $nobukti }}">
                        <input class="form-control form-control-clicked form-control-sm" name="tanggal" id="tanggal"
                            type="date" placeholder="Tanggal" value="{{ $tanggal }}">
                        <button class="btn btn-sm btn-success" style="submit">
                            <i class="fa fa-search"></i> Search</button>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover mb-0" style="width: 280%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No Bukti</th>
                                <th>Tanggal</th>
                                <th>Jenis Pemasukan</th>
                                <th>Diserahkan</th>
                                <th>Diterima</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemasukan as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->nobukti }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->jenis_pemasukan }}</td>
                                    <td>{{ $item->diserahkan }}</td>
                                    <td>{{ $item->diterima }}</td>
                                    <td>
                                        <a href="{{ route('pemasukan.delete', $item->nobukti) }}"
                                            class="btn btn-sm btn-danger waves-effect waves-light"><i
                                                class="fa fa-trash"></i></a>
                                        <a href="{{ route('pemasukan.edit', $item->nobukti) }}"
                                            class="btn btn-sm btn-success waves-effect waves-light"><i
                                                class="fa fa-pencil"></i></a>
                                        <a href="#" data-id="{{ $item->nobukti }}"
                                            class="btn btn-sm btn-primary waves-effect waves-light detailPemasukan"><i
                                                class="fa fa-list"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            {!! $pemasukan->links('') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('pemasukan.tambah') }}" class="float">
        <i class="fa fa-plus my-float"></i>
    </a>
    <div class="modal fade" id="modalDetailBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false"
        style="opacity: 1;zoom:85%">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Detail Barang</h6>
                    <button class="btn btn-close p-1 ms-auto" type="button" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Satuan</th>
                                    <th>Qty</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody id="detailPemasukan">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(document).ready(function($) {

            $('.detailPemasukan').click(function(e) {
                e.preventDefault();

                $('#modalDetailBarang').modal('show');

                var nobukti = $(this).attr('data-id');

                $.ajax({
                    type: "POST",
                    url: "{{ route('pemasukan.detailPemasukan') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        nobukti: nobukti,
                    },
                    cache: false,
                    success: function(respond) {

                        $("#detailPemasukan").html(respond);

                    }

                });
            });

        });
    </script>
@endsection
