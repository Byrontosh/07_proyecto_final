@props([
'id' => 'checked',
'color' => 'blue',
'checked' => false
])

<label for="{{$id}}" class="inline-flex items-center cursor-pointer">
    <input id="{{$id}}"
           type="checkbox"
           {{ $checked ? 'checked' : '' }}
           {!! $attributes->merge(['class' => "rounded border-gray-300 text-$color-500 shadow-sm cursor-pointer focus:ring focus:ring-$color-200 focus:ring-opacity-50"]) !!}>
    <span class="ml-2 text-sm text-gray-600">{{$slot}}</span>
</label>
