<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ward;
use Illuminate\Database\Seeder;

class WardSeeder extends Seeder
{

    public function run()
    {


        Ward::factory()->count(20)->create();


        
        $users_guards = User::where('role_id', 3)->get();
        // dd($users_guards);
        // dd(count($users_guards));
        $wards=Ward::all();
        // Los guardias pueden estar en varios pabellones
        $wards->each(function($ward) use ($users_guards)
        {
            $ward->users()->attach($users_guards->shift(2));
        });
    }
}
