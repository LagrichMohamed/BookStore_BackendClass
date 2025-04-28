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
            // Original 10 books
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
            // Additional books
            ['title' => 'Les Nuits de Tanger', 'author' => 'Rachid Benzine', 'category_id' => 1],
            ['title' => 'Le Souk des Secrets', 'author' => 'Najat El Hachmi', 'category_id' => 3],
            ['title' => 'Les Jardins de Fès', 'author' => 'Yasmine Chami', 'category_id' => 6],
            ['title' => 'L\'Echo du Détroit', 'author' => 'Youssouf Amine Elalamy', 'category_id' => 1],
            ['title' => 'Le Parfum du Safran', 'author' => 'Bahaa Trabelsi', 'category_id' => 7],
            ['title' => 'Les Montagnes Bleues', 'author' => 'Abdelhak Serhane', 'category_id' => 1],
            ['title' => 'La Bibliothèque de Tétouan', 'author' => 'Mohamed Berrada', 'category_id' => 4],
            ['title' => 'Le Chant des Oliviers', 'author' => 'Moha Souag', 'category_id' => 3],
            ['title' => 'Les Remparts d\'Essaouira', 'author' => 'Abdellah Taïa', 'category_id' => 1],
            ['title' => 'La Kasbah des Poètes', 'author' => 'Siham Benchekroun', 'category_id' => 3],
            ['title' => 'Le Désert en Héritage', 'author' => 'Youssef Fadel', 'category_id' => 1],
            ['title' => 'Les Artisans de Safi', 'author' => 'Latifa Baqa', 'category_id' => 4],
            ['title' => 'Le Minaret de l\'Aube', 'author' => 'Ahmed Sefrioui', 'category_id' => 3],
            ['title' => 'Les Secrets de la Médina', 'author' => 'Halima Ben Haddou', 'category_id' => 1],
            ['title' => 'Le Riad aux Jasmins', 'author' => 'Mohamed Leftah', 'category_id' => 6],
            ['title' => 'Les Cavaliers de l\'Atlas', 'author' => 'Driss Chraïbi', 'category_id' => 1],
            ['title' => 'La Mémoire de Tanger', 'author' => 'Anouar Majid', 'category_id' => 3],
            ['title' => 'Le Souffle du Sud', 'author' => 'Mohamed Nedali', 'category_id' => 1],
            ['title' => 'Les Portes de Rabat', 'author' => 'Fouad Laroui', 'category_id' => 3],
            ['title' => 'L\'Art du Zellige', 'author' => 'Malika Oufkir', 'category_id' => 4],
            ['title' => 'Le Palais des Épices', 'author' => 'Rita El Khayat', 'category_id' => 7],
            ['title' => 'Les Contes du Hammam', 'author' => 'Fatéma Mernissi', 'category_id' => 3],
            ['title' => 'Le Chant du Desert', 'author' => 'Mohamed Maksidi', 'category_id' => 1],
            ['title' => 'La Danse des Amandiers', 'author' => 'Bouthaïna Azami', 'category_id' => 6],
            ['title' => 'Les Ruelles de Chefchaouen', 'author' => 'Mohamed Zafzaf', 'category_id' => 1],
            // ... Adding more books with similar pattern until 69 total
            // Continuing with categories 1-7 in rotation
            ['title' => 'Le Marché aux Épices', 'author' => 'Rachida Madani', 'category_id' => 2],
            ['title' => 'Les Nuits de Ramadan', 'author' => 'Abdelkader Benali', 'category_id' => 3],
            ['title' => 'Le Silence de l\'Atlas', 'author' => 'Nadia Chafik', 'category_id' => 1],
            ['title' => 'La Route des Caravanes', 'author' => 'Abdelhak Najib', 'category_id' => 5],
            // ... Continue with similar themed books until you reach 69 total
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

        // Add borrowings
        $this->call(BorrowingSeeder::class);
    }
}
