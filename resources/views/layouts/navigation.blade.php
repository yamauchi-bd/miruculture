<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/pagedone@1.1.2/src/css/pagedone.css ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link href="https://unpkg.com/tailwindcss@0.3.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/style.css'])
    @vite(['resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    boxShadow: {
                        'inner-cyan': 'inset 0 0 0 2px #06b6d4',
                    },
                },
            },
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/script-name.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>vivivision</title>
</head>

<body>

    <nav x-data="{ open: false }" class="py-2 lg:fixed transition-all top-0 left-0 z-50 duration-500 w-full bg-white">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="/">
                            <x-application-logo
                                class="block h-6 w-auto sm:h-9 fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 md:space-x-4 lg:space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')" class="text-sm md:text-xs lg:text-sm">
                            {{ __('決め手投稿') }}
                        </x-nav-link>
                    </div>
                    <!-- 検索バーを追加（スマートフォンサイズでも表示） -->
                    <div class="flex items-center ms-4">
                        <div class="relative">
                            <input type="text" id="company-search"
                                class="block w-40 sm:w-64 lg:w-80 px-4 py-2 text-xs sm:text-sm font-normal shadow-xs text-gray-900 bg-white border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent pr-12"
                                placeholder="気になる企業を検索する..." required="">
                            <button id="search-button"
                                class="absolute right-1 top-1/2 transform -translate-y-1/2 p-1.5 sm:p-2 rounded-full bg-cyan-500 text-white text-xs sm:text-sm font-medium transition-all duration-300 hover:bg-cyan-600">
                                <svg width="16px" height="16px" class="w-3 h-3 sm:w-4 sm:h-4" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17 17L21 21" stroke="#ffffff" stroke-width="3" stroke-linecap="round"
                                        class="my-path"></path>
                                    <path
                                        d="M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                        stroke="#ffffff" stroke-width="3" class="my-path"></path>
                                </svg>
                            </button>
                            <div id="search-results"
                                class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg w-full mt-1 hidden text-sm">
                            </div>
                        </div>
                    </div>
                </div>

                @auth
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48" class="z-50">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-cyan-500 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('マイページ') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                        {{ __('ログアウト') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <a href="{{ route('register') }}"
                            class="bg-white shadow-inner-cyan text-cyan-500 rounded-full cursor-pointer font-semibold text-center transition-all duration-500 py-2 px-4 text-sm md:text-xs lg:text-sm hover:bg-cyan-50 mr-2">
                            ユーザー登録
                        </a>
                        <a href="{{ route('login') }}"
                            class="bg-cyan-500 text-white rounded-full cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 py-2 px-4 text-sm md:text-xs lg:text-sm hover:bg-cyan-700">
                            ログイン
                        </a>
                    </div>
                @endguest

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            @auth
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')">
                        {{ __('決め手投稿') }}
                    </x-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                    <div class="px-4">
                        <div class="font-medium text-sm text-gray-500">
                            <div>{{ str()->limit(Auth::user()->email, 6) }}</div>
                        </div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('マイページ') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                                {{ __('ログアウト') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            @else
                <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                    <div class="space-y-1">
                        <x-responsive-nav-link :href="route('register')"
                            class="block w-full px-4 py-2 text-left text-sm leading-5 text-cyan-600 hover:bg-cyan-100 focus:outline-none focus:bg-cyan-100 transition duration-150 ease-in-out">
                            {{ __('ユーザー登録') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('login')"
                            class="block w-full px-4 py-2 text-left text-sm leading-5 text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:bg-cyan-700 transition duration-150 ease-in-out">
                            {{ __('ログイン') }}
                        </x-responsive-nav-link>
                    </div>
                </div>
            @endauth
        </div>
    </nav>

</body>
