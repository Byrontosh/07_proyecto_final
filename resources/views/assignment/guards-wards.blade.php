@extends('dashboard')

@section('content')


    <!-- Validation Errors -->
    <x-validation-errors class="mb-4" :errors="$errors" />

    <div class="bg-white p-6 md:p-8 shadow-md">
        <div class="grid grid-cols-12 gap-3 px-4 sm:px-0">
            <div class="col-span-12 md:col-span-8">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __("Assignment of guards to wards") }}
                </h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("You can assign a guard to a certain ward or change a guard's ward.") }}
                </p>
            </div>

            <div class="col-span-12 md:col-span-4 flex items-center mx-auto max-w-max md:w-full">
                <form method="GET" action="{{ route('assignment.guards-wards.index') }}">
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
                    <x-table.th>{{ __("Ward") }}</x-table.th>
                    <x-table.th>{{ __("Action") }}</x-table.th>
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
                            <x-badge :color="$guard->state ? 'green' : 'red'">
                                {{ $guard->state ? 'active' : 'inactive'}}
                            </x-badge>
                        </x-table.td>

                        <x-table.td>
                            {{ $guard->wards->first()->name ?? "N/A" }}
                        </x-table.td>


                        @if($guard->state)
                        <!--Form-->
                            <x-table.td>
                                <form method="POST" class="flex space-x-3"
                                      action="{{ route('assignment.guards-wards.update', ['user' => $guard->id]) }}">
                                    @method('PUT')
                                    @csrf

                                    <x-select name="ward" id="ward" required>
                                        <option value="">{{ __('Change ward') }}</option>
                                        @foreach($wards as $ward)
                                            <option value="{{ $ward->id }}">
                                                {{ $ward->name }}
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
                {{ $guards->links() }}
            </x-slot>
        </x-table.list>
    </div>

@endsection
