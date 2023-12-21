<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-md fixed top-0 w-full">
    <!-- Primary Navigation Menu -->
    <div class="flex flex-wrap items-center h-16 justify-between max-w-screen-xl px-4 mx-auto">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
                {{ __('messages.appName') }}
            </span>
        </a>
        <!-- Navigation Links -->
        <div class="justify-center">
            <a href="{{ route('task_statuses.index') }}" class="ml-4 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                {{ __('Задачи') }}
            </a>
            <a href="{{ route('task_statuses.index') }}" class="ml-4 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                {{ __('messages.taskStatuses') }}
            </a>
            <a href="{{ route('task_statuses.index') }}" class="ml-4 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                {{ __('Метки') }}
            </a>
        </div>
        <div>
            @if (Route::has('login'))
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-secondary-button :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('messages.logOut') }}
                        </x-secondary-button>
                    </form>
                    @else
                        <a href="{{ route('login') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('messages.logIn') }}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('messages.register') }}</a>
                        @endif
                    @endauth
            @endif
        </div>
    </div>
</nav>
