<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-2xl font-semibold mb-6">{{ auth()->user()->isAdmin() ? 'All Borrowings' : 'My Borrowings' }}</h2>

            @if($borrowings->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Book Title</th>
                                @if(auth()->user()->isAdmin())
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Borrower</th>
                                @endif
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Borrowed Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($borrowings as $borrowing)
                                <tr>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('books.show', $borrowing->book) }}" class="text-primary-600 hover:text-primary-900">
                                            {{ $borrowing->book->title }}
                                        </a>
                                    </td>
                                    @if(auth()->user()->isAdmin())
                                        <td class="px-6 py-4">{{ $borrowing->user->name }}</td>
                                    @endif
                                    <td class="px-6 py-4">{{ $borrowing->borrowed_at->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">{{ $borrowing->due_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4">
                                        @if($borrowing->returned_at)
                                            <span class="inline-flex px-2 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Returned on {{ $borrowing->returned_at->format('M d, Y') }}
                                            </span>
                                        @elseif($borrowing->isOverdue())
                                            <span class="inline-flex px-2 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Overdue by {{ ceil(now()->diffInDays($borrowing->due_date)) }} days
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Due in {{ ceil($borrowing->getDaysUntilDue()) }} days
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if(!$borrowing->returned_at)
                                            <form action="{{ route('borrowings.return', $borrowing) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="text-green-600 hover:text-green-900">
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
