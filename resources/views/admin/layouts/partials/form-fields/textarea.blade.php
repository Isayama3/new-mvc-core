<div class="form-group mb-3">
    <label class="mb-1" for="{{ $name }}">{{ __('admin_panel.' . $label) }}</label>
    <textarea class="form-control" id="{{ $name }}" rows="3" spellcheck="false" data-ms-editor="true"
        style="height: 71px;" placeholder="{{ __('admin_panel.' . $label) }}" value="{{ $value ?? old($name) }}"
        placeholder="{{ $placeholder ? __('admin_panel.' . $placeholder) : __('admin_panel.' . $label) }}"></textarea>
    <span class="help-block"><strong id="{{ $name }}_error">{{ $errors->first($name) }}</strong></span>
</div>
