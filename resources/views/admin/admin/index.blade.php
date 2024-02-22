@extends('layouts.partials.components.table')

@section('filter')
    @include('admin.admin.filter', [
        'create_route' => $create_route,
    ])
@stop

@section('table')
    <thead>
        <tr>
            <th>{{ __('#') }}</th>
            <th>{{ __('admin_panel.name') }}</th>
            <th>{{ __('admin_panel.email') }}</th>
            <th>{{ __('admin_panel.phone') }}</th>
            <th>{{ __('admin_panel.status') }}</th>
            <th>{{ __('admin_panel.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
            <tr id="removable{{ $record->id }}">
                <td>{{ $record->id }}</td>
                <td>{{ $record->name }}</td>
                <td>{{ $record->email }}</td>
                <td>{{ $record->phone }}</td>
                <td>{{ $record->status }}</td>
                <td style="display: flex;gap: 12px;">
                    <a href="{{ route($edit_route, $record->id) }}">
                        <button href class="btn btn-success float-start" type="button">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </a>
                    <button id="{{ $record->id }}" data-token="{{ csrf_token() }}"
                        data-route="{{ route($destroy_route, $record->id) }}" type="button"
                        class="destroy btn btn-danger float-end">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>

@stop