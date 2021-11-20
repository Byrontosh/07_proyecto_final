@props([
    'isActive' => false,
    'color' => 'indigo',
])

<div x-data="{ dropdownOpen: {{ $isActive ? 'true' : 'false' }}}">
    <button @click="dropdownOpen = ! dropdownOpen"
        {{ $attributes->merge([
            'class' => "flex justify-between items-center p-2 text-gray-500 rounded-md hover:bg-$color-100"
        ]) }}
        :class="{'bg-{{ $color }}-100': dropdownOpen }">

        <div class="inline-flex space-x-2 items-center">

            {{ $header }}

        </div>

        <div class="transition-transform transform"
            :class="{ 'rotate-180': dropdownOpen }">
            <x-icons.chevron-down/>
        </div>
    </button>
    <div x-show="dropdownOpen" class="mt-2 space-y-2 px-7">

       {{ $content }}

    </div>
</div>
