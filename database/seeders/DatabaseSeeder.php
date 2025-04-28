<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed categories first
        $this->call(CategorySeeder::class);

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@library.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular users with Moroccan names
        $users = [
            ['name' => 'Karim Alami', 'email' => 'karim@example.com'],
            ['name' => 'Fatima Zahra', 'email' => 'fatima@example.com'],
            ['name' => 'Youssef Mansouri', 'email' => 'youssef@example.com'],
            ['name' => 'Laila Bennis', 'email' => 'laila@example.com'],
            ['name' => 'Hassan El Fassi', 'email' => 'hassan@example.com'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }

        // Create books with French titles and Moroccan authors
        $books = [
            ['title' => 'Le Secret des Etoiles du Sahara', 'author' => 'Mohammed El Maghrebi', 'category_id' => 1],
            ['title' => 'Les Contes de Fes', 'author' => 'Amina Alaoui', 'category_id' => 3],
            ['title' => 'L\'Heritage de l\'Atlas', 'author' => 'Driss El Khouri', 'category_id' => 1],
            ['title' => 'La Médina Eternelle', 'author' => 'Leila Slimani', 'category_id' => 3],
            ['title' => 'Les Mystères du Rif', 'author' => 'Ahmed Bouanani', 'category_id' => 1],
            ['title' => 'Le Jardin des Roses', 'author' => 'Fatima Mernissi', 'category_id' => 6],
            ['title' => 'Les Voix de Marrakech', 'author' => 'Tahar Ben Jelloun', 'category_id' => 3],
            ['title' => 'Le Café de la Paix', 'author' => 'Fouad Laroui', 'category_id' => 7],
            ['title' => 'L\'Art de la Mosaïque', 'author' => 'Hassan El Glaoui', 'category_id' => 4],
            ['title' => 'Les Routes de l\'Orient', 'author' => 'Mohammed Choukri', 'category_id' => 1],
        ];

        foreach ($books as $book) {
            Book::create([
                'title' => $book['title'],
                'author' => $book['author'],
                'category_id' => $book['category_id'],
                'publication_year' => rand(1990, 2023),
                'is_available' => true,
            ]);
        }
    }
}
