<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;

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
}
