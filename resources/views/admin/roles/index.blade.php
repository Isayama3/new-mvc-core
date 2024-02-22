@extends('layouts.partials.components.table')

@section('filter')
    @include('admin.roles.filter', [
        'create_route' => $create_route,
    ])
@stop

@section('table')
    <thead>
        <tr>
            <th>{{ __('#') }}</th>
            <th>{{ __('admin_panel.name') }}</th>
            <th>{{ __('admin_panel.permissions') }}</th>
            <th>{{ __('admin_panel.actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
            <tr id="removable{{ $record->id }}">
                <td>{{ $record->id }}</td>
                <td>{{ $record->name }}</td>
                <td>
                    <button type="button" class="btn icon btn-info" data-bs-toggle="modal" data-bs-target="#permissions">
                        <i class="bi bi-info-circle"></i>
                    </button>

                    <div class="modal fade text-left" id="permissions" tabindex="-1" aria-labelledby="myModalLabel140"
                        style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title white" id="myModalLabel140">info
                                        Modal
                                    </h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Tart lemon drops macaroon oat cake chocolate toffee
                                    chocolate
                                    bar icing. Pudding jelly beans
                                    carrot cake pastry gummies cheesecake lollipop. I love
                                    cookie
                                    lollipop cake I love sweet
                                    gummi bears cupcake dessert.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>

                                    <button type="button" class="btn btn-info ms-1" data-bs-dismiss="modal">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Accept</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
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