<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title'=>fake()->jobTitle(),
            'description'=>fake()->sentence(1000),
              'min_experience'=>fake()->numberBetween(0,5),
              'max_experience'=>fake()->numberBetween(3,6),
              'min_salary'=>fake()->numberBetween(10000,20000),
              'max_salary'=>fake()->numberBetween(30000,60000),
              'apply_url'=>fake()->url(),
              'expiration_date'=>Carbon::now()->addDay()->format('Y-m-d')
        ];
    }
}
