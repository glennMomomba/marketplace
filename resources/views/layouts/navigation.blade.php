<!-- Navigation -->
<div class="hidden sm:flex sm:items-center sm:ms-6">
    @auth
        <!-- Dropdown utilisateur -->
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                    <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="ms-2 h-4 w-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path fill="currentColor" fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.25 8.29a.75.75 0 01-.02-1.08z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Lien profil -->
                    <x-dropdown-link :href="route('profile.edit')">
                        <i class="fas fa-user text-blue-500 mr-2"></i> Profil
                    </x-dropdown-link>

                    <!-- Déconnexion -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link as="button">
                            <i class="fas fa-sign-out-alt text-red-500 mr-2"></i> Déconnexion
                        </x-dropdown-link>
                    </form>
                </div>
            </x-slot>
        </x-dropdown>
    @endauth

    @guest
        <div class="flex space-x-4">
            <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-medium bg-green-500 text-white hover:bg-green-600 transition">
                <i class="fas fa-sign-in-alt mr-1"></i> Connexion
            </a>
            <a href="{{ route('register') }}" class="px-3 py-2 rounded-md text-sm font-medium bg-blue-500 text-white hover:bg-blue-600 transition">
                <i class="fas fa-user-plus mr-1"></i> Inscription
            </a>
        </div>
    @endguest
</div>
