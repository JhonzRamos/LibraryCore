<?php
namespace Laraveldaily\Quickadmin\Builders;

use Laraveldaily\Quickadmin\Models\Files;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Laraveldaily\Quickadmin\Cache\QuickCache;

class ViewsBuilder
{
    // Templates
    protected $formFieldsShow;
    private $template; // Array: [0]->index, [1]->edit, [2]->create
    // Variables
    private $fields;
    private $route;
    private $resource;
    private $headings;
    private $columns;
    private $formFieldsEdit;
    private $model;
    private $path;
    private $formFieldsCreate;
    private $files;
    private $relationshipName ;
    private $toggle ;
    private $dataTable;
    // @todo Move into FieldsDescriber for usage in fields extension
    private $starred = [
        'required',
        'required|unique'
    ];
    // Menu Id
    private $menu_id;
    private $title ;
    private $icon ;


    /**
     * Build our views files
     */
    public function build()
    {
        $cache          = new QuickCache();
        $cached         = $cache->get('fieldsinfo');
        $this->template = [
            0 => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'view_index',
            1 => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'view_edit',
            2 => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'view_create',
            3 => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'view_show',
        ];
        $this->name     = $cached['name'];
        $this->fields   = $cached['fields'];
        $this->files    = $cached['files'];
        $this->relationshipName     = $cached['reference_table']; //many
        $this->menu_id     = $cached['menu_id'];
        $this->title     = $cached['title'];
        $this->icon     = $cached['icon'];
        $this->names();
        $template = (array)$this->loadTemplate();
        $template = $this->buildParts($template);

        $this->publish($template);
    }

    public function buildCustom($name, $id)
    {
        $this->menu_id      = $id;
        $this->name     = $name;
        $this->template = [
            0 => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'customView_index',
            1 => '',
            2 => '',
            3 => ''
        ];
        $this->names();
        $template = (array)$this->loadTemplate();
        $this->publishCustom($template);

    }

    /**
     *  Load views templates
     */
    private function loadTemplate()
    {
        return [
            0 => $this->template[0] != '' ? file_get_contents($this->template[0]) : '',
            1 => $this->template[1] != '' ? file_get_contents($this->template[1]) : '',
            2 => $this->template[2] != '' ? file_get_contents($this->template[2]) : '',
            3 => $this->template[3] != '' ? file_get_contents($this->template[3]) : '',
        ];
    }

    /**
     * Build views templates parts
     *
     * @param $template
     *
     * @return mixed
     */
    private function buildParts($template)
    {
        $this->buildTable();
        $this->buildCreateForm();
        $this->buildEditForm();
        $this->buildShowForm();


        // Index template
        $template[0] = str_replace([
            '$ICON$',
            '$NAME$',
            '$ROUTE$',
            '$RESOURCE$',
            '$HEADINGS$',
            '$FIELDS$',
            '$TOGGLE$',
            '$TABLE$',
            '$COLUMN$'
        ], [
            $this->icon,
            $this->title,
            $this->route,
            $this->resource,
            $this->headings,
            $this->columns,
            $this->toggle,
            ucfirst($this->resource),
            $this->dataTable,
        ], $template[0]);

        // Edit template
        $template[1] = str_replace([
            '$NAME$',
            '$ROUTE$',
            '$RESOURCE$',
            '$FORMFIELDS$',
            '$MODEL$',
            '$FILES$'
        ], [
            $this->title,
            $this->route,
            $this->resource,
            $this->formFieldsEdit,
            $this->model,
            $this->files != 0 ? "'files' => true, " : ''
        ], $template[1]);

        // Create template
        $template[2] = str_replace([
            '$NAME$',
            '$ROUTE$',
            '$RESOURCE$',
            '$FORMFIELDS$',
            '$FILES$'
        ], [
            $this->title,
            $this->route,
            $this->resource,
            $this->formFieldsCreate,
            $this->files != 0 ? "'files' => true, " : ''
        ], $template[2]);

        // Show template
        $template[3] = str_replace([
            '$NAME$',
            '$ROUTE$',
            '$RESOURCE$',
            '$FORMFIELDS$',
            '$MODEL$',
            '$FILES$'
        ], [
            $this->title,
            $this->route,
            $this->resource,
            $this->formFieldsShow,
            $this->model,
            $this->files != 0 ? "'files' => true, " : ''
        ], $template[3]);

        return $template;
    }

