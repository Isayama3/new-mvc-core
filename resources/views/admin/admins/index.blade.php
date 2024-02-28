@extends('admin.layouts.partials.crud-components.table', [
    'page_header' => __('admin.admins'),
])

@section('filter')
    @include('admin.admins.filter', [
        'create_route' => $create_route,
    ])
@stop

@section('table')
    <thead>
        <tr>
            <th>{{ __('#') }}</th>
            <th>{{ __('admin.name') }}</th>
            <th>{{ __('admin.email') }}</th>
            <th>{{ __('admin.phone') }}</th>
            <th>{{ __('admin.status') }}</th>
            <th>{{ __('admin.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
            <tr id="removable{{ $record->id }}">
                <td>{{ $record->id }}</td>
                <td>{{ $record->name }}</td>
                <td>{{ $record->email }}</td>
                <td>{{ $record->phone }}</td>
                <td> {!! \App\Base\Helper\Field::toggleBooleanView(
                    name: 'status',
                    label: 'status',
                    model: $record,
                    url: route('admin.admins.toggleBoolean', ['id' => $record->id, 'action' => 'status']),
                ) !!}
                </td>
                <td style="display: flex;gap: 12px; justify-content: center;">
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
