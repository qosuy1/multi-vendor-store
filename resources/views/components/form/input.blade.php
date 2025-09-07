@props(['name' => 'name', 'type' => 'text', 'value' => '', 'lable' => false])

@if ($lable != false)
    <label for="{{ $name }}">{{ $lable }}</label>
@endif

<input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }} />
@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
