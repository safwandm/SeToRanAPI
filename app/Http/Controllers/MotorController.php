<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Motor;
use App\Models\Transaksi;
use Carbon\Carbon;

class MotorController extends Controller
{


    public function filtered(Request $request)
    {
        $model = $request->input('model');
        $date = $request->input('date');
        $transmission = $request->input('transmission');

        $motors = Motor::where('status_motor', 'Tersedia');
        
        if ($model) {
            $motors = $motors
                ->where('model', 'LIKE', "%$model%")
                ->orWhere('brand', 'LIKE', "%$model%");;
        }

        if ($transmission) {
            $motors = $motors->where('transmisi', $transmission);
        }

        $motors = $motors->get();

        if ($date) {
            $date = Carbon::createFromFormat('d/m/Y', $date);
            $availableMotors = $motors->filter(function ($motor) use ($date) {
                $overlappingReservation = Transaksi::where('id_motor', $motor->id_motor)
                    ->where('status_transaksi', '!=', 'selesai')
                    ->where(function ($query) use ($date) {
                        $query->where('tanggal_mulai', '<=', $date)
                            ->where('tanggal_selesai', '>=', $date);
                    })
                    ->exists();
    
                return !$overlappingReservation;
            });
            $motors = $availableMotors;
        }

        // Return the response
        return response()->json($motors->values());
    }
}
