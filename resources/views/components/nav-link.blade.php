@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none transition duration-150 ease-in-out relative after:absolute after:bottom-[-8px] after:left-0 after:w-full after:h-0.5 after:bg-cyan-400 dark:after:bg-cyan-500'
            : 'inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 transition duration-150 ease-in-out relative after:absolute after:bottom-[-20px] after:left-0 after:w-full after:h-0.5 after:bg-transparent hover:after:bg-cyan-600 dark:hover:after:bg-cyan-600 focus:after:bg-cyan-300 dark:focus:after:bg-cyan-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
