@extends('layout.admin')
@section('titlepage', 'Laporan Pengeluaran Barang')
@section('admin')
    <div class="container">
        <div class="element-heading mt-3">
            <h6 style="text-align: center">Laporan Pengeluaran Barang</h6>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover mb-0" style="width: 280%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No Bukti</th>
                                <th>Tanggal</th>
                                <th>Jenis Pengeluaran</th>
                                <th>Diserahkan</th>
                                <th>Diterima</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluaran as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->nobukti }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->jenis_pengeluaran }}</td>
                                    <td>{{ $item->diserahkan }}</td>
                                    <td>{{ $item->diterima }}</td>
                                    <td>{{ $item->kode_barang }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
