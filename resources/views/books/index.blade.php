<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <!-- Search and Filter Section -->
            <form method="GET" action="{{ route('books.search') }}" class="mb-6 flex gap-4">
                <div>
                    <x-input-label for="query" :value="__('Search')" />
                    <x-text-input id="query" name="query" type="text" class="mt-1 block"
                        value="{{ request('query') }}" placeholder="Search by title or author..." />
                </div>

                <div>
                    <x-input-label for="category" :value="__('Category')" />
                    <select name="category" id="category" class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">All Categories</option>
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->name }}" {{ request('category') == $category->name ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <x-input-label for="available" :value="__('Availability')" />
                    <select name="available" id="available" class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">All Books</option>
                        <option value="true" {{ request('available') === 'true' ? 'selected' : '' }}>Available Only</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <x-primary-button>{{ __('Search') }}</x-primary-button>
                    @if(request()->hasAny(['query', 'category', 'available']))
                        <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 tracking-widest hover:bg-gray-300">
                            {{ __('Clear') }}
                        </a>
                    @endif
                </div>
            </form>

            @if(auth()->user()->isAdmin())
                <div class="mb-6">
                    <a href="{{ route('books.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                        Add New Book
                    </a>
                </div>
            @endif

            <!-- Books Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($books as $book)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $book->title }}</h3>
                            <p class="text-gray-600 mb-4">By {{ $book->author }}</p>
                            <div class="mb-4">
                                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                                    {{ $book->category->name }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('books.show', $book) }}" class="text-indigo-600 hover:text-indigo-900">
                                    View Details
                                </a>
                                @if($book->isAvailable())
                                <x-borrow-modal :book="$book" />
                                @else
                                <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">
                                    Not Available
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        No books found.
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
