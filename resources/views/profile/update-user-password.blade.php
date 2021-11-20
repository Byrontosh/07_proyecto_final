<x-form-section>

    <x-slot name="title">{{ __("Update password") }}</x-slot>

    <x-slot name="description">
        {{ __("Make sure your account uses a long, random password to be safe.") }}
    </x-slot>

    <x-slot name="form">
        <form method="POST" action="{{ route('user-password.update') }}" class="grid grid-cols-6 gap-6">
            @method('PUT')
            @csrf
            <!--Current password-->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="current_password" :value="__('Current password')"/>

                <x-input id="current_password"
                         class="block mt-2 w-full"
                         type="password"
                         name="current_password"
                         placeholder="Enter your current password"
                         maxlength="255"
                         required />

                <x-input-error for="current_password" class="mt-2"/>
            </div>

            <!--New password-->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="password" :value="__('New password')"/>

                <x-input id="password"
                         class="block mt-2 w-full"
                         type="password"
                         name="password"
                         placeholder="Enter your new password"
                         maxlength="255"
                         required/>

                <x-input-error for="password" class="mt-2"/>
            </div>


            <!--Confirm new password-->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')"/>

                <x-input id="password_confirmation"
                         class="block mt-2 w-full"
                         type="password"
                         name="password_confirmation"
                         placeholder="Enter your new password again"
                         maxlength="255"
                         required/>

                <x-input-error for="password_confirmation" class="mt-2"/>
            </div>

            <!--Actions-->
            <div class="col-span-6 flex justify-end">
                <x-button class="min-w-max">{{ __('Update') }}</x-button>
            </div>
        </form>
    </x-slot>
</x-form-section>
