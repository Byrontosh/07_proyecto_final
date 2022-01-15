<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Http\Request;

class GuardWardController extends Controller
{
    private int $allowed_number_of_guards_per_ward = 2;


    public function __construct()
    {
        $this->middleware('can:manage-assignment');
        $this->middleware('active.user')->except('index');
        $this->middleware('verify.user.role:guard')->except('index');
    }


    public function index()
    {

        $guard_role = Role::where('name', 'guard')->first();

        $guards = $guard_role -> users();

        if (request('search'))
        {
            $guards = $guards->where('username', 'like', '%' . request('search') . '%');
        }

        $guards = $guards
            ->orderBy('first_name', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate();


        $wards = Ward::orderBy('name', 'asc')->cursor()->filter(function ($ward)
        {
           return $this -> allowed_number_of_guards_per_ward > $ward -> users -> count() && $ward -> state;
        });



        return view('assignment.guards-wards', [
            'guards' => $guards,
            'wards' => $wards->all()
        ]);
    }


    public function update(Request $request, User $user)
    {

        $request->validate([
            'ward' => ['required', 'string', 'numeric', 'exists:wards,id']
        ]);

        $guard = $user;

        if ($this->verifyItIsTheSameWard($guard->wards->first(), $request['ward']))
        {
            return back()->with([
                'status' => 'The guard is already in that ward.',
                'color' => 'yellow'
            ]);
        }

        //A new user and ward relationship is created.
        $guard->wards()->sync($request['ward']);

        return back()->with('status', 'Assignment updated successfully');
    }


    private function verifyItIsTheSameWard(Ward|null $ward, string $ward_id)
    {
        return !is_null($ward) && $ward->id === (int)$ward_id;
    }

}
