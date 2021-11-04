@php
    /*Colors for this view*/
    $primary = "green";
    $secondary = "gray";
@endphp


<x-auth-layout
    :primaryColor="$primary"
    :secondaryColor="$secondary"
    reversColumns=1
>

    <!--Login Info-->
    <x-slot name="formTitle">{{"Email Verification"}}</x-slot>

    <x-slot name="formDescription">{{'Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.'}}</x-slot>

    
    <!--Forgot Password  Form-->
    <x-slot name="authForm">
        <div class="flex justify-between content-center mt-4 space-x-4">
            <form method="POST" action="{{ route('verification.send') }}" class="w-1/2">
                @csrf
                <div class="flex justify-center">
                    <x-button class="w-full"
                              :primary-color="$primary"
                              :secondary-color="$secondary">
                        {{ __('Resend link') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-1/2">
                @csrf
                <div class="flex justify-center">
                    <x-button class="w-full"
                              primary-color="red"
                              secondary-color="pink">
                        {{ __('Log out') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-slot>
</x-auth-layout>
