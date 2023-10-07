<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Enums\Title;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type_id' => 1,
            'title' => fake()->randomElement(Title::cases()),
            'description' => fake()->sentence(3),
            'starting_at' => fake()->dateTimeInInterval('-10 days', '-5 days'),
            'conclusion_at' => fake()->dateTimeInInterval('-10 days', '+10 days'), // Date where the user actually concluded the activity. It can be set bofore or after the due date.
            'due_at' => fake()->dateTimeInInterval('-2 days', '-1 days'),
            'status' => fake()->randomElement(Status::cases()),
        ];
    }
}
