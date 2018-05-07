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
    public function build()
    {
        return $this->compactBuilder();


//        $this->template = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'provider';
//
//        $this->table = $table;
//
//        $this->names();
//
//        'Gate::define(\'user_access\', function ($user) {
//            return in_array($user->role_id, [1]);
//        });';
//
//        $template = (string)$this->loadTemplate();
//        $template = $this->buildParts($template);
//        $this->publish($template);

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
            '$CALLS$',

        ], [
            $this->tokenizer($this->table)

        ], $template);

        return $template;
    }


    private function tokenizer($table)
    {

        $template = '';

        foreach ($table as $row) {
            $seeds = new SeederBuilder();
            $seeds->build($row);
            $template .= '        ';
            $template .= '$this->call('.$row["modelName"].'Seeder::class);'. "\r\n";
        }

        return $template;
    }


    /**
     *  Publish file into it's place
     */
    private function publish($template)
    {

        file_put_contents( public_path('temp').DIRECTORY_SEPARATOR .'database'.DIRECTORY_SEPARATOR.'seeds' .DIRECTORY_SEPARATOR . $this->fileName, $template);

    }

    /**
     * Checks if a database table exists
     * @param string $table
     * @return boolean
     */
    public function hasTable($table)
    {
        return Schema::connection($this->databaseName)->hasTable($table);
    }

    /**
     * Get the Data
     * @param  string $table
     * @return Array
     */
    public function getData($table, $max, $exclude = null, $orderBy = null, $direction = 'ASC')
    {
        $max =0;

        $result = \DB::connection($this->databaseName)->table($table);

        if (!empty($exclude)) {
            $allColumns = \DB::connection($this->databaseName)->getSchemaBuilder()->getColumnListing($table);
            $result = $result->select(array_diff($allColumns, $exclude));
        }

        if($orderBy) {
            $result = $result->orderBy($orderBy, $direction);
        }

        if ($max) {
            $result = $result->limit($max);
        }

        return $result->get();
    }

    /**
     * Generates a seed class name (also used as a filename)
     * @param  string  $table
     * @return string
     */
    public function generateClassName($table)
    {
        $tableString = '';
        $tableName = explode('_', $table);
        foreach ($tableName as $tableNameExploded) {
            $tableString .= ucfirst($tableNameExploded);
        }
        return ucfirst($tableString);
    }


}
