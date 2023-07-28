<!DOCTYPE html>
<html lang="en">
@php

    $id = Auth::user()->id;
    $adminData = App\Models\User::find($id);

@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Affan - PWA Mobile HTML Template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- Title -->
    <title>@yield('titlepage')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('upload/logo.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('upload/logo.jpg') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('upload/logo.jpg') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('upload/logo.jpg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('upload/logo.jpg') }}">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('mobile/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mobile/css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('mobile/css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('mobile/css/baguetteBox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mobile/css/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('mobile/css/vanilla-dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mobile/css/apexcharts.css') }}">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ asset('mobile/style.css') }}">
    <link rel="manifest" href="{{ asset('mobile/manifest.json') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 78px;
            right: 10px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            z-index: 100;
        }

        .my-float {
            margin-top: 16px;
        }
    </style>
    <!-- Web App Manifest -->
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    <!-- Internet Connection Status -->
    <div class="internet-connection-status" id="internetStatus"></div>
    <div class="header-area" id="headerArea" style="zoom: 70%">
        <div class="container">
            <div
                class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
                <div class="logo-wrapper"><a href="#"><img src="{{ asset('upload/logo.jpg') }}" alt="">
                        99 NJ MOTOR</a>
                </div>
                <div class="navbar--toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas"
                    data-bs-target="#affanOffcanvas" aria-controls="affanOffcanvas"><span class="d-block"></span><span
                        class="d-block"></span><span class="d-block"></span></div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1"
        aria-labelledby="affanOffcanvsLabel" style="zoom: 70%">
        <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        <div class="offcanvas-body p-0">
            <div class="sidenav-wrapper">
                <div class="sidenav-profile bg-gradient">
                    <div class="sidenav-style1"></div>
                    <div class="user-profile"><img src="{{ asset('upload/logo.jpg') }}" alt=""></div>
                    <div class="user-info">
                        <h6 class="user-name mb-0">{{ $adminData->name }}</h6><span>{{ $adminData->role }}</span>
                    </div>
                </div>
                <ul class="sidenav-nav ps-0">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door"></i>Home
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="bi bi-table"></i>Data Master</a>
                        <ul>
                            <li><a href="{{ route('barang') }}">Data Barang</a></li>
                            <li><a href="{{ route('admin') }}">Data Users</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="bi bi-cart"></i>Transaksi</a>
                        <ul>
                            <li><a href="{{ route('pemasukan') }}">Pemasukan Barang</a></li>
                            <li><a href="{{ route('pengeluaran') }}">Pengeluaran Barang</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="bi bi-book"></i>Laporan</a>
                        <ul>
                            <li><a href="{{ route('laporanPemasukan') }}">Laporan Pemasukan</a></li>
                            <li><a href="{{ route('laporanPengeluaran') }}">Laporan Pemasukan</a></li>
                            <li><a href="{{ route('laporanStok') }}">Laporan Stok Barang</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('signout') }}"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                </ul>
                {{-- <div class="social-info-wrap">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
                <div class="copyright-info">
                    <p>2021 &copy; Made by<a href="#">Designing World</a></p>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="page-content-wrapper py-3" style="zoom: 70%">
        @yield('admin')
    </div>
    <!-- Footer Nav -->
    <div class="footer-nav-area" id="footerNav" style="zoom: 70%">
        <div class="container px-0">
            <div class="footer-nav position-relative">
                <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
                    <li class="active">
                        <a href="{{ route('dashboard') }}">
                            <svg class="bi bi-house" width="20" height="20" viewBox="0 0 16 16"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z">
                                </path>
                                <path fill-rule="evenodd"
                                    d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z">
                                </path>
                            </svg>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile') }}">
                            <svg class="bi bi-user" width="20" height="20" viewBox="0 0 16 16"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z">
                                </path>
                                <path fill-rule="evenodd"
                                    d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z">
                                </path>
                            </svg>
                            <span>Profile</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script src="{{ asset('mobile/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('mobile/js/slideToggle.min.js') }}"></script>
    <script src="{{ asset('mobile/js/internet-status.js') }}"></script>
    <script src="{{ asset('mobile/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('mobile/js/baguetteBox.min.js') }}"></script>
    <script src="{{ asset('mobile/js/rangeslider.min.js') }}"></script>
    <script src="{{ asset('mobile/js/vanilla-dataTables.min.js') }}"></script>
    <script src="{{ asset('mobile/js/index.js') }}"></script>
    <script src="{{ asset('mobile/js/magic-grid.min.js') }}"></script>
    <script src="{{ asset('mobile/js/dark-rtl.js') }}"></script>
    <script src="{{ asset('mobile/js/active.js') }}"></script>
    <!-- PWA -->
    <script src="{{ asset('mobile/js/pwa.js') }}"></script>
</body>

</html>
