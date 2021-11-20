@props([
    'color' => 'gray',
])

<a role="menuitem"
    {{ $attributes->merge([
                           'class' => "block p-2 text-sm text-$color-500 transition-colors duration-200
                           hover:text-$color-800 cursor-pointer"
    ]) }}>

    {{ $slot }}

</a>
