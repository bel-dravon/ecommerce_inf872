@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 dark:border-indigo-600 text-start text-base font-medium text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/50 focus:outline-none focus:text-indigo-800 dark:focus:text-indigo-200 focus:bg-indigo-100 dark:focus:bg-indigo-900 focus:border-indigo-700 dark:focus:border-indigo-300 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-black-600 dark:text-black-400 hover:text-black-800 dark:hover:text-black-200 hover:bg-black-50 dark:hover:bg-black-700 hover:border-black-300 dark:hover:border-black-600 focus:outline-none focus:text-black-800 dark:focus:text-black-200 focus:bg-black-50 dark:focus:bg-black-700 focus:border-black-300 dark:focus:border-black-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
