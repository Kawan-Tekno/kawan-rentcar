<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rents';

    protected $fillable = [
        'admin_id',
        'name',
        'phone',
        'destination',
        'start_date',
        'end_date',
        'status',
        'fee_total'
    ];

    public function car()
    {
        return $this->belongsToMany(Car::class, 'rent_cars', 'rent_id', 'car_id');
    }
}
