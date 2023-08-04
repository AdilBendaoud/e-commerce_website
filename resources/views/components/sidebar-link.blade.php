@props(['active','link'])

@php
    $classes = ($active ?? false) ? 'bg-danger' : 'bg-primary';
@endphp
<div {{ $attributes->merge(['class' => $classes]) }}>
    <a href="{{ route($link) }}">
        <p>{{ $slot }}</p>
    </a>
</div>
