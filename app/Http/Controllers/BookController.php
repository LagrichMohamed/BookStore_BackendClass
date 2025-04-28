<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['index', 'show', 'search']);
    }

    public function index()
    {
        $books = Book::query()
            ->when(request('category'), fn($query, $category) =>
                $query->where('category', $category)
            )
            ->when(request('available') === 'true', fn($query) =>
                $query->where('is_available', true)
            )
            ->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();

        $book = Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'publication_year' => $validated['publication_year'],
            'category_id' => $validated['category_id'],
            'is_available' => true,
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        $book->load(['borrowings.user']);
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if (!$book->isAvailable()) {
            return back()->with('error', 'Cannot delete a book that is currently borrowed.');
        }

        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $categoryName = $request->get('category');

        $books = Book::query()
            ->when($query, function($q) use ($query) {
                $q->where(function($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('author', 'like', "%{$query}%");
                });
            })
            ->when($categoryName, function($q) use ($categoryName) {
                $q->whereHas('category', function($q) use ($categoryName) {
                    $q->where('name', $categoryName);
                });
            })
            ->when($request->get('available') === 'true', function($q) {
                $q->where('is_available', true);
            })
            ->with('category') // Eager load category relationship
            ->paginate(10)
            ->withQueryString();

        return view('books.index', compact('books'));
    }
}
