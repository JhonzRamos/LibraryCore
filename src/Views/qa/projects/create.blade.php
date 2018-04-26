@extends('admin.layouts.master')

@section('content')
@if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {!! implode('', $errors->all('<li class="error">:message</li>')) !!}
                </ul>
        	</div>
@endif

 <div class="box ">
        <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-plus-circle fa-fw"></i> {{ trans('quickadmin::templates.templates-view_create-add_new') }}</h3>
        </div>
        <div class="box-body">
         {!! Form::open(array('route' => 'projects.store', 'id' => 'form-with-validation')) !!}
            <div class="form-group">
    {!! Form::label('name', 'Project Name*', array('class'=>'control-label')) !!}
        {!! Form::text('name', old('name'), array('class'=>'form-control','disabled'=> isset($view) ? true : false))  !!}
        
</div><div class="form-group">
    {!! Form::label('title', 'Project Title', array('class'=>'control-label')) !!}
        {!! Form::text('title', old('title'), array('class'=>'form-control','disabled'=> isset($view) ? true : false))  !!}
        
</div><div class="form-group">
    {!! Form::label('version', 'Laravel Version', array('class'=>'control-label')) !!}
        {!! Form::text('version', old('version'), array('class'=>'form-control','disabled'=> isset($view) ? true : false))  !!}
        
</div>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-md-12">
                  {!! Form::submit( trans('quickadmin::templates.templates-view_create-create') , array('class' => 'btn btn-primary')) !!}
                   {!! link_to_route('menu', trans('quickadmin::templates.templates-view_edit-cancel'), null, array('class' => 'btn btn-default')) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('javascript')
<script src="{{asset('adminlte/plugins/tinymce/tinymce.min.js')}}"></script>
<script type="text/javascript">
    tinymce.init({
        mode : "textareas",
        editor_selector : "mceEditor",
        editor_deselector : "mceNoEditor"
    });
</script>
@endsection