<?php

namespace Laraveldaily\Quickadmin\Models;


use Illuminate\Database\Eloquent\Model;

class RolePermissions extends Model
{
    protected $table = 'role_permissions';

    protected $fillable = [
        'role_id',
        'menu_id',
        'permission_id',
    ];
}
