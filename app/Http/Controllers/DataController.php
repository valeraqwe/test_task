<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function find(Request $request)
    {
        $query = Data::query();

        if ($request->has('ship_to_name')) {
            $query->where('ship_to_name', $request->input('ship_to_name'));
        }

        if ($request->has('customer_email')) {
            $query->where('customer_email', $request->input('customer_email'));
        }

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $limit = $request->input('limit', 10);
        $data = $query->paginate($limit);

        return response()->json($data);
    }
}
