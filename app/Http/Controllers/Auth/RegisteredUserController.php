<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{

    // Invocación de la vista
    public function create()
    {
        return view('auth.register');
    }

    // Captura los datos de la vista y crea el usuario en la BDD
    public function store(Request $request)
    {
        $request->validate([

            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'personal_phone' => ['required', 'string', 'max:10'],
            'home_phone' => ['required', 'string', 'max:9'],
            'address' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);


        //dd($request->all());

        $user = User::make([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => "$request->first_name $request->last_name",
            'personal_phone' => $request->personal_phone,
            'home_phone' => $request->home_phone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);


        // Se hace una consulta a la BDD y
        // se asigna el rol al usuario
        // por medio del modelo ROL
        $guard_role = Role::where('name', 'guard')->first();

        $guard_role->users()->save($user);

        event(new Registered($user)); // VERIFICACIÓN DEL CHECK EN EL EMAIL

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
