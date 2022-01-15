@extends('dashboard')

@section('content')



    <div class="bg-white p-6 md:p-8 shadow-md">
        <div class="grid grid-cols-12 gap-3 px-4 sm:px-0">
            <div class="col-span-12 md:col-span-8">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __("List of jails") }}
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("List of jails registered in the system.") }}
                </p>
            </div>

            <div class="col-span-12 md:col-span-4 flex items-center mx-auto max-w-max md:w-full">
                <form method="GET" action="{{ route('jail.index') }}" >
                    <x-search/>
                </form>
            </div>

        </div>

        <x-table.list>
            <x-slot name="thead">
                <tr>
                    <x-table.th>{{ __("Name") }}</x-table.th>
                    <x-table.th>{{ __("Code") }}</x-table.th>
                    <x-table.th>{{ __("Type") }}</x-table.th>
                    <x-table.th>{{ __("Capacity") }}</x-table.th>
                    <x-table.th>{{ __("state") }}</x-table.th>
                    <x-table.th>{{ __("Actions") }}</x-table.th>
                </tr>
            </x-slot>

            <x-slot name="tbody">

                @foreach($jails as $jail)
                    <tr>
                        <x-table.td>
                            {{ $jail->name }}
                        </x-table.td>

                        <x-table.td>
                            {{ $jail->code }}
                        </x-table.td>

                        <x-table.td>
                            {{ $jail->type }}
                        </x-table.td>

                        <x-table.td>
                            {{ $jail->capacity }}
                        </x-table.td>

                        <x-table.td>
                            <x-badge :color="$jail->state ? 'green' : 'red'">
                                {{ $jail->state ? 'active' : 'inactive'}}
                            </x-badge>
                        </x-table.td>

                        <x-table.td class="space-x-3 whitespace-nowrap">
                            <x-link color="gray" class="inline-flex"
                                    href="{{ route('jail.show', ['jail' => $jail->id]) }}">
                                <x-icons.show/>
                            </x-link>
                            <x-link color="indigo" class="inline-flex"
                                    href="{{ route('jail.edit', ['jail' => $jail->id]) }}">
                                <x-icons.edit/>
                            </x-link>
                            <x-link color="{{ $jail->state ? 'red' : 'green'}}" class="inline-flex"
                                    href="{{ route('jail.destroy', ['jail' => $jail->id]) }}">
                                @if($jail->state)
                                    <x-icons.delete/>
                                @else
                                    <x-icons.check/>
                                @endif
                            </x-link>
                        </x-table.td>
                    </tr>
                @endforeach

            </x-slot>
            <x-slot name="pagination">
                {{ $jails->links() }}
            </x-slot>
        </x-table.list>
    </div>

@endsection