    /**
     *  Build index table
     */
    private function buildTable()
    {
        $used     = [];
        $headings = '';
        $columns  = '';
        $dataTable = [];
        $toggle   = '';
        $index = 1;

        $temp = [
            "width" => '30px',
            "targets" => 0,
            "searchable" =>  false,
            "orderable" =>  false,
            "visible" => true
        ];

        array_push($dataTable, $temp);


        foreach ($this->fields as $field) {

            // Check if there is no duplication for radio and checkbox.
            // Password fields are excluded from the table too.
            if (! in_array($field->title, $used)
                && $field->type != 'password'
                && $field->type != 'textarea'
                && $field->list == 1
            ) {
                $headings .= "<th>$field->label</th>\r\n";
                $toggle .= '<li action="form" data-column="'.$index.'" class="toggle-vis Checked">' .
                            '<a href="javascript:void(0)"><i class="fa fa-check"></i>'.$field->label.'</a>' .
                            '</li>'."\r\n";

                $temp = [
                    "targets" => $index,
                    "searchable" =>  ($field->search == 1)? true : false,
                    "orderable" =>  true,
                    "visible" => ($field->list == 1)? true : false
                ];

                // Format our table column by field type ///RENDER
                if ($field->type == 'relationship') {
                    $columns .= '<td>{{ isset($row->' . $field->relationship_name . '->' . $field->relationship_field . ') ? $row->' . $field->relationship_name . '->' . $field->relationship_field . " : '' }}</td>\r\n";
                    $used[$field->relationship_field] = $field->relationship_field;

                }elseif ($field->type == 'relationship_many') {
                    $columns .='<td> @forelse($row->' . $field->relationship_name . ' as $key) <span class="label label-primary">{{$key->' . $field->relationship_name . '->' . $field->relationship_field . '}}</span> @empty Empty @endforelse </td>';
                    $used[$field->relationship_field] = $field->relationship_field;
                }
                elseif ($field->type == 'photo') {
                    $columns .= '<td>@if($row->' . $field->title . ' != \'\')<a href="{{ asset(\'uploads/thumb\') . \'/\'.  $row->' . $field->title . ' }}\" class="image-thumbnail"><img src="{{ asset(\'uploads/thumb\') . \'/\'.  $row->' . $field->title . " }}\" height=\"50px\"></a>@endif</td>\r\n";
                    $used[$field->title] = $field->title;
                } elseif ($field->type == 'file') {
                $columns .= '<td>{{ HTML::link( \'/uploads/\'.$row->'.$field->title.', $row->'.$field->title." ) }}</td>\r\n"; ///file render
                $used[$field->title] = $field->title;
                }
                elseif ($field->type == 'color') {
                    $columns .= '<td><div style="width: 14px;height: 14px;display: inline-block; background: {{ $row->'.$field->title.' }};"></div> <label>{{ $row->'.$field->title."}}</label></td>"; ///file render
                    $used[$field->title] = $field->title;
                }
                elseif ($field->type == 'toggle') {
                    $columns .= '@if($row->'.$field->title.'== 1)<td><span class="label label-success">True</span></td>@else<td><span class="label label-danger">False</span></td>@endif'; ///file render
                    $used[$field->title] = $field->title;
                }
                else {
                    $columns .= '<td>{{ $row->' . $field->title . " }}</td>\r\n";
                    $used[$field->title] = $field->title;
                }

                $index++;
            }

            array_push($dataTable, $temp);
        }



        $temp = [
            "width" =>"200px",
            "targets" => $index,
            "searchable" =>  false,
            "orderable" =>  false,
            "visible" => true
        ];

        array_push($dataTable, $temp);

        $this->dataTable = json_encode([ 'columnDefs' => $dataTable], 1);

        $this->headings = $headings;
        $this->columns  = $columns;
        $this->toggle  = $toggle;



    }

