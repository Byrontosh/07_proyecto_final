@extends('dashboard')

@section('content')

    <div class="mt-2">
        <x-form-section>

            <x-slot name="title">{{ __("Ward information") }}</x-slot>

            <x-slot name="description">
                {{ __("You can view the ward's information.") }}
            </x-slot>

            <x-slot name="form">
                <div class="grid grid-cols-6 gap-6">

                    <!--Name-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="name" :value="__('Name')"/>

                        <x-input id="name"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="name"
                                 :value="$ward->name"
                                 disabled/>
                    </div>

                    <!--Location-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="location" :value="__('Location')"/>

                        <x-input id="location"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="location"
                                 :value="$ward->location"
                                 disabled/>
                    </div>

                    <!--Description-->
                    <div class="col-span-6">
                        <x-label for="description" :value="__('Description')"/>

                        <x-text-area id="description"
                                     class="block mt-2 w-full"
                                     rows="6"
                                     name="description"
                                     disabled>{{ $ward->description }}</x-text-area>
                    </div>

                    <!--Actions-->
                    <div class="col-span-6 flex justify-end">
                        <x-link :href="route('ward.index')">
                            <x-button class="min-w-max">{{ __('Previous page') }}</x-button>
                        </x-link>
                    </div>
                </div>
            </x-slot>

        </x-form-section>
    </div>


@endsection
