<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{

    public function run()
    {
        $users_guards = User::where('role_id',3)->get();
        // dd($users_guards);
        // dd(count($users_guards));


        // Por cada guardia se asigna 2 reportes
        $users_guards->each(function($user)
        {
            Report::factory()->count(2)->for($user)->create();
        });


    }
}
