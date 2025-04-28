<x-app-layout>
    <div class="space-y-6">
        <!-- Welcome Section -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold mb-4">Welcome, {{ auth()->user()->name }}!</h2>
                <p class="text-gray-600">
                    {{ auth()->user()->isAdmin()
                        ? 'Manage books, users, and monitor library activities.'
                        : 'Browse and borrow books from our collection.' }}
                </p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @if(auth()->user()->isAdmin())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Total Books</div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900">{{ \App\Models\Book::count() }}</div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Active Borrowings</div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ \App\Models\Borrowing::whereNull('returned_at')->count() }}
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Overdue Books</div>
                        <div class="mt-1 text-3xl font-semibold text-indigo-600">
                            {{ \App\Models\Borrowing::whereNull('returned_at')->where('due_date', '<', now())->count() }}
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Total Users</div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900">{{ \App\Models\User::count() }}</div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">My Active Borrowings</div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ auth()->user()->borrowings()->whereNull('returned_at')->count() }}
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="text-sm font-medium text-gray-500">Overdue Books</div>
                        <div class="mt-1 text-3xl font-semibold {{ auth()->user()->borrowings()->whereNull('returned_at')->where('due_date', '<', now())->count() > 0 ? 'text-red-600' : 'text-gray-900' }}">
                            {{ auth()->user()->borrowings()->whereNull('returned_at')->where('due_date', '<', now())->count() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('books.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Browse Books
                    </a>
                    <a href="{{ route('borrowings.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        My Borrowings
                    </a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('borrowings.overdue') }}"
                            class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            View Overdue Books
                        </a>
                        <a href="{{ route('books.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Add New Book
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        @if(auth()->user()->isAdmin())
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
                    @php
                        $recentBorrowings = \App\Models\Borrowing::with(['user', 'book'])
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp
                    @if($recentBorrowings->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentBorrowings as $borrowing)
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $borrowing->user->name }}
                                            {{ $borrowing->returned_at ? 'returned' : 'borrowed' }}
                                            <a href="{{ route('books.show', $borrowing->book) }}" class="text-indigo-600 hover:text-indigo-900">
                                                {{ $borrowing->book->title }}
                                            </a>
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $borrowing->returned_at ? $borrowing->returned_at->diffForHumans() : $borrowing->borrowed_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <span class="inline-block {{ $borrowing->returned_at ? 'bg-green-200 text-green-700' : 'bg-yellow-200 text-yellow-700' }} rounded-full px-3 py-1 text-sm font-semibold">
                                        {{ $borrowing->returned_at ? 'Returned' : 'Borrowed' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No recent activity.</p>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
