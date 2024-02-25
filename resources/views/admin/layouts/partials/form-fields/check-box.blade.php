<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}" id="{{ __('admin_panel.' . $name) }}_wrap">
    <label class="mb-1" for="{{ __('admin_panel.' . $name) }}">{{ __('admin_panel.' . $label) }}</label>
    <div class="form-check">
        <div class="checkbox row">
            @foreach ($options as $key => $value)
                <div class="col-md-3">
                    <label for="{{ $key }}">{{ Str::limit($value, 25) }}</label>
                    <input type="checkbox" id="{{ $key }}" class="form-check-input" checked=""
                        value="{{ $key }}" name="{{ $name }}[]">
                </div>
            @endforeach
        </div>
        <span class="help-block"><strong id="{{ $name }}_error">{{ $errors->first($name) }}</strong></span>
    </div>
</div>