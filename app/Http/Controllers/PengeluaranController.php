<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{

    public function index(Request $request)
    {
        $nobukti = $request->nobukti;
        $tanggal = $request->tanggal;

        $pengeluaran = DB::table('pengeluaran')
            ->where('nobukti', 'like', "%" . $nobukti . "%")
            ->where('tanggal', 'like', "%" . $tanggal . "%")
            ->paginate(10);
        $detail = DB::table('detail_pengeluaran')
            ->join('barang', 'barang.kode_barang', '=', 'detail_pengeluaran.kode_barang')
            ->where('nobukti', 'like', "%" . $nobukti . "%")
            ->get();
        return view('pengeluaran.index', compact('pengeluaran', 'detail', 'tanggal', 'nobukti'));
    }

    public function Tambah()
    {
        $barang = DB::table('barang')->get();
        return view('pengeluaran.tambah', compact('barang'));;
    }
    public function viewTemp()
    {
        $temp = DB::table('detail_pengeluaran_temp')
            ->join('barang', 'barang.kode_barang', '=', 'detail_pengeluaran_temp.kode_barang')
            ->get();
        return view('pengeluaran.viewTemp', compact('temp'));
    }

    public function StoreTemp(Request $request)
    {
        $data = array(
            'kode_barang' => $request->kode_barang,
            'qty' => $request->qty,
            'keterangan' => $request->keterangan,
        );
        DB::table('detail_pengeluaran_temp')->insert($data);
    }

    public function DeleteTemp(Request $request)
    {
        $kode_barang = $request->kode_barang;
        DB::table('detail_pengeluaran_temp')->where('kode_barang', $kode_barang)->delete();
    }

    public function detailpengeluaran(Request $request)
    {
        $nobukti = $request->nobukti;
        $detail = DB::table('detail_pengeluaran')
            ->join('barang', 'barang.kode_barang', '=', 'detail_pengeluaran.kode_barang')
            ->where('nobukti', $nobukti)
            ->get();
        return view('pengeluaran.detailPengeluaran', compact('detail'));
    }

    public function detailBarang(Request $request)
    {
        $nobukti = $request->nobukti;
        $detail = DB::table('detail_pengeluaran')
            ->join('barang', 'barang.kode_barang', '=', 'detail_pengeluaran.kode_barang')
            ->where('nobukti', $nobukti)
            ->get();
        return view('pengeluaran.detail', compact('detail'));
    }

    public function Store(Request $request)
    {
        $pengeluaran      = DB::table('pengeluaran')->select('nobukti')->orderByDesc('nobukti')->get();
        $nourut         = substr($pengeluaran, 19, 4);
        $noterakhir     = substr($pengeluaran, 22, 1);
        $bulan          = Date('m');
        $tahun          = Date('y');

        if ($noterakhir > 0) {
            $kode = $nourut;
            $kode = intval($nourut) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodetampil = "BK" . $bulan . $tahun . $batas;

        $id = Auth::user()->id;
        $user = User::find($id);
        $pengeluaran = new Pengeluaran();
        $pengeluaran->nobukti = $kodetampil;
        $pengeluaran->tanggal = $request->tanggal;
        $pengeluaran->jenis_pengeluaran = $request->jenis_pengeluaran;
        $pengeluaran->diterima = $request->diterima;
        $pengeluaran->diserahkan = $user->name;
        $pengeluaran->save();

        $detailpengeluaran      = DB::table('detail_pengeluaran_temp')->get();

        foreach ($detailpengeluaran as $key => $value) {
            DB::table('detail_pengeluaran')->insert(
                [
                    'nobukti' => $kodetampil,
                    'kode_barang' => $value->kode_barang,
                    'qty' => $value->qty,
                    'keterangan' => $value->keterangan,
                ]
            );
        }
        $detailpengeluaran      = DB::table('detail_pengeluaran_temp')->delete();

        return redirect()->route('pengeluaran');
    }

    public function StoreDetail(Request $request)
    {
        $data = array(
            'nobukti' => $request->nobukti,
            'kode_barang' => $request->kode_barang,
            'qty' => $request->qty,
            'keterangan' => $request->keterangan,
        );
        DB::table('detail_pengeluaran')->insert($data);
    }
    public function Edit($id)
    {
        $pengeluaran  = Pengeluaran::findOrFail($id);
        $barang     = DB::table('barang')->get();
        $detail     = DB::table('detail_pengeluaran')
            ->join('barang', 'barang.kode_barang', '=', 'detail_pengeluaran.kode_barang')
            ->where('nobukti', $id)
            ->get();
        return view('pengeluaran.edit', compact('pengeluaran', 'barang', 'detail'));
    }

    public function Update(Request $request)
    {

        $id = $request->nobukti;
        $pengeluaran = Pengeluaran::findOrFail($id);

        $pengeluaran->nobukti = $request->nobukti;
        $pengeluaran->tanggal = $request->tanggal;
        $pengeluaran->jenis_pengeluaran = $request->jenis_pengeluaran;
        $pengeluaran->diterima = $request->diterima;
        $pengeluaran->save();

        return redirect()->route('pengeluaran');
    }

    public function deleteDetail(Request $request)
    {
        $kode_barang        = $request->kode_barang;
        $nobukti            = $request->nobukti;
        $detailpengeluaran    = DB::table('detail_pengeluaran')->where('nobukti', $nobukti)->where('kode_barang', $kode_barang);
        if (!is_null($detailpengeluaran)) {
            $detailpengeluaran->delete();
        }
    }

    public function Delete($id)
    {

        $pengeluaran = Pengeluaran::findOrFail($id);
        if (!is_null($pengeluaran)) {
            $pengeluaran->delete();
        }
        return redirect()->back();
    }
}
