@extends('layout.admin')
@section('titlepage', 'Data Users')
@section('admin')
    <div class="container">
        <div class="element-heading mt-3">
            <h6 style="text-align: center">Data Users</h6>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0" style="width: 300%">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Email</th>
                                <th scope="col">HP</th>
                                <th scope="col">Level</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alladminuser as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->role }}</td>
                                    <td>
                                        @if ($item->status == 'active')
                                            <span class="badge bg-success text-white">Active</span>
                                        @else
                                            <span class="badge bg-danger text-white">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.delete', $item->id) }}"
                                            class="btn btn-sm btn-danger waves-effect waves-light"><i
                                                class="fa fa-trash"></i></a>
                                        <a href="{{ route('admin.edit', $item->id) }}"
                                            class="btn btn-sm btn-success waves-effect waves-light"><i
                                                class="fa fa-pencil"></i></a>
                                        @if ($item->status != 'active')
                                            <a href="{{ route('admin.active', $item->id) }}"
                                                class="btn btn-sm btn-success waves-effect waves-light" title="Active"><i
                                                    class="fa fa-thumbs-up"></i></a>
                                        @else
                                            <a href="{{ route('admin.inactive', $item->id) }}"
                                                class="btn btn-sm btn-danger waves-effect waves-light" title="Inactive"><i
                                                    class="fa fa-thumbs-down"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            {!! $alladminuser->links('') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('admin.tambah') }}" class="float">
        <i class="fa fa-plus my-float"></i>
    </a>
    <br>
@endsection
