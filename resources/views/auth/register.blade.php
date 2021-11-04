@php
    /*Colors for this view*/
    $primary = "green";
    $secondary = "indigo";
@endphp

<x-auth-layout
    :primaryColor="$primary"
    :secondaryColor="$secondary"
    reversColumns=1
>

    <!--Login Info-->
    <x-slot name="formTitle">{{"Create Account"}}</x-slot>

    <x-slot name="formDescription">{{"Great, now you can be part of us, just sign up."}}</x-slot>


    <!--Create Count Form-->
    <x-slot name="authForm">
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf


            <!--Email-->
            <div>
                <x-label for="email"
                         :value="__('Email address')"/>

                <x-input id="email"
                         class="block mt-2 w-full"
                         :focus-color="$primary"
                         type="email"
                         name="email"
                         :value="old('email')"
                         placeholder="Enter your email"
                         required
                         autofocus/>
            </div>



            <!--First Name-->
            <div>
                <x-label for="first_name"
                         :value="__('First Name')"/>

                <x-input id="first_name"
                         class="block mt-2 w-full"
                         :focus-color="$primary"
                         type="text"
                         name="first_name"
                         :value="old('first_name')"
                         placeholder="Enter your first name"
                         required/>
            </div>



            <!--Last Name-->
            <div>
                <x-label for="last_name"
                         :value="__('Last Name')"/>

                <x-input id="last_name"
                         class="block mt-2 w-full"
                         :focus-color="$primary"
                         type="text"
                         name="last_name"
                         :value="old('last_name')"
                         placeholder="Enter your last name"
                         required/>
            </div>



            <!--Personal Phone-->
            <div>
                <x-label for="personal_phone"
                         :value="__('Personal Phone')"/>

                <x-input id="personal_phone"
                         class="block mt-2 w-full"
                         :focus-color="$primary"
                         type="text"
                         name="personal_phone"
                         :value="old('personal_phone')"
                         placeholder="Enter your personal phone"
                         required/>
            </div>



            <!--Home Phone-->
            <div>
                <x-label for="home_phone"
                         :value="__('Home Phone')"/>

                <x-input id="home_phone"
                         class="block mt-2 w-full"
                         :focus-color="$primary"
                         type="text"
                         name="home_phone"
                         :value="old('home_phone')"
                         placeholder="Enter your home phone"
                         required/>
            </div>



            <!--Address-->
            <div>
                <x-label for="address"
                         :value="__('Address')"/>

                <x-input id="address"
                         class="block mt-2 w-full"
                         :focus-color="$primary"
                         type="text"
                         name="address"
                         :value="old('address')"
                         placeholder="Enter your address"
                         required/>
            </div>



            <!-- Password -->
            <div>
                <x-label for="password"
                         :value="__('Password')"/>

                <x-input id="password"
                         class="block mt-2 w-full"
                         :focus-color="$primary"
                         type="password"
                         name="password"
                         placeholder="Enter your new password"
                         required/>
            </div>


            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation"
                         :value="__('Confirm Password')"/>

                <x-input id="password_confirmation"
                         class="block mt-2 w-full"
                         :focus-color="$primary"
                         type="password"
                         name="password_confirmation"
                         placeholder="Enter your new password again"
                         required/>
            </div>



            <div class="mt-4 flex justify-center">
                <x-button class="w-3/5"
                          :primary-color="$primary"
                          :secondary-color="$secondary">
                    {{ __('Register') }}
                </x-button>
            </div>



            <div class="mt-4 flex flex-col items-center justify-center text-md text-gray-500">
                <!--Sign In-->
                <span>{{"Already have an account?"}}</span>
                <x-link href="{{route('login')}}"
                        class="text-base font-semibold"
                        :color="$primary"
                        :hover="$secondary">
                    {{ __('Sign in') }}
                </x-link>
            </div>


        </form>

        
    </x-slot>
</x-auth-layout>
