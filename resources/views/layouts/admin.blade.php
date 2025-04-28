<div class="flex">
    <nav class="w-1/4 bg-gray-800 text-white h-screen">
        <ul>
            <li><a href="{{ route('admin.books.index') }}">Livres</a></li>
            <li><a href="{{ route('admin.books.create') }}">Ajouter document</a></li>
            <li><a href="{{ route('admin.books.edit') }}">Modifier document</a></li>
            <li><a href="{{ route('admin.members.index') }}">Adhérents</a></li>
            <li><a href="{{ route('admin.members.create') }}">Ajouter adhérent</a></li>
            <li><a href="{{ route('admin.members.edit') }}">Modifier adhérent</a></li>
            <li><a href="{{ route('logout') }}">Déconnecter</a></li>
        </ul>
    </nav>
    <main class="w-3/4">
        @yield('content')
    </main>
</div>
