<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarTypeCRUDController extends Controller
{
    public function index(Request $req)
    {
        $carTypes = CarType::paginate($req->all());

        return response()->json($carTypes, 206);
    }

    public function show(int $id)
    {
        try {
            return CarType::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(["error" => "not found"], 404);
        }
    }

    public function store(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'manufacture' => 'required',
            'brand' => 'required',
        ]);

        if ($validate->fails()) {
            return response()
                ->json([
                    "error" => "required params must filled",
                    "detail" => $validate->errors()
                ], 406);
        }

        $carType = CarType::create($req->all());

        return response()->json($carType, 201);
    }

    public function update(Request $req, int $id)
    {
        try {
            $carType = CarType::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(["error" => "not found"], 404);
        }

        $validate = Validator::make($req->all(), [
            'manufacture' => 'required',
            'brand' => 'required',
        ]);

        if ($validate->fails()) {
            return response()
                ->json([
                    "error" => "required params must filled",
                    "detail" => $validate->errors()
                ], 406);
        }

        $carType->update($req->all());

        return response()->json($carType, 200);
    }

    public function destroy(int $id)
    {
        try {
            $carType = CarType::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(["error" => "not found"], 404);
        }

        $carType->delete();

        return response()->json(null, 204);
    }
}
