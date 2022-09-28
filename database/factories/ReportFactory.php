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
            'types_id' => fake()->numberBetween(1,10),
            'title' => fake()->name(),
            'description' => fake()->name(),
            'proof_fhoto' => fake()->name(),
            'reply_comment' => fake()->name(),
            'reporting_date' => \Carbon\Carbon::createFromDate(2000, 01, 01)->toDateTimeString(),
            'status' => fake()->numberBetween(0,2),
        ];
    }
}
