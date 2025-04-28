<x-app-layout>
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-red-600 mb-4">{{ $code ?? '500' }}</h1>
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">{{ $message ?? 'Something went wrong' }}</h2>
            <p class="text-gray-600 mb-8">
                {{ $description ?? 'An unexpected error occurred. Please try again later.' }}
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('dashboard') }}"
                    class="bg-indigo-500 text-white px-6 py-3 rounded-md hover:bg-indigo-600 transition-colors">
                    Return to Dashboard
                </a>
                @if(auth()->user()->isAdmin())
                    <a href="javascript:history.back()"
                        class="bg-gray-500 text-white px-6 py-3 rounded-md hover:bg-gray-600 transition-colors">
                        Go Back
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
