@php
    use Illuminate\Support\Str;
@endphp

@include('layouts.navigation')

<section class="relative py-8 lg:py-14 lg:pt-40 lg:pb-16 bg-cover" style="background-image: url('{{ asset('items/top-background.jpg') }}'); background-position: center 100%;">
    <div class="w-full max-w-7xl mx-auto px-4 lg:px-8">
        <div class="w-full max-w-4xl mx-auto sm:px-12 mb-10 lg:mb-20">
            <h2 class="text-xs font-semibold sm:text-sm md:text-base lg:text-lg leading-relaxed sm:leading-loose tracking-wide sm:tracking-wider text-center mb-4 mt-6 sm:mb-6 md:mb-8 lg:mb-10 sm:mt-10 lg:mt-10 text-gray-800">
                匿名の入社エントリを投稿して<br>企業カルチャーを可視化していきましょう！
            </h2>

            <div class="flex justify-center mt-4 sm:mt-6 md:mt-8 lg:mt-12 xl:mt-16">
                @auth
                    <a href="{{ route('posts.create.step1') }}"
                        class='py-2 px-4 sm:py-2 sm:px-8 md:py-3 md:px-10 lg:py-3 lg:px-12 xl:py-4 xl:px-16 text-xs sm:text-sm md:text-base lg:text-base bg-cyan-500 text-white rounded-full cursor-pointer font-semibold text-center shadow-lg duration-200 hover:bg-cyan-700 hover:shadow-xl hover:scale-105'>
                        入社エントリを投稿する
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class='py-2 px-4 sm:py-2 sm:px-8 md:py-3 md:px-10 lg:py-3 lg:px-12 xl:py-4 xl:px-16 text-xs sm:text-sm md:text-base lg:text-base bg-cyan-500 text-white rounded-full cursor-pointer font-semibold text-center shadow-lg duration-200 hover:bg-cyan-700 hover:shadow-xl hover:scale-105'>
                        入社エントリを投稿する
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>

<div class="h-10 md:h-10 lg:h-10"></div>

<section class="mb-16 sm:mb-24 md:mb-32 lg:mb-36 xl:mb-40">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12 flex justify-center">
            <h2 class="text-base sm:text-base md:text-xl lg:text-xl font-bold text-gray-700 relative inline-block pb-3">
                最新の投稿
                <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-2/5 h-1 bg-cyan-500"></span>
            </h2>
        </div>
        

        <!--Slider wrapper-->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper w-max">
                @foreach ($latestPosts as $post)
                    @if ($post->corporate_number)
                        <div class="swiper-slide">
                            <a href="{{ route('companies.show', ['corporate_number' => $post->corporate_number]) }}" class="block">
                                <div class="group bg-white border-2 border-solid border-gray-300 mt-2 rounded-xl p-4 sm:p-5 md:p-6 transition-all duration-300 hover:border-cyan-500 hover:shadow-lg relative h-[275px] sm:h-[325px] md:h-[325px] flex flex-col cursor-pointer transform hover:-translate-y-1">
                                    <h6 class="text-gray-700 text-xs sm:text-xs md:text-xs font-medium mb-3 sm:mb-4">
                                        「<span class="text-cyan-600 hover:text-cyan-700">{{ $post->company_name }}</span>」への決め手
                                    </h6>
                                    <div class="mb-1 sm:mb-2 flex-grow overflow-y-auto">
                                        @foreach ($post->decidingFactors as $index => $factor)
                                            @if ($index < 3)
                                                <div class="mb-2">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <p class="text-sm sm:text-sm md:text-base font-bold text-gray-700">
                                                            【{{ $index + 1 }}位】{{ $factor->factor }}</p>
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
                                                    <p class="text-xs sm:text-sm text-gray-600">
                                                        {{ Str::limit($factor->detail, 20) }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <hr class="my-2 sm:my-3 md:my-4 border-gray-200">

                                    <div class="text-xs sm:text-xs text-gray-600">
                                        <p>{{ $post->start_year ?? '◯◯' }}年
                                            {{ $post->entry_type ?? '未設定' }}（{{ $post->status ?? '未設定' }}）</p>
                                        <p>{{ $post->jobCategory->name ?? '職種未設定' }} 
                                            {{-- {{ $post->jobSubcategory->name ?? '未設定' }} --}}
                                        </p>
                                    </div>
                                </div>
                            </a>
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
