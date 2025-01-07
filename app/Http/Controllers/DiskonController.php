<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diskons = Diskon::all();
        return response()->json(['data' => $diskons], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'status_promo' => 'required|string|in:aktif,nonaktif',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        Diskon::create($validated);

        return response()->json(['success' => 'Diskon berhasil ditambahkan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $diskon = Diskon::find($id);
        if (!$diskon) {
            return response()->json(['message' => 'Diskon not found'], 404);
        }
        return response()->json(['data' => $diskon], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $diskon = Diskon::find($request->route('id'));
        if (!$diskon) {
            return response()->json(['message' => 'Diskon tidak ditemukan'], 404);
        }
        $diskon->update($request->all());

        return response()->json(['success' => 'Diskon berhasil diperbarui!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
{
    $diskon = Diskon::find($request->route('id'));
    if (!$diskon) {
        return response()->json(['message' => 'Diskon tidak ditemukan'], 404);
    }

    $diskon->delete();

    return response()->json(['success' => 'Diskon berhasil dihapus!'], 200);
}

}
