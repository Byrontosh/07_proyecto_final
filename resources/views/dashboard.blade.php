
<div class="container">

    Bienvenido - {{ Auth::user()->first_name }}

</div>

<div>
    <form method="POST" action="{{ route('logout') }}" class="w-1/2">
        @csrf
        <div class="flex justify-center">
            <button type="submit">LOGOUT</button>
        </div>
    </form>
</div>





