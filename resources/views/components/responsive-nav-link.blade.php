@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-red-500 text-start text-base font-medium text-white bg-red-500 focus:outline-none focus:text-white focus:bg-blue-500 focus:border-red-500 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white hover:text-white hover:bg-blue-500 hover:border-blue-500 focus:outline-none focus:text-white focus:bg-blue-500 focus:border-blue-500 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
