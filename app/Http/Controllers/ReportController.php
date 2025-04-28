<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        // Most borrowed books
        $popularBooks = Book::select('books.*', DB::raw('COUNT(borrowings.id) as borrow_count'))
            ->leftJoin('borrowings', 'books.id', '=', 'borrowings.book_id')
            ->groupBy('books.id')
            ->orderByDesc('borrow_count')
            ->limit(5)
            ->get();

        // Most active users
        $activeUsers = User::select('users.*', DB::raw('COUNT(borrowings.id) as borrow_count'))
            ->leftJoin('borrowings', 'users.id', '=', 'borrowings.user_id')
            ->where('users.role', '=', 'user')
            ->groupBy('users.id')
            ->orderByDesc('borrow_count')
            ->limit(5)
            ->get();

        // Monthly statistics
        $monthlyStats = Borrowing::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total_borrowings'),
                DB::raw('COUNT(CASE WHEN returned_at IS NULL AND due_date < NOW() THEN 1 END) as overdue_count')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        // Category distribution
        $categoryStats = Book::select('categories.name as category_name', DB::raw('COUNT(*) as total'))
            ->join('categories', 'books.category_id', '=', 'categories.id')
            ->groupBy('categories.id', 'categories.name')
            ->get();

        return view('reports.index', compact(
            'popularBooks',
            'activeUsers',
            'monthlyStats',
            'categoryStats'
        ));
    }

    public function overdueSummary()
    {
        $overdueBooks = Borrowing::with(['book', 'user'])
            ->whereNull('returned_at')
            ->where('due_date', '<', now())
            ->orderBy('due_date')
            ->get();

        return view('reports.overdue', compact('overdueBooks'));
    }
}
