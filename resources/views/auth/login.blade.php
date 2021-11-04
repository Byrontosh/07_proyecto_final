@php
    /*Colors for this view*/
    $primary = "yellow";
    $secondary = "pink";
@endphp

<x-auth-layout
    :primaryColor="$primary"
    :secondaryColor="$secondary"
    reversColumns=0
>

    <!--Login Info-->
    <x-slot name="formTitle">{{"Welcome Back"}}</x-slot>

    <x-slot name="formDescription">{{"Please sign in to your account"}}</x-slot>

    <!--Login  Form-->
    <x-slot name="authForm">

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <!--Username or email-->
            <div>
                <x-label for="login_field"
                         :value="__('Username or email address')"/>

                <x-input id="login_field"
                         class="block mt-2 w-full"
                         :focus-color="$primary"
                         type="text"
                         name="login_field"
                         :value="old('login_field')"
                         placeholder="Enter your username or email"
                         required
                         autofocus/>
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password"
                         :value="__('Password')"/>

                <x-input id="password"
                         class="block mt-2 w-full"
                         :focus-color="$primary"
                         type="password"
                         name="password"
                         placeholder="Enter your password"
                         required
                         autocomplete="current-password"/>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <!-- Remember Me -->
                <x-check id="remember_me"
                         name="remember"
                         :color="$primary"
                         :checked="old('remember') == 'on'">
                    {{ __('Remember me') }}
                </x-check>
                <!--Forgot Password-->
                @if (Route::has('password.request'))
                    <x-link href="{{ route('password.request') }}"
                            :color="$primary"
                            :hover="$secondary">
                        {{ __('Forgot your password?') }}
                    </x-link>
                @endif
            </div>

            <div class="mt-4 flex justify-center">
                <x-button class="w-3/5"
                          :primary-color="$primary"
                          :secondary-color="$secondary">
                    {{ __('Sing in') }}
                </x-button>
            </div>

            <div class="mt-4 flex flex-col items-center justify-center text-md text-gray-500">
                <!--Sign Up-->
                @if (Route::has('register'))
                    <span>{{"Don't have an account?"}}</span>
                    <x-link href="{{ route('register') }}"
                            class="text-base font-semibold"
                            :color="$primary"
                            :hover="$secondary">
                        {{ __('Sign up') }}
                    </x-link>
                @endif
            </div>
        </form>
    </x-slot>
</x-auth-layout>
