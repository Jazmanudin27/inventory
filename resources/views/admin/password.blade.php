@extends('layout.admin')
@section('titlepage', 'Ganti Password')
@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h6 class="page-title" style="text-align: center">Ganti Password</h6>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('update.password') }}" method="post" autocomplete="off">
                                @csrf
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @elseif(session('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="old_password" class="form-label">Old Password</label>
                                            <input type="password"
                                                class="form-control form-control-sm @error('old_password') is-invalid @enderror"
                                                id="old_password" name="old_password" placeholder="Your old Password">
                                            @error('old_password')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="new_password" class="form-label">New Password</label>
                                            <input type="password"
                                                class="form-control form-control-sm  @error('new_password') is-invalid @enderror"
                                                name="new_password" id="new_password" placeholder="Your New Password">
                                            @error('new_password')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="confirm_password" class="form-label">Confirm Password</label>
                                            <input type="password"
                                                class="form-control form-control-sm  @error('confirm_password') is-invalid @enderror"
                                                id="confirm_password" name="confirm_password"
                                                placeholder="Confirm Your Password">
                                            @error('confirm_password')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2 btn-sm"><i
                                            class="mdi mdi-content-save"></i> Ganti Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // Code untuk mengganti foto sesuai dengan input type file dengan change event jquery.
        $(document).ready(function() {

            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

        });
    </script>

@endsection
