@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-sm-10 col-sm-offset-2">
            <h1>{{ trans('quickadmin::qa.menus-edit-edit_menu_information') }}</h1>

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

    @if($menu->menu_type != 2)
        <div class="form-group">
            {!! Form::label('parent_id', trans('quickadmin::qa.menus-edit-parent'), ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::select('parent_id', $parentsSelect, old('parent_id', $menu->parent_id), ['class'=>'form-control']) !!}
            </div>
        </div>
    @endif

    <div class="form-group">
        {!! Form::label('title', trans('quickadmin::qa.menus-edit-title'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            {!! Form::text('title', old('title',$menu->title), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::qa.menus-edit-title_placeholder')]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('roles', trans('quickadmin::qa.menus-edit-roles'), ['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-10">
            @foreach($roles as $role)
                <div>
                    <label>
                        {!! Form::checkbox('roles['.$role->id.']',$role->id,old('roles.'.$role->id, $role->canAccessMenu($menu))) !!}
                        {!! $role->title !!}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('icon', trans('quickadmin::qa.menus-edit-icon'), ['class'=>'col-sm-2 control-label']) !!}
        {{--<div class="col-sm-10">--}}
            {{--{!! Form::text('icon', old('icon',$menu->icon), ['class'=>'form-control', 'placeholder'=> trans('quickadmin::qa.menus-edit-icon_placeholder')]) !!}--}}
        {{--</div>--}}

        <div class="col-sm-10">
            {{--{!! Form::text('icon', old('icon','fa-database'), ['class'=>'form-control icp icp-auto',  'placeholder'=> trans('quickadmin::qa.menus-createCrud-icon_placeholder')]) !!}--}}
            <div class="input-group">
                {!! Form::text('icon', old('icon','fa-archive'), ['class'=>'form-control icp icp-auto', 'data-placement'=>'bottomRight', 'placeholder'=> trans('quickadmin::qa.menus-edit-icon_placeholder')]) !!}
                <span class="input-group-addon"></span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            {!! Form::submit( trans('quickadmin::qa.menus-edit-update'), ['class' => 'btn btn-primary']) !!}
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('quickadmin::qa.logs-index-list') }}</div>
        <div class="panel-body">
        </div>
    </div>

    {!! Form::close() !!}

@endsection

@section('javascript')
    <script>$('.icp-auto').iconpicker();</script>
@endsection