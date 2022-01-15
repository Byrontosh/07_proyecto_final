@extends('dashboard')

@section('content')

    <div class="mt-2">
        <x-form-section>

            <x-slot name="title">{{ __("Jail information") }}</x-slot>

            <x-slot name="description">
                {{ __("You can view the jail's information.") }}
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
                                 :value="$jail->name"
                                 disabled/>
                    </div>

                    <!--Code-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="code" :value="__('Code')"/>

                        <x-input id="code"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="code"
                                 :value="$jail->code"
                                 disabled/>
                    </div>

                    <!--Type-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="type" :value="__('Type')"/>

                        <x-input id="type"
                                 class="block mt-2 w-full capitalize"
                                 type="text"
                                 name="type"
                                 :value="$jail->type"
                                 disabled/>
                    </div>

                    <!--Capacity-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="capacity" :value="__('Capacity')"/>

                        <x-input id="capacity"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="capacity"
                                 :value="$jail->capacity"
                                 disabled/>
                    </div>

                    <!--Ward-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="ward" :value="__('Ward')"/>

                        <x-input id="ward"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="ward"
                                 :value="$jail->ward->name"
                                 disabled/>
                    </div>

                    <!--Description-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="description" :value="__('Description')"/>

                        <x-text-area id="description"
                                     class="block mt-2 w-full"
                                     rows="6"
                                     name="description"
                                     disabled>{{ $jail->description }}</x-text-area>
                    </div>

                    <!--Actions-->
                    <div class="col-span-6 flex justify-end">
                        <x-link :href="route('jail.index')">
                            <x-button class="min-w-max">{{ __('Previous page') }}</x-button>
                        </x-link>
                    </div>
                </div>
            </x-slot>

        </x-form-section>
    </div>

@endsection
