<?php

namespace App\Http\Controllers;

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
