<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'max:255'],
            'password' => [
                'required',
                'string',
                Password::min(6)->mixedCase()->numbers()->symbols(),
                'confirmed',
                'max:255'
            ],
        ]);

        $user = $request->user();


        //Se debe verificar si la pass coincide con la del usuario
        if(!$this->checkPassword($request->input('current_password'), $user->password)){

            throw ValidationException::withMessages([
                'current_password' => 'No es su password actual',
            ]);
        }


        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('status', 'Password update successfully');
    }


    public function checkPassword(string $current_password, string $user_password): bool
    {
        return Hash::check($current_password, $user_password);

    }
}
