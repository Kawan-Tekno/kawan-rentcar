<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $table = 'admins';

    protected $fillable = [
        'name',
        'avatar',
        'username',
        'password',
        'phone'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function rent()
    {
        return $this->hasMany(Rent::class, 'admin_id', 'id');
    }
}
