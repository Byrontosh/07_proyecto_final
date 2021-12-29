@extends('dashboard')

@section('content')

    <div class="bg-white p-6 md:p-8 shadow-md">
        <div class="grid grid-cols-12 gap-3 px-4 sm:px-0">
            <div class="col-span-12 md:col-span-8">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __("List of guards") }}
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("List of users with the role of guard and who have been registered in the system.") }}
                </p>
            </div>

            <div class="col-span-12 md:col-span-4 flex items-center mx-auto max-w-max md:w-full">
                <form method="GET" action="{{ route('guard.index') }}" >
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

                @foreach($guards as $guard)
                    <tr>
                        <x-table.td class=" space-x-3 whitespace-nowrap">
                            <x-user-avatar class="hidden md:inline-flex" src="{{  $guard->image->getUrl() }}"/>
                            <p class="inline-flex">{{ $guard->getFullName() }}</p>
                        </x-table.td>

                        <x-table.td>
                            {{ $guard->username }}
                        </x-table.td>
                        <x-table.td>
                            {{ $guard->email }}
                        </x-table.td>

                        <x-table.td>
                            <x-badge :color="$guard->state ? 'green' : 'red'">
                                {{ $guard->state ? 'active' : 'inactive'}}
                            </x-badge>
                        </x-table.td>

                        <x-table.td class="space-x-3 whitespace-nowrap">
                            <x-link color="gray" class="inline-flex"
                                    href="{{ route('guard.show', ['user' => $guard->id]) }}">
                                <x-icons.show/>
                            </x-link>
                            <x-link color="indigo" class="inline-flex"
                                    href="{{ route('guard.edit', ['user' => $guard->id]) }}">
                                <x-icons.edit/>
                            </x-link>
                            <x-link color="{{ $guard->state ? 'red' : 'green'}}" class="inline-flex"
                                    href="{{ route('guard.destroy', ['user' => $guard->id]) }}">
                                @if($guard->state)
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
                {{ $guards->links() }}
            </x-slot>
        </x-table.list>
    </div>

@endsection
