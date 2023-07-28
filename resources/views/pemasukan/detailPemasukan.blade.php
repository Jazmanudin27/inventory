@foreach ($detail as $key => $b)
    <tr>
        <th>{{ $key + 1 }}</th>
        <th>{{ $b->kode_barang }}</th>
        <th>{{ $b->nama_barang }}</th>
        <th>{{ $b->satuan }}</th>
        <th>{{ $b->qty }}</th>
        <th>{{ $b->keterangan }}</th>
    </tr>
@endforeach
