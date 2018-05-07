<?php
namespace Laraveldaily\Quickadmin\Builders;


use Carbon\Carbon;
use Illuminate\Support\Str;
use Laraveldaily\Quickadmin\Cache\QuickCache;
use Laraveldaily\Quickadmin\Models\Files;
use Laraveldaily\Quickadmin\Models\Menu;
use Laraveldaily\Quickadmin\Models\ProjectMenus;
use Laraveldaily\Quickadmin\Models\Projects;

class RoutesBuilder
{
    // Controller namespace
    private $namespace = 'App\Http\Controllers\Admin';
    // Template
    private $template;
    // Global names
    private $name;
    private $className;
    private $modelName;
    private $createRequestName;
    private $updateRequestName;
    private $fileName;
    private $fields;
    private $relationships;
    private $files;
    private $enum;
    private $relationshipName;
    private $relationshipTable;
    // Menu Id
    private $menuId;

    /**
     * Build our controller file
     */
    public function build()
    {

        $this->template      = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'web';
        $template = (string)$this->loadTemplate();
        $template = $this->buildParts($template);
        $this->publish($template);
    }

    public function buildCustom()
    {
        $cache               = new QuickCache();
        $cached              = $cache->get('fieldsinfo');
        $this->template      = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'controller_many';
        $this->name          = $cached['name'];
        $this->fields        = $cached['fields'];
        $this->relationships = $cached['relationship_many'];
        $this->files         = $cached['files'];
        $this->enum          = $cached['enum'];
        $this->menuId     = $cached['menu_id'];
        $this->relationshipName     = $cached['reference_table']; //many

        $this->relationshipTable     = ucfirst(Str::camel($this->name)).ucfirst($this->relationshipName); //many
        $this->names();
        $template = (string)$this->loadTemplate();


        $template = $this->buildCustomParts($template);


            $this->publish($template);
    }

    public function buildCustomCRUD($name)
    {
        $this->template = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'customController';
        $this->name     = $name;
        $this->names();
        $template = (string)$this->loadTemplate();
        $template = $this->buildParts($template);
        $this->publish($template);
    }

    /**
     *  Load controller template
     */
    private function loadTemplate()
    {
        return file_get_contents($this->template);
    }

    /**
     * Build controller template parts
     *
     * @param $template
     *
     * @return mixed
     */
    private function buildParts($template)
    {
        $template = str_replace([
            '$ROUTES$'
        ], [
            $this->compactBuilder(),

        ], $template);

        return $template;
    }

    /**
     * Build compact for create form
     * @return mixed|string
     */
    public function compactBuilder()
    {
        $compact = '';

        $active = Projects::where('active', 1)->first();
        $menus1 = ProjectMenus::where('project_id',$active->id)->pluck('menu_id');

        $menus = Menu::with('children')->where('menu_type', '!=', 0)->orderBy('position')->whereIn('id',$menus1)->get();

        foreach ($menus as $menu) {
            switch ($menu->menu_type) {
                case 1:
                    $compact .= 'Route::post('.'\''.strtolower($menu->name).'/massDelete\''.', ['. '\'as\'' .' => '. '\''.strtolower($menu->name) . '.massDelete'.'\''.','.'\'uses\''.' => '.'\''.'Admin\\'.ucfirst(camel_case($menu->name)). 'Controller@massDelete'.'\''.','.']);'. "\r\n";
                    $compact .= '    ';
                    $compact .= 'Route::resource('.'\''.strtolower($menu->name).'\''.','.'\''.'Admin\\'.ucfirst(camel_case($menu->name)). 'Controller'.'\')'.';' . "\r\n";
                    $compact .= '    ';
                    break;
                case 3:
                    $compact .= 'Route::get('.'\''.strtolower($menu->name).'\''.', ['. '\'as\'' .' => '. '\''.strtolower($menu->name) . '.index'.'\''.','.'\'uses\''.' => '.'\''.'Admin\\'.ucfirst(camel_case($menu->name)). 'Controller@index'.'\''.','.']);'. "\r\n";
                    $compact .= '    ';
                    break;
            }
        }

            return $compact;

    }


    /**
     *  Generate names
     */
    private function names()
    {
        $camelName               = ucfirst(Str::camel($this->name));
        $this->className         = $camelName . 'Controller';
        $this->modelName         = $camelName;
        $this->createRequestName = 'Create' . $camelName . 'Request';
        $this->updateRequestName = 'Update' . $camelName . 'Request';

        $fileName       = $this->className . '.php';
        $this->fileName = $fileName;
    }

    /**
     *  Publish file into it's place
     */
    private function publish($template)
    {

//        file_put_contents(public_path('web.php'),
//            $template);

        file_put_contents( public_path('temp').DIRECTORY_SEPARATOR .'routes'.DIRECTORY_SEPARATOR. 'web.php', $template);

    }



}
