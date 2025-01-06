<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;

class PenggunaController extends Controller
{
    public function update(Request $request) {
        $pengguna = Pengguna::find($request->route('id'));
        if (!$pengguna) {
            return response()->json(['error' => 'Record not found.'], 404);
        }
        $pengguna->update($request->all());
        return response()->json($pengguna);
    }
}
