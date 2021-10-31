<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ReportSeeder::class,
            WardSeeder::class,
            JailSeeder::class,
            ImageSeeder::class
        ]);
    }
}
