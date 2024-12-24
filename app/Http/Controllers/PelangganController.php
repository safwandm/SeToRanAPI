<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = DB::select("SELECT * FROM pengguna_pelanggan_view");
        return response()->json($pelanggans);
    }

    public function show(Request $request)
    {
        $pelanggan = DB::select("SELECT * FROM pengguna_pelanggan_view where id_pelanggan =" . $request->route('id'));
        if (!$pelanggan) {
            return response()->json(['error' => 'Record not found.'], 404);
        }
        return response()->json($pelanggan);
    }
}
