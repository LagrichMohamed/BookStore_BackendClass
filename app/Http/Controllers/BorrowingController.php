<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;
use App\Http\Requests\StoreBorrowingRequest;
use App\Http\Requests\ReturnBorrowingRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of borrowings
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $borrowings = $user->isAdmin()
            ? Borrowing::with(['user', 'book'])->latest()->paginate(10)
            : $user->borrowings()->with('book')->latest()->paginate(10);

        return view('borrowings.index', compact('borrowings'));
    }

    public function store(StoreBorrowingRequest $request, Book $book)
    {
        $borrowing = new Borrowing([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => $request->borrowed_at . ' ' . now()->format('H:i:s'),
            'due_date' => $request->due_date . ' 23:59:59',
        ]);

        $borrowing->save();
        $book->update(['is_available' => false]);

        return redirect()->route('borrowings.index')
            ->with('success', 'Book borrowed successfully.');
    }

    public function update(ReturnBorrowingRequest $request, Borrowing $borrowing)
    {
        $borrowing->update([
            'returned_at' => now()
        ]);

        $borrowing->book->update(['is_available' => true]);

        return redirect()->route('borrowings.index')
            ->with('success', 'Book returned successfully.');
    }

    /**
     * Display overdue borrowings
     *
     * @return \Illuminate\View\View
     */
    public function overdue()
    {
        /** @var User $user */
        $user = Auth::user();
        abort_if(!$user->isAdmin(), 403);

        $overdueBorrowings = Borrowing::whereNull('returned_at')
            ->where('due_date', '<', now())
            ->with(['user', 'book'])
            ->get();

        return view('borrowings.overdue', compact('overdueBorrowings'));
    }
}
