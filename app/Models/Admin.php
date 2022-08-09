<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'admins';

    protected $fillable = [
        'role_id',
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
        return $this->hasMany(Rent::class, 'admin_role_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(AdminRole::class, 'admin_role_id', 'id');
    }
}
