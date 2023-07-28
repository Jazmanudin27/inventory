@foreach ($detail as $key => $b)
    <tr>
        <th>{{ $key + 1 }}</th>
        <th>{{ $b->kode_barang }}</th>
        <th>{{ $b->nama_barang }}</th>
        <th>{{ $b->satuan }}</th>
        <th>{{ $b->qty }}</th>
        <th>{{ $b->keterangan }}</th>
        <th>
            <a href="#" data-id="{{ $b->nobukti }}" data-kode="{{ $b->kode_barang }}"
                class="btn btn-sm btn-danger waves-effect waves-light delete"><i class="fa fa-trash"></i></a>
        </th>
    </tr>
@endforeach

<script type="text/javascript">
    $(document).ready(function($) {

        function detailBarang() {
            var nobukti = $('#nobukti').val();
            $.ajax({
                type: "POST",
                url: "{{ route('pemasukan.detailBarang') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    nobukti: nobukti,
                },
                cache: false,
                success: function(respond) {

                    $("#detailBarang").html(respond);
                }

            });
        }

        $('.delete').click(function() {
            var kode_barang = $(this).attr("data-kode");
            var nobukti = $(this).attr("data-id");
            $.ajax({
                type: "POST",
                url: "{{ route('pemasukan.deleteDetail') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    nobukti: nobukti,
                    kode_barang: kode_barang,
                },
                cache: false,
                success: function(respond) {
                    swal(
                        'Hapus',
                        'File Berhasil Di Hapus',
                        'success'
                    );
                    detailBarang();
                }

            });
        });

    });
</script>
