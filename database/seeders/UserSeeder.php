<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run()
    {
        $rol_admin = Role::where('name', 'admin')->first();
        //dd($user_admin);
        // 5 usuarios que le pertenecen al rol admin
        User::factory()->for($rol_admin)->count(5)->create();


        $rol_director = Role::where('name', 'director')->first();
        // 5 usuarios que le pertenecen al rol director
        User::factory()->for($rol_director)->count(5)->create();


        $rol_guard = Role::where('name', 'guard')->first();
        // 5 usuarios que le pertenecen al rol guard
        User::factory()->for($rol_guard)->count(40)->create();


        $rol_prisoner = Role::where('name', 'prisoner')->first();
        // 5 usuarios que le pertenecen al rol prisoner
        User::factory()->for($rol_prisoner)->count(60)->create();


        // $users_prisioners = User::where('role_id',4)->get();
        // dd(count($users_prisioners));


    }
}
