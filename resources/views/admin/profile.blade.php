@extends('layout.admin')
@section('titlepage', 'Profile Admin')
@section('admin')
    <div class="container">
        <!-- User Information-->
        <div class="card user-info-card mb-3">
            <div class="card-body d-flex align-items-center">
                <div class="user-profile me-3"><img src="{{ asset('upload/logo.jpg') }}" alt="">
                </div>
                <div class="user-info">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-1">{{ $adminData->name }}</h5><span class="badge bg-warning ms-2 rounded-pill"></span>
                    </div>
                    <p class="mb-0">{{ $adminData->role }}</p>
                </div>
            </div>
        </div>
        <div class="card mb-3 shadow-sm">
            <div class="card-body direction-rtl">
                <p>Account</p>
                <div class="single-setting-panel">
                    <a href="{{ route('change.password') }}">
                        <div class="icon-wrapper bg-info"><i class="bi bi-lock"></i></div>Change Password
                    </a>
                </div>
                <div class="single-setting-panel">
                    <a href="{{ route('signout') }}">
                        <div class="icon-wrapper bg-danger">
                            <i class="bi bi-box-arrow-right"></i>
                        </div>Logout
                    </a>
                </div>
            </div>
        </div>
        <div class="card user-data-card mb-3">
            <div class="card-body">
                <form action="#">
                    <div class="form-group mb-3">
                        <label class="form-label" for="fullname">Full Name</label>
                        <input class="form-control" readonly id="fullname" type="text" value="{{ $adminData->name }}"
                            placeholder="Full Name" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" readonly id="email" type="text" value="{{ $adminData->email }}"
                            placeholder="Email" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Level</label>
                        <input class="form-control" readonly id="role" type="text" value="{{ $adminData->role }}"
                            placeholder="Level">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">HP</label>
                        <input class="form-control" readonly id="HP" type="text" value="{{ $adminData->phone }}"
                            placeholder="HP">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
