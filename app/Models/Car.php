<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'car_type_id',
        'plat_no',
        'year',
        'condition',
        'description',
        'avaliable',
        'price_per_period'
    ];

    public function media()
    {
        return $this->hasMany(CarMedia::class, 'car_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(CarType::class, 'car_type_id', 'id');
    }

    public function appointment()
    {
        return $this->hasMany(CarAppointment::class, 'car_id', 'id');
    }

    public function rent()
    {
        # code...
    }

    protected static function booted()
    {
        static::deleting(function (Car $car) {
            DB::table('rent_cars')
                ->where('car_id', $car->id)
                ->update(['car_id' => 99999999]);
        });
    }
}
