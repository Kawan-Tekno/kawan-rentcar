<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CarAppointment;
use Illuminate\Http\Request;

class CarAppointmentCRUDController extends Controller
{
    public function show(int $id)
    {
        return CarAppointment::where('car_id', $id)
            ->get();
    }
}
