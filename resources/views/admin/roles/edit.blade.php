@extends('layouts.partials.components.edit-page')

@section('form')
    {{ \App\Base\Helper\Field::text(name: 'name', label: 'name', value: $record->name) }}
@stop
