<?php

namespace App\Http\Controllers;

use App\Models\DeviceToken;
use App\Models\Notifikasi;
use App\Models\Pengguna;
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

    public function registerDevice(Request $request)
    {
        $request->validate([
            'device_token' => 'required|string|unique:device_tokens,device_token',
        ]);

        $user = $request->user();

        DeviceToken::updateOrCreate(
            ['id_pengguna' => $user->id_pengguna],
            ['device_token' => $request->device_token]
        );

        return response()->json(['message' => 'Device token saved successfully.']);
    }

    public function sendNotif(Request $request)
    {
        $target = Pengguna::find($request->id_pengguna);

        if (!$target) {
            return response()->json(['message' => 'Pengguna not found'], 404);
        }

        $target->sendNotif(
            $request->judul,
            $request->deskripsi,
            $request->navigasi,
            $request->data_navigasi,
        );

        return response()->json(['message' => 'Notifikasi terkirim ke' . $target->nama . "."]);
    }

    public function getForPengguna(Request $request)
    {
        $notifs = Notifikasi::where("id_pengguna", $request->user()->id_pengguna)->get();
        return response()->json($notifs);
    }
}
