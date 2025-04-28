<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="max-w-3xl">
                <!-- Book Details -->
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold mb-4">{{ $book->title }}</h2>
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

                    @if($book->isAvailable())
                        <x-borrow-modal :book="$book" />
                    @endif
                </div>

                <!-- Borrowing History -->
                @if(auth()->user()->isAdmin())
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Borrowing History</h3>
                        @if($book->borrowings->count() > 0)
                            <div class="bg-white rounded-lg shadow overflow-hidden">
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
                            <p class="text-gray-500">No borrowing history found.</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
