<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-semibold">{{ $category->name }}</h2>
                        <a href="{{ route('categories.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">Back to Categories</a>
                    </div>

                    <!-- Books List -->
                    <div class="mt-6">
                        <h3 class="text-lg font-medium mb-4">Books in this category</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($books as $book)
                                <div class="border rounded-lg p-4 shadow-sm">
                                    <h4 class="font-semibold">{{ $book->title }}</h4>
                                    <p class="text-gray-600">By {{ $book->author }}</p>
                                    <p class="text-gray-500">{{ $book->publication_year }}</p>
                                    <div class="mt-4">
                                        <a href="{{ route('books.show', $book) }}" class="text-indigo-600 hover:text-indigo-800">View Details</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6">
                            {{ $books->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
