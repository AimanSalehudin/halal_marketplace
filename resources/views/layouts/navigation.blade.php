<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- LEFT SIDE -->
            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800"/>
                    </a>
                </div>

                <!-- Home Link -->
                <div class="hidden sm:flex sm:items-center sm:ms-10 space-x-8">
                    <a href="/" class="text-gray-700 hover:text-black">
                        Home
                    </a>
                </div>

            </div>


            <!-- RIGHT USER MENU -->
            <div class="hidden sm:flex sm:items-center">

                <x-dropdown align="right" width="48">

                    <!-- Dropdown Button -->
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700">

                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                ▼
                            </div>

                        </button>
                    </x-slot>

                    <!-- Dropdown Content -->
                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit       <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link href="#"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            <!-- MOBILE BUTTON -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open">☰</button>
            </div>

        </div>
    </div>


    <!-- MOBILE MENU -->
    <div x-show="open" class="sm:hidden">

        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/" class="block text-gray-700">Home</a>
        </div>

        <div class="border-t pt-4 pb-1 px-4">
            <div>{{ Auth::user()->name }}</div>
            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>

            <div class="mt-3 space-y-1">

                <a href="{{ route('profile.edit') }}" class="block">Profile</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="text-red-500">
                        Logout
                    </button>
                </form>

            </div>
        </div>

    </div>

</nav>