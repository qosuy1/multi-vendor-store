@props(['lable' => false , 'name', 'options' => [] , 'selected' ])


@if ($lable != false)
    <label for="{{ $name }}" class="d-flex">{{ $lable }}</label>
@endif

<select name = "{{ $name }}"
    {{ $attributes->class(['form-control', 'form-select', 'is-invalid' => $errors->has($name)]) }}>

    @foreach ($options as $value => $text )
    <option value="{{$value}}" @selected($value == $selected)>{{$text}}</option>
    @endforeach
</select>
