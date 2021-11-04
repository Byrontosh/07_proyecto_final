@php
    /*Colors for this view*/
    $primary = "indigo";
    $secondary = "pink";
@endphp

<x-auth-layout
    :primaryColor="$primary"
    :secondaryColor="$secondary"
    reversColumns=1
>

    <!--Login Info-->
    <x-slot name="formTitle">{{"Forgot Password"}}</x-slot>

    <x-slot name="formDescription">{{"Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one."}}</x-slot>


    <!--Forgot Password  Form-->
    <x-slot name="authForm">
        
        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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

            <div class="mt-4 flex justify-center">
                <x-button class="w-3/5"
                          :primary-color="$primary"
                          :secondary-color="$secondary">
                    {{ __('Request link') }}
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
