<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller
{
    /**
     * Menampilkan daftar mitra beserta data pengguna yang terkait.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data Mitra beserta data Pengguna yang terkait
        $mitras = Mitra::with('pengguna')->get();

        // Mengembalikan response dalam bentuk JSON
        return response()->json($mitras);
    }

    public function mitraMotor()
    {
        // Mengambil semua data Mitra beserta data Pengguna dan motors
        $mitras = Mitra::with('pengguna')->get();

        // Looping untuk menghitung jumlah motor per mitra
        $mitrasWithMotorCount = $mitras->map(function ($mitra) {
            $jumlahMotor = DB::table('motors')
            ->where('id_mitra', $mitra->id_mitra)  // Menghitung motor berdasarkan mitra_id
            ->count();  // Menghitung jumlah motor
            $mitra->jumlah_motor = $jumlahMotor;  
            return $mitra;
        });

        // Mengembalikan response dalam bentuk JSON dengan tambahan jumlah motor
        return response()->json($mitrasWithMotorCount);
    }
}
