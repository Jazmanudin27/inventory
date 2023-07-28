<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index()
    {
        $slider = DB::table('about')->where('kategori', 'Slider')->get();
        return view('layout.website', compact('slider'));
    }
}
