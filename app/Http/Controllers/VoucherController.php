<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kode_voucher' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    $existingVoucher = Voucher::where('kode_voucher', $value)
                        ->where('id_voucher', '!=', $request->id_voucher)
                        ->first();
                    
                    if ($existingVoucher) {
                        $fail('Kode voucher sudah digunakan');
                    }
                },
            ],
            'tanggal_mulai' => 'required|date',
            'nama_voucher' => 'required|string',
            'persen_voucher' => 'required|numeric|min:1|max:100',
        ]);

        $voucher = Voucher::create($request->all());

        return response()->json($voucher, 201);
    }

    public function update(Request $request)
    {
        $voucher = Voucher::find($request->route('id'));

        if (!$voucher) {
            return response()->json(['message' => 'Voucher not found'], 404);
        }

        $voucher->update($request->all());

        return response()->json([
            'message' => 'Voucher updated successfully',
            'voucher' => $voucher,
        ]);
    }

    public function filtered(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $start = $request->query('start'); // Start date
        $end = $request->query('end');   

        $query = Voucher::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $columns = (new Voucher)->getFillable();
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%$search%");
                }
            });
        }

        if (!is_null($status)) {
            $query->where('status_voucher', $status);
        }

        if (!empty($start)) {
            $query->where('tanggal_mulai', '<=', $start);
        }
    
        if (!empty($end)) {
            $query->where('tanggal_akhir', '>=', $end);
        }

        $vouchers = $query->get();

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

    public function getActive(Request $request)
    {
        return response()->json(Voucher::getActive()->get());
    }

    public function checkVoucher(Request $request)
    {
        $voucher = Voucher::getActive()->where('kode_voucher', $request->route("kode_voucher"))->first();

        if (!$voucher) {
            return response()->json(["valid" => false]);
        }

        return response()->json(["valid" => true, "voucher" => $voucher]);
    }
}
