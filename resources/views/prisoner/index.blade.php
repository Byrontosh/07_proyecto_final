@extends('dashboard')

@section('content')

    <div class="bg-white p-6 md:p-8 shadow-md">
        <div class="grid grid-cols-12 gap-3 px-4 sm:px-0">
            <div class="col-span-12 md:col-span-8">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __("List of prisoners") }}
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("List of users with the role of prisoner and who have been registered in the system.") }}
                </p>
            </div>

            <div class="col-span-12 md:col-span-4 flex items-center mx-auto max-w-max md:w-full">
                <form method="GET" action="{{ route('prisoner.index') }}" >
                    <x-search/>
                </form>
            </div>

        </div>

        <x-table.list>
            <x-slot name="thead">
                <tr>
                    <x-table.th>{{ __("User") }}</x-table.th>
                    <x-table.th>{{ __("Nickname") }}</x-table.th>
                    <x-table.th>{{ __("Email") }}</x-table.th>
                    <x-table.th>{{ __("State") }}</x-table.th>
                    <x-table.th>{{ __("Actions") }}</x-table.th>
                </tr>
            </x-slot>

            <x-slot name="tbody">

                @foreach($prisoners as $prisoner)
                    <tr>
                        <x-table.td class=" space-x-3 whitespace-nowrap">
                            <x-user-avatar class="hidden md:inline-flex" src="{{  $prisoner->image->getUrl() }}"/>
                            <p class="inline-flex">{{ $prisoner->getFullName() }}</p>
                        </x-table.td>

                        <x-table.td>
                            {{ $prisoner->username }}
                        </x-table.td>
                        <x-table.td>
                            {{ $prisoner->email }}
                        </x-table.td>

                        <x-table.td>
                            <x-badge :color="$prisoner->state ? 'green' : 'red'">
                                {{ $prisoner->state ? 'active' : 'inactive'}}
                            </x-badge>
                        </x-table.td>

                        <x-table.td class="space-x-3 whitespace-nowrap">
                            <x-link color="gray" class="inline-flex"
                                    href="{{ route('prisoner.show', ['user' => $prisoner->id]) }}">
                                <x-icons.show/>
                            </x-link>
                            @if ($prisoner->state)
                                <x-link color="indigo" class="inline-flex"
                                        href="{{ route('prisoner.update', ['user' => $prisoner->id]) }}">
                                    <x-icons.edit/>
                                </x-link>
                            @endif
                            <x-link color="{{ $prisoner->state ? 'red' : 'green'}}" class="inline-flex"
                                    href="{{ route('prisoner.destroy', ['user' => $prisoner->id]) }}">
                                @if($prisoner->state)
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
                {{ $prisoners->links() }}
            </x-slot>
        </x-table.list>
    </div>
@endsection()
