<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\RegisteredUserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class DirectorController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:manage-directors');

        $this->middleware('active.user')->only('edit', 'update');

        $this->middleware('verify.user.role:director')->except('index', 'create', 'store', 'search');
    }


    public function index()
    {

        $director_role = Role::where('name', 'director')->first();


        $directors = $director_role->users();

        if (request('search'))
        {
           $directors = $directors->where('username', 'like', '%' . request('search') . '%');
        }


        $directors = $directors->orderBy('first_name', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate();



        return view('director.index', compact('directors'));
    }


    public function create()
    {
        return view('director.create');
    }


    public function store(Request $request)
    {

        $request->validate([
        'first_name' => ['required', 'string', 'min:3', 'max:35'],
        'last_name' => ['required', 'string', 'min:3', 'max:35'],
        'username' => ['required', 'string', 'min:5', 'max:20', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'birthdate' => ['required', 'string', 'date_format:d/m/Y',
            'after_or_equal:' . date('Y-m-d', strtotime('-70 years')),
            'before_or_equal:' . date('Y-m-d', strtotime('-18 years')),
        ],
        'personal_phone' => ['required', 'numeric', 'digits:10'],
        'home_phone' => ['required', 'numeric', 'digits:9'],
        'address' => ['required', 'string', 'min:5', 'max:50']
    ]);


        $password_generated = $this->generatePassword();

        $director_role = Role::where('name', 'director')->first();

        $director = $director_role->users()->create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'birthdate' => $this->changeDateFormat($request['birthdate']),
            'personal_phone' => $request['personal_phone'],
            'home_phone' => $request['home_phone'],
            'address' => $request['address'],
            'password' => Hash::make($password_generated),
        ]);

        $director->image()->create([
            'path' => $director->generateAvatarUrl(),
        ]);


        $director->notify(
            new RegisteredUserNotification(
                $director->getFullName(),
                $director_role->name,
                $password_generated
            )
        );

        return back()->with('status', 'Director created successfully');
    }


    public function show(User $user)
    {
        return view('director.show', ['director' => $user]);
    }



    public function edit(User $user)
    {
        return view('director.update', ['director' => $user]);
    }


    public function update(Request $request, User $user)
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


    public function destroy(User $user)
    {
        $director = $user;
        $state = $director->state;
        $message = $state ? 'inactivated' : 'activated';

        $director->state = !$state;
        $director->save();

        return back()->with('status', "Director $message successfully");
    }





    public function generatePassword(): string
    {
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
        $length = 8;
        $count = mb_strlen($characters);
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($characters, $index, 1);
        }
        return $result;
    }

    public function changeDateFormat(string $date, string $date_format='d/m/Y', string $expected_format = 'Y-m-d')
    {
        return Carbon::createFromFormat($date_format, $date)->format($expected_format);
    }

    private function verifyEmailChange(User $director, string $old_email)
    {
        if ($director->email !== $old_email) {
            $password_generated = $this->generatePassword();
            $director->password = Hash::make($password_generated);
            $director->save();

            $director->notify(
                new RegisteredUserNotification(
                    $director->getFullName(),
                    $director->role->name,
                    $password_generated
                )
            );
        }
    }

}
