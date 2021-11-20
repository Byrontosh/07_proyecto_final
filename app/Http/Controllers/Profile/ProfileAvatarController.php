<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileAvatarController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:512']
        ]);

        $user = $request->user();

        $user->updateImage($request['image'], 'avatars');
        
        return back()->with('status', 'Avatar update successfully');
    }
}
