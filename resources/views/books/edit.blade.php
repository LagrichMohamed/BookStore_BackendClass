<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h2 class="text-2xl font-semibold mb-6">Edit Book: {{ $book->title }}</h2>

            <form method="POST" action="{{ route('books.update', $book) }}" class="max-w-2xl">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $book->title) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="author" class="block text-sm font-medium text-gray-700">Author</label>
                    <input type="text" name="author" id="author" value="{{ old('author', $book->author) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('author')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="publication_year" class="block text-sm font-medium text-gray-700">Publication Year</label>
                    <input type="number" name="publication_year" id="publication_year"
                        value="{{ old('publication_year', $book->publication_year) }}"
                        min="1800" max="{{ date('Y') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('publication_year')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category" id="category"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @foreach(['Fiction', 'Non-Fiction', 'Science', 'History', 'Technology', 'Literature'] as $category)
                            <option value="{{ $category }}" {{ old('category', $book->category) == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>

                <!-- Remove the availability checkbox, it's handled automatically -->

                <div class="mt-6 flex items-center gap-4">
                    <x-primary-button>{{ __('Update Book') }}</x-primary-button>
                </div>
            </form>

            @if(!$book->isAvailable() && $book->currentBorrowing())
                <div class="mt-4">
                    <form action="{{ route('borrowings.return', $book->currentBorrowing()) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                            Return Book
                        </button>
                    </form>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('books.index') }}" class="text-gray-600 hover:text-gray-900">{{ __('Cancel') }}</a>
            </div>
        </div>
    </div>
</x-app-layout>
