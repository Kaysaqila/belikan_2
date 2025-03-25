@props(['active'])

@php
$classes = ($active ?? false)
                    ? 'text-sm font-semibold inline-flex items-center' 
                    : 'text-sm-300 hover:text-blue-300 inline-flex items-center';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
