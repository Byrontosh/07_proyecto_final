@props([
    'color' => 'indigo',
])

<a {{ $attributes->merge(['class' => "block px-4 py-2 text-sm text-gray-500 hover:bg-$color-100"]) }}>
    {{ $slot }}
</a>
