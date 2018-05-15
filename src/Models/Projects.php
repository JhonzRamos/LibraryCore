<?php

namespace Laraveldaily\Quickadmin\Models;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Projects extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'projects';
    
    protected $fillable = [
          'name',
          'title',
          'version',
          'skin',
          'description',
          'landing'
    ];


    public static $skin = ["skin-blue" => "skin-blue", "skin-black" => "skin-black", "skin-purple" => "skin-purple", "skin-green" => "skin-green", "skin-red" => "skin-red", "skin-yellow" => "skin-yellow", "skin-blue-light" => "skin-blue-light", "skin-black-light" => "skin-black-light", "skin-purple-light" => "skin-purple-light", "skin-green-light" => "skin-green-light", "skin-red-light" => "skin-red-light", "skin-yellow-light" => "skin-yellow-light", ];



    public static function boot()
    {
        parent::boot();

        Projects::observe(new UserActionsObserver);
    }

    public function menus()
    {
        return $this->hasMany('Laraveldaily\Quickadmin\Models\ProjectMenus', 'menu_id', 'id');
    }


    
    
    
}