<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = DB::SELECT("SELECT * FROM transaksi_motor_pelanggan_view");
        return response()->json(['data' => $transaksis], 200);
    }

    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi not found'], 404);
        }
        return response()->json(['data' => $transaksi], 200);
    }

    public function showByPelanggan(Request $request)
    {
        $transaksis;
        if ($request->query('expand' == true)) {
            $transaksis = DB::table('transaksi_motor_pelanggan_view')
                ->where('id_pelanggan', $request->route('id'))
                ->get();
        } else {
            $transaksis = DB::table('transaksis')
                ->where('id_pelanggan', $request->route('id'))
                ->get();
        }
        return response()->json($transaksis);
    }

    public function showByMitra($id)
    {

    }

    public function showByMotor($id)
    {
        $transaksis = DB::table('transaksi_motor_pelanggan_view')
            ->where('id_motor', $id)
            ->get();
        return response()->json(['data' => $transaksis], 200);
    }

    public function showAktif()
    {
        $transaksis = DB::table('transaksi_motor_pelanggan_view')
            ->where('status_transaksi', 'berlangsung')
            ->get();

        if (!$transaksis) {
            return response()->json(['message' => 'Tidak ada transaksi'], 404);
        }
        
        return response()->json(['data' => $transaksis], 200);
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi not found'], 404);
        }
        $transaksi->update($request->all());
        return response()->json(['data' => $transaksi], 200);
    }
}
