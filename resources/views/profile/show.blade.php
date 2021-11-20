@extends('dashboard')


@section('content')

<div class="mt-2">
    @include('profile.update-user-avatar')
</div>


<div class="mt-2">
    @include('profile.update-profile-information')
</div>

<div class="mt-10">
    @include('profile.update-user-password')
</div>

@endsection()
