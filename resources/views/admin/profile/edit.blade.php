@extends('admin.layouts.partials.crud-components.edit-page')

@section('form')
    {{ \App\Base\Helper\Field::text(name: 'name', label: 'name', value: auth()->user()->name) }}
    {{ \App\Base\Helper\Field::email(name: 'email', label: 'email', value: auth()->user()->email) }}
    {{ \App\Base\Helper\Field::number(name: 'phone', label: 'phone', value: auth()->user()->phone) }}
    {{ \App\Base\Helper\Field::password(name: 'old-password', label: 'old_password', value: auth()->user()->phone) }}
    {{ \App\Base\Helper\Field::password(name: 'new-password', label: 'new-password', placeholder: 'new-password') }}
    {{ \App\Base\Helper\Field::password(name: 'new-password-confirmation', label: 'new-password-confirmation', placeholder: 'new-password-confirmation') }}
@stop
