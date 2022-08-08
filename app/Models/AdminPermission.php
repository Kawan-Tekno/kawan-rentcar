<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    use HasFactory;

    protected $table = 'admin_permissions';

    protected $fillable = ['name'];

    public function role()
    {
        return $this->belongsToMany(AdminRole::class, 'admin_roles_permissions', 'admin_permission_id', 'admin_role_id');
    }
}
