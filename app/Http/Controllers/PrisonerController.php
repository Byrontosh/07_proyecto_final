<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PrisonerController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage-prisoners');
        $this->middleware('active.user')->only('edit', 'update');
        $this->middleware('verify.user.role:prisoner')->except('index', 'create', 'store');
    }


    public function index()
    {
        $prisioner_role = Role::where('name', 'prisoner')->first();

        $prisioners = $prisioner_role->users();

        if (request('search')) {
            $prisioners = $prisioners->where('username', 'like', '%' . request('search') . '%');
        }

        $prisoners = $prisioners->orderBy('first_name', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate();

        return view('prisoner.index', compact('prisoners'));
    }



    public function create()
    {
        return view('prisoner.create');
    }


    public function store(Request $request)
    {

        $prisoner_role = Role::where('name', 'prisoner')->first()->id;


        $request->validate([
            'first_name' => ['required', 'string', 'min:3', 'max:35'],
            'last_name' => ['required', 'string', 'min:3', 'max:35'],
            'username' => ['required', 'string', 'min:5', 'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birthdate' => [
                'required', 'string', 'date_format:d/m/Y',
                'after_or_equal:' . date('Y-m-d', strtotime('-70 years')),
                'before_or_equal:' . date('Y-m-d', strtotime('-18 years')),
            ],
            'personal_phone' => ['required', 'numeric', 'digits:10'],
            'home_phone' => ['required', 'numeric', 'digits:9'],
            'address' => ['required', 'string', 'min:5', 'max:50'],
        ]);


        $prisoner = User::create([
            'role_id' => $prisoner_role,
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'birthdate' => $this->changeDateFormat($request['birthdate']),
            'personal_phone' => $request['personal_phone'],
            'home_phone' => $request['home_phone'],
            'address' => $request['address'],
            'password' => Hash::make('secret123'),
        ]);


        $prisoner->image()->create([
            'path' => $prisoner->generateAvatarUrl(),
        ]);

        return redirect()->route('prisoner.index')->with('status', 'Prisoner created successfully');

    }



    public function show(User $user)
    {
        return view('prisoner.show', ['prisoner' => $user]);
    }



    public function edit(User $user)
    {
        return view('prisoner.update', ['prisoner' => $user]);
    }



    public function update( Request $request, User $user)
    {
     $userRequest = $request->user;

     $request->validate([
         'first_name' => ['required', 'string', 'min:3', 'max:35'],
         'last_name' => ['required', 'string', 'min:3', 'max:35'],
         'username' => ['required', 'string', 'min:5', 'max:20',
             Rule::unique('users')->ignore($userRequest),
         ],
         'email' => ['required', 'string', 'email', 'max:255',
             Rule::unique('users')->ignore($userRequest),
         ],
         'birthdate' => ['nullable', 'string', 'date_format:d/m/Y',
             'after_or_equal:' . date('Y-m-d', strtotime('-70 years')),
             'before_or_equal:' . date('Y-m-d', strtotime('-18 years')),
         ],
         'personal_phone' => ['required', 'numeric', 'digits:10'],
         'home_phone' => ['required', 'numeric', 'digits:9'],
         'address' => ['required', 'string', 'min:5', 'max:50'],
     ]);
     $old_email = $user->email;

     $director = $user;

     $director->update([
     'first_name' => $request['first_name'],
     'last_name' => $request['last_name'],
     'username' => $request['username'],
     'email' => $request['email'],
     'birthdate' => $this->changeDateFormat($request['birthdate']),
     'personal_phone' => $request['personal_phone'],
     'home_phone' => $request['home_phone'],
     'address' => $request['address'],
     ]);

     $director->updateUIAvatar($director->generateAvatarUrl());

     $this->verifyEmailChange($director, $old_email);

     return back()->with('status', 'Director updated successfully');
    }


    /* Eliminar los datos de los prisioneros en la BDD*/
    public function destroy(User $user)
    {
        $prisoner = $user;

        $state = $prisoner->state;

        $message = $state ? 'inactivated' : 'activated';

        $prisoner->state = !$state;

        $prisoner->save();

        return back()->with('status', "Prisoner $message successfully");
    }


    public function changeDateFormat(string $date, string $date_format='d/m/Y', string $expected_format = 'Y-m-d')
    {
        return Carbon::createFromFormat($date_format, $date)->format($expected_format);
    }
}
