<?php

namespace Database\Factories;

use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\Factory;

class WardFactory extends Factory
{

    protected $model = Ward::class;


    public function definition()
    {
        return [

            'name' => $this->faker->streetName,

            'location' => $this->faker->streetName,

            'description' => $this->faker->text($maxNbChars = 45),
        ];
    }
}