    /**
     *  Build edit.blade.php form
     */
    private function buildEditForm()
    {
        $form = '';
        foreach ($this->fields as $field) {
            if($field->edit == 1){
                $title = addslashes($field->label);
                $label = $field->title;
                if (in_array($field->validation,
                        $this->starred) && $field->type != 'password' && $field->type != 'file' && $field->type != 'photo'
                ) {
                    $title .= '*';
                }
                if ($field->type == 'relationship') {
                    $label = $field->relationship_name . '_id';
                }

                if ($field->type == 'relationship_many') {
                    $label = $field->relationship_name;
                }
                if ($field->type == 'checkbox') {
                    $field->default = '$' . $this->model . '->' . $label . ' == 1';
                }
                $temp = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'fields' . DIRECTORY_SEPARATOR . $field->type);
                $temp = str_replace([
                    'old(\'$LABEL$\')',
                    '$LABEL$',
                    '$TITLE$',
                    '$VALUE$',
                    '$STATE$',
                    '$SELECT$',
                    '$TEXTEDITOR$',
                    '$HELPER$',
                    '$WIDTH$',
                    '$HEIGHT$',
                ], [
                    ($field->type == 'relationship_many') ? '$old_'.strtolower($this->relationshipName) :'old(\'$LABEL$\',$' . $this->resource . '->' . $label . ')',
                    ($field->type == 'relationship_many') ? $label. '_id[]' :$label,
                    $title,
                    $field->type != 'radio' ?
                        $field->value != '' ? ', "' . $field->value . '"' : ''
                        : "'$field->value'",
                    $field->default,
                    '$' . $field->relationship_name,
                    $field->texteditor == 1 ? ' mceEditor' : ' mceNoEditor',
                    $this->helper($field->helper),
                    $field->dimension_w,
                    $field->dimension_h,

                ], $temp);
                $form .= $temp;
            }
        }
        $this->formFieldsEdit = $form;
    }

    /**
     *  Build show.blade.php form
     */
    private function buildShowForm()
    {

        $form = '';
        foreach ($this->fields as $field) {
            if($field->show == 1){
                $title = addslashes($field->label);
                $label = $field->title;
                if (in_array($field->validation,
                        $this->starred) && $field->type != 'password' && $field->type != 'file' && $field->type != 'photo'
                ) {
                    $title .= '*';
                }
                if ($field->type == 'relationship') {
                    $label = $field->relationship_name . '_id';
                }

                if ($field->type == 'relationship_many') {
                    $label = $field->relationship_name;
                }
                if ($field->type == 'checkbox') {
                    $field->default = '$' . $this->model . '->' . $label . ' == 1';
                }
                $temp = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'fields' . DIRECTORY_SEPARATOR . $field->type);
                $temp = str_replace([
                    'old(\'$LABEL$\')',
                    '$LABEL$',
                    '$TITLE$',
                    '$VALUE$',
                    '$STATE$',
                    '$SELECT$',
                    '$TEXTEDITOR$',
                    '$HELPER$',
                    '$WIDTH$',
                    '$HEIGHT$',
                ], [
                    ($field->type == 'relationship_many') ? '$old_'.strtolower($this->relationshipName) :'old(\'$LABEL$\',$' . $this->resource . '->' . $label . ')',
                    ($field->type == 'relationship_many') ? $label. '_id[]' :$label,
                    $title,
                    $field->type != 'radio' ?
                        $field->value != '' ? ', "' . $field->value . '"' : ''
                        : "'$field->value'",
                    $field->default,
                    '$' . $field->relationship_name,
                    $field->texteditor == 1 ? ' mceEditor' : ' mceNoEditor',
                    $this->helper($field->helper),
                    $field->dimension_w,
                    $field->dimension_h,

                ], $temp);
                $form .= $temp;
            }
        }
        $this->formFieldsShow = $form;
    }

    /**
     *  Build create.blade.php form
     */
    private function buildCreateForm()
    {
        $form = '';
        foreach ($this->fields as $field) {
            if($field->add == 1){
                $title = addslashes($field->label);
                $key   = $field->title;
                if (in_array($field->validation, $this->starred)) {
                    $title .= '*';
                }
                if ($field->type == 'relationship') {
                    $key = $field->relationship_name . '_id';
                }

                if ($field->type == 'relationship_many') {
                    $key = $field->relationship_name . '_id[]';
                }

                $temp = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR . 'fields' . DIRECTORY_SEPARATOR . $field->type);
                $temp = str_replace([
                    '$LABEL$',
                    '$TITLE$',
                    '$VALUE$',
                    '$STATE$',
                    '$SELECT$',
                    '$TEXTEDITOR$',
                    '$HELPER$',
                    '$WIDTH$',
                    '$HEIGHT$',
                ], [
                    $key,
                    $title,
                    $field->type != 'radio' ?
                        $field->value != '' ? ', ' . $field->value : ''
                        : "'$field->value'",
                    $field->default,
                    '$' . $field->relationship_name,
                    $field->texteditor == 1 ? ' mceEditor' : ' mceNoEditor',
                    $this->helper($field->helper),
                    $field->dimension_w,
                    $field->dimension_h,
                ], $temp);
                $form .= $temp;
            }
        }
        $this->formFieldsCreate = $form;
    }

    /**
     *  Generate names for the views
     */
    private function names()
    {
        $camelCase      = ucfirst(Str::camel($this->name));
        $this->route    = strtolower($camelCase);
        $this->path     = strtolower($camelCase);
        $this->resource = strtolower($camelCase);
        $this->model    = strtolower($camelCase);
    }

    /**
     * Create helper blocks for form fields
     *
     * @param $value
     *
     * @return string
     */
    private function helper($value)
    {
        if ($value != '') {
            return '<p class="help-block">' . $value . '</p>';
        } else {
            return '';
        }
    }

    /**
     *  Publish files into their places
     */
    private function publish($template)
    {
        if (! file_exists(base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path))) {
            mkdir(base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path));
            chmod(base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin'), 0777);
        }
        file_put_contents(base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path . DIRECTORY_SEPARATOR . 'index.blade.php'),
            $template[0]);

        $file = new Files();
        $file->path = base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path . DIRECTORY_SEPARATOR . 'index.blade.php');
        $file->type = "View";
        $file->created_at = Carbon::now();
        $file->updated_at = Carbon::now();
        $file->menu_id = $this->menu_id;
        $file->filename = $this->path . DIRECTORY_SEPARATOR . 'index.blade.php';
        $file->save();

        file_put_contents(base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path . DIRECTORY_SEPARATOR . 'edit.blade.php'),
            $template[1]);

        $file = new Files();
        $file->path = base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path . DIRECTORY_SEPARATOR . 'edit.blade.php');
        $file->type = "View";
        $file->created_at = Carbon::now();
        $file->updated_at = Carbon::now();
        $file->menu_id = $this->menu_id;
        $file->filename = $this->path . DIRECTORY_SEPARATOR . 'edit.blade.php';
        $file->save();

        file_put_contents(base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path . DIRECTORY_SEPARATOR . 'create.blade.php'),
            $template[2]);

        $file = new Files();
        $file->path = base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path . DIRECTORY_SEPARATOR . 'create.blade.php');
        $file->type = "View";
        $file->created_at = Carbon::now();
        $file->updated_at = Carbon::now();
        $file->menu_id = $this->menu_id;
        $file->filename = $this->path . DIRECTORY_SEPARATOR . 'create.blade.php';
        $file->save();

        file_put_contents(base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path . DIRECTORY_SEPARATOR . 'show.blade.php'),
            $template[3]);

        $file = new Files();
        $file->path = base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path . DIRECTORY_SEPARATOR . 'show.blade.php');
        $file->type = "View";
        $file->created_at = Carbon::now();
        $file->updated_at = Carbon::now();
        $file->menu_id = $this->menu_id;
        $file->filename = $this->path . DIRECTORY_SEPARATOR . 'show.blade.php';
        $file->save();

    }

    private function publishCustom($template)
    {
        if (! file_exists(base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path))) {
            mkdir(base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path));
            chmod(base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin'), 0777);
        }
        file_put_contents(base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path . DIRECTORY_SEPARATOR . 'index.blade.php'),
            $template[0]);

        $file = new Files();
        $file->path = base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . $this->path . DIRECTORY_SEPARATOR . 'index.blade.php');
        $file->type = "View";
        $file->created_at = Carbon::now();
        $file->updated_at = Carbon::now();
        $file->menu_id = $this->menu_id;
        $file->filename = $this->path . DIRECTORY_SEPARATOR . 'index.blade.php';
        $file->save();
    }

}