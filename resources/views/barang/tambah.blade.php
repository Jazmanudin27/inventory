@extends('layout.admin')
@section('titlepage', 'Tambah Barang')
@section('admin')
    <div class="container">
        <div class="element-heading">
            <h6 style="text-align: center">Input Data</h6>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('barang.store') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Nama Barang</label>
                        <input class="form-control form-control-sm" type="text" name="nama_barang"
                            placeholder="Nama Barang">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Satuan</label>
                        <input class="form-control form-control-sm" type="text" name="satuan" placeholder="Satuan">
                    </div>
                    <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center btn-sm"
                        type="submit">Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
