<div x-data="{ dropdownOpen: false }" class="relative">
    <button @click="dropdownOpen = ! dropdownOpen"
        class="flex items-center h-14 space-x-2 focus:outline-none text-gray-700">

        {{ $header }}

    </button>

    <div class="absolute right-0  mt-4 min-w-max sm:min-w-full bg-white rounded-md overflow-hidden shadow-xl z-10"
        x-show="dropdownOpen" @click.away="dropdownOpen = false">

        {{ $content }}

    </div>
</div>
