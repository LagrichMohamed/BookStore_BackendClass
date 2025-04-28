<nav x-data="{ open: false }" class="fixed left-0 top-0 h-full w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
    <div class="h-full flex flex-col">
        <!-- Logo -->
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="{{ asset('Logo_Lib.svg') }}" alt="Digital Library Logo" class="w-8 h-8 mr-2">
                <span class="text-xl font-semibold">Digital <span class="text-primary-600">Library</span></span>
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 space-y-1 px-2 py-4">
            @guest
                <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.index')"
                    class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    Books
                </x-nav-link>
                <x-nav-link :href="route('login')" :active="request()->routeIs('login')"
                    class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    Login
                </x-nav-link>
            @else
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    Dashboard
                </x-nav-link>

                <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.index')"
                    class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    Books
                </x-nav-link>

                <x-nav-link :href="route('borrowings.index')" :active="request()->routeIs('borrowings.index')"
                    class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    {{ auth()->user()->isAdmin() ? 'All Borrowings' : 'My Borrowings' }}
                </x-nav-link>

                @if(auth()->user()->isAdmin())
                    <hr class="my-3 border-gray-200 dark:border-gray-700">

                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')"
                        class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        Manage Users
                    </x-nav-link>

                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')"
                        class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        Categories
                    </x-nav-link>

                    <x-nav-link :href="route('borrowings.overdue')" :active="request()->routeIs('borrowings.overdue')"
                        class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        Overdue Books
                    </x-nav-link>

                    <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')"
                        class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                        Reports
                    </x-nav-link>
                @endif
            @endguest
        </div>

        <!-- User Menu -->
        @auth
        <div class="border-t border-gray-200 dark:border-gray-700 p-4">
            <div class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</div>

            <div class="mt-3 space-y-1">
                <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')"
                    class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    Profile
                </x-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-nav-link href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg text-red-600 dark:text-red-400">
                        Sign Out
                    </x-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>

<!-- Main Content Wrapper -->
<div class="ml-64">
    {{ $slot }}
</div>
