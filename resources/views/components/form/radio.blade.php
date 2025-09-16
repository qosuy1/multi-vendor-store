@props(['name', 'value', 'options' , 'lable'])

@if ($lable != false)
    <label for="{{ $name }}" class="d-flex">{{ $lable }}</label>
@endif

@foreach ($options as $key => $keyValue)
    <div class="form-check form-check-inline mr-4">

        <input type="radio" name="{{ $name }}" value="{{ $key }}"
            {{ $attributes->class(['form-check-input', 'is-invalid' => $errors->has($name)]) }}
            {{ old($name, $value)  == $key ? 'checked' : '' }} id="{{ $key }}-active">

        <label class="form-check-label" for="{{ $key }}-active">{{ $keyValue }}</label>
    </div>
@endforeach
@error($name)
    <div class="invalid-feedback d-block">{{ $message }}</div>
@enderror
