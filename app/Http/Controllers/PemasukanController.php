<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Pemasukan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemasukanController extends Controller
{

    public function index(Request $request)
    {
        $nobukti = $request->nobukti;
        $tanggal = $request->tanggal;

        $pemasukan = DB::table('pemasukan')
            ->where('nobukti', 'like', "%" . $nobukti . "%")
            ->where('tanggal', 'like', "%" . $tanggal . "%")
            ->paginate(10);
        $detail = DB::table('detail_pemasukan')
            ->join('barang', 'barang.kode_barang', '=', 'detail_pemasukan.kode_barang')
            ->where('nobukti', 'like', "%" . $nobukti . "%")
            ->get();
        return view('pemasukan.index', compact('pemasukan', 'detail', 'tanggal', 'nobukti'));
    }

    public function Tambah()
    {
        $barang = DB::table('barang')->get();
        return view('pemasukan.tambah', compact('barang'));;
    }
    public function viewTemp()
    {
        $temp = DB::table('detail_pemasukan_temp')
            ->join('barang', 'barang.kode_barang', '=', 'detail_pemasukan_temp.kode_barang')
            ->get();
        return view('pemasukan.viewTemp', compact('temp'));
    }

    public function StoreTemp(Request $request)
    {
        $data = array(
            'kode_barang' => $request->kode_barang,
            'qty' => $request->qty,
            'keterangan' => $request->keterangan,
        );
        DB::table('detail_pemasukan_temp')->insert($data);
    }

    public function DeleteTemp(Request $request)
    {
        $kode_barang = $request->kode_barang;
        DB::table('detail_pemasukan_temp')->where('kode_barang', $kode_barang)->delete();
    }

    public function detailPemasukan(Request $request)
    {
        $nobukti = $request->nobukti;
        $detail = DB::table('detail_pemasukan')
            ->join('barang', 'barang.kode_barang', '=', 'detail_pemasukan.kode_barang')
            ->where('nobukti', $nobukti)
            ->get();
        return view('pemasukan.detailPemasukan', compact('detail'));
    }

    public function detailBarang(Request $request)
    {
        $nobukti = $request->nobukti;
        $detail = DB::table('detail_pemasukan')
            ->join('barang', 'barang.kode_barang', '=', 'detail_pemasukan.kode_barang')
            ->where('nobukti', $nobukti)
            ->get();
        return view('pemasukan.detail', compact('detail'));
    }

    public function Store(Request $request)
    {

        $pemasukan      = DB::table('pemasukan')->select('nobukti')->orderByDesc('nobukti')->get();
        $nourut         = substr($pemasukan, 19, 4);
        $noterakhir     = substr($pemasukan, 22, 1);
        $bulan          = Date('m');
        $tahun          = Date('y');

        if ($noterakhir > 0) {
            $kode = $nourut;
            $kode = intval($nourut) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodetampil = "BM" . $bulan . $tahun . $batas;


        $id = Auth::user()->id;
        $user = User::find($id);

        $pemasukan = new Pemasukan();
        $pemasukan->nobukti = $kodetampil;
        $pemasukan->tanggal = $request->tanggal;
        $pemasukan->jenis_pemasukan = $request->jenis_pemasukan;
        $pemasukan->diserahkan = $request->diserahkan;
        $pemasukan->diterima = $user->name;
        $pemasukan->save();

        $detailpemasukan      = DB::table('detail_pemasukan_temp')->get();

        foreach ($detailpemasukan as $key => $value) {
            DB::table('detail_pemasukan')->insert(
                [
                    'nobukti' => $kodetampil,
                    'kode_barang' => $value->kode_barang,
                    'qty' => $value->qty,
                    'keterangan' => $value->keterangan,
                ]
            );
        }
        $detailpemasukan      = DB::table('detail_pemasukan_temp')->delete();

        return redirect()->route('pemasukan');
    }

    public function StoreDetail(Request $request)
    {
        $data = array(
            'nobukti' => $request->nobukti,
            'kode_barang' => $request->kode_barang,
            'qty' => $request->qty,
            'keterangan' => $request->keterangan,
        );
        DB::table('detail_pemasukan')->insert($data);
    }
    public function Edit($id)
    {
        $pemasukan  = Pemasukan::findOrFail($id);
        $barang     = DB::table('barang')->get();
        $detail     = DB::table('detail_pemasukan')
            ->join('barang', 'barang.kode_barang', '=', 'detail_pemasukan.kode_barang')
            ->where('nobukti', $id)
            ->get();
        return view('pemasukan.edit', compact('pemasukan', 'barang', 'detail'));
    }

    public function Update(Request $request)
    {

        $id = $request->nobukti;
        $pemasukan = Pemasukan::findOrFail($id);

        $pemasukan->nobukti = $request->nobukti;
        $pemasukan->tanggal = $request->tanggal;
        $pemasukan->jenis_pemasukan = $request->jenis_pemasukan;
        $pemasukan->diserahkan = $request->diserahkan;
        $pemasukan->save();

        return redirect()->route('pemasukan');
    }

    public function deleteDetail(Request $request)
    {
        $kode_barang        = $request->kode_barang;
        $nobukti            = $request->nobukti;
        $detailpemasukan    = DB::table('detail_pemasukan')->where('nobukti', $nobukti)->where('kode_barang', $kode_barang);
        if (!is_null($detailpemasukan)) {
            $detailpemasukan->delete();
        }
    }

    public function Delete($id)
    {

        $pemasukan = Pemasukan::findOrFail($id);
        if (!is_null($pemasukan)) {
            $pemasukan->delete();
        }
        return redirect()->back();
    }
}
