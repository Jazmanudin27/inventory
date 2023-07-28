@extends('layout.admin')
@section('titlepage', 'Laporan Stok Barang')
@section('admin')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('cetakLaporanStok') }}" autocomplete="off" target="_blank">
                                @csrf
                                <h4 class="header-title" style="text-align: center">Laporan Stok Barang</h4>
                                <div class="form-group">
                                    <label class="form-label">Bulan</label>
                                    <select class="form-select form-select-sm" id="bulan" name="bulan">
                                        <option value="">Pilih Bulan</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tahun</label>
                                    <select class="form-select form-select-sm" id="tahun" name="tahun">
                                        <option value="">Pilih Tahun</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
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
