@extends('admin.layouts.partials.crud-components.create-page')
@inject('permissionModel', 'Spatie\Permission\Models\Permission')
@inject('roleModel', 'Spatie\Permission\Models\Role')

@php
    $permissions = $permissionModel::select('group')->groupBy('group')->get();
@endphp

@section('form')
    {{ \App\Base\Helper\Field::text(name: 'name', label: 'name', required: 'false', placeholder: 'name') }}
    {{ \App\Base\Helper\Field::text(name: 'description', label: 'description', required: 'false', placeholder: 'description') }}
    <label class="mb-1" for="{{ __('admin_panel.permissions') }}">{{ __('admin_panel.permissions') }}</label>
    <br>
    @foreach ($permissions as $permission)
        <label>{{ __($permission->goup) }}</label>
        <input type="checkbox" class="selectSameGroup form-check-input"
            id="{{ str_replace(' ', '_', __($permission->group)) }}">
        <label style="font-size: 15px; font-weight: 600"
            for="{{ str_replace(' ', '_', __($permission->group)) }}">{{ $permission->group . ' - ' . __('admin.select-all') }}</label>

        <div class="row">
            @foreach ($permissionModel->where('group', $permission->group)->get() as $key => $value)
                <div class="form-group col-md-3" id="permissions_wrap" style="display: flex; margin: 0px 4px;">
                    <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}"
                        id="{{ __('admin_panel.permissions') }}_wrap">
                        <div class="form-check">
                            <label for="{{ $value->id }}">{{ Str::limit($value->name, 25) }}</label>
                            <input type="checkbox" id="{{ $value->id }}"
                                class="form-check-input {{ str_replace(' ', '_', __($permission->group)) }}"
                                {{ $roleModel->hasPermissionTo($value) ? 'checked' : '' }} value="{{ $value->id }}"
                                name="permissions[]">
                            <span class="help-block">
                                <strong id="permissions_error">
                                    {{ $errors->first('permissions') }}
                                </strong>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@stop


@push('scripts')
    <script>
        $("#selectAll").click(function() {
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
        });

        $(".selectSameGroup").click(function() {
            let group = $(this).attr('id');
            $('.' + group).prop('checked', $(this).prop('checked'));
        });
    </script>
@endpush
