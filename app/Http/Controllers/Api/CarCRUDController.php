<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarCRUDController extends Controller
{
    public function index(Request $req)
    {
        $cars = Car::paginate($req->all());

        return response()->json($cars, 206);
    }

    public function show(int $id)
    {
        try {
            return Car::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(["error" => "not found"], 404);
        }
    }

    public function store(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'car_type_id' => 'required|exists:car_types,id',
            'plat_no' => 'required',
            'year' => 'required|date_format:Y',
            'condition' => 'required|in:Good,Need fix,On repairing,Other',
            'avaliable' => 'required|boolean',
            'price_per_period' => 'required|numeric'
        ]);

        if ($validate->fails()) {
            return response()
                ->json([
                    "error" => "required params must filled",
                    "detail" => $validate->errors()
                ], 406);
        }

        $car = Car::create($req->all());

        return response()->json($car, 201);
    }

    public function update(Request $req, int $id)
    {
        try {
            $car = Car::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(["error" => "not found"], 404);
        }

        $validate = Validator::make($req->all(), [
            'car_type_id' => 'required|exists:car_types,id',
            'plat_no' => 'required',
            'year' => 'required|date_format:Y',
            'condition' => 'required|in:Good,Need fix,On repairing,Other',
            'avaliable' => 'required|boolean',
            'price_per_period' => 'required|numeric'
        ]);

        if ($validate->fails()) {
            return response()
                ->json([
                    "error" => "required params must filled",
                    "detail" => $validate->errors()
                ], 406);
        }

        $car->update($req->all());

        return response()->json($car, 200);
    }

    public function destroy(int $id)
    {
        try {
            $car = Car::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(["error" => "not found"], 404);
        }

        $car->delete();

        return response()->json(null, 204);
    }
}
