@push('css')
    <link rel="stylesheet" href={{ asset('dashboard/extensions/flatpickr/flatpickr.min.css') }}>
@endpush

<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}" id="{{ __('admin.' . $name) }}_wrap">
    <label class="mb-1" for="{{ $name }}">{{ __('admin.' . $label) }}</label>
    <input name="{{ $name }}" type="text" class="form-control flatpickr-range mb-3 flatpickr-input"
        placeholder="{{ $placeholder ? __('admin.' . $placeholder) : __('admin.' . $label) }}"
        readonly="readonly" id="{{ $name }}">
    <span class="help-block"><strong id="{{ $name }}_error">{{ $errors->first($name) }}</strong></span>

</div>

@push('scripts')
    <script src={{ asset('dashboard/extensions/flatpickr/flatpickr.min.js') }}></script>
    <script src={{ asset('dashboard/static/js/pages/date-picker.js') }}></script>
@endpush
