<div class="form-switch">
    <input onchange="toggleBoolean(this , '{{ $url }}')" name="{{ $name }}"
        class="form-check-input toggle-boolean" type="checkbox" id="flexSwitchCheckDefault"
        {{ $model->$name == 1 || $model->$name == true ? 'checked' : '' }}>
</div>
