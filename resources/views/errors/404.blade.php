<x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-indigo-600 mb-4">404</h1>
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">Page Not Found</h2>
            <p class="text-gray-600 mb-8">
                Sorry, we couldn't find the page you're looking for.
                <br>Please check the URL or return to the homepage.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('dashboard') }}"
                    class="bg-indigo-500 text-white px-6 py-3 rounded-md hover:bg-indigo-600 transition-colors">
                    Go to Dashboard
                </a>
                <a href="{{ route('books.index') }}"
                    class="bg-gray-500 text-white px-6 py-3 rounded-md hover:bg-gray-600 transition-colors">
                    Browse Books
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
