<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{

    public function run()
    {
        $rols = ['admin','director','guard','prisoner'];

        for($i=0 ; $i<4 ; $i++)
        {
            Role::create([
                'name'=>$rols[$i]
            ]);
        }

    }
}
