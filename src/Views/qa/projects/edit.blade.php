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
            <h3 class="box-title"><i
                        class="fa fa-plus-circle fa-fw"></i> {{ trans('quickadmin::templates.templates-view_edit-edit') }}
            </h3>
        </div>
        <div class="box-body">
            {!! Form::model($projects, array('id' => 'form-with-validation', 'method' => 'PATCH', 'route' => array('projects.update', $projects->id))) !!}

            <div class="form-group">
                {!! Form::label('name', 'Project Name*', array('class'=>'control-label')) !!}
                {!! Form::text('name', old('name',$projects->name), array('class'=>'form-control','disabled'=> isset($view) ? true : false))  !!}

            </div>
            <div class="form-group">
                {!! Form::label('title', 'Project Title', array('class'=>'control-label')) !!}
                {!! Form::text('title', old('title',$projects->title), array('class'=>'form-control','disabled'=> isset($view) ? true : false))  !!}

            </div>
            <div class="form-group">
                {!! Form::label('version', 'Laravel Version', array('class'=>'control-label')) !!}
                {!! Form::text('version', old('version',$projects->version), array('class'=>'form-control','disabled'=> isset($view) ? true : false))  !!}

            </div>
            <div class="form-group">
                {!! Form::label('description', 'Project Description', array('class'=>'control-label')) !!}
                {!! Form::textarea('description', old('description'), array('class'=>'form-control mceEditor','disabled'=> isset($view) ? true : false))  !!}
            </div>
            <div class="form-group">
                {!! Form::label('skin', 'Skin', array('class'=>'control-label')) !!}
                {!! Form::select('skin', $skin, old('skin'), array('class'=>'form-control select2' , 'width'=>'100'  ,'disabled'=> isset($view) ? true : false)) !!}
            </div>
            <div class="form-group">
                {!! Form::label('landing', 'Landing Page', array('class'=>'control-label')) !!}
                {!! Form::select('landing', $models, old('categories_id'), array('class'=>'form-control select2', 'width'=>'100' ,'disabled'=> isset($view) ? true : false)) !!}
            </div>
        </div>
        <div class="box-footer">
            <div class="row">
                <div class="col-md-12">
                    @if(!isset($view)){!! Form::submit(trans('quickadmin::templates.templates-view_edit-update'), array('class' => 'btn btn-primary')) !!}@endif
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
            mode: "textareas",
            editor_selector: "mceEditor",
            editor_deselector: "mceNoEditor"
        });
    </script>


@endsection