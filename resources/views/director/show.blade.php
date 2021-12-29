@extends('dashboard')

@section('content')

    <div class="mt-2">
        <x-form-section>

            <x-slot name="title">{{ __("Director information") }}</x-slot>

            <x-slot name="description">
                {{ __("You can view the director's information.") }}
            </x-slot>

            <x-slot name="form">
                <div class="grid grid-cols-6 gap-6">
                    <!--Avatar-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-user-avatar class="w-24 h-24 md:w-20 md:h-20 mx-auto" :src="$director->image->getUrl()"/>
                    </div>

                    <!--Username-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="username" :value="__('Username')"/>

                        <x-input id="username"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="username"
                                 :value="$director->username"
                                 disabled/>
                    </div>

                    <!--First name-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="first_name" :value="__('First name')"/>

                        <x-input id="first_name"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="first_name"
                                 :value="$director->first_name"
                                 disabled/>
                    </div>

                    <!--Last name-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="last_name" :value="__('Last name')"/>

                        <x-input id="last_name"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="last_name"
                                 :value="$director->last_name"
                                 disabled/>
                    </div>

                    <!--Email-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="email" :value="__('Email')"/>

                        <x-input id="email"
                                 class="block mt-2 w-full"
                                 type="email"
                                 name="email"
                                 :value="$director->email"
                                 disabled/>
                    </div>

                    <!--Birthdate-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="birthdate">
                            {{ __('Birthdate') }}
                            <span class="text-sm ml-2 text-gray-400"> ({{ __('Optional') }})</span>
                        </x-label>

                        <x-input id="birthdate"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="birthdate"
                                 :value="$director->birthdate"
                                 disabled/>
                    </div>

                    <!--Phone number-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="personal_phone" :value="__('Phone number')"/>

                        <x-input id="personal_phone"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="personal_phone"
                                 :value="$director->personal_phone"
                                 disabled/>
                    </div>

                    <!--Home phone number-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="home_phone" :value="__('Home phone number')"/>

                        <x-input id="home_phone"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="home_phone"
                                 :value="$director->home_phone"
                                 disabled/>
                    </div>

                    <!--Address-->
                    <div class="col-span-6">
                        <x-label for="address" :value="__('Address')"/>

                        <x-input id="address"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="address"
                                 :value="$director->address"
                                 disabled/>
                    </div>

                    <!--Actions-->
                    <div class="col-span-6 flex justify-end">
                        <x-link :href="route('director.index')">
                            <x-button class="min-w-max">{{ __('Previous page') }}</x-button>
                        </x-link>
                    </div>
                </div>
            </x-slot>

        </x-form-section>
    </div>

    @endsection()
