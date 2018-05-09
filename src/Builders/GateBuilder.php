<?php
namespace Laraveldaily\Quickadmin\Builders;


use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Laraveldaily\Quickadmin\Cache\QuickCache;
use Laraveldaily\Quickadmin\Models\Files;
use Laraveldaily\Quickadmin\Models\Menu;
use Laraveldaily\Quickadmin\Models\ProjectMenus;
use Laraveldaily\Quickadmin\Models\Projects;
use Laraveldaily\Quickadmin\Models\RolePermissions;

class GateBuilder
{
    protected $access;
    protected $create;
    protected $view;
    protected $edit;
    protected $delete;
    private $table;
    private $template;
    private $fileName;
    private $menu_name;
    private $roles ;
    private $model_name ;
    /**
     * Name of the database upon which the seed will be executed.
     *
     * @var string
     */
    protected $databaseName;

    /**
     * New line character for seed files.
     * Double quotes are mandatory!
     *
     * @var string
     */
    private $newLineCharacter = PHP_EOL;

    /**
     * Desired indent for the code.
     * For tabulator use \t
     * Double quotes are mandatory!
     *
     * @var string
     */
    private $indentCharacter = "    ";

    /**
     * @var Data
     */
    private $data;

    /**
     * @var Classname
     */
    private $className;

    /**
     * Build our seeder file
     */
    public function build($menu_id,$model)
    {
//        return $this->compactBuilder();

        //Create Gates
        $permissions = RolePermissions::where('menu_id', $menu_id)->get();
        $menu = Menu::findorfail($menu_id);
        $camelCase      = ucfirst(Str::camel($menu->name));
        $name    = strtolower($camelCase);
        $this->model_name = $model;
        $this->menu_name = $name;
        $this->access = array();
        $this->create = array();
        $this->view = array();
        $this->edit = array();
        $this->delete = array();

        foreach($permissions as $row){
            if($row->permission_id == 1) { //access
                $this->access[] = $row->role_id;
            }
            if($row->permission_id == 2) {//create
                $this->create[] = $row->role_id;
            }
            if($row->permission_id == 3) {//view
                $this->view[] = $row->role_id;
            }
            if($row->permission_id == 4) { //edit
                $this->edit[] = $row->role_id;
            }
            if($row->permission_id == 5) { //delete
                $this->delete[] = $row->role_id;
            }
        }




        $this->template =  public_path('temp').DIRECTORY_SEPARATOR .'app'.DIRECTORY_SEPARATOR. 'Providers' . DIRECTORY_SEPARATOR  . 'AuthServiceProvider.php';


        $template = (string)$this->loadTemplate();


        $template = $this->buildParts($template);


        $this->publish($template);

//
//        $this->table = $table;
//
//        $this->names();
//
//        'Gate::define(\'user_access\', function ($user) {
//            return in_array($user->role_id, [1]);
//        });';
//




    }

    public function compactBuilder()
    {
        $compact = '';

        $active = Projects::where('active', 1)->first();
        $menus1 = ProjectMenus::where('project_id',$active->id)->pluck('menu_id');

        $menus = Menu::with('children')->where('menu_type', '!=', 0)->orderBy('position')->whereIn('id',$menus1)->get();

        foreach ($menus as $menu) {
            $compact .= $menu->name. ', ';
        }

        return $compact;

    }


    /**
     *  Generate file and class names for the migration
     */
    private function names()
    {
        $fileName       = 'DatabaseSeeder'. '.php';
        $this->fileName = $fileName;
    }
    /**
     *  Load seeder template
     */
    private function loadTemplate()
    {
        return file_get_contents($this->template);
    }

    /**
     * Build seeder template parts
     *
     * @param $template
     *
     * @return mixed
     */
    private function buildParts($template)
    {
        $template = str_replace([
            '//MODEL//',
            '//APPEND//',

        ], [
            $this->model(),
            $this->tokenizer()

        ], $template);

        return $template;
    }


    private function tokenizer()
    {
        $permissions = ['access', 'create', 'view', 'edit', 'delete'];
        $roles = array(
            $this->access,
            $this->create,
            $this->view,
            $this->edit,
            $this->delete,
        );
        $name = $this->menu_name;
        $template ='';

        foreach($permissions as $key=>$value){
            $template .= 'Gate::define(\''.$name.'_'.$value.'\', function ($user) { '."\r\n";
            $template .= '            ';
            $template .= ' return in_array($user->role_id, ['.implode(",",$roles[$key]).']);'."\r\n";
            $template .= '       ';
            $template .= ' });'."\r\n";
            $template .= '        ';

        }

        $template .= "//APPEND//";

        return $template;
    }

    private function model()
    {
        $template = '';
        $template .= 'use App\\'.$this->model_name.';'."\r\n";
        $template .= "//MODEL//";
        return $template;
    }


    /**
     *  Publish file into it's place
     */
    private function publish($template)
    {
        file_put_contents( public_path('temp').DIRECTORY_SEPARATOR .'app'.DIRECTORY_SEPARATOR. 'Providers' . DIRECTORY_SEPARATOR  . 'AuthServiceProvider.php', $template);
    }





}
