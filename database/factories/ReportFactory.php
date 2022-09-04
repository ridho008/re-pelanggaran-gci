<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->numberBetween(1,10),
            'reporting' => fake()->numberBetween(1,10),
            'description' => fake()->name(),
            'proof_fhoto' => fake()->name(),
            'reply_comment' => fake()->name(),
        ];
    }
}
