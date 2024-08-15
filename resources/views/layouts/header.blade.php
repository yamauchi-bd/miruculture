<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/pagedone@1.1.2/src/css/pagedone.css ">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link href="https://unpkg.com/tailwindcss@0.3.0/dist/tailwind.min.css" rel="stylesheet">
  @vite(['resources/css/style.css'])

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/script-name.js"></script>

  <title>vivivision</title>
</head>

<body>

    <nav class="py-5 lg:fixed transition-all top-0 left-0 z-50 duration-500 w-full bg-white">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="w-full flex flex-col lg:flex-row">
          <div class="flex justify-between lg:flex-row">
            <a href="/" class="flex items-center">
                <img src="{{ asset('items/vivivision-logo_default.png') }}" alt="ビビビジョン" class="w-40">
            </a>
            <button data-collapse-toggle="navbar" type="button"
              class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
              aria-controls="navbar-default" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                  clip-rule="evenodd"></path>
              </svg>
            </button>
          </div>
          <div class="hidden w-full lg:flex lg:pl-11 max-lg:mt-1 max-lg:h-screen max-lg:overflow-y-auto" id="navbar">
            <div
              class="flex lg:items-center w-full justify-end flex-col lg:flex-row gap-4 lg:w-max max-lg:gap-4 lg:ml-auto">
              <a href="javascript:;"
                class="nav-link mb-2 block lg:mr-6 md:mb-0 lg:text-left text-sm text-gray-500 font-semibold transition-all duration-500 hover:text-gray-900">新着データ</a>
              <button
                class="bg-indigo-50 text-indigo-600 rounded-full cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 py-3 px-6 text-sm hover:bg-indigo-100">
                ユーザー登録
              </button>
              <button
                class="bg-indigo-600 text-white rounded-full cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 py-3 px-6 text-sm hover:bg-indigo-700">
                ログイン
              </button>
            </div>
          </div>
        </div>
      </div>
    </nav>