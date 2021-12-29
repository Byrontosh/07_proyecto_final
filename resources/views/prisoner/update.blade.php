@extends('dashboard')

@section('content')

    <div class="mt-2">
        <x-form-section>

            <x-slot name="title">{{ __("Update prisoner") }}</x-slot>

            <x-slot name="description">
                {{ __("You can update the prisoner's information.") }}
            </x-slot>

            <x-slot name="form">
                <form method="POST" action="{{ route('prisoner.update', ['user' => $prisoner->id]) }}" class="grid grid-cols-6 gap-6">
                    @method('PUT')
                    @csrf

                    <!--First name-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="first_name" :value="__('First name')"/>

                        <x-input id="first_name"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="first_name"
                                 :value="old('first_name') ?? $prisoner->first_name"
                                 placeholder="Enter the first name"
                                 maxlength="35"
                                 required/>

                        <x-input-error for="first_name" class="mt-2"/>
                    </div>

                    <!--Last name-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="last_name" :value="__('Last name')"/>

                        <x-input id="last_name"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="last_name"
                                 :value="old('last_name') ?? $prisoner->last_name"
                                 placeholder="Enter the last name"
                                 maxlength="35"
                                 required/>

                        <x-input-error for="last_name" class="mt-2"/>
                    </div>

                    <!--Username-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="username" :value="__('Username')"/>

                        <x-input id="username"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="username"
                                 :value="old('username') ?? $prisoner->username"
                                 placeholder="Enter the username"
                                 maxlength="20"
                                 required/>

                        <x-input-error for="username" class="mt-2"/>
                    </div>

                    <!--Email-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="email" :value="__('Email')"/>

                        <x-input id="email"
                                 class="block mt-2 w-full"
                                 type="email"
                                 name="email"
                                 :value="old('email') ?? $prisoner->email"
                                 placeholder="Enter the email"
                                 required/>

                        <x-input-error for="email" class="mt-2"/>
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
                                 maxlength="10"
                                 :value="old('birthdate') ?? $prisoner->birthdate"
                                 placeholder="dd/mm/yyyy"/>

                        <x-input-error for="birthdate" class="mt-2"/>
                    </div>

                    <!--Phone number-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="phone_number" :value="__('Phone number')"/>

                        <x-input id="phone_number"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="phone_number"
                                 maxlength="10"
                                 :value="old('phone_number') ?? $prisoner->phone_number"
                                 placeholder="Example: 0989999999"
                                 required/>

                        <x-input-error for="phone_number" class="mt-2"/>
                    </div>

                    <!--Home phone number-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="home_phone_number" :value="__('Home phone number')"/>

                        <x-input id="home_phone_number"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="home_phone_number"
                                 maxlength="9"
                                 :value="old('home_phone_number') ?? $prisoner->home_phone_number"
                                 placeholder="Example: 022999999"
                                 required/>

                        <x-input-error for="home_phone_number" class="mt-2"/>
                    </div>

                    <!--Address-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="address" :value="__('Address')"/>

                        <x-input id="address"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="address"
                                 :value="old('address') ?? $prisoner->address"
                                 placeholder="Enter the address"
                                 maxlength="50"
                                 required/>

                        <x-input-error for="address" class="mt-2"/>
                    </div>

                    <!--Actions-->
                    <div class="col-span-6 flex justify-end">
                        <x-button class="min-w-max">{{ __('Update') }}</x-button>
                    </div>
                </form>
            </x-slot>

        </x-form-section>
    </div>

@endsection()
