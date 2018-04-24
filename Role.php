<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laraveldaily\Quickadmin\Models\Menu;
use Laraveldaily\Quickadmin\Models\RolePermissions;

class Role extends Model
{
    protected $fillable = ['title'];

    public $relation_ids = [];

    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }

    public function permissions()
    {
        return $this->hasMany(RolePermissions::class);
    }


    public function canAccessMenu($menu)
    {
        if ($menu instanceof Menu) {
            $menu = $menu->id;
        }

        if (! isset($this->relation_ids['menus'])) {
            $this->relation_ids['menus'] = $this->menus()->pluck('id')->flip()->all();
        }

        return isset($this->relation_ids['menus'][$menu]);
    }

    public function canCreate($path)
    {
        //Create => 2
        //$path ex books
        $menu_id = Menu::where('name', $path)->pluck('id')->first();
        $permissions = Auth::user()->role->permissions->where('menu_id',$menu_id)->where('permission_id',2)->first();
        return $permissions;
    }

    public function canView($path)
    {
        //View => 3
        $menu_id = Menu::where('name', $path)->pluck('id')->first();
        $permissions = Auth::user()->role->permissions->where('menu_id',$menu_id)->where('permission_id',3)->first();
        return $permissions;
    }

    public function canEdit($path)
    {
        //Edit => 4
        $menu_id = Menu::where('name', $path)->pluck('id')->first();
        $permissions = Auth::user()->role->permissions->where('menu_id',$menu_id)->where('permission_id',4)->first();
        return $permissions;
    }

    public function canDelete($path)
    {
        //Delete => 5
        $menu_id = Menu::where('name', $path)->pluck('id')->first();
        $permissions = Auth::user()->role->permissions->where('menu_id',$menu_id)->where('permission_id',5)->first();
        return $permissions;
    }
}

