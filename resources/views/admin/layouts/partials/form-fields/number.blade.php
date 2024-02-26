<div class="form-group {{ $errors->has($name) ? 'is-invalid' : '' }}">
    <label class="mb-1" for="{{ $name }}">{{ __('admin_panel.' . $label) }}</label>
    <input type="number" class="form-control" id="{{ $name }}" name={{ $name }}
        placeholder="{{ $placeholder ? __('admin_panel.' . $placeholder) : __('admin_panel.' . $label) }}"
        spellcheck="false" data-ms-editor="true" {{ $required == 'true' ? 'required' : '' }}
        value="{{ $value == null ? old($name) : $value }}">
    <span class="help-block"><strong id="{{ $name }}_error">{{ $errors->first($name) }}</strong></span>

</div>
