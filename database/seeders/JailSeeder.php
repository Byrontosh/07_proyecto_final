<?php

namespace Database\Seeders;

use App\Models\Jail;
use App\Models\User;
use App\Models\Ward;
use Illuminate\Database\Seeder;

class JailSeeder extends Seeder
{

    public function run()
    {

        // UNO A MUCHOS
        $wards = Ward::all();
        $wards->each(function($ward)
        {
            Jail::factory()->count(3)->for($ward)->create();
        });


        // MUCHOS A MUCHOS
        $jails=Jail::all();
        $users_prisoers = User::where('role_id',4)->get();
        $jails->each(function($jail) use ($users_prisoers)
        {
            $jail->users()->attach($users_prisoers->shift(5));
        });

    }
}
