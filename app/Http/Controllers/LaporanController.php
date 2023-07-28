<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{

    public function laporanPemasukan()
    {
        return view('laporan.laporanPemasukan');
    }
    public function cetakLaporanPemasukan(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $jenis_pemasukan = $request->jenis_pemasukan;

        $pemasukan = DB::table('pemasukan')
            ->leftJoin('detail_pemasukan', 'pemasukan.nobukti', '=', 'detail_pemasukan.nobukti')
            ->leftJoin('barang', 'detail_pemasukan.kode_barang', '=', 'barang.kode_barang')
            ->whereBetween('tanggal', [$dari, $sampai])
            ->where('jenis_pemasukan', $jenis_pemasukan)->get();
        return view('laporan.cetakLaporanPemasukan', compact('pemasukan'));
    }

    public function laporanPengeluaran()
    {
        return view('laporan.laporanPengeluaran');
    }
    public function cetakLaporanPengeluaran(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $jenis_pengeluaran = $request->jenis_pengeluaran;

        $pengeluaran = DB::table('pengeluaran')
            ->leftJoin('detail_pengeluaran', 'pengeluaran.nobukti', '=', 'detail_pengeluaran.nobukti')
            ->leftJoin('barang', 'detail_pengeluaran.kode_barang', '=', 'barang.kode_barang')
            ->whereBetween('tanggal', [$dari, $sampai])
            ->where('jenis_pengeluaran', $jenis_pengeluaran)->get();
        return view('laporan.cetakLaporanPengeluaran', compact('pengeluaran'));
    }

    public function laporanStok()
    {
        return view('laporan.laporanStok');
    }
    public function cetakLaporanStok(Request $request)
    {

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        if ($bulan == 01) {
            $bulanlalu = 12;
            $tahunlalu = $request->tahun - 1;
        } else {
            $bulanlalu = $bulan - 1;
            $tahunlalu = $request->tahun;
        }


        $stokopname = DB::select("SELECT barang.kode_barang,nama_barang,satuan,pemasukan,pengeluaran,pemasukanlalu,pengeluaranlalu
        FROM barang
        LEFT JOIN (
            SELECT detail_pemasukan.kode_barang,
            SUM( IF(YEAR(tanggal) = '$tahun' AND MONTH(tanggal) = '$bulan', qty, 0)) AS pemasukan,
            SUM( IF(YEAR(tanggal) = '$tahunlalu' AND MONTH(tanggal) = '$bulanlalu', qty, 0)) AS pemasukanlalu
            FROM detail_pemasukan
            INNER JOIN pemasukan ON pemasukan.nobukti = detail_pemasukan.nobukti
            GROUP BY detail_pemasukan.kode_barang
        ) masuk ON (masuk.kode_barang = barang.kode_barang)
        LEFT JOIN (
            SELECT detail_pengeluaran.kode_barang,
            SUM( IF(YEAR(tanggal) = '$tahun' AND MONTH(tanggal) = '$bulan', qty, 0)) AS pengeluaran,
            SUM( IF(YEAR(tanggal) = '$tahunlalu' AND MONTH(tanggal) = '$bulanlalu', qty, 0)) AS pengeluaranlalu
            FROM detail_pengeluaran
            INNER JOIN pengeluaran ON pengeluaran.nobukti = detail_pengeluaran.nobukti
            GROUP BY detail_pengeluaran.kode_barang
        ) keluar ON (keluar.kode_barang = barang.kode_barang)
        ");
        return view('laporan.cetakLaporanStok', compact('stokopname'));
    }
}
