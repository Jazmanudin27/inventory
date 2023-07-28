<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{

    public function index(Request $request)
    {
        $kode_barang = $request->kode_barang;
        $nama_barang = $request->nama_barang;

        $barang = DB::table('barang')
            ->where('kode_barang', 'like', "%" . $kode_barang . "%")
            ->where('nama_barang', 'like', "%" . $nama_barang . "%")
            ->paginate(10);
        return view('barang.index', compact('barang', 'nama_barang', 'kode_barang'));
    }

    public function Tambah()
    {
        return view('barang.tambah');
        ;
    }

    public function Store(Request $request)
    {
        $barang = DB::table('barang')->select('kode_barang')->orderByDesc('kode_barang')->get();
        $nourut = substr($barang, 20, 4);
        $noterakhir = substr($barang, 23, 1);

        if ($noterakhir > 0) {
            $kode = $nourut;
            $kode = intval($nourut) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodetampil = "BRG" . $batas;

        $barang = new Barang();
        $barang->kode_barang = $kodetampil;
        $barang->nama_barang = $request->nama_barang;
        $barang->satuan = $request->satuan;
        $barang->status = "active";
        $barang->save();

        $notification = array(
            'message' => 'Added Successful',
            'alert-type' => 'success'
        );
        return redirect()->route('barang')->with($notification);
    }

    public function Edit($id)
    {
        $getbarang = Barang::findOrFail($id);
        return view('barang.edit', compact('getbarang'));
    }

    public function Update(Request $request)
    {

        $id = $request->kode_barang;
        $barang = Barang::findOrFail($id);

        $barang->nama_barang = $request->nama_barang;
        $barang->satuan = $request->satuan;
        $barang->status = $request->status;
        $barang->save();

        $notification = array(
            'message' => 'Update Successful',
            'alert-type' => 'success'
        );
        return redirect()->route('barang')->with($notification);
    }

    public function Delete($id)
    {

        $barang = Barang::findOrFail($id);
        if (!is_null($barang)) {
            $barang->delete();
        }

        $notification = array(
            'message' => 'Portfolio Deleted Successfuly',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
