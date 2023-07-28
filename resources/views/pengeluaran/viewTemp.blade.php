@foreach ($temp as $key => $t)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $t->nama_barang }}</td>
        <td>{{ $t->satuan }}</td>
        <td>{{ $t->qty }}</td>
        <td>{{ $t->keterangan }}</td>
        <td>
            <a href="#" data-id="{{ $t->kode_barang }}"
                class="btn btn-sm btn-danger waves-effect waves-light delete"><i class="fa fa-trash"></i></a>
            <a href="#" class="btn btn-sm btn-success waves-effect waves-light"><i class="fa fa-pencil"></i></a>
        </td>
    </tr>
@endforeach

<script>
    $(function() {

        function viewTemp() {
            $.ajax({
                type: "POST",
                url: "{{ route('pengeluaran.ViewTemp') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                cache: false,
                success: function(respond) {

                    $("#viewTemp").html(respond);
                }

            });
        }

        $('.delete').click(function(e) {
            e.preventDefault();
            var kode_barang = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('pengeluaran.DeleteTemp') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    kode_barang: kode_barang,
                },
                cache: false,
                success: function(respond) {

                    viewTemp();
                }

            });
        });
    });
</script>
