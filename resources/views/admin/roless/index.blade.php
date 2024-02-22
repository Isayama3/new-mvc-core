@extends('layouts.master', [
    'page_header' => __('Roles'),
])

@section('content')
    @include('layouts.partials.components.filter', [
        'coulmns' => $columns,
        'filter' => $filter,
        'create_route' => $create_route,
    ])

    @include('layouts.partials.components.table', [
        'columns' => $columns,
        'records' => $record,
        'edit_route' => $edit_route,
        'destroy_route' => $destroy_route,
    ])
@stop
