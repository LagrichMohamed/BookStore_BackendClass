@props(['book'])

<div x-data="{ open: false }">
    <!-- Trigger -->
    <button @click="open = true" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
        Borrow Book
    </button>

    <!-- Modal Backdrop -->
    <div x-show="open"
         x-cloak
         class="fixed inset-0 bg-black bg-opacity-50 z-40"
         @click="open = false">
    </div>

    <!-- Modal Content -->
    <div x-show="open"
         x-cloak
         @click.away="open = false"
         @keydown.escape.window="open = false"
         class="fixed inset-x-0 top-4 md:inset-0 md:flex md:items-center md:justify-center z-50">

        <div class="bg-white rounded-lg overflow-hidden transform transition-all w-full md:max-w-md">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Borrow "{{ $book->title }}"</h3>

                <form method="POST" action="{{ route('borrowings.store', $book) }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Borrow Date</label>
                            <input type="date" name="borrowed_at"
                                value="{{ date('Y-m-d') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Return Date</label>
                            <input type="date" name="due_date"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="flex justify-end space-x-3 mt-6">
                            <button type="button" @click="open = false"
                                class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">
                                Cancel
                            </button>
                            <button type="submit"
                                class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                                Confirm Borrowing
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
