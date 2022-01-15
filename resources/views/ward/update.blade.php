@extends('dashboard')

@section('content')

    <div class="mt-2">
        <x-form-section>

            <x-slot name="title">{{ __("Update ward") }}</x-slot>

            <x-slot name="description">
                {{ __("You can update the ward's information.") }}
            </x-slot>

            <x-slot name="form">
                <form method="POST" action="{{ route('ward.update', ['ward' => $ward->id]) }}" class="grid grid-cols-6 gap-6">
                    @method('PUT')
                    @csrf

                    <!--Name-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="name" :value="__('Name')"/>

                        <x-input id="name"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="name"
                                 :value="old('name') ?? $ward->name"
                                 placeholder="Enter the name"
                                 maxlength="45"
                                 required/>

                        <x-input-error for="name" class="mt-2"/>
                    </div>

                    <!--Location-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="location" :value="__('Location')"/>

                        <x-input id="location"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="location"
                                 :value="old('location') ?? $ward->location"
                                 placeholder="Enter the location"
                                 maxlength="45"
                                 required/>

                        <x-input-error for="location" class="mt-2"/>
                    </div>

                    <!--Description-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="description">
                            {{ __('Description') }}
                            <span class="text-sm ml-2 text-gray-400"> ({{ __('Optional') }})</span>
                        </x-label>

                        <x-text-area id="description"
                                     name="description"
                                     class="block mt-2 w-full"
                                     rows="6"
                                     placeholder="Enter the description"
                                     maxlength="255">{{ old('description') ?? $ward->description }}</x-text-area>

                        <x-input-error for="description" class="mt-2"/>
                    </div>

                    <!--Actions-->
                    <div class="col-span-6 flex justify-end">
                        <x-button class="min-w-max">{{ __('Update') }}</x-button>
                    </div>
                </form>
            </x-slot>

        </x-form-section>
    </div>

    
@endsection
