@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-10 col-sm-offset-2">


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        {!! implode('', $errors->all('
                        <li class="error">:message</li>
                        ')) !!}
                    </ul>
                </div>
            @endif
        </div>
    </div>

    {!! Form::open(['class' => 'form-horizontal']) !!}

    <div class="row">
        <div class="col-md-12">

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-cogs"></i> CRUD Settings</h3>

                </div>
                <div class="box-body">


                    <div class="form-group">
                        {!! Form::label('parent_id', 'Parent', ['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('parent_id', $parentsSelect, old('parent_id'), ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Table Name*', ['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::qa.menus-createCrud-crud_name_placeholder')]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('title', 'Menu Name*', ['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::qa.menus-createCrud-crud_title_placeholder'), 'required'=> 'required']) !!}
                        </div>
                    </div>


                    <div class="form-group">
                        {!! Form::label('action', 'Actions', ['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            <div>
                                <label>
                                    {!! Form::checkbox('action[]', 'api', 1) !!}
                                    Generate API
                                </label>
                            </div>
                            <div>
                                <label>
                                    {!! Form::checkbox('action[]', 'ajax', 1) !!}
                                    AJAX datatables
                                </label>
                            </div>

                        </div>
                    </div>






                    <div class="form-group">
                        {!! Form::label('soft', trans('quickadmin::qa.menus-createCrud-soft_delete'), ['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::select('soft', [1 => trans('quickadmin::strings.yes'), 0 => trans('quickadmin::strings.no')], old('soft'), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('icon', trans('quickadmin::qa.menus-createCrud-icon'), ['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {{--{!! Form::text('icon', old('icon','fa-database'), ['class'=>'form-control icp icp-auto',  'placeholder'=> trans('quickadmin::qa.menus-createCrud-icon_placeholder')]) !!}--}}
                            <div class="input-group">
                                {!! Form::text('icon', old('icon','fa-archive'), ['class'=>'form-control icp icp-auto', 'data-placement'=>'bottomRight', 'placeholder'=> trans('quickadmin::qa.menus-createCrud-icon_placeholder')]) !!}
                                <span class="input-group-addon"></span>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('quickadmin::qa.menus-createCrud-add_fields') }}</div>
        <div class="panel-body">

            <div class="form-group">
                <div class="col-md-12">
                    <button type="button" id="addField" class="btn btn-success"><i
                                class="fa fa-plus"></i> {{ trans('quickadmin::qa.menus-createCrud-add_field') }}
                    </button>
                </div>
            </div>
            <em><b>Notice:</b> you <strong>don't</strong> need to add <b>ID</b> and <b>Timestamps</b> fields - they are added automatically.</em>

            <table class="table table-bordered">
                <thead>
                    <th>Field Type</th>
                    <th>Database column</th>
                    <th>Visual Title</th>
                    <th>Render<span>*</span></th>
                    <th>In List</th>
                    <th>In Add</th>
                    <th>In Show</th>
                    <th>In Edit</th>
                    <th>In Search</th>
                    <th>Validation</th>
                    <th>Action</th>
                </thead>
                <tbody id="generator">


                @if(old('f_type'))
                    @foreach(old('f_type') as $index => $fieldName)
                        @include('tpl::menu_field_line', ['index' => $index])
                    @endforeach
                @else
                    @include('tpl::menu_field_line', ['index' => ''])
                @endif
                </tbody>
            </table>

        </div>
    </div>





    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="caption">Permissions</div>
        </div>
        <div class="panel-body">


                    <table class="table table-bordered ">
                        <thead>
                        <tr>
                            <th>Role</th>
                            <th width="100" class="text-center">
                                Access
                                <i data-toggle="tooltip" data-placement="top" data-html="true"
                                   title="Allows role to access this CRUD" class="fa fa-question-circle"></i> <input
                                        type="checkbox" class="mass_access" value="1"></th>
                            <th width="100" class="text-center">
                                Create
                                <i data-toggle="tooltip" data-placement="top" data-html="true"
                                   title="Allows role to create new entry" class="fa fa-question-circle"></i> <input
                                        type="checkbox" value="1" class="mass_create"></th>
                            <th width="100" class="text-center">
                                Edit
                                <i data-toggle="tooltip" data-placement="top" data-html="true" title=""
                                   class="fa fa-question-circle"
                                   data-original-title="Allows role to edit existing entry"></i> <input type="checkbox" class="mass_edit"
                                                                                                        value="1"></th>
                            <th width="100" class="text-center">
                                View
                                <i data-toggle="tooltip" data-placement="top" data-html="true"
                                   title="Allows role to view existing entry" class="fa fa-question-circle"></i> <input
                                        type="checkbox" class="mass_view" value="1"></th>
                            <th width="100" class="text-center">
                                Delete
                                <i data-toggle="tooltip" data-placement="top" data-html="true"
                                   title="Allows role to delete existing entry" class="fa fa-question-circle"></i>
                                <input type="checkbox" class="mass_delete" value="1"></th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($roles as $role)
                            <tr>
                                <td>
                                    <label>
                                        {!! $role->title !!}
                                        {!! Form::checkbox('roles['.$role->id.']',$role->id,old('roles.'.$role->id), ['class'=> 'single_role']) !!}
                                    </label>
                                </td>
                                <td class="text-center"><label style="width: 100%; height: 100%;"><input type="checkbox" class="single_access"
                                                                                                         name="permissions[{{$role->id}}][access]"
                                                                                                         value="1"></label>
                                </td>
                                <td class="text-center"><label style="width: 100%; height: 100%;"><input type="checkbox"  class="single_create"
                                                                                                         name="permissions[{{$role->id}}][create]"
                                                                                                         value="1"></label>
                                </td>
                                <td class="text-center"><label style="width: 100%; height: 100%;"><input type="checkbox" class="single_edit"
                                                                                                         name="permissions[{{$role->id}}][edit]"
                                                                                                         value="1"></label>
                                </td>
                                <td class="text-center"><label style="width: 100%; height: 100%;"><input type="checkbox" class="single_view"
                                                                                                         name="permissions[{{$role->id}}][view]"
                                                                                                         value="1"></label>
                                </td>
                                <td class="text-center"><label style="width: 100%; height: 100%;"><input type="checkbox" class="single_delete"
                                                                                                         name="permissions[{{$role->id}}][delete]"
                                                                                                         value="1"></label>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            {!! Form::submit(trans('quickadmin::qa.menus-createCrud-create_crud'), ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}





    <div style="display: none;">
        <table>
            <tbody id="line">
                @include('tpl::menu_field_line', ['index' => ''])
            </tbody>
        </table>

        <!-- Select for relationship column-->
        @foreach($models as $key => $model)
            <select name="f_relationship_field[{{ $key }}]" class="form-control relationship-field rf-{{ $key }}">
                <option value="">{{ trans('quickadmin::qa.menus-createCrud-select_display_field') }}</option>
                @foreach($model as $key2 => $option)
                    <option value="{{ $option }}"
                            @if($option == old('f_relationship_field.'.$key)) selected @endif>{{ $option }}</option>
                @endforeach
            </select>
            @endforeach
                    <!-- /Select for relationship column-->
    </div>

@endsection

@section('javascript')
        <script>$('.icp-auto').iconpicker();</script>
    <script>
        function typeChange(e) {



            var val = $(e).val();



            // Hide all possible outputs
            $(e).parent().parent().find('.value').hide();
            $(e).parent().parent().find('.default_c').hide();
            $(e).parent().parent().find('.relationship').hide();
            $(e).parent().parent().find('.title').show().val('');
            $(e).parent().parent().find('.texteditor').hide();
            $(e).parent().parent().find('.size').hide();
            $(e).parent().parent().find('.dimensions').hide();
            $(e).parent().parent().find('.enum').hide();

//            showElements(e);

            // Show a checbox which enables/disables showing in list
            $(e).parent().parent().find('.list2').show().prop('checked', true);
            $(e).parent().parent().find('.list_hid').val(1);
            $(e).parent().parent().find('.add2').show().prop('checked', true);
            $(e).parent().parent().find('.add_hid').val(1);
            $(e).parent().parent().find('.edit2').show().prop('checked', true);
            $(e).parent().parent().find('.edit_hid').val(1);
            $(e).parent().parent().find('.show2').show().prop('checked', true);
            $(e).parent().parent().find('.show_hid').val(1);
            $(e).parent().parent().find('.search2').show().prop('checked', true);
            $(e).parent().parent().find('.search_hid').val(1);
//



            switch (val) {
                case 'radio':
                     console.log(val);
                     $(e).parent().parent().find('.list2').show();

                    $(e).parent().parent().find('.list_hid').val(1);
                    $(e).parent().parent().find('.value').show();
                    break;
                case 'checkbox':
                    console.log(val);
                    $(e).parent().parent().find('.list2').show();
                    $(e).parent().parent().find('.list2').click();
                    $(e).parent().parent().find('.list_hid').val(1);
                    $(e).parent().parent().find('.default_c').show();
                    break;
                case 'relationship':
                    console.log(val);
                    $(e).parent().parent().find('.list2').show();
                    $(e).parent().parent().find('.list_hid').val(1);
                    $(e).parent().parent().find('.relationship').show();
                    $(e).parent().parent().find('.title').hide().val('-');
                    break;
                case 'relationship_many':
                    console.log(val);
                    $(e).parent().parent().find('.list2').show();
                    $(e).parent().parent().find('.list_hid').val(1);
                    $(e).parent().parent().find('.relationship').show();
                    $(e).parent().parent().find('.title').hide().val('_id');
                    break;
                case 'textarea':
                    console.log(val);
                    $(e).parent().parent().find('.list2').show();
                    $(e).parent().parent().find('.list_hid').val(1);
                    $(e).parent().parent().find('.texteditor').show();

                    break;
                case 'file':
                    console.log(val);
                    $(e).parent().parent().find('.list2').show();
                    $(e).parent().parent().find('.list_hid').val(1);
                    $(e).parent().parent().find('.size').show();
                    break;
                case 'enum':
                    console.log(val);
                    $(e).parent().parent().find('.list2').show();
                    $(e).parent().parent().find('.list_hid').val(1);
                    $(e).parent().parent().find('.enum').show();
                    break;
                case 'photo':
                    console.log(val);
                    $(e).parent().parent().find('.list2').show();
                    $(e).parent().parent().find('.list_hid').val(1);
                    $(e).parent().parent().find('.size').show();
                    $(e).parent().parent().find('.dimensions').show();
                    break;
                default:
                    console.log(val);
                    $(e).parent().parent().find('.list2').show();
                    $(e).parent().parent().find('.list_hid').val(1);
                    break;
            }



        }

        function renderChange(e) {
            var val = $(e).val();
            // Hide all possible outputs
//            $(e).parent().parent().find('.custom').hide();

//            console.log(val);
        }
        function relationshipChange(e) {
            var val = $(e).val();
            $(e).parent().parent().find('.relationship-field').remove();
            var select = $('.rf-' + val).clone();
            $(e).parent().parent().find('.relationship-holder').html(select);
        }

        function showElements(e){
            $(e).parent().parent().parent().find('.list2').show();
            $(e).parent().parent().parent().find('.list_hid').val(1);

            $(e).parent().parent().parent().find('.add2').show();
            $(e).parent().parent().parent().find('.add_hid').val(1);

            $(e).parent().parent().parent().find('.edit2').show();
            $(e).parent().parent().parent().find('.edit_hid').val(1);

            $(e).parent().parent().parent().find('.show2').show();
            $(e).parent().parent().parent().find('.show_hid').val(1);

            $(e).parent().parent().parent().find('.search2').show();
            $(e).parent().parent().parent().find('.search_hid').val(1);
        }



        $(document).ready(function () {

            $(function(){
                var $foo = $('#name');
                var $bar = $('#title');
                function onChange() {
                    $bar.val($foo.val());
                };
                $('#name').change(onChange).keyup(onChange);
            });



            $(document).on('change', '.field_title', function () {
                var $foo = $(this);
                var $bar =$(this).parent().parent().find('.visual_title');
                function onChange() {
                    $bar.val($foo.val());
                };
                $(this).change(onChange).keyup(onChange);
            }).change();

            $("#generator").sortable();

//            $('.relationship').each(function () {
//                renderChange($(this))
//            });

            $('.type').each(function () { //initialize
                typeChange($(this))
//                $(this).parent().parent().parent().find('.list_hid').val(1);
            });


            $('.relationship').each(function () {
                relationshipChange($(this))
            });


//            $(document).on('keypress', '.field_title', function () {
//                if ($(this).which == 32)
//                    return false;
//            });


            $(document).on('change', '.add2', function () {
                var checked = $(this).is(":checked");
                if (checked) {
                    $(this).parent().find('.add_hid').val(1);
                } else {
                    $(this).parent().find('.add_hid').val(0);
                }
            });

            $(document).on('change', '.show2', function () {
                var checked = $(this).is(":checked");
                if (checked) {
                    $(this).parent().find('.show_hid').val(1);
                } else {
                    $(this).parent().find('.show_hid').val(0);
                }
            });

            $(document).on('change', '.list2', function () {
                var checked = $(this).is(":checked");
                if (checked) {
                    $(this).parent().find('.list_hid').val(1);
                } else {
                    $(this).parent().find('.list_hid').val(0);
                }
            });


            $(document).on('change', '.edit2', function () {
                var checked = $(this).is(":checked");
                if (checked) {
                    $(this).parent().find('.edit_hid').val(1);
                } else {
                    $(this).parent().find('.edit_hid').val(0);
                }
            });

            $(document).on('change', '.search2', function () {
                var checked = $(this).is(":checked");
                if (checked) {
                    $(this).parent().find('.search_hid').val(1);
                } else {
                    $(this).parent().find('.search_hid').val(0);
                }
            });

            // Add new row to the table of fields
            $('#addField').click(function () {
                var line = $('#line').html();
                var table = $('#generator');
                table.append(line);


            });

            // Remove row from the table of fields
            $(document).on('click', '.rem', function () {
                $(this).parent().parent().remove();
            });
            $(document).on('change', '.relationship', function () {
                renderChange($(this))
            });


            $(document).on('focus', '.type', function () {
                previous = this.value;
            });

            $(document).on('change', '.type', function () {
                typeChange($(this))
            });





            $(document).on('change', '.relationship', function () {
                relationshipChange($(this))
            });

            $('.mass_access').click(function () {
                if ($(this).is(":checked")) {
                    $('.single_access').each(function () {
                        if ($(this).is(":checked") == false) {
                            $(this).click();
                        }
                    });
                    $('.single_role').each(function () {
                        if ($(this).is(":checked") == false) {
                            $(this).click();
                        }
                    });
                } else {
                    $('.single_access').each(function () {
                        if ($(this).is(":checked") == true) {
                            $(this).click();
                        }
                    });
                    $('.single_role').each(function () {
                        if ($(this).is(":checked") == false) {
                            $(this).click();
                        }
                    });
                }
            });

            $('.single_access').click(function () {
                if ($(this).is(":checked")) {

                } else {
                    $('.single_access').each(function () {
                        if ($(this).is(":checked") == true) {
                            $(this).click();
                        }
                    });
                }
            });

            $('.mass_create').click(function () {
                if ($(this).is(":checked")) {
                    $('.single_create').each(function () {
                        if ($(this).is(":checked") == false) {
                            $(this).click();
                        }
                    });
                } else {
                    $('.single_create').each(function () {
                        if ($(this).is(":checked") == true) {
                            $(this).click();
                        }
                    });
                }
            });

            $('.mass_edit').click(function () {
                if ($(this).is(":checked")) {
                    $('.single_edit').each(function () {
                        if ($(this).is(":checked") == false) {
                            $(this).click();
                        }
                    });
                } else {
                    $('.single_edit').each(function () {
                        if ($(this).is(":checked") == true) {
                            $(this).click();
                        }
                    });
                }
            });

            $('.mass_view').click(function () {
                if ($(this).is(":checked")) {
                    $('.single_view').each(function () {
                        if ($(this).is(":checked") == false) {
                            $(this).click();
                        }
                    });
                } else {
                    $('.single_view').each(function () {
                        if ($(this).is(":checked") == true) {
                            $(this).click();
                        }
                    });
                }
            });

            $('.mass_delete').click(function () {
                if ($(this).is(":checked")) {
                    $('.single_delete').each(function () {
                        if ($(this).is(":checked") == false) {
                            $(this).click();
                        }
                    });
                } else {
                    $('.single_delete').each(function () {
                        if ($(this).is(":checked") == true) {
                            $(this).click();
                        }
                    });
                }
            });

        });

    </script>
@stop