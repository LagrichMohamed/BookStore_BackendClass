<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Histoire',
            'Sciences',
            'Littérature',
            'Art',
            'Philosophie',
            'Religion',
            'Société',
            'Education'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
