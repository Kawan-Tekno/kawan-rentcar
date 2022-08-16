<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarAppointment;
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

        $this->handelCarAppointment($rent, $req->query('request'));

        return response()->json([
            'rent_id' => $id,
            'approval' => $req->query('request')
        ], 200);
    }

    private function handelCarAppointment(Rent $rent, string $request)
    {
        if ($request == 'Accept') {
            foreach ($rent->car as $car) {
                CarAppointment::updateOrCreate(
                    [
                        'car_id' => $car->id,
                        'rent_id' => $rent->id
                    ],
                    [
                        'date_start' => $rent->date_start,
                        'date_end' => $rent->date_end,
                    ]
                );
            }
        }

        if ($request == 'Reject') {
            CarAppointment::where('rent_id', $rent->id)->delete();
        }
    }
}
