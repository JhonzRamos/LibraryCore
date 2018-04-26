@extends('admin.layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('quickadmin::qa.logs-index-list') }}</div>
        <div class="panel-body">
            <table class="table table-striped table-hover table-responsive" id="ajaxtable">
                <thead>
                <th>Path</th>
                <th>Name</th>
                <th>Menu</th>
                <th>Type</th>
                <th>Time</th>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        $('#ajaxtable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('files.ajax') }}',
            language: {
                url: "{{ trans('quickadmin::strings.datatable_url_language') }}"
            },
            columns: [
                {data: 'path', name: 'path'},
                {data: 'filename', name: 'name'},
                {data: 'menu_id', name: 'menu'},
                {data: 'type', name: 'type'},
                {data: 'created_at', name: 'created_at'}
            ]
        });
    </script>
@stop