@extends('dashboard')

@section('content')

    <div class="mt-2">
        <x-form-section>

            <x-slot name="title">{{ __("Update ward") }}</x-slot>

            <x-slot name="description">
                {{ __("You can update the jail's information.") }}
            </x-slot>

            <x-slot name="form">
                <form method="POST" action="{{ route('jail.update', ['jail' => $jail->id]) }}" class="grid grid-cols-6 gap-6">
                    @method('PUT')
                    @csrf

                    <!--Name-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="name" :value="__('Name')"/>

                        <x-input id="name"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="name"
                                 :value="old('name') ?? $jail->name"
                                 placeholder="Enter the name"
                                 maxlength="45"
                                 required/>

                        <x-input-error for="name" class="mt-2"/>
                    </div>

                    <!--Code-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="code" :value="__('Code')"/>

                        <x-input id="code"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="code"
                                 :value="old('code') ?? $jail->code"
                                 placeholder="Enter the code"
                                 maxlength="45"
                                 required/>

                        <x-input-error for="code" class="mt-2"/>
                    </div>

                    <!--Type-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="type" :value="__('Type')"/>

                        <x-select name="type" id="type" class="block mt-2 w-full" required>
                            <option value="">{{ __('Select the type') }}</option>
                            <option value="low" {{ $jail->type === 'low' ? 'selected' : ''}}>
                                {{ __('Low') }}
                            </option>
                            <option value="medium" {{ $jail->type === 'medium' ? 'selected' : ''}}>
                                {{ __('Medium') }}
                            </option>
                            <option value="high" {{ $jail->type === 'high' ? 'selected' : ''}}>
                                {{ __('High') }}
                            </option>
                        </x-select>

                        <x-input-error for="type" class="mt-2"/>
                    </div>

                    <!--Capacity-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="capacity" :value="__('Capacity')"/>

                        <x-input id="capacity"
                                 class="block mt-2 w-full"
                                 type="text"
                                 name="capacity"
                                 :value="old('capacity') ?? $jail->capacity"
                                 placeholder="Enter the capacity"
                                 maxlength="1"
                                 required/>

                        <x-input-error for="capacity" class="mt-2"/>
                    </div>

                    <!--Ward-->
                    <div class="col-span-6 sm:col-span-3">
                        <x-label for="ward_id" :value="__('Ward')"/>

                        <x-select name="ward_id" id="ward_id" class="block mt-2 w-full" required>
                            <option value="">{{ __('Select the ward') }}</option>
                            @foreach($wards as $ward)
                                <option value="{{ $ward->id }}" {{ $jail->ward->id === $ward->id ? 'selected' : ''}}>
                                    {{ $ward->name }}
                                </option>
                            @endforeach
                        </x-select>

                        <x-input-error for="ward" class="mt-2"/>
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
                                     maxlength="255">{{ old('description') ?? $jail->description }}</x-text-area>

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
