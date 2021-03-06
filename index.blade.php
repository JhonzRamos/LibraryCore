@extends('admin.layouts.master')

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('quickadmin::templates.templates-view_index-list') }}</h3>
        </div>
        <div class="box-body">
            <table class="table table-striped table-hover table-responsive" id="BooksDataTable">
                <thead>
                    <tr>
                        <th>
                            {!! Form::checkbox('delete_all',1,false,['class' => 'mass']) !!}
                        </th>
                        <th>Book</th>

                        <th>
                            <div class="btn-group tools">
                                @if(Auth::user()->role->canCreate())
                                <button action="form" type="button" onclick="location.href ='{{ route(config('quickadmin.route').'.books.create') }}'" class="btn btn-default btn-sm fa">+</button>
                                @endif
                                    <div class="btn-group">
                                    <button class="btn dropdown-toggle btn-default btn-sm fa fa-bars"
                                            data-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu pull-right ColumnToggle" role="menu">
                                       <li action="form" data-column="1" class="toggle-vis Checked"><a href="javascript:void(0)"><i class="fa fa-check"></i>Book</a></li>

                                    </ul>
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($books as $row)
                    <tr>
                        <td>
                            {!! Form::checkbox('del-'.encrypt($row->id),1,false,['class' => 'single','data-id'=> encrypt($row->id)]) !!}
                        </td>
                        <td>{{ $row->sTitle }}</td>

                        <td>

                            <div class="btn-group tools">
                                @if(Auth::user()->role->canView())
                                    <button type="button"
                                            onclick="location.href ='{{route(config('quickadmin.route').'.books.show', array(encrypt($row->id))) }}'"
                                            class="btn btn-default btn-sm fa fa-search"></button>
                                @endif
                                @if(Auth::user()->role->canEdit()===true ||  Auth::user()->role->canDelete()===true)
                                    <div class="btn-group">
                                        <button class="btn dropdown-toggle btn-default btn-sm fa fa-bars"
                                                data-toggle="dropdown"></button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            @if(Auth::user()->role->canEdit())
                                                <li action="form"><a
                                                            href="{{route(config('quickadmin.route').'.books.edit', array(encrypt($row->id))) }}"><i
                                                                class="fa fa-pencil-square-o"></i>Edit</a></li>
                                            @endif
                                            @if(Auth::user()->role->canDelete())
                                                <li action="delete"><a href="#" data-toggle="modal"
                                                                       id="{{encrypt($row->id)}}"
                                                                       data-route="{{route(config('quickadmin.route').'.books.destroy', encrypt($row->id))}}"
                                                                       data-target="#mDelete">
                                                        <i class="fa fa-minus"></i>Delete</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-danger" id="delete">
                        {{ trans('quickadmin::templates.templates-view_index-delete_checked') }}
                    </button>
                </div>
            </div>
            {!! Form::open(['route' => config('quickadmin.route').'.books.massDelete', 'method' => 'post', 'id' => 'massDelete']) !!}
                <input type="hidden" id="send" name="toDelete">
            {!! Form::close() !!}
        </div>
	</div>
	 <div id="eModalContainer">
                <div class="modal fade" id="mDelete">
                    <div class="modal-dialog">
                        <div class="modal-content">

                               {!! Form::open(array('method' => 'DELETE', 'id' => 'deleteEntry')) !!}

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Delete</h4>
                                </div>
                                <div class="modal-body">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <p id="deleteMessage"></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                 {!! Form::close() !!}
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </div>

@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('#delete').click(function () {
                if (window.confirm('{{ trans('quickadmin::templates.templates-view_index-are_you_sure') }}')) {
                    var send = $('#send');
                    var mass = $('.mass').is(":checked");
                    if (mass == true) {
                        send.val('mass');
                    } else {
                        var toDelete = [];
                        $('.single').each(function () {
                            if ($(this).is(":checked")) {
                                toDelete.push($(this).data('id'));
                            }
                        });
                        send.val(JSON.stringify(toDelete));
                    }
                    $('#massDelete').submit();
                }
            });
             var table = $('#BooksDataTable').DataTable({"columnDefs":[{"width":"30px","targets":0,"searchable":false,"orderable":false,"visible":true},{"targets":1,"searchable":true,"orderable":true,"visible":true},{"width":"200px","targets":2,"searchable":false,"orderable":false,"visible":true}]});
                $('.toggle-vis').on('click', function (e) {
                    e.preventDefault();

                    // Get the column API object
                    var column = table.column($(this).attr('data-column'));

                    // Toggle the visibility
                    column.visible(!column.visible());


                    if (!column.visible() == true) {
                        $(this).removeClass('Checked');
                    } else {
                        $(this).addClass('Checked');
                    }

                });
        });
    </script>
    <script>
        $('#mDelete').on('show.bs.modal', function(e) {
            var id     = e.relatedTarget.id,
                    name = 'this entry',
                    modal    = $(this);
            $('#deleteMessage').replaceWith(' <p> Comfirm delete '+name+' ?</p>');
            $('#deleteEntry').attr('action', e.relatedTarget.dataset.route);
        });
    </script>
@stop