@extends('layouts.partials.components.create-page')

@section('form')
    {{ \App\Base\Helper\Field::text(name: 'name', label: 'name', required: 'false', placeholder: 'name') }}
@stop
