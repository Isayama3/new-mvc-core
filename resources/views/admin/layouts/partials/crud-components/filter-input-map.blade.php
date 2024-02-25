@php
    $field_map = [
        'text' => 'text',
        'email' => 'email',
        'number' => 'number',
        'password' => 'password',
        'checkBox' => 'checkBox',
        'radio' => 'radio',
        'textarea' => 'textarea',
        'fileWithPreview' => 'fileWithPreview',
        'multiFileUpload' => 'multiFileUpload',
        'dateTime' => 'dateTime',
        'dateRange' => 'dateTime',
    ];
@endphp

@foreach ($filter as $key => $value)
    @php
        $input_type = $columns[$key]['input-type'] ?? null;
    @endphp
    @if (in_array($input_type, array_keys($field_map)))
        <div class="col-md-3 col-12">
            {!! call_user_func([\App\Base\Helper\Field::class, $field_map[$input_type]], "filter[$key]", $key) !!}
        </div>
    @elseif($input_type == 'select')
        <div class="col-md-3 col-12">
            {{ \App\Base\Helper\Field::select("filter[$key]", $key, $columns[$key]['options']) }}
        </div>
    @endif
@endforeach
