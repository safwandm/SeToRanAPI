<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function filtered(Request $request)
    {
        // Retrieve query parameters
        $search = $request->query('search');
        $broken = $request->query('status');

        // Initialize query builder
        $query = Voucher::query();

        // Apply search filter (check if search value exists in any field as a substring)
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $columns = (new Voucher)->getFillable(); // Dynamically fetch fillable columns from the model.
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%$search%");
                }
            });
        }

        // Apply broken filter (check for enum column "broken")
        if (!is_null($broken)) {
            $query->where('status_voucher', $broken);
        }

        // Get the results
        $vouchers = $query->get();

        // Return the results as JSON
        return response()->json($vouchers);
    }

    public function get_code(Request $request) 
    {
        $voucher = Voucher::where('kode_voucher', $request->route("kode_voucher"))->first();
        if (!$voucher) {
            return response()->json(['error' => 'Voucher not found.'], 404);
        }
        return response()->json($voucher);
    }
}
