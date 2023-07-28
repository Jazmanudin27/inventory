@extends('layout.admin')
@section('titlepage', 'Laporan Stok Barang')
@section('admin')
    <div class="container">
        <div class="element-heading mt-3">
            <h6 style="text-align: center">Laporan Stok Barang</h6>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover mb-0" style="width: 170%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Sisa Stok</th>
                                <th>Pemasukan</th>
                                <th>Pengeluaran</th>
                                <th>Stok Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stokopname as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->kode_barang }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->satuan }}</td>
                                    <td>{{ $item->pemasukanlalu - $item->pengeluaranlalu }}</td>
                                    <td>{{ $item->pemasukan }}</td>
                                    <td>{{ $item->pengeluaran }}</td>
                                    <td>{{ $item->pemasukan - $item->pengeluaran }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
