<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-2xl font-semibold mb-6">{{ auth()->user()->isAdmin() ? 'All Borrowings' : 'My Borrowings' }}</h2>

            @if($borrowings->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Book Title
                                </th>
                                @if(auth()->user()->isAdmin())
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Borrower
                                    </th>
                                @endif
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Borrowed Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Due Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($borrowings as $borrowing)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('books.show', $borrowing->book) }}" class="text-indigo-600 hover:text-indigo-900">
                                            {{ $borrowing->book->title }}
                                        </a>
                                    </td>
                                    @if(auth()->user()->isAdmin())
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $borrowing->user->name }}
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $borrowing->borrowed_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $borrowing->due_date->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($borrowing->returned_at)
                                            <span class="inline-block bg-green-200 text-green-700 rounded-full px-3 py-1 text-sm font-semibold">
                                                Returned on {{ $borrowing->returned_at->format('M d, Y') }}
                                            </span>
                                        @elseif($borrowing->isOverdue())
                                            <span class="inline-block bg-red-200 text-red-700 rounded-full px-3 py-1 text-sm font-semibold">
                                                Overdue by {{ now()->diffInDays($borrowing->due_date) }} days
                                            </span>
                                        @else
                                            <span class="inline-block bg-yellow-200 text-yellow-700 rounded-full px-3 py-1 text-sm font-semibold">
                                                Due in {{ round(now()->diffInDays($borrowing->due_date)) }} days
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if(!$borrowing->returned_at)
                                            <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                                    Return Book
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-6">
                    {{ $borrowings->links() }}
                </div>
            @else
                <p class="text-gray-500">No borrowings found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
