@props(['active'])

@php
    $classes = $active ?? false ? 'navbar-item active' : 'navbar-item';
@endphp

<li class="{{ $classes }}">
    {{ $slot }}
</li>
