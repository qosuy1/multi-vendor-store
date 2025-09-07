@props(['name' => 'name', 'value', 'lable' => false])

@if ($lable != false)
    <label for="{{ $name }}">{{ $lable }}</label>
@endif

<textarea name="{{ $name }}" id="{{ $name }}"
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>{{ old($name, $value) }}
</textarea>
@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
