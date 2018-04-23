@extends('admin.layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">{{ trans('quickadmin::qa.logs-index-list') }}</div>
        <div class="panel-body">
            <table class="table table-striped table-hover table-responsive" id="ajaxtable">
                <thead>
                <th>{{ trans('quickadmin::qa.logs-index-user') }}</th>
                <th>{{ trans('quickadmin::qa.logs-index-action') }}</th>
                <th>{{ trans('quickadmin::qa.logs-index-action_model') }}</th>
                <th>{{ trans('quickadmin::qa.logs-index-action_id') }}</th>
                <th>{{ trans('quickadmin::qa.logs-index-time') }}</th>
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
            ajax: '{{ route('actions.ajax') }}',
            language: {
                url: "{{ trans('quickadmin::strings.datatable_url_language') }}"
            },            
            columns: [
                {data: 'users.name', name: 'user_id'},
                {data: 'action', name: 'action'},
                {data: 'action_model', name: 'action_model'},
                {data: 'action_id', name: 'action_id'},
                {data: 'created_at', name: 'created_at'}
            ]
        });
    </script>
@stop