<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Models\Menu;

class Permissions extends Model
{
    protected $fillable = ['name'];

    protected $table = 'permissions';
}

