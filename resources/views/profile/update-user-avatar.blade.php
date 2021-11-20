<x-form-section>

    <x-slot name="title">{{ __("Avatar") }}</x-slot>

    <x-slot name="description">
        {{ __("Update your profile avatar.") }}
    </x-slot>

    <x-slot name="form">
        <form method="POST" action="{{ route('user-avatar.update') }}" enctype="multipart/form-data"
              class="grid grid-cols-6 gap-6">
            @method('PUT')
            @csrf
            <!--User avatar-->
            <div class="col-span-6 sm:col-span-2">
               <x-user-avatar class="w-24 h-24 md:w-28 md:h-28 mx-auto" :src="$user->image->getUrl()"/>
            </div>

            <!--Image-->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="image" :value="__('Image')"/>

                <x-input id="image"
                         class="block mt-2 w-full"
                         type="file"
                         name="image"
                         required/>

                <x-input-error for="image" class="mt-2"/>
            </div>

            <!--Actions-->
            <div class="col-span-6 flex justify-end">
                <x-button class="min-w-max">{{ __('Update') }}</x-button>
            </div>
        </form>
    </x-slot>

</x-form-section>
