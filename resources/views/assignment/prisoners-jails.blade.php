@extends('dashboard')

@section('content')


<!-- Validation Errors -->
    <x-validation-errors class="mb-4" :errors="$errors" />

    <div class="bg-white p-6 md:p-8 shadow-md">
        <div class="grid grid-cols-12 gap-3 px-4 sm:px-0">
            <div class="col-span-12 md:col-span-8">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __("Assignment of prisoners to jails") }}
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("You can assign a prisoner to a certain jail or change a prisoner's jail.") }}
                </p>
            </div>

            <div class="col-span-12 md:col-span-4 flex items-center mx-auto max-w-max md:w-full">
                <form method="GET" action="{{ route('assignment.prisoners-jails.index') }}">
                    <x-search/>
                </form>
            </div>

        </div>

        <x-table.list>
            <x-slot name="thead">
                <tr>
                    <x-table.th>{{ __("User") }}</x-table.th>
                    <x-table.th>{{ __("Nickname") }}</x-table.th>
                    <x-table.th>{{ __("State") }}</x-table.th>
                    <x-table.th>{{ __("Jail") }}</x-table.th>
                    <x-table.th>{{ __("Action") }}</x-table.th>
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
                            <x-badge :color="$prisoner->state ? 'green' : 'red'">
                                {{ $prisoner->state ? 'active' : 'inactive'}}
                            </x-badge>
                        </x-table.td>

                        <x-table.td>
                            {{ $prisoner->jails->first()->name ?? "N/A" }}
                        </x-table.td>


                        @if($prisoner->state)
                        <!--Form-->
                            <x-table.td>
                                <form method="POST" class="flex space-x-3"
                                      action="{{ route('assignment.prisoners-jails.update', ['user' => $prisoner->id]) }}"
                                      x-ref="prisoner-jail-update">
                                    @method('PUT')
                                    @csrf

                                    <x-select name="jail" id="jail" required>
                                        <option value="">{{ __('Change jail') }}</option>
                                        @foreach($jails as $jail)
                                            <option value="{{ $jail->id }}">
                                                {{ $jail->name }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    <x-button class="min-w-max">{{ __('Assign') }}</x-button>
                                </form>
                            </x-table.td>
                        @endif

                    </tr>
                @endforeach

            </x-slot>
            <x-slot name="pagination">
                {{ $prisoners->links() }}
            </x-slot>
        </x-table.list>
    </div>


@endsection
