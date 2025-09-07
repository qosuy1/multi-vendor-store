@props(['type' => 'success'])
<div>

    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    @if (session($type))
        <div class="alert alert-{{ $type }}">
            {{ session($type) }}
        </div>
    @endif
</div>
