<div class="form-group">
    <label>{{ $label }}
        @if ($required == 'true')
            <span style="color: red">*</span>
        @endif
    </label>
    <input id="{{ $id }}" type="text" class="form-control input rupiah" name="{{ $id }}"
        placeholder="" value="0">
    <span class="text-danger error error-text {{ $id }}_err"></span>
</div>
