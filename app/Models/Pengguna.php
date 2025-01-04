<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

use function Laravel\Prompts\text;

class Pengguna extends Model
{
    use HasFactory, HasApiTokens;

    protected $primaryKey = 'id_pengguna';
    protected $fillable = [
        'nama', 'email', 'password', 'tanggal_lahir',
        'nomor_telepon', 'umur', 'nomor_KTP', 'alamat',
    ];

    public function sendNotif($judul, $deskripsi, $navigasi, $dataNavigasi)
    {
        Pengguna::sendNotifStatic($this->id_pengguna, $judul, $deskripsi, $navigasi, $dataNavigasi);
    }

     public static function sendNotifStatic($idPengguna, $judul, $deskripsi, $navigasi, $dataNavigasi)
    {
        $notif = new Notifikasi;
        $notif->id_pengguna = $idPengguna;
        $notif->judul = $judul;
        $notif->deskripsi = $deskripsi;
        $notif->navigasi = $navigasi;
        $notif->data_navigasi = $dataNavigasi;
        $notif->is_sent = false; // kalau jadi pake firebase hapus
        $notif->is_read = false;

        $notif->save();

        // send firebase notif, perlu send notif id juga buat update is_read

        try {
            $deviceTokens = DeviceToken::where('id_pengguna', $idPengguna)->pluck('device_token');

            $messaging = app('firebase.messaging');
            foreach ($deviceTokens as $token) {
                $message = CloudMessage::new()
                    ->withNotification(Notification::create($judul, $deskripsi))
                    ->withData(['navigasi' => $navigasi, 'data_navigasi' => $dataNavigasi])
                    ->toToken($token)
                    // ->toTopic('...')
                    // ->toCondition('...')
                ;
                
                $messaging->send($message);
            }
        } catch (Exception $e) {
            error_log("error: " . $e->getMessage());
            error_log("gagal kirim push notif firebase, apakah sudah setup FIREBASE_CREDENTIALS di .env?");
        }

    }
}
