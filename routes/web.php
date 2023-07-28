<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VisiMisiController;


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom');

Route::middleware(['auth', 'admin'])->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('/', 'dashboard')->name('dashboard');
        Route::get('/signout', 'signOut')->name('signout');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('/profile', 'Profile')->name('profile');
        Route::post('/profile/store', 'ProfileStore')->name('store.profile');
        Route::get('/change/password', 'ChangePassword')->name('change.password');
        Route::post('/update/password', 'UpdatePassword')->name('update.password');

        Route::get('/admin', 'index')->name('admin');
        Route::get('/admin/tambah', 'Tambah')->name('admin.tambah');
        Route::get('/admin/edit/{id}', 'EditAdmin')->name('admin.edit');
        Route::get('/admin/delete/{id}', 'DeleteAdmin')->name('admin.delete');
        Route::post('/admin/store', 'StoreAdmin')->name('admin.store');
        Route::post('/admin/update', 'UpdateAdmin')->name('admin.update');
        Route::get('/admin/inactive/{id}', 'InactiveAdminUser')->name('admin.inactive');
        Route::get('/admin/active/{id}', 'ActiveAdminUser')->name('admin.active');
    });

    Route::controller(BarangController::class)->group(function () {
        Route::get('/barang', 'index')->name('barang');
        Route::get('/barang/tambah', 'Tambah')->name('barang.tambah');
        Route::get('/barang/edit/{id}', 'Edit')->name('barang.edit');
        Route::get('/barang/delete/{id}', 'Delete')->name('barang.delete');
        Route::post('/barang/store', 'Store')->name('barang.store');
        Route::post('/barang/update', 'Update')->name('barang.update');
        Route::post('/barang/cari', 'index')->name('barang.cari');
    });

    Route::controller(PostController::class)->group(function () {
        Route::get('/post', 'index')->name('post');
        Route::get('/post/tambah', 'Tambah')->name('post.tambah');
        Route::get('/post/edit/{id}', 'Edit')->name('post.edit');
        Route::get('/post/delete/{id}', 'Delete')->name('post.delete');
        Route::post('/post/store', 'Store')->name('post.store');
        Route::post('/post/update', 'Update')->name('post.update');
        Route::get('/post/inactive/{id}', 'Inactive')->name('post.inactive');
        Route::get('/post/active/{id}', 'Active')->name('post.active');
    });

    Route::controller(PemasukanController::class)->group(function () {
        Route::get('/pemasukan', 'index')->name('pemasukan');
        Route::post('/pemasukan/cari', 'index')->name('pemasukan.cari');
        Route::get('/pemasukan/tambah', 'Tambah')->name('pemasukan.tambah');
        Route::get('/pemasukan/edit/{id}', 'Edit')->name('pemasukan.edit');
        Route::post('/pemasukan/delete', 'Delete')->name('pemasukan.delete');
        Route::post('/pemasukan/store', 'Store')->name('pemasukan.store');
        Route::post('/pemasukan/update', 'Update')->name('pemasukan.update');
        Route::post('/pemasukan/StoreTemp', 'StoreTemp')->name('pemasukan.StoreTemp');
        Route::post('/pemasukan/StoreDetail', 'StoreDetail')->name('pemasukan.StoreDetail');
        Route::post('/pemasukan/ViewTemp', 'ViewTemp')->name('pemasukan.ViewTemp');
        Route::post('/pemasukan/DeleteTemp', 'DeleteTemp')->name('pemasukan.DeleteTemp');
        Route::post('/pemasukan/detailBarang', 'detailBarang')->name('pemasukan.detailBarang');
        Route::post('/pemasukan/detailPemasukan', 'detailPemasukan')->name('pemasukan.detailPemasukan');
        Route::post('/pemasukan/deleteDetail', 'deleteDetail')->name('pemasukan.deleteDetail');
    });

    Route::controller(PengeluaranController::class)->group(function () {
        Route::get('/pengeluaran', 'index')->name('pengeluaran');
        Route::post('/pengeluaran/cari', 'index')->name('pengeluaran.cari');
        Route::get('/pengeluaran/tambah', 'Tambah')->name('pengeluaran.tambah');
        Route::get('/pengeluaran/edit/{id}', 'Edit')->name('pengeluaran.edit');
        Route::post('/pengeluaran/delete', 'Delete')->name('pengeluaran.delete');
        Route::post('/pengeluaran/store', 'Store')->name('pengeluaran.store');
        Route::post('/pengeluaran/update', 'Update')->name('pengeluaran.update');
        Route::post('/pengeluaran/StoreTemp', 'StoreTemp')->name('pengeluaran.StoreTemp');
        Route::post('/pengeluaran/StoreDetail', 'StoreDetail')->name('pengeluaran.StoreDetail');
        Route::post('/pengeluaran/ViewTemp', 'ViewTemp')->name('pengeluaran.ViewTemp');
        Route::post('/pengeluaran/DeleteTemp', 'DeleteTemp')->name('pengeluaran.DeleteTemp');
        Route::post('/pengeluaran/detailBarang', 'detailBarang')->name('pengeluaran.detailBarang');
        Route::post('/pengeluaran/detailPengeluaran', 'detailPengeluaran')->name('pengeluaran.detailPengeluaran');
        Route::post('/pengeluaran/deleteDetail', 'deleteDetail')->name('pengeluaran.deleteDetail');
    });

    Route::controller(LaporanController::class)->group(function () {
        Route::get('/laporanPemasukan', 'laporanPemasukan')->name('laporanPemasukan');
        Route::post('/cetakLaporanPemasukan', 'cetakLaporanPemasukan')->name('cetakLaporanPemasukan');
        Route::get('/laporanPengeluaran', 'laporanPengeluaran')->name('laporanPengeluaran');
        Route::post('/cetakLaporanPengeluaran', 'cetakLaporanPengeluaran')->name('cetakLaporanPengeluaran');
        Route::get('/laporanStok', 'laporanStok')->name('laporanStok');
        Route::post('/cetakLaporanStok', 'cetakLaporanStok')->name('cetakLaporanStok');
    });
});
