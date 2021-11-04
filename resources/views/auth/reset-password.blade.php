@php
    /*Colors for this view*/
    $primary = "purple";
    $secondary = "yellow";
@endphp

<x-auth-layout
    :primaryColor="$primary"
    :secondaryColor="$secondary"
    reversColumns=1
>

    <!--Login Info-->
    <x-slot name="formTitle">{{"Reset Password"}}</x-slot>

    <x-slot name="formDescription">{{"Now you can change your password, make sure it is secure."}}</x-slot>


    <!--Reset Password  Form-->
    <x-slot name="authForm">
        
        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!--Email-->
            <x-input type="hidden"
                     name="email"
                     :value="$request->email"
                     required/>

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
                         required
                         autofocus/>
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
                    {{ __('Reset') }}
                </x-button>
            </div>
        </form>
    </x-slot>
</x-auth-layout>
