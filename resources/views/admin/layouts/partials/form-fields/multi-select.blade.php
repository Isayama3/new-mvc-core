<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}" id="{{ __('admin.' . $name) }}_wrap">
    <label for="{{ $name }}">{{ __('admin.' . $label) }}</label>
    <div class="">
        {!! Form::select($name . '[]', $options, $selected, [
            'data-placeholder' => $placeholder ? __('admin.' . $placeholder) : __('admin.' . $label),
            'class' => 'form-control ' . $plugin,
            'multiple' => 'multiple',
            'id' => $name,
        ]) !!}
    </div>
    <span class="help-block"><strong id="{{ $name }}_error">{{ $errors->first($name) }}</strong></span>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#{{ __('admin.' . $name) }}').select2();
        });
    </script>
@endpush
