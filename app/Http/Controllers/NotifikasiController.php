<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    // public function updateIsSent(Request $request)
    // {
    //     $id = $request->route("id");
    //     $notifikasi = Notifikasi::find($id);

    //     if (!$notifikasi) {
    //         return response()->json(['message' => 'Notification not found'], 404);
    //     }

    //     $notifikasi->is_sent = true;
    //     $notifikasi->save();

    //     return response()->json(['message' => 'Notification is_sent updated successfully', 'data' => $notifikasi]);
    // }

    public function updateIsRead(Request $request)
    {
        $id = $request->route("id");
        $notifikasi = Notifikasi::find($id);

        if (!$notifikasi) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notifikasi->is_read = true;
        $notifikasi->save();

        return response()->json(['message' => 'Notification is_read updated successfully', 'data' => $notifikasi]);
    }
}
