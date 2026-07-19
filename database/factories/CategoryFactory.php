<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Erro Impressora', 'Erro no Sistema', 'Acesso Bloqueado', 'Rede/Internet']),
            'description' => fake()->sentence(),
        ];
    }
}
