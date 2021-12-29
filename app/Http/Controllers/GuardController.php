<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\RegisteredUserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class GuardController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manage-guards');
        $this->middleware('active.user')->only('edit', 'update');
        $this->middleware('verify.user.role:guard')->except('index', 'create', 'store');
    }


    public function index()
    {
        $guard_role = Role::where('name', 'guard')->first();

        $guards = $guard_role->users();

        if (request('search')) {
            $guards = $guards->where('username', 'like', '%' . request('search') . '%');
        }

        $guards = $guards->orderBy('first_name', 'asc')
            ->orderBy('last_name', 'asc')
            ->paginate();


        return view('guard.index', compact('guards'));
    }




    public function create()
    {
        return view('guard.create');
    }



    public function store(Request $request)
    {

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
            'address' => ['required', 'string', 'min:5', 'max:50']
        ]);

        $password_generated = $this->generatePassword();

        $guard_role = Role::where('name', 'guard')->first();

        $guard = $guard_role->users()->create([
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

        $guard->image()->create([
            'path' => $guard->generateAvatarUrl(),
        ]);

        $guard->notify(
            new RegisteredUserNotification(
                $guard->getFullName(),
                $guard_role->name,
                $password_generated
            )
        );

        return back()->with('status', 'Guard created successfully');
    }


    public function show(User $user)
    {
        return view('guard.show', ['guard' => $user]);
    }


    public function edit(User $user)
    {
        return view('guard.update', ['guard' => $user]);
    }


    public function update(Request $request, User $user)
    {
        $userRequest = $request->user;

        $request->validate([
            'first_name' => ['required', 'string', 'min:3', 'max:35'],
            'last_name' => ['required', 'string', 'min:3', 'max:35'],
            'username' => [
                'required', 'string', 'min:5', 'max:20',
                Rule::unique('users')->ignore($userRequest),
            ],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($userRequest),
            ],
            'birthdate' => [
                'nullable', 'string', 'date_format:d/m/Y',
                'after_or_equal:' . date('Y-m-d', strtotime('-70 years')),
                'before_or_equal:' . date('Y-m-d', strtotime('-18 years')),
            ],
            'personal_phone' => ['required', 'numeric', 'digits:10'],
            'home_phone' => ['required', 'numeric', 'digits:9'],
            'address' => ['required', 'string', 'min:5', 'max:50'],
        ]);

        $old_email = $user->email;

        $guard = $user;

        $guard->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'birthdate' => $this->changeDateFormat($request['birthdate']),
            'personal_phone' => $request['personal_phone'],
            'home_phone' => $request['home_phone'],
            'address' => $request['address'],
        ]);



        $guard->updateUIAvatar($guard->generateAvatarUrl());

        $this->verifyEmailChange($guard, $old_email);

        return back()->with('status', 'Guard updated successfully');
    }


    public function destroy(User $user)
    {
        $guard = $user;
        $state = $guard->state;
        $message = $state ? 'inactivated' : 'activated';
        $guard->state = !$state;
        $guard->save();

        return back()->with('status', "Guard $message successfully");
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

    public function changeDateFormat(string $date, string $date_format = 'd/m/Y', string $expected_format = 'Y-m-d')
    {
        return Carbon::createFromFormat($date_format, $date)->format($expected_format);
    }


    private function verifyEmailChange(User $guard, string $old_email): void
    {
        if ($guard->email !== $old_email) {
            $password_generated = $this->generatePassword();
            $guard->password = Hash::make($password_generated);
            $guard->save();

            $guard->notify(
                new RegisteredUserNotification(
                    $guard->getFullName(),
                    $guard->role->name,
                    $password_generated
                )
            );
        }
    }
}
