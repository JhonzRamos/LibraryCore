<?php

namespace Laraveldaily\Quickadmin\Models;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Models\Projects;

class ProjectMenus extends Model
{
    protected $table = 'project_menus';

    protected $fillable = [
        'project_id',
        'menu_id',
    ];

    public function project()
    {
        return $this->belongsTo('Laraveldaily\Quickadmin\Models\Projects', 'project_id', 'id');
    }


    public function menus()
    {
        return $this->belongsTo('Laraveldaily\Quickadmin\Models\Menu', 'menu_id', 'id');
    }
}
