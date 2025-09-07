@props(['name', 'value', 'options'])

@foreach ($options as $key => $keyValue)
    <div class="form-check form-check-inline">

        <input type="radio" name="{{ $name }}" value="{{ $keyValue }}"
            {{ $attributes->class(['form-check-input', 'is-invalid' => $errors->has($name)]) }}
            {{ old($name, $value) == $keyValue ? 'checked' : '' }} id="{{ $keyValue }}-active">

        <label class="form-check-label" for="{{ $keyValue }}-active">{{ $key }}</label>
    </div>
@endforeach
@error($name)
    <div class="invalid-feedback d-block">{{ $message }}</div>
@enderror
