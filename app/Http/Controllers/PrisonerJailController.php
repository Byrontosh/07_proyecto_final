<?php

namespace App\Http\Controllers;

use App\Models\Jail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PrisonerJailController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage-assignment');
        $this->middleware('active.user')->except('index');
        $this->middleware('verify.user.role:prisoner')->except('index');
    }

    public function index()
    {
        $prisoner_role = Role::where('name', 'prisoner')->first();

        $prisoners = $prisoner_role->users();

        if (request('search')) {
            $prisoners = $prisoners->where('username', 'like', '%' . request('search') . '%');
        }

        $prisoners = $prisoners
            ->orderBy('first_name', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate();

        $jails = Jail::orderBy('name', 'asc')
            ->cursor()->filter(function ($jail) {
            return $jail->capacity > $jail->users->count() && $jail->state;
        });

        return view('assignment.prisoners-jails', [
            'prisoners' => $prisoners,
            'jails' => $jails->all()
        ]);
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'jail' => ['required', 'string', 'numeric', 'exists:jails,id']
        ]);

        $prisoner = $user;

        if ($this->verifyItIsTheSameJail($prisoner->jails->first(), $request['jail'])) {
            return back()->with([
                'status' => 'The prisoner is already in that jail.',
                'color' => 'yellow'
            ]);
        }


        //A new user and jail relationship is created.
        $prisoner->jails()->sync($request['jail']);

        return back()->with('status', 'Assignment updated successfully');
    }

    private function verifyItIsTheSameJail(Jail|null $jail, string $jail_id): bool
    {
        return !is_null($jail) && $jail->id === (int)$jail_id;
    }
}
