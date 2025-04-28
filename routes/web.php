<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Book routes
    Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
    Route::resource('books', BookController::class);

    // Borrowing routes
    Route::post('/books/{book}/borrow', [BorrowingController::class, 'store'])->name('borrowings.store');
    Route::put('/borrowings/{borrowing}/return', [BorrowingController::class, 'update'])->name('borrowings.return');
    Route::get('/borrowings', [BorrowingController::class, 'index'])->name('borrowings.index');

    // Admin only routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('admin/users', \App\Http\Controllers\Admin\UserController::class)->names('admin.users');
        Route::get('/borrowings/overdue', [BorrowingController::class, 'overdue'])->name('borrowings.overdue');
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/overdue', [ReportController::class, 'overdueSummary'])->name('reports.overdue');
    });
});

require __DIR__.'/auth.php';
