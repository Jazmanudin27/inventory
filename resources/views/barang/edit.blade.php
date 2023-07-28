@extends('layout.admin')
@section('titlepage', 'Edit Kategori')
@section('admin')
    <div class="container">
        <div class="element-heading">
            <h6 style="text-align: center">Edit Data</h6>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('barang.update') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Kode Barang</label>
                        <input class="form-control form-control-sm" type="text" name="kode_barang"
                            placeholder="Kode Barang" value="{{ $getbarang->kode_barang }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nama Barang</label>
                        <input class="form-control form-control-sm" type="text" name="nama_barang"
                            placeholder="Nama Barang" value="{{ $getbarang->nama_barang }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Satuan</label>
                        <input class="form-control form-control-sm" type="text" name="satuan" placeholder="Satuan"
                            value="{{ $getbarang->satuan }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select class="form-select form-select-sm" id="status" name="status">
                            <option value="">Status</option>
                            <option {{ $getbarang->status == 'Aktif' ? 'selected' : '' }} value="Aktif">Aktif</option>
                            <option {{ $getbarang->status == 'Tidak Aktif' ? 'selected' : '' }} value="Tidak Aktif">Tidak
                                Aktif</option>
                        </select>
                    </div>
                    <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                        type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection
