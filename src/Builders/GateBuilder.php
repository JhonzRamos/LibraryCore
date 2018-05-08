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

class GateBuilder
{
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
    public function build($name, $model, $roles)
    {
//        return $this->compactBuilder();
        $this->roles = (array)$roles;
        $this->model_name = $model;
        $this->menu_name = $name;
        $this->template = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'provider';
        $template = (string)$this->loadTemplate();
        $template = $this->buildParts($template, $roles);
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
    private function buildParts($template, $roles)
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
        $name = $this->menu_name;
        $template = 'Gate::define(\''.$name.'\', function ($user) { '."\r\n";
        $template .= '            ';
        $template .= ' return in_array($user->role_id, ['.implode(",",(array)$this->roles).']);'."\r\n";
        $template .= '       ';
        $template .= ' });'."\r\n";
        $template .= '        ';
        $template .= "//APPEND//";
        return $template;
    }

    private function model()
    {
        $name = $this->model_name;
        $template = 'use App\\'.$name.';'."\r\n";
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
