<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BorrowingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $books = Book::all();
        $now = Carbon::now();

        // Create 50 borrowings with different statuses
        for ($i = 0; $i < 50; $i++) {
            $user = $users->random();
            $book = $books->random();
            $borrowedAt = $now->copy()->subDays(rand(1, 60));
            $isReturned = (bool) rand(0, 1);

            // For returned books
            if ($isReturned) {
                $returnedAt = $borrowedAt->copy()->addDays(rand(1, 14));
                $dueDate = $borrowedAt->copy()->addDays(14);
            }
            // For non-returned books
            else {
                $returnedAt = null;
                // 40% chance of being overdue
                $dueDate = rand(1, 100) > 60
                    ? $borrowedAt->copy()->addDays(14)->subDays(rand(15, 30)) // Overdue
                    : $borrowedAt->copy()->addDays(14); // Not overdue
            }

            Borrowing::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'borrowed_at' => $borrowedAt,
                'due_date' => $dueDate,
                'returned_at' => $returnedAt,
            ]);

            // Update book availability
            $book->update(['is_available' => $isReturned]);
        }
    }
}
