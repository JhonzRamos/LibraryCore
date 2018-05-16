<?php
namespace Laraveldaily\Quickadmin\Builders;

use Laraveldaily\Quickadmin\Models\Files;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Laraveldaily\Quickadmin\Cache\QuickCache;
use Laraveldaily\Quickadmin\Models\Menu;

class ModelBuilder
{
    // Model namespace
    private $namespace = 'App';
    // Template
    private $template;
    // Names
    private $name;
    private $className;
    private $fileName;
    private $relationshipName;
    private $pivotTable;
    // Fields
    private $fields;
    // Soft delete?
    private $soft;
    // Have password?
    private $password;
    // Have datepickers?
    private $date;
    // Have datetimepickers?
    private $datetime;
    // Have enum?
    private $enum;
    // Menu Id
    private $menuId;


    /**
     * Build our model file
     */
    public function build()
    {
        $cache          = new QuickCache();
        $cached         = $cache->get('fieldsinfo');
        $this->template = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'model';

        $this->name     = $cached['name'];
        $this->fields   = $cached['fields'];
        $this->soft     = $cached['soft_delete'];
        $this->password = $cached['password'];
        $this->date     = $cached['date'];
        $this->datetime = $cached['datetime'];
        $this->enum     = $cached['enum'];
        $this->menuId     = $cached['menu_id'];
        $this->names();
        $template = (string)$this->loadTemplate();
        $template = $this->buildParts($template);

        $this->publish($template);
    }

    /**
     * Build our reference model file
     */
    public function buildCustom()
    {
        $cache          = new QuickCache();
        $cached         = $cache->get('fieldsinfo');
        $this->template = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'model';
        $this->relationshipName = $cached['reference_table'];
        $this->name     = $cached['name'];
        $this->fields   = $cached['fields'];
        $this->soft     = $cached['soft_delete'];
        $this->password = $cached['password'];
        $this->date     = $cached['date'];
        $this->datetime = $cached['datetime'];
        $this->enum     = $cached['enum'];
        $this->menuId     = $cached['menu_id'];
        $this->pivotTable = strtolower(Str::camel($this->name)).'_'.strtolower(Str::camel( $this->relationshipName ));
        $this->className = ucfirst(Str::camel($this->name)).ucfirst(Str::camel( $this->relationshipName ));
        $fileName       = $this->className . '.php';
        $this->fileName = $fileName;
        $template = (string)$this->loadTemplate();
        $template = $this->buildCustomParts($template);

        $this->publish($template);
    }

    /**
     *  Load model template
     */
    private function loadTemplate()
    {
        return file_get_contents($this->template);
    }


    /**
     * Build reference model template parts
     *
     * @param $template
     *
     * @return mixed
     */
    private function buildCustomParts($template)
    {
        // Insert table names
        $tableName = $this->pivotTable;
        if ($this->soft == 1) {
            $soft_call = 'use Illuminate\Database\Eloquent\SoftDeletes;';
            $soft_use  = 'use SoftDeletes;';
            $soft_date = '/**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = [\'deleted_at\'];';
        } else {
            $soft_call = '';
            $soft_use  = '';
            $soft_date = '';
        }
        $template = str_replace([
            '$NAMESPACE$',
            '$SOFT_DELETE_CALL$',
            '$SOFT_DELETE_USE$',
            '$SOFT_DELETE_DATES$',
            '$TABLENAME$',
            '$CLASS$',
            '$FILLABLE$',
            '$RELATIONSHIPS$',
            '$PASSWORDHASH_CALL$',
            '$PASSWORDHASH$',
            '$DATEPICKERS_CALL$',
            '$DATEPICKERS$',
            '$DATETIMEPICKERS$',
            '$ENUMS$',
        ], [
            $this->namespace,
            $soft_call,
            $soft_use,
            $soft_date,
            $tableName,
            $this->className,
            "'" . strtolower(Str::camel($this->name)) . "_id', '". $this->relationshipName  ."_id'",
            $this->buildCustomRelationships(),
            $this->password > 0 ? "use Illuminate\Support\Facades\Hash; \n\r" : '',
            $this->password > 0 ? $this->passwordHash() : '',
            $this->date > 0 || $this->datetime > 0 ? "use Carbon\Carbon; \n\r" : '',
            $this->date > 0 ? $this->datepickers() : '',
            $this->datetime > 0 ? $this->datetimepickers() : '',
            $this->enum > 0 ? $this->enum() : '',
        ], $template);


       return $template;
    }
    /**
     * Build model template parts
     *
     * @param $template
     *
     * @return mixed
     */
    private function buildParts($template)
    {


        $camelName = Str::camel($this->name);
        // Insert table names
        $tableName = strtolower($camelName);
        if ($this->soft == 1) {
            $soft_call = 'use Illuminate\Database\Eloquent\SoftDeletes;';
            $soft_use  = 'use SoftDeletes;';
            $soft_date = '/**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = [\'deleted_at\'];';
        } else {
            $soft_call = '';
            $soft_use  = '';
            $soft_date = '';
        }


        $template = str_replace([
            '$NAMESPACE$',
            '$SOFT_DELETE_CALL$',
            '$SOFT_DELETE_USE$',
            '$SOFT_DELETE_DATES$',
            '$TABLENAME$',
            '$CLASS$',
            '$FILLABLE$',
            '$RELATIONSHIPS$',
            '$PASSWORDHASH_CALL$',
            '$PASSWORDHASH$',
            '$DATEPICKERS_CALL$',
            '$DATEPICKERS$',
            '$DATETIMEPICKERS$',
            '$ENUMS$',
        ], [
            $this->namespace,
            $soft_call,
            $soft_use,
            $soft_date,
            $tableName,
            $this->className,
            $this->buildFillables(),
            $this->buildRelationships(),
            $this->password > 0 ? "use Illuminate\Support\Facades\Hash; \n\r" : '',
            $this->password > 0 ? $this->passwordHash() : '',
            $this->date > 0 || $this->datetime > 0 ? "use Carbon\Carbon; \n\r" : '',
            $this->date > 0 ? $this->datepickers() : '',
            $this->datetime > 0 ? $this->datetimepickers() : '',
            $this->enum > 0 ? $this->enum() : '',
        ], $template);

        return $template;
    }

