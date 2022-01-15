@props([
    'status',
    'color' => 'green'
])

@if ($status)
    <div {{ $attributes->merge(['class' => "bg-$color-500 rounded-md p-3 border-l-4 border-r-4 border-$color-800
                                            font-medium text-sm text-gray-100"]) }}>
        {{ $status }}
    </div>
@endif
