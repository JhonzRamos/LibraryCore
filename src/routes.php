<?php

/**
 * Package routing file specifies all of this package routes.
 */

use Illuminate\Support\Facades\View;
use Laraveldaily\Quickadmin\Models\Menu;
use Laraveldaily\Quickadmin\Models\ProjectMenus;
use Laraveldaily\Quickadmin\Models\Projects;

if (Schema::hasTable('menus')) {

    $active = Projects::where('active', 1)->first();
    $menus1 = ProjectMenus::where('project_id',$active->id)->pluck('menu_id');

    $menus = Menu::with('children')->where('menu_type', '!=', 0)->orderBy('position')->whereIn('id',$menus1)->get();

    
    View::share('menus', $menus);
    if (! empty($menus)) {
        Route::group([
            'middleware' => ['web', 'auth', 'role'],
            'prefix'     => config('quickadmin.route'),
            'as'         => config('quickadmin.route') . '.',
            'namespace'  => 'App\Http\Controllers',
        ], function () use ($menus) {
            foreach ($menus as $menu) {
                switch ($menu->menu_type) {
                    case 1:{
                        Route::post(strtolower($menu->name) . '/massDelete', [
                            'as'   => strtolower($menu->name) . '.massDelete',
                            'uses' => 'Admin\\' . ucfirst(camel_case($menu->name)) . 'Controller@massDelete'
                        ]);
                        Route::resource(strtolower($menu->name),
                            'Admin\\' . ucfirst(camel_case($menu->name)) . 'Controller');

                        Log::info('Route::get('.'\''.strtolower($menu->name).'\''.', ['. '\'as\'' .' => '. '\''.strtolower($menu->name) . '.index'.'\''.','.'\'uses\''.' => '.'\''.'Admin\\'.ucfirst(camel_case($menu->name)). 'Controller@index'.'\''.','.']);' );
                        Log::info('Route::resource('.'\''.strtolower($menu->name).'\''.','.'\''.'Admin\\'.ucfirst(camel_case($menu->name)). 'Controller'.')'.';' );

                        break;
                    }

                    case 3: {
                        Route::get(strtolower($menu->name), [
                            'as' => strtolower($menu->name) . '.index',
                            'uses' => 'Admin\\' . ucfirst(camel_case($menu->name)) . 'Controller@index',
                        ]);

                        Log::info('Route::get(' . '\'' . strtolower($menu->name) . '\'' . ', [' . '\'as\'' . ' => ' . '\'' . strtolower($menu->name) . '.index' . '\'' . ',' . '\'uses\'' . ' => ' . '\'' . 'Admin\\' . ucfirst(camel_case($menu->name)) . 'Controller@index' . '\'' . ',' . ']);');

                        break;
                    }
                }
            }

        });
    }
}

Route::group([
    'namespace'  => 'Laraveldaily\Quickadmin\Controllers',
    'middleware' => ['web', 'auth']
], function () {
    // Dashboard home page route
    Route::get(config('quickadmin.homeRoute'), config('quickadmin.homeAction','QuickadminController@index'));

    Route::group([
        'middleware' => 'role'
    ], function () {
        // Menu routing


        Route::get(config('quickadmin.route') . '/project', [
            'as'   => 'projects',
            'uses' => 'ProjectsController@index'
        ]);

        Route::get(config('quickadmin.route') . '/menu', [
            'as'   => 'menu',
            'uses' => 'QuickadminMenuController@index'
        ]);
        Route::post(config('quickadmin.route') . '/menu', [
            'as'   => 'menu',
            'uses' => 'QuickadminMenuController@rearrange'
        ]);

        Route::get(config('quickadmin.route') . '/menu/edit/{id}', [
            'as'   => 'menu.edit',
            'uses' => 'QuickadminMenuController@edit'
        ]);
        Route::post(config('quickadmin.route') . '/menu/edit/{id}', [
            'as'   => 'menu.edit',
            'uses' => 'QuickadminMenuController@update'
        ]);

        Route::get(config('quickadmin.route') . '/menu/crud', [
            'as'   => 'menu.crud',
            'uses' => 'QuickadminMenuController@createCrud'
        ]);
        Route::post(config('quickadmin.route') . '/menu/crud', [
            'as'   => 'menu.crud.insert',
            'uses' => 'QuickadminMenuController@insertCrud'
        ]);

        Route::get(config('quickadmin.route') . '/menu/parent', [
            'as'   => 'menu.parent',
            'uses' => 'QuickadminMenuController@createParent'
        ]);
        Route::post(config('quickadmin.route') . '/menu/parent', [
            'as'   => 'menu.parent.insert',
            'uses' => 'QuickadminMenuController@insertParent'
        ]);

        Route::get(config('quickadmin.route') . '/menu/custom', [
            'as'   => 'menu.custom',
            'uses' => 'QuickadminMenuController@createCustom'
        ]);
        Route::post(config('quickadmin.route') . '/menu/custom', [
            'as'   => 'menu.custom.insert',
            'uses' => 'QuickadminMenuController@insertCustom'
        ]);

        Route::get(config('quickadmin.route') . '/actions', [
            'as'   => 'actions',
            'uses' => 'UserActionsController@index'
        ]);
        Route::get(config('quickadmin.route') . '/actions/ajax', [
            'as'   => 'actions.ajax',
            'uses' => 'UserActionsController@table'
        ]);

        // Files routing
        Route::get(config('quickadmin.route') . '/files', [
            'as'   => 'files',
            'uses' => 'QuickadminFilesController@index'
        ]);
        Route::get(config('quickadmin.route') . '/files/ajax', [
            'as'   => 'files.ajax',
            'uses' => 'QuickadminFilesController@table'
        ]);

        Route::get(config('quickadmin.route') . '/menu/delete/{id}', [
            'as'   => 'menu.delete',
            'uses' => 'QuickadminMenuController@delete'
        ]);
        Route::get(config('quickadmin.route') . '/menu/ajax', [
            'as'   => 'menu.ajax',
            'uses' => 'QuickadminMenuController@table'
        ]);



        Route::resource(config('quickadmin.route') . '/projects', 'ProjectsController');

        Route::get(config('quickadmin.route') . '/projects/active/{id}', [
            'as'   => 'projects.active',
            'uses' => 'ProjectsController@active'
        ]);



        Route::get(config('quickadmin.route') . '/projects', [
            'as'   => 'projects.massDelete',
            'uses' => 'ProjectsController@massDelete'
        ]);

        Route::get(config('quickadmin.route') . '/download/{id}', [
            'as'   => 'download.zip',
            'uses' => 'JSZipController@download',
        ]);
//
        Route::get(config('quickadmin.route') . '/forms', [
            'as'   => 'forms.builder',
            'uses' => 'ProjectsController@index'
        ]);
//
//        Route::get(config('quickadmin.route') . '/forms', function(){
//            return view('qa::forms.index');
//        });


    });
});

// @todo move to default routes.php
Route::group([
    'namespace'  => 'App\Http\Controllers',
    'middleware' => ['web']
], function () {
    // Point to App\Http\Controllers\UsersController as a resource


    Route::group([
        'middleware' => 'role'
    ], function () {
        Route::resource('users', 'UsersController');
        Route::resource('roles', 'RolesController');
    });
    Route::auth();
});