    /**
     * Build model fillables
     * @return string
     */
    private function buildFillables()
    {
        $used      = [];
        $fillables = '';
        $count     = count($this->fields);
        // Move to the new line if we have more than one field
        if ($count > 1) {
            $fillables .= "\r\n";
        }
        foreach ($this->fields as $key => $field) {
            // Check if there is no duplication for radio and checkbox
            if (! in_array($field->title, $used)) {
                if ($count > 1) {
                    $fillables .= '          '; // Add formatting space to the model
                }
                if ($field->type == 'relationship') {
                    $fillables .= "'" . $field->relationship_name . "_id'";
                    $used[$field->relationship_name] = $field->relationship_name;
                }else {
                    $fillables .= "'" . $field->title . "'";
                    $used[$field->title] = $field->title;
                }
                // Formatting lines
                if ($count != 1) {
                    if ($key != $count - 1) {
                        $fillables .= ",\r\n";
                    } else {
                        if ($key == $count - 1) {
                            $fillables .= "\r\n    ";
                        } else {
                            $fillables .= "\r\n";
                        }
                    }
                }
            }
        }

        return $fillables;
    }


    /**
     * Build model relationships
     * @return string
     */
    private function buildRelationships()
    {
        $menus         = Menu::all()->keyBy('id');
        $used          = [];
        $relationships = '';
        foreach ($this->fields as $key => $field) {
            if (! in_array($field->title, $used) && $field->type == 'relationship') {
                $menu    = $menus[$field->relationship_id];
                $relLine = '
    public function $RELATIONSHIP$()
    {
        return $this->hasOne(\'App\$RELATIONSHIP_MODEL$\', \'id\', \'$RELATIONSHIP$_id\');
    }' . "\r\n\r\n";
                $relLine = str_replace([
                    '$RELATIONSHIP$',
                    '$RELATIONSHIP_MODEL$'
                ], [
                    strtolower($menu->name),
                    ucfirst(Str::camel($menu->name))
                ], $relLine);
                $relationships .= $relLine;
            }

            else if (! in_array($field->title, $used) && $field->type == 'relationship_many') {
                $menu    = $menus[$field->relationship_id];
                $relLine = '
    public function $RELATIONSHIP$()
    {
        return $this->hasMany(\'App\$TABLENAME$$RELATIONSHIP_MODEL$\', \'$LOCALKEY$_id\', \'id\');
    }' . "\r\n\r\n";
                $relLine = str_replace([
                    '$RELATIONSHIP$',
                    '$RELATIONSHIP_MODEL$',
                    '$TABLENAME$',
                    '$LOCALKEY$',

                ], [
                    strtolower(Str::camel($menu->name)),
                    ucfirst(Str::camel($menu->name)),
                    ucfirst(Str::camel($this->name)),
                    strtolower(Str::camel($this->name))
                ], $relLine);
                $relationships .= $relLine;
            }

            
        }

        return $relationships;
    }

    /**
     * Build model relationships
     * @return string
     */
    private function buildCustomRelationships()
    {
        $relationships = '';

        $relLine = '
            public function $RELATIONSHIP1$()
            {
                return $this->belongsTo(\'App\$RELATIONSHIP_MODEL1$\', \'$RELATIONSHIP1$_id\', \'id\');
            }' . "\r\n\r\n" .'
            public function $RELATIONSHIP2$()
            {
                return $this->belongsTo(\'App\$RELATIONSHIP_MODEL2$\', \'$RELATIONSHIP2$_id\', \'id\');
            }' . "\r\n\r\n";




        $relLine = str_replace([
            '$RELATIONSHIP1$',
            '$RELATIONSHIP2$',
            '$RELATIONSHIP_MODEL1$',
            '$RELATIONSHIP_MODEL2$'
        ], [
            strtolower(Str::camel($this->name)),
            strtolower(Str::camel($this->relationshipName)),
            ucfirst(Str::camel($this->name)),
            ucfirst(Str::camel($this->relationshipName))
        ], $relLine);


        $relationships .= $relLine;


        return $relationships;
    }

    /**
     *  Generate file and class names for the model
     */
    private function names()
    {
        $this->className = ucfirst(Str::camel($this->name));

        $fileName       = $this->className . '.php';
        $this->fileName = $fileName;
    }

    /**
     *  Publish file into it's place
     */
    private function publish($template)
    {
        file_put_contents(app_path($this->fileName), $template);
        $file = new Files();
        $file->path = app_path($this->fileName);
        $file->type = "Model";
        $file->created_at = Carbon::now();
        $file->updated_at = Carbon::now();
        $file->menu_id = $this->menuId;
        $file->filename =  $this->fileName;
        $file->save();
    }

    private function passwordHash()
    {
        $passwordHashes = '';
        foreach ($this->fields as $field) {
            if ($field->type == 'password') {
                $camel = ucfirst(Str::camel(str_replace('_', ' ', $field->title)));
                $passwordHashes .= '/**
     * Hash password
     * @param $input
     */
    public function set' . $camel . 'Attribute($input)
    {
        $this->attributes[\'' . $field->title . '\'] = Hash::make($input);
    }' . "\r\n\r\n";
            }
        }

        return $passwordHashes;
    }

    private function datepickers()
    {
        $dates = '';
        foreach ($this->fields as $field) {
            if ($field->type == 'date') {
                $camel = ucfirst(Str::camel(str_replace('_', ' ', $field->title)));
                $dates .= '/**
     * Set attribute to date format
     * @param $input
     */
    public function set' . $camel . 'Attribute($input)
    {
        if($input != \'\') {
            $this->attributes[\'' . $field->title . '\'] = Carbon::parse($input)->format(\'Y-m-d\');
        }else{
            $this->attributes[\'' . $field->title . '\'] = \'\';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function get' . $camel . 'Attribute($input)
    {
        if($input != \'0000-00-00\') {
            return Carbon::parse($input)->format(\'Y-m-d\');
        }else{
            return \'\';
        }
    }' . "\r\n\r\n";
            }
        }

        return $dates;
    }

    private function datetimepickers()
    {
        $dates = '';
        foreach ($this->fields as $field) {
            if ($field->type == 'datetime') {
                $camel = ucfirst(Str::camel(str_replace('_', ' ', $field->title)));
                $dates .= '/**
     * Set attribute to datetime format
     * @param $input
     */
    public function set' . $camel . 'Attribute($input)
    {
        if($input != \'\') {
            $this->attributes[\'' . $field->title . '\'] = Carbon::parse($input)->format(\'Y-m-d H:i:s\');
        }else{
            $this->attributes[\'' . $field->title . '\'] = \'\';
        }
    }

    /**
     * Get attribute from datetime format
     * @param $input
     *
     * @return string
     */
    public function get' . $camel . 'Attribute($input)
    {
        if($input != \'0000-00-00\') {
            return Carbon::parse($input)->format(\'Y-m-d H:i:s\');
        }else{
            return \'\';
        }
    }' . "\r\n\r\n";
            }
        }

        return $dates;
    }

    /**
     * Generate enum model
     * @return string
     */
    public function enum()
    {
        $return = "\r\n";
        foreach ($this->fields as $field) {
            if ($field->type == 'enum') {
                $values      = '';
                $field->enum = explode(',', $field->enum);
                foreach ($field->enum as $val) {
                    // Remove first whitespace
                    if (strpos(substr($val, 0, 1), ' ') !== false) {
                        $len = strlen($val);
                        $val = substr($val, 1, $len);
                    }
                    $values .= '"' . $val . '" => "' . $val . '"';
                    if ($val != last($field->enum)) {
                        $values .= ', ';
                    }
                }
                $return .= '    public static $' . $field->title . ' = [' . $values . '];' . "\r\n";
            }
        }

        return $return;
    }
}