<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-start mb-6">
                        <h1 class="text-2xl font-semibold text-gray-900">{{ $book->title }}</h1>
                        @if($book->isAvailable())
                            <x-borrow-modal :book="$book" />
                        @endif
                    </div>

                    <!-- Book Details -->
                    <div class="mt-4 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-600">Author</p>
                                <p class="font-medium">{{ $book->author }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Publication Year</p>
                                <p class="font-medium">{{ $book->publication_year }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Category</p>
                                <p class="font-medium">{{ $book->category->name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Status</p>
                                <p class="font-medium">
                                    <span class="inline-block {{ $book->isAvailable() ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700' }} rounded-full px-3 py-1 text-sm font-semibold">
                                        {{ $book->isAvailable() ? 'Available' : 'Borrowed' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-4 mb-8">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('books.edit', $book) }}"
                                class="bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600">
                                Edit Book
                            </a>
                            @if($book->isAvailable())
                                <form action="{{ route('books.destroy', $book) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this book?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
                                        Delete Book
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>

                    <!-- Borrowing History Section -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold mb-4">Borrowing History</h3>
                        @if($book->borrowings->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                User
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Borrowed At
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Due Date
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Returned At
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($book->borrowings as $borrowing)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $borrowing->user->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $borrowing->borrowed_at->format('M d, Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $borrowing->due_date->format('M d, Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $borrowing->returned_at ? $borrowing->returned_at->format('M d, Y') : '-' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($borrowing->returned_at)
                                                        <span class="inline-block bg-green-200 text-green-700 rounded-full px-3 py-1 text-sm font-semibold">
                                                            Returned
                                                        </span>
                                                    @elseif($borrowing->isOverdue())
                                                        <span class="inline-block bg-red-200 text-red-700 rounded-full px-3 py-1 text-sm font-semibold">
                                                            Overdue
                                                        </span>
                                                    @else
                                                        <span class="inline-block bg-yellow-200 text-yellow-700 rounded-full px-3 py-1 text-sm font-semibold">
                                                            Borrowed
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500">No borrowing history</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
