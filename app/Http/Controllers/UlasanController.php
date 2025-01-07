<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function average(Request $request)
    {
        $idMotor = $request->route("id");

        $averageRating = Ulasan::getAvgRating($idMotor);

        return response()->json([
            'id_motor' => $idMotor,
            'average_rating' => $averageRating ? round($averageRating, 2) : null, // Round to 2 decimal places
        ]);
    }
}
