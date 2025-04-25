<x-app-layout class="min-h-screen mb-8">
    <div class="p-6 text-center">
        <h1 class="text-3xl font-bold">Bienvenue sur la boutique !</h1>

        @auth
            <p class="mt-4 text-lg">Bonjour, <strong>{{ Auth::user()->name }}</strong> 👋</p>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">
                    Se déconnecter
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-blue-600 underline">Connexion</a>
            <a href="{{ route('register') }}" class="ml-4 text-blue-600 underline">Inscription</a>
        @endauth
    </div>
</x-app-layout>