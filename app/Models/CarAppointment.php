<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarAppointment extends Model
{
    use HasFactory;

    protected $table = 'car_appointments';

    protected $fillable = [
        'car_id',
        'date_start',
        'date_end',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id'. 'id');
    }
}
