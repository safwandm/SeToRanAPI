<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    public function showByPelanggan($id)
    {
        $transaksis = DB::table('transaksi_motor_pelanggan_view')
            ->where('id_pelanggan', $id)
            ->get();
        return response()->json(['data' => $transaksis], 200);
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

    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'id_motor' => 'required|exists:motors,id_motor',
            'id_pelanggan' => 'required|exists:pelanggans,id_pelanggan',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status_transaksi' => 'required|in:dibuat,berlangsung,batal,selesai',
            'durasi' => 'required|integer|min:1',
            'nominal' => 'required|numeric|min:0',
        ]);
    
        // Check for validation errors
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        try {
            // Create a new transaction
            $transaksi = Transaksi::create([
                'id_motor' => $request->id_motor,
                'id_pelanggan' => $request->id_pelanggan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'status_transaksi' => $request->status_transaksi,
                'durasi' => $request->durasi,
                'nominal' => $request->nominal,
            ]);
    
            // Return success response
            return response()->json(['data' => $transaksi], 201);
        } catch (\Exception $e) {
            // Handle errors and return response
            return response()->json(['error' => 'Failed to store transaksi: ' . $e->getMessage()], 500);
        }
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
