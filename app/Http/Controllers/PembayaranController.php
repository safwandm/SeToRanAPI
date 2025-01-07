<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::all();
        if ($pembayarans->isEmpty()) {
            return response()->json(['message' => 'Data pembayaran kosong'], 404);
        }
        return response()->json($pembayarans, 200);
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::find($id);
        if ($pembayaran === null) {
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }
        return response()->json($pembayaran, 200);
    }

    public function showByTransaksi($id)
    {
        $pembayaran = Pembayaran::where('id_transaksi', $id)->first();
        if ($pembayaran === null) {
            return response()->json(['message' => 'Pembayaran tidak ditemukan'], 404);
        }
        return response()->json($pembayaran, 200);
        
    }
        
}
