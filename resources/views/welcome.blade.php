@include('layouts.navigation')

<section class="relative py-14 lg:pt-44 lg:pb-16">
    <div class="w-full max-w-7xl mx-auto px-4 lg:px-8">
        <div class="w-full max-w-4xl mx-auto sm:px-12 mb-10 lg:mb-20">
            <h1 class="font-manrope font-bold text-2xl leading-snug lg:text-2xl sm:text-xl text-center mb-10 text-black">
                あなたの決め手が､ 誰かの決め手に｡
            </h1>

            <div class="flex justify-center mt-20">
              @auth
                  <a href="{{ route('posts.create') }}"
                      class='py-4 px-20 text-lg bg-cyan-500 text-white rounded-xl cursor-pointer font-semibold text-center shadow-lg transition-all duration-300 ease-in-out bg-gradient-to-tl hover:from-red-400 hover:to-cyan-500 hover:shadow-lg transform hover:scale-105'>
                      入社の決め手を投稿する
                      <i class="far fa-plus-square fa-lg ml-2"></i>
                  </a>
              @else
                  <a href="{{ route('register') }}"
                      class='py-4 px-20 text-lg bg-cyan-500 text-white rounded-xl cursor-pointer font-semibold text-center shadow-lg transition-all duration-300 ease-in-out bg-gradient-to-tl hover:from-red-400 hover:to-cyan-500 hover:shadow-lg transform hover:scale-105'>
                      入社の決め手を投稿する
                      <i class="far fa-plus-square fa-lg ml-2"></i>
                  </a>
              @endauth
          </div>

        </div>
    </div>
</section>


