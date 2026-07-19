<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'priority' => fake()->randomElement(['Baixa', 'Média', 'Alta']),
            'status' => 'Aberto',
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
            'technician_id' => null,
        ];
    }
}
