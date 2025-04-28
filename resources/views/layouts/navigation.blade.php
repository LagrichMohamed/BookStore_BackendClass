<nav class="fixed left-0 top-0 h-screen w-64 bg-gray-800 text-white">
    <div class="p-4">
        <a href="/" class="text-xl font-bold">Library System</a>
    </div>

    <div class="mt-8">
        @guest
            <div class="px-4 py-2 hover:bg-gray-700">
                <a href="{{ route('books.index') }}" class="block">Books</a>
            </div>
            <div class="px-4 py-2 hover:bg-gray-700">
                <a href="{{ route('login') }}" class="block">Login</a>
            </div>
        @else
            <div class="px-4 py-2 hover:bg-gray-700">
                <a href="{{ route('dashboard') }}" class="block">Dashboard</a>
            </div>
            <div class="px-4 py-2 hover:bg-gray-700">
                <a href="{{ route('books.index') }}" class="block">Books</a>
            </div>

            @if(auth()->user()->isAdmin())
                <div class="px-4 py-2 hover:bg-gray-700">
                    <a href="{{ route('admin.users.index') }}" class="block">Manage Users</a>
                </div>
                <div class="px-4 py-2 hover:bg-gray-700">
                    <a href="{{ route('categories.index') }}" class="block">Categories</a>
                </div>
                <div class="px-4 py-2 hover:bg-gray-700">
                    <a href="{{ route('borrowings.overdue') }}" class="block">Overdue Books</a>
                </div>
                <div class="px-4 py-2 hover:bg-gray-700">
                    <a href="{{ route('reports.index') }}" class="block">Reports</a>
                </div>
            @endif

            <div class="px-4 py-2 hover:bg-gray-700">
                <a href="{{ route('profile.edit') }}" class="block">Profile</a>
            </div>
            <div class="px-4 py-2 hover:bg-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left">Sign Out</button>
                </form>
            </div>
        @endguest
    </div>
</nav>
