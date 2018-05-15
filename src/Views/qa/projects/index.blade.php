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

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Project</h3>
        </div>
        <div class="box-body">
            <table class="table table-striped table-hover table-bordered" width="100%"  id="">
                <thead>
                <th>ID</th>
                <th>Project Name</th>
                <th>Version</th>
                <th>Skin</th>
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
                        <td>{{ $row->skin }}</td>
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
             var table = $('#ProjectsDataTable').DataTable({"columnDefs":[{"width":"30px","targets":0,"searchable":false,"orderable":false,"visible":true},{"targets":1,"searchable":true,"orderable":true,"visible":true},{"targets":2,"searchable":true,"orderable":true,"visible":true},{"targets":3,"searchable":true,"orderable":true,"visible":true},{"width":"200px","targets":4,"searchable":false,"orderable":false,"visible":true}]});
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