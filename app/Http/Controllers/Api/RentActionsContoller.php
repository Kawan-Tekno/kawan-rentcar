<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RentActionsContoller extends Controller
{
    public function approval(Request $req, int $id)
    {
        $validate = Validator::make($req->query(), [
            'request' => 'required|in:Accept,Reject'
        ]);

        if ($validate->fails()) {
            return response()
                ->json([
                    "error" => "required params must filled",
                    "detail" => $validate->errors()
                ], 406);
        }

        try {
            $rent = Rent::findOrFail($id);
        } catch (ModelNotFoundException) {
            return response()->json(["error" => "not found"], 404);
        }

        $rent->update([
            'status' => $req->query('request')
        ]);

        return response()->json([
            'rent_id' => $id,
            'approval' => $req->query('request')
        ], 200);
    }
}
