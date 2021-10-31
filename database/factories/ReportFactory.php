<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{

    protected $model = Report::class;


    public function definition()
    {
        return [
            
            'title' => $this->faker->title,

            'description' => $this->faker->text(255),
        ];
    }
}
