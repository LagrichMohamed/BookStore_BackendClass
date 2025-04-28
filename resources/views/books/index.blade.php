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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($books as $book)
                    <div class="bg-white rounded-lg shadow p-6 hover:shadow-md transition-shadow">
                        <div class="flex flex-col h-full">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900 mb-2">
                                    <a href="{{ route('books.show', $book) }}" class="hover:text-primary-600">
                                        {{ $book->title }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $book->author }}</p>
                                <p class="text-sm text-gray-500 mb-4">{{ $book->category->name }}</p>

                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full mb-4
                                    {{ $book->isAvailable() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $book->isAvailable() ? 'Available' : 'Borrowed' }}
                                </span>
                            </div>

                            <div class="mt-4 flex justify-between items-center">
                                @if($book->isAvailable())
                                    <x-borrow-modal :book="$book" />
                                @endif

                                @if(auth()->user()->isAdmin())
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('books.edit', $book) }}"
                                           class="text-primary-600 hover:text-primary-900">Edit</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