<section class="mb-36">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-16 ">
            <h2 class="text-xl text-center font-bold text-gray-900 ">最新の入社エントリー</h2>
        </div>
        <!--Slider wrapper-->

        <div class="swiper mySwiper">
            <div class="swiper-wrapper w-max">
                <div class="swiper-slide">
                    <div
                        class="group bg-white border border-solid border-gray-300 rounded-xl p-6 transition-all duration-500  w-full mx-auto hover:border-cyan-600 hover:shadow-sm slide_active:border-cyan-600">
                        <img class="h-10 w-15"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxlb-9v2oRbQmCwe2laUG8lnAIfbrSBYYBPw&s"
                            alt="avatar" />
                        <h5 class="text-gray-900 font-medium transition-all duration-500  mb-1">エン・ジャパン株式会社</h5>
                        <div class="flex items-center mb-7 gap-2 text-amber-500 transition-all duration-500  ">
                            <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                    fill="currentColor" />
                            </svg>
                            <span class="text-base font-semibold text-cyan-600">4.9</span>
                        </div>
                        <div class="flex items-center gap-5 border-t border-solid border-gray-200 pt-5"></div>
                        <span class="text-sm leading-4 text-gray-500">入社の決め手</span>
                        <p
                            class="text-base text-gray-600 leading-6  transition-all duration-500 pb-8 group-hover:text-gray-800 slide_active:text-gray-800">
                            会社のビジョンに共感し、ホゲホゲです。
                        </p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="group bg-white border border-solid border-gray-300 rounded-xl p-6 transition-all duration-500  w-full mx-auto hover:border-cyan-600 hover:shadow-sm slide_active:border-cyan-600">
                        <img class="h-10 w-15" src="https://image.itmedia.co.jp/news/articles/1911/05/yu_facebook3.jpg"
                            alt="avatar" />
                        <h5 class="text-gray-900 font-medium transition-all duration-500  mb-1">フェイスブックジャパン株式会社</h5>
                        <div class="flex items-center mb-7 gap-2 text-amber-500 transition-all duration-500  ">
                            <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                    fill="currentColor" />
                            </svg>
                            <span class="text-base font-semibold text-cyan-600">4.9</span>
                        </div>
                        <div class="flex items-center gap-5 border-t border-solid border-gray-200 pt-5"></div>
                        <span class="text-sm leading-4 text-gray-500">入社の決め手</span>
                        <p
                            class="text-base text-gray-600 leading-6  transition-all duration-500 pb-8 group-hover:text-gray-800 slide_active:text-gray-800">
                            会社のビジョンに共感し、ホゲホゲです。
                        </p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="group bg-white border border-solid border-gray-300 rounded-xl p-6 transition-all duration-500  w-full mx-auto hover:border-cyan-600 hover:shadow-sm slide_active:border-cyan-600">
                        <img class="h-10 w-15"
                            src="https://cdn.icon-icons.com/icons2/2699/PNG/512/tesla_logo_icon_167878.png"
                            alt="avatar" />
                        <h5 class="text-gray-900 font-medium transition-all duration-500  mb-1">テスラジャパン株式会社</h5>
                        <div class="flex items-center mb-7 gap-2 text-amber-500 transition-all duration-500  ">
                            <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                    fill="currentColor" />
                            </svg>
                            <span class="text-base font-semibold text-cyan-600">4.9</span>
                        </div>
                        <div class="flex items-center gap-5 border-t border-solid border-gray-200 pt-5"></div>
                        <span class="text-sm leading-4 text-gray-500">入社の決め手</span>
                        <p
                            class="text-base text-gray-600 leading-6  transition-all duration-500 pb-8 group-hover:text-gray-800 slide_active:text-gray-800">
                            会社のビジョンに共感し、ホゲホゲです。
                        </p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="group bg-white border border-solid border-gray-300 rounded-xl p-6 transition-all duration-500  w-full mx-auto hover:border-cyan-600 hover:shadow-sm slide_active:border-cyan-600">
                        <img class="h-10 w-15"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/1200px-Google_2015_logo.svg.png"
                            alt="avatar" />
                        <h5 class="text-gray-900 font-medium transition-all duration-500  mb-1">グーグルジャパン合同会社</h5>
                        <div class="flex items-center mb-7 gap-2 text-amber-500 transition-all duration-500  ">
                            <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                    fill="currentColor" />
                            </svg>
                            <span class="text-base font-semibold text-cyan-600">4.9</span>
                        </div>
                        <div class="flex items-center gap-5 border-t border-solid border-gray-200 pt-5"></div>
                        <span class="text-sm leading-4 text-gray-500">入社の決め手</span>
                        <p
                            class="text-base text-gray-600 leading-6  transition-all duration-500 pb-8 group-hover:text-gray-800 slide_active:text-gray-800">
                            会社のビジョンに共感し、ホゲホゲです。
                        </p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="group bg-white border border-solid border-gray-300 rounded-xl p-6 transition-all duration-500  w-full mx-auto hover:border-cyan-600 hover:shadow-sm slide_active:border-cyan-600">
                        <img class="h-10 w-15"
                            src="https://prtimes.jp/data/corp/496/3dcfefa91a54713897fa39541acf7e2f.jpg?auto=avif"
                            alt="avatar" />
                        <h5 class="text-gray-900 font-medium transition-all duration-500  mb-1">デジタルハリウッド株式会社</h5>
                        <div class="flex items-center mb-7 gap-2 text-amber-500 transition-all duration-500  ">
                            <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                    fill="currentColor" />
                            </svg>
                            <span class="text-base font-semibold text-cyan-600">4.9</span>
                        </div>
                        <div class="flex items-center gap-5 border-t border-solid border-gray-200 pt-5"></div>
                        <span class="text-sm leading-4 text-gray-500">入社の決め手</span>
                        <p
                            class="text-base text-gray-600 leading-6  transition-all duration-500 pb-8 group-hover:text-gray-800 slide_active:text-gray-800">
                            会社のビジョンに共感し、ホゲホゲです。
                        </p>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div
                        class="group bg-white border border-solid border-gray-300 rounded-xl p-6 transition-all duration-500  w-full mx-auto hover:border-cyan-600 hover:shadow-sm slide_active:border-cyan-600">
                        <img class="h-10 w-15"
                            src="https://upload.wikimedia.org/wikipedia/commons/b/b5/Yahoo_Japan_Logo.svg"
                            alt="avatar" />
                        <h5 class="text-gray-900 font-medium transition-all duration-500  mb-1">ヤフー・ジャパン株式会社</h5>
                        <div class="flex items-center mb-7 gap-2 text-amber-500 transition-all duration-500  ">
                            <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                    fill="currentColor" />
                            </svg>
                            <span class="text-base font-semibold text-cyan-600">4.9</span>
                        </div>
                        <div class="flex items-center gap-5 border-t border-solid border-gray-200 pt-5"></div>
                        <span class="text-sm leading-4 text-gray-500">入社の決め手</span>
                        <p
                            class="text-base text-gray-600 leading-6  transition-all duration-500 pb-8 group-hover:text-gray-800 slide_active:text-gray-800">
                            会社のビジョンに共感し、ホゲホゲです。
                        </p>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>


@include('layouts.footer')
@vite(['resources/js/app.js'])
