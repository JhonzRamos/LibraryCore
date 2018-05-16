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
                        {!! Form::label('title', 'Controller Name*', ['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=> 'Controller Name', 'required'=> 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('title', 'Menu Title*', ['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-10">
                            {!! Form::text('title', old('title'), ['class'=>'form-control', 'placeholder'=> 'Menu Title', 'required'=> 'required']) !!}
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
                                type="checkbox" class="mass_access" value="1">
                    </th>
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
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            {!! Form::submit('Create Parent', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@endsection
@section('javascript')
    <script>$('.icp-auto').iconpicker();</script>
    <script>
        $(document).ready(function () {


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
@endsection