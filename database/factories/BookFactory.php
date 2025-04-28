<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Fiction', 'Non-Fiction', 'Science', 'History', 'Technology', 'Literature'];

        return [
            'title' => fake()->catchPhrase(),
            'author' => fake()->name(),
            'publication_year' => fake()->year(),
            'category' => fake()->randomElement($categories),
            'is_available' => fake()->boolean(80), // 80% chance of being available
        ];
    }
}
