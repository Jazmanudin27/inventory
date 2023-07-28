@extends('layout.admin')
@section('titlepage', 'Data Barang')
@section('admin')
    <div class="container">
        <div class="element-heading mt-3">
            <h6 style="text-align: center">Data Barang</h6>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('barang.cari') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="input-group mb-3">
                            <input class="form-control form-control-clicked form-control-sm" name="kode_barang"
                                id="kode_barang" type="text" placeholder="Kode Barang" value="{{ $kode_barang }}">
                            <input class="form-control form-control-clicked form-control-sm" name="nama_barang"
                                id="nama_barang" type="text" placeholder="Nama Barang" value="{{ $nama_barang }}">
                            <button class="btn btn-sm btn-success" style="submit">
                                <i class="fa fa-search"></i> Search</button>
                        </div>
                    </form>
                    <table class="table
                                    table-striped table-hover mb-0"
                        style="width: 200%">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->kode_barang }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <a href="{{ route('barang.delete', $item->kode_barang) }}"
                                            class="btn btn-sm btn-danger waves-effect waves-light"><i
                                                class="fa fa-trash"></i></a>
                                        <a href="{{ route('barang.edit', $item->kode_barang) }}"
                                            class="btn btn-sm btn-success waves-effect waves-light"><i
                                                class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            {!! $barang->links('') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('barang.tambah') }}" class="float">
        <i class="fa fa-plus my-float"></i>
    </a>
@endsection
