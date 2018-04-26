<?php
namespace Laraveldaily\Quickadmin\Builders;


use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Laraveldaily\Quickadmin\Cache\QuickCache;
use Laraveldaily\Quickadmin\Models\Files;
use Laraveldaily\Quickadmin\Models\Menu;

class SeederBuilder
{

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
    public function build($table)
    {

        $database = config('database.default');


        $this->databaseName = $database;

        // Check if table exists
        if (!$this->hasTable($table)) {
            throw new TableNotFoundException("Table $table was not found.");
        }

        // Get the data
        $this->data = $this->tokenizer($this->getData($table, 0, null, null, 'ASC'));

        // Generate class name
        $this->className = $this->generateClassName($table);

        $this->names();

        $this->template = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'seed';

        $template = (string)$this->loadTemplate();



        $template = $this->buildParts($template);



        $this->publish($template);

    }
    /**
     *  Generate file and class names for the migration
     */
    private function names()
    {
        $fileName       = $this->className;
        $fileName       = $fileName. '.php';
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
            '$CLASS$',
            '$DATA$',

        ], [
            $this->className,
            $this->data,

        ], $template);

        return $template;
    }


    private function tokenizer($template)
    {
        $template = str_replace([
            '":',
            '{',
            '}',

        ], [
            '"=>',
            '[',
            ']',

        ], $template);

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
        return ucfirst($tableString) . 'Seed';
    }


}
