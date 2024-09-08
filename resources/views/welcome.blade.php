@php
    use Illuminate\Support\Str;
@endphp

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
                @foreach ($latestPosts as $post)
                    @if ($post->corporate_number)
                        <div class="swiper-slide">
                            <div class="group bg-white border-2 border-solid border-gray-300 rounded-xl p-6 transition-all duration-500 w-full mx-auto hover:border-cyan-500 hover:border-3 hover:shadow-md slide_active:border-cyan-600">
                                <h6 class="text-gray-900 text-sm font-medium mb-3">
                                    「<a href="{{ route('companies.show', ['corporate_number' => $post->corporate_number]) }}" class="text-cyan-600 hover:text-cyan-500 transition duration-150 ease-in-out">{{ $post->company_name }}</a>」への入社の決め手
                                </h6>
                                <div class="mb-4">
                                    @foreach ($post->decidingFactors as $index => $factor)
                                        @if ($index < 3)
                                            <div class="mb-2">
                                                <div class="flex items-center justify-between mb-1">
                                                    <p class="text-base font-bold text-gray-900">
                                                        {{ $index + 1 }}位：{{ $factor->factor }}</p>
                                                    <div class="flex items-center">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $factor->satisfaction)
                                                                <svg class="w-4 h-4 text-yellow-400"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                    </path>
                                                                </svg>
                                                            @else
                                                                <svg class="w-4 h-4 text-gray-300"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                    </path>
                                                                </svg>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                                <p class="text-sm text-gray-600">
                                                    {{ Str::limit($factor->detail, 10) }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <hr class="my-4 border-gray-200">

                                <div class="text-sm text-gray-600">
                                    <p>{{ $post->start_year ?? '◯◯' }}年
                                        {{ $post->entry_type ?? '未設定' }}（{{ $post->status ?? '未設定' }}）</p>
                                    <p>{{ $post->jobCategory->name ?? '職種未設定' }} ＞
                                        {{ $post->jobSubcategory->name ?? '未設定' }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>


@include('layouts.footer')
@vite(['resources/js/app.js'])
