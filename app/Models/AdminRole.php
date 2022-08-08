<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    use HasFactory;

    protected $table = 'admin_roles';

    protected $fillable = ['name'];

    public function permission()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_roles_permissions', 'admin_role_id', 'admin_permission_id');
    }
}
