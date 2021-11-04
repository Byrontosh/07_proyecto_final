<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>




<body class="font-sans antialiased">

    <div class="relative">

        <!--Side-->
        <div class="md:fixed md:w-2/5  {{ $reversColumns ? 'right-0' : 'left-0' }}">

            <div
                class="hidden md:flex justify-center items-center  min-h-screen
             bg-gradient-to-r from-{{ $primaryColor }}-500 to-{{ $secondaryColor }}-500">

                <div class="text-center text-white space-y-3 p-8">
                    <a href="{{ route('home') }}" class="inline-flex">
                        <x-icon class="w-28 h-28 mx-auto"/>
                    </a>

                    {{-- Side Title --}}
                    <h2 class="text-3xl font-extrabold">Prison System</h2>

                    {{-- Side Description --}}
                    <p class="text-base">Web system for the management of a penitentiary center.</p>

                </div>
            </div>

        </div>

        {{-- Auth Form --}}
        <div class="absolute flex w-full md:w-3/5 min-h-screen items-center justify-center py-16
         {{ $reversColumns ? 'left-0' : 'right-0' }}">

            <main class="max-w-md w-full h-auto px-4">

                <div class="text-center space-y-2">
                    <a href="{{ route('home') }}" class="inline-flex md:hidden">
                        <x-icon class="w-14 h-14 mx-auto text-{{$primaryColor}}-500"/>
                    </a>

                    {{-- Title Form --}}
                    <h2 class="text-2xl md:text-3xl font-bold">
                        {{-- Slot --}}
                        {{ $formTitle }}
                    </h2>

                    {{-- Description Form --}}
                    <p class="text-sm text-gray-500">
                        {{-- Slot --}}
                        {{ $formDescription }}
                    </p>

                    {{-- Session Status --}}
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    {{-- Validation Errors --}}
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                </div>
                <div class="mt-6">
                    {{ $authForm }}
                </div>

            </main>


        </div>

    </div>


</body>

</html>
