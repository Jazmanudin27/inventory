@extends('layout.admin')
@section('titlepage', 'Laporan Pemasukan Barang')
@section('admin')
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('cetakLaporanPemasukan') }}" autocomplete="off"
                                target="_blank">
                                @csrf
                                <h4 class="header-title" style="text-align: center">Laporan Pemasukan Barang</h4>
                                <div class="form-group">
                                    <label class="form-label">Dari</label>
                                    <input class="form-control form-control-sm" type="date" name="dari"
                                        placeholder="Dari">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Sampai</label>
                                    <input class="form-control form-control-sm" type="date" name="sampai"
                                        placeholder="Sampai">
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
                                    <button
                                        class="btn btn-success w-100 d-flex align-items-center justify-content-center btn-sm"
                                        name="submit" type="submit">Cetak
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
