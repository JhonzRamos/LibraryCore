@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-2">
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




    {{--@if($menusList->count() == 0)--}}
    {{--<div class="row">--}}
    {{--<div class="col-xs-6 col-md-4">--}}
    {{--<div class="alert alert-info">--}}
    {{--{{ trans('quickadmin::qa.menus-index-no_menu_items_found') }}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endif--}}


    {{--<div class="btn-group ">--}}
    {{--<button type="button" class="btn btn-primary dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
    {{--Add New Menu--}}
    {{--</button>--}}
    {{--<div class="dropdown-menu">--}}
    {{--<a href="{{ route('menu.crud') }}"--}}
    {{--class="dropdown-item">New CRUD</a> </br>--}}
    {{--<a href="{{ route('menu.custom') }}"--}}
    {{--class="dropdown-item">Custom CRUD</a>  </br>--}}
    {{--<a href="{{ route('menu.parent') }}"--}}
    {{--class="dropdown-item">Parent Menu</a>  </br>--}}
    {{--</div>--}}

    {{--</div>--}}





    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Project</h3>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-hover table-bordered" width="100%"  id="">
                        <thead>
                        <th>ID</th>
                        <th>Project Name</th>
                        <th>Version</th>
                        <th>
                            <div class="btn-group tools">
                                <button action="form" type="button" onclick="location.href ='{{route('projects.create')}}'" class="btn btn-default btn-sm fa">+</button>
                                <div class="btn-group">
                                    <button class="btn dropdown-toggle btn-default btn-sm fa fa-bars"
                                            data-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu pull-right ColumnToggle" role="menu">
                                        <li action="form" data-column="0" class="toggle-vis Checked">
                                            <a href="javascript:void(0)"><i class="fa fa-check"></i>ID</a>
                                        </li>
                                        <li action="form" data-column="1" class="toggle-vis Checked">
                                            <a href="javascript:void(0)"><i class="fa fa-check"></i>Project Name</a>
                                        </li>
                                        <li action="form" data-column="2" class="toggle-vis Checked">
                                            <a href="javascript:void(0)"><i class="fa fa-check"></i>Version</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </th>
                        </thead>

                        <tbody>
                        @foreach($projects as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->version}}</td>
                            <td>
                                <a href="{{route('projects.active', $row->id)}}" class="btn {{($row->active == 1)? 'btn-primary':'btn-default'}} btn-xs btn-flat">Active</a>
                                <a href="{{route('projects.edit', $row->id)}}" class="btn btn-info btn-xs btn-flat">Edit</a>
                                <a href="{{route('download.zip', $row->id)}}" class="btn btn-success btn-xs btn-flat">Download</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Menus</h3>

                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    {!! Form::open(['class' => 'form-horizontal']) !!}
                    <div class="row">
                        <div class="col-xs-12">
                            <div style="padding-bottom: 5px;">
                                <a href="{{ route('menu.crud') }}"
                                   class="btn btn-primary btn-flat">New CRUD</a>
                                <a href="{{ route('menu.custom') }}"
                                   class="btn btn-primary btn-flat">Custom CRUD</a>
                                <a href="{{ route('menu.parent') }}"
                                   class="btn btn-primary btn-flat">Parent Menu</a>

                            </div>
                        </div>
                    </div>




                    {{--@if($menusList->count() != 0)--}}
                    {{--<div class="row">--}}
                    {{--<div class="col-xs-12 col-md-6">--}}
                    {{--<div class="alert alert-danger">--}}
                    {{--{{ trans('quickadmin::qa.menus-index-positions_drag_drop') }}--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    {{--@endif--}}

                    <div class="row">
                        <div class="col-md-12 ">

                            {{--<a href="http://myigniter.kotaxdev.com/myigniter/crud_menu/side-menu/add" class="btn btn-primary btn-flat"><i class="fa fa-plus-circle"></i> Add Menu</a>--}}
                            {{--<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Save</button>--}}
                            {{--<input class="btn btn-success" type="submit" value="<i class='fa fa-save'></i> Save">--}}


                            <ul id="sortable" class="list-unstyled ui-sortable">
                                @foreach($menusList as $menu)
                                    @if($menu->children()->first() == null)
                                        <li data-menu-id="{{ $menu->id }}" >
                                        <span>
                                            <span class="handle  drag-n-drop"  >
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>

                                            <i class="fa {{ $menu->icon }} "> </i> {{ $menu->title }} {{ $menu->parent_id }}
                                            <span class="pull-right dd-action" style="padding-right: 5px;">
                                                <a href=""><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('menu.edit',[$menu->id]) }}" title="edit"><i class="fa fa-pencil"></i></a>
                                                <a class="delete" href="#" data-route="{{ route('menu.delete',[$menu->id]) }}"><i class="fa fa-trash"></i></a>
                                                {{--<a href="{{ route('menu.edit',[$menu->id]) }}" class="btn btn-xs btn-info">Edit </a>--}}
                                                {{--<a href="#" class="btn btn-xs btn-warning"> Clone </a>--}}

                                                {{--<input class="btn btn-xs btn-danger" type="submit" value="Delete">--}}

                                            </span>

                                        </span>
                                            <input type="hidden" class="menu-no" value="{{ $menu->position }}"
                                                   name="menu-{{ $menu->id }}">
                                            @if($menu->menu_type == 2)
                                                <ul class="childs" style="min-height: 5px;"></ul>
                                            @endif
                                        </li>
                                    @else
                                        <li data-menu-id="{{ $menu->id }}">
                                            <span>
                                                   <span class="handle  drag-n-drop"  >
                                                        <i class="fa fa-ellipsis-v"></i>
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </span>
                                            <i class="fa {{ $menu->icon }} "> </i> {{ $menu->title }}
                                                <span class="pull-right dd-action" style="padding-right: 5px;">
                                                    <a href=""><i class="fa fa-eye"></i></a>
                                                    <a href="{{ route('menu.edit',[$menu->id]) }}" title="edit"><i class="fa fa-pencil"></i></a>
                                                    <a class="delete" href="#" data-route="{{ route('menu.delete',[$menu->id]) }}"><i class="fa fa-trash"></i></a>

                                            </span>
                                            </span>
                                            <input type="hidden" class="menu-no" value="{{ $menu->position }}"
                                                   name="menu-{{ $menu->id }}">
                                            <ul class="childs list-unstyled" style="min-height: 5px;">

                                                @forelse($menu->children as $child)
                                                    <li>
                                                        <span>
                                                               <span class="handle  drag-n-drop">
                                                                    <i class="fa fa-ellipsis-v"></i>
                                                                    <i class="fa fa-ellipsis-v"></i>
                                                               </span>
                                                            <i class="fa {{ $child->icon }} "> </i> {{ $child->title }}
                                                            <span class="pull-right dd-action"  style="padding-right: 5px;">
                                                                     <a href=""><i class="fa fa-eye"></i></a>
                                                                     <a href="{{ route('menu.edit',[$child->id])}}" title="edit"><i class="fa fa-pencil"></i></a>
                                                                     <a class="delete" href="#" data-route="{{ route('menu.delete',[$child->id]) }}"><i class="fa fa-trash"></i></a>
                                                            </span>
                                                        </span>
                                                        <input type="hidden" class="child-no"
                                                               value="{{ $child->position }}"
                                                               name="child-{{ $child->id }}">
                                                        <input type="hidden" class="menu-id" value="{{ $menu->id }}"
                                                               name="child-parent-{{ $child->id }}">
                                                    </li>
                                                @empty
                                                @endforelse

                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>


                            @if($menusList->count() != 0)

                                <div class="row" id="dragMessage" style="display: none;">
                                    <div class="col-xs-12 ">
                                        <div class="alert alert-danger">
                                            {{ trans('quickadmin::qa.menus-index-click_save_positions') }}
                                        </div>
                                    </div>
                                </div>

                                {{--{!! Form::submit(trans('quickadmin::qa.menus-index-save_positions'),['class' => 'btn btn-success']) !!}--}}


                            @endif

                            <div style="padding-top: 5px;">
                                <button type="submit" class="btn btn-success btn-flat "><i class="fa fa-save"></i> Save</button>
                            </div>

                        </div>


                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Menu Type</h3>
                </div >
                <div class="box-body">
                    <table class="table table-striped table-hover table-bordered" width="100%"  id="MenuDataTable">
                        <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Route</th>
                        <th>
                            <div class="btn-group tools">
                                <button action="form" type="button" onclick="location.href ='{{ route('menu.crud') }}'" class="btn btn-default btn-sm fa">+</button>
                                <div class="btn-group">
                                    <button class="btn dropdown-toggle btn-default btn-sm fa fa-bars"
                                            data-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu pull-right ColumnToggle" role="menu">
                                        <li action="form" data-column="0" class="toggle-vis Checked">
                                            <a href="javascript:void(0)"><i class="fa fa-check"></i>ID</a>
                                        </li>
                                        <li action="form" data-column="1" class="toggle-vis Checked">
                                            <a href="javascript:void(0)"><i class="fa fa-check"></i>Category Name</a>
                                        </li>
                                        <li action="form" data-column="2" class="toggle-vis Checked">
                                            <a href="javascript:void(0)"><i class="fa fa-check"></i>Category Description</a>
                                        </li>
                                        <li action="form" data-column="3" class="toggle-vis Checked">
                                            <a href="javascript:void(0)"><i class="fa fa-check"></i>Photo</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </th>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

        @stop
        @section('javascript')
            <script>
                $(document).ready(function () {
                    $('.delete').click(function (e) {
//                        e.preventDefault;
                        console.log($(this)["0"].dataset.route);
                        if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
                            location.href = $(this)["0"].dataset.route;
                        }
                    });
                });
            </script>
            <script>
                $(function () {
                    $("#sortable").sortable({
                        placeholder: "ui-state-highlight",
                        update: function () {
                            $('#dragMessage').show();
                            var i = 1;
                            $('#sortable').find('> li').each(function () {
                                $(this).attr('data-menu-no', i);
                                var no = $(this).attr('data-menu-no');
                                $(this).find('.menu-no').val(no);
                                i++;
                            });
                        }

                    });
                    $("#sortable").disableSelection();
                    $(".childs").sortable({
                        placeholder: "ui-state-highlight",
                        connectWith: ".childs",
                        dropOnEmpty: true,
                        update: function () {
                            $('#dragMessage').show();
                            $('#sortable').find('> li').each(function () {
                                var i = 1;
                                $('> ul > li', this).each(function () {
                                    var no = $(this).parent().parent().attr('data-menu-id');
                                    $(this).find('.menu-id').val(no);
                                    $(this).find('.child-no').val(i);
                                    i++;
                                    console.log('ok');
                                });
                            });
                        }
                    });
                });
            </script>

            <script>
                $('#MenuDataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('menu.ajax') }}',
                    columns: [
                        {
                            data: 'id',
                            name: 'ID',
                            width: "30px"
                        },
                        {data: 'name', name: 'Name', searchable: true
                        },
                        {data: 'name', name: 'Route', searchable: true
                        },


                    ],
                    "columnDefs": [
                        {
                            "targets": 1,
                            searchable: true
                        },
                        {

                            "targets": 3,
                            "searchable": false,
                            "orderable": false,
                            "visible": true,
                        "render": function ( data, type, row, meta ) {
                            return '<div class="btn-group tools"><button type="button" onclick="#" class="btn btn-default btn-sm fa fa-search"></button>' +
                                    '<div class="btn-group"><button class="btn dropdown-toggle btn-default btn-sm fa fa-bars" ' +
                                    'data-toggle="dropdown"></button><ul class="dropdown-menu pull-right" role="menu">' +
                                    '<li action="form"><a href=""><i class="fa fa-pencil-square-o"></i>Edit</a></li>' +
                                    '<li action="delete"><a href="#" data-toggle="modal" id="' +  'Encrypted' +'"  name="' + 'Name'+ '" data-target="#mDelete">' +
                                    '<i class="fa fa-minus"></i>Delete</a></li>'+
                                    '</div></div>';
                        }
                    } ]

                });
            </script>

@stop