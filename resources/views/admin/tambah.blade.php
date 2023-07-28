@extends('layout.admin')
@section('titlepage', 'Tambah Users')
@section('admin')
    <div class="container">
        <div class="element-heading">
            <h6 style="text-align: center">Input Data</h6>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('admin.store') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input class="form-control form-control-sm" type="text" name="name"
                            placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label class="form-label">E-mail</label>
                        <input class="form-control form-control-sm" type="email" name="email" placeholder="E-mail">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input class="form-control form-control-sm" type="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="form-label">HP</label>
                        <input class="form-control form-control-sm" type="text" name="phone" placeholder="HP">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Level</label>
                        <select class="form-select" id="role" name="role">
                            <option>Pilih Roles</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center"
                        type="submit">Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
