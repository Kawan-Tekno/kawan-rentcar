<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarAppointment;
use App\Models\Rent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentCRUDController extends Controller
{
    public function index(Request $req)
    {
        $rents = Rent::with(['car'])
            ->paginate($req->all());

        return response()->json($rents, 206);
    }

    public function show(int $id)
    {
        try {
            return Rent::with(['car'])
                ->findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(["error" => "not found"], 404);
        }
    }

    /**
     * Need inserd data cars that rented
     */
    public function store(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'name' => 'required',
            'phone' => 'required',
            'destination' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date',
            'fee_total' => 'required|numeric',
            'car_ids' => 'required|array',
            'car_ids.*' => 'required|exists:cars,id'
        ]);

        if ($validate->fails()) {
            return response()
                ->json([
                    "error" => "required params must filled",
                    "detail" => $validate->errors()
                ], 406);
        }

        $rent = Rent::create([
            'name' => $req->name,
            'phone' => $req->phone,
            'destination' => $req->destination,
            'date_start' => $req->start_date,
            'date_end' => $req->end_date,
            'status' => 'NEW',
            'fee_total' => $req->fee_total
        ]);

        $rent->car()->attach($req->car_ids);

        return response()->json($rent, 201);
    }

    public function destroy(int $id)
    {
        try {
            $rent = Rent::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(["error" => "not found"], 404);
        }

        // handle car appointment
        CarAppointment::where('rent_id', $id)->delete();

        $rent->delete();

        return response()->json(null, 204);
    }
}
