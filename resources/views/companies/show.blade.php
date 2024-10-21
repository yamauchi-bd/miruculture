@php
    use Illuminate\Support\Str;
@endphp

@include('layouts.navigation')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 sm:pt-10 md:pt-14 lg:pt-28 pb-4 sm:pb-6 md:pb-8 lg:pb-16">
    <div class="flex flex-col lg:flex-row justify-between gap-4 lg:gap-12">
        {{-- メインコンテンツ（左側） --}}
        <div class="w-full lg:w-3/4">
            <div
                class="w-full flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 lg:mb-12 sm:mb-6">
                <h2 class="font-semibold text-lg sm:text-xl text-gray-700 mb-2 sm:mb-0">
                    {{ $company['company_name'] }}
                </h2>
                @auth
                    <a href="{{ route('enrollment_records.create', ['corporate_number' => $company['corporate_number'], 'company_name' => $company['company_name']]) }}"
                        class='block w-full sm:w-auto py-3 px-6 text-sm bg-cyan-500 text-white rounded-lg shadow-md cursor-pointer font-semibold text-center transition-all duration-300 ease-in-out hover:bg-cyan-700'>
                        企業カルチャーを登録する
                    </a>
                @else
                    <a href="{{ route('register', ['redirect_to' => route('enrollment_records.create', ['corporate_number' => $company['corporate_number'], 'company_name' => $company['company_name']])]) }}"
                        class='block w-full sm:w-auto py-3 px-6 text-sm bg-cyan-500 text-white rounded-lg shadow-md cursor-pointer font-semibold text-center transition-all duration-300 ease-in-out hover:bg-cyan-700'>
                        企業カルチャーを登録する
                    </a>
                @endauth
            </div>

            {{-- タブ切り替え --}}
            <div class="mb-4 sm:mb-2">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex" aria-label="Tabs">
                        <button
                            class="tab-button w-1/3 py-3 px-1 text-center border-b-2 border-x-2 border-x-white font-semibold text-xs sm:text-sm flex items-center justify-center transition-all duration-200 ease-in-out cursor-pointer"
                            data-tab="personality-types">
                            <span>性格タイプ(MBTI)</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <button
                            class="tab-button w-1/3 py-3 px-1 text-center border-b-2 border-x-2 border-x-white font-semibold text-xs sm:text-sm flex items-center justify-center transition-all duration-200 ease-in-out cursor-pointer"
                            data-tab="deciding-factors">
                            <span>入社の決め手</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <button
                            class="tab-button w-1/3 py-3 px-1 text-center border-b-2 border-x-2 border-x-white font-semibold text-xs sm:text-sm flex items-center justify-center transition-all duration-200 ease-in-out cursor-pointer"
                            data-tab="company-culture">
                            <span>社風･雰囲気</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </nav>
                </div>
            </div>

            {{-- グラフ部分 --}}
            <section class="py-2 sm:py-2 md:py-8 lg:py-2 mt-4 sm:mt-4">
                <div class="border border-gray-200 rounded-lg overflow-hidden">

                    {{-- 性格タイプグラフ --}}
                    <div id="personality-types-content" class="tab-content hidden">
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <div class="flex items-center px-3 py-2 sm:px-4 sm:py-3 bg-gray-100">
                                <h3 class="text-xs sm:text-sm font-semibold text-gray-700">性格タイプ</h3>
                                <h2 class="text-2xs sm:text-xs text-gray-600">（従業員の性格傾向）</h2>
                            </div>
                            <div class="px-4 sm:px-8 py-3 sm:py-4 relative h-[30vh] w-full lg:h-[45vh] sm:h-[30vh]">
                                @if ($personalityTypeRecords->isEmpty())
                                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                                        <p
                                            class="text-sm sm:text-base md:text-lg lg:text-xl text-cyan-500 font-bold text-center leading-tight sm:leading-normal mb-4">
                                            「性格タイプ(MBTI)」を登録して、<br class="sm:hidden">企業カルチャーを<br
                                                class="hidden sm:inline md:hidden">可視化しよう！
                                        </p>
                                        @auth
                                            <a href="{{ route('enrollment_records.create', ['corporate_number' => $company['corporate_number'], 'company_name' => $company['company_name']]) }}"
                                                class='block sm:w-auto py-3 px-6 text-sm bg-cyan-500 text-white rounded-lg shadow-md cursor-pointer font-semibold text-center transition-all duration-300 ease-in-out hover:bg-cyan-700'>
                                                性格タイプを登録する
                                            </a>
                                        @else
                                            <a href="{{ route('register', ['redirect_to' => route('enrollment_records.create', ['corporate_number' => $company['corporate_number'], 'company_name' => $company['company_name']])]) }}"
                                                class='block sm:w-auto py-3 px-6 text-sm bg-cyan-500 text-white rounded-lg shadow-md cursor-pointer font-semibold text-center transition-all duration-300 ease-in-out hover:bg-cyan-700'>
                                                性格タイプを登録する
                                            </a>
                                        @endauth
                                    </div>
                                @endif
                                <canvas id="personalityTypesChart"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- 決め手グラフ --}}
                    <div id="deciding-factors-content" class="tab-content">
                        <div class="flex items-center px-3 py-2 sm:px-4 sm:py-3 bg-gray-100">
                            <h3 class="text-xs sm:text-sm font-semibold text-gray-700">入社の決め手</h3>
                            <h2 class="text-2xs sm:text-xs text-gray-600">（従業員の価値観）</h2>
                        </div>
                        <div class="px-4 sm:px-8 py-3 sm:py-4 relative h-[30vh] w-full lg:h-[45vh] sm:h-[30vh]">
                            @if ($decidingFactorRecords->isEmpty())
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <p
                                        class="text-sm sm:text-base md:text-lg lg:text-xl text-cyan-500 font-bold text-center leading-tight sm:leading-normal mb-4">
                                        「入社の決め手」を登録して、<br class="sm:hidden">企業カルチャーを<br
                                            class="hidden sm:inline md:hidden">可視化しよう！
                                    </p>
                                    @auth
                                        <a href="{{ route('enrollment_records.create', ['corporate_number' => $company['corporate_number'], 'company_name' => $company['company_name']]) }}"
                                            class='block sm:w-auto py-3 px-6 text-sm bg-cyan-500 text-white rounded-lg shadow-md cursor-pointer font-semibold text-center transition-all duration-300 ease-in-out hover:bg-cyan-700'>
                                            入社の決め手を登録する
                                        </a>
                                    @else
                                        <a href="{{ route('register', ['redirect_to' => route('enrollment_records.create', ['corporate_number' => $company['corporate_number'], 'company_name' => $company['company_name']])]) }}"
                                            class='block sm:w-auto py-3 px-6 text-sm bg-cyan-500 text-white rounded-lg shadow-md cursor-pointer font-semibold text-center transition-all duration-300 ease-in-out hover:bg-cyan-700'>
                                            入社の決め手を登録する
                                        </a>
                                    @endauth
                                </div>
                            @endif
                            <canvas id="decidingFactorsChart"></canvas>
                        </div>
                    </div>

                    {{-- 社風グラフ --}}
                    <div id="company-culture-content" class="tab-content hidden">
                        <div class="flex items-center px-3 py-2 sm:px-4 sm:py-3 bg-gray-100">
                            <h3 class="text-xs sm:text-sm font-semibold text-gray-700">社風･雰囲気</h3>
                            <h2 class="text-2xs sm:text-xs text-gray-600">（環境や仕事の進め方）</h2>
                        </div>
                        <div class="px-4 sm:px-12 py-3 sm:py-6 relative w-full">
                            @if ($companyCultureRecords->isEmpty())
                                <div
                                    class="px-4 sm:px-8 py-3 sm:py-4 relative h-[27vh] w-full lg:h-[39vh] sm:h-[27vh] flex flex-col items-center justify-center">
                                    <p
                                        class="text-sm sm:text-base md:text-lg lg:text-xl text-cyan-500 font-bold text-center leading-tight sm:leading-normal mb-4">
                                        「社風･雰囲気」を登録して、<br class="sm:hidden">企業カルチャーを<br
                                            class="hidden sm:inline md:hidden">可視化しよう！
                                    </p>
                                    @auth
                                        <a href="{{ route('enrollment_records.create', ['corporate_number' => $company['corporate_number'], 'company_name' => $company['company_name']]) }}"
                                            class='block sm:w-auto py-3 px-6 text-sm bg-cyan-500 text-white rounded-lg shadow-md cursor-pointer font-semibold text-center transition-all duration-300 ease-in-out hover:bg-cyan-700'>
                                            社風･雰囲気を登録する
                                        </a>
                                    @else
                                        <a href="{{ route('register', ['redirect_to' => route('enrollment_records.create', ['corporate_number' => $company['corporate_number'], 'company_name' => $company['company_name']])]) }}"
                                            class='block sm:w-auto py-3 px-6 text-sm bg-cyan-500 text-white rounded-lg shadow-md cursor-pointer font-semibold text-center transition-all duration-300 ease-in-out hover:bg-cyan-700'>
                                            社風･雰囲気を登録する
                                        </a>
                                    @endauth
                                </div>
                            @else
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                                    @foreach ($companyCultureFactors as $factor)
                                        <div class="mb-3 sm:mb-4 px-2 sm:px-4">
                                            <div class="flex items-center mb-1 sm:mb-2">
                                                <span
                                                    class="text-xs sm:text-sm font-semibold text-gray-700">{{ $factor['name'] }}
                                                    :</span>
                                                <span
                                                    class="text-xs sm:text-sm font-medium text-gray-700">（{{ number_format(abs($factor['average_score'] - 3) * 25 + 50, 0) }}%）</span>
                                                <span
                                                    class="text-xs sm:text-sm font-medium text-gray-700">{{ $factor['average_score'] > 3 ? $factor['b'] : $factor['a'] }}
                                                    型</span>
                                            </div>
                                            <div class="relative pt-1">
                                                <div class="h-2 mb-1 rounded bg-gray-200"></div>
                                                <div class="absolute top-0 left-1/2 w-0.5 h-2 bg-gray-400"></div>
                                                <div class="absolute top-[-2.5px] w-4 h-4 sm:w-5 sm:h-5 rounded-full bg-cyan-500 border-2 border-white shadow-md"
                                                    style="left: calc({{ (($factor['average_score'] - 1) / 4) * 100 }}% - 8px);">
                                                </div>
                                            </div>
                                            <div
                                                class="flex justify-between text-2xs sm:text-xs text-gray-600 mt-1 sm:mt-2">
                                                <span>{{ $factor['a'] }} ←</span>
                                                <span>→ {{ $factor['b'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            {{-- 性格タイプデータをJavaScriptに渡す --}}
            <script id="personalityTypeData" type="application/json">
                {!! json_encode($personalityTypeData) !!}
            </script>

            {{-- 社風データをJavaScriptに渡す --}}
            <script id="companyCultureData" type="application/json">
                {!! json_encode($companyCultureFactors) !!}
            </script>

            {{-- タブ切り替え --}}
            <div class="mt-10">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex" aria-label="Tabs">
                        <button
                            class="tab-button w-1/3 py-3 px-1 text-center border-b-2 border-x-2 border-x-white font-semibold text-xs sm:text-sm flex items-center justify-center transition-all duration-200 ease-in-out cursor-pointer"
                            data-tab="personality-types">
                            <span>性格タイプ(MBTI)</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <button
                            class="tab-button w-1/3 py-3 px-1 text-center border-b-2 border-x-2 border-x-white font-semibold text-xs sm:text-sm flex items-center justify-center transition-all duration-200 ease-in-out cursor-pointer"
                            data-tab="deciding-factors">
                            <span>入社の決め手</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <button
                            class="tab-button w-1/3 py-3 px-1 text-center border-b-2 border-x-2 border-x-white font-semibold text-xs sm:text-sm flex items-center justify-center transition-all duration-200 ease-in-out cursor-pointer"
                            data-tab="company-culture">
                            <span>社風･雰囲気</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                    </nav>
                </div>
            </div>

            {{-- 性格タイプタブコンテンツ --}}
            <div id="personality-types-content" class="tab-content hidden">
                <section class="py-6 sm:py-6 md:py-6">
                    <div class="mx-auto max-w-full">
                        @foreach ($personalityTypeRecords as $enrollmentRecord)
                            @if ($enrollmentRecord->personalityTypes->isNotEmpty())
                                <div class="post-container group bg-white border border-solid border-gray-200 rounded-lg px-4 sm:px-6 md:px-8 py-4 mb-6 transition-all duration-300 hover:border-cyan-500 hover:shadow-lg relative flex flex-col cursor-pointer transform hover:-translate-y-1"
                                    data-post-id="{{ $enrollmentRecord->id }}">

                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-10 w-10 sm:h-12 sm:w-12 text-gray-500" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="grid flex-grow">
                                            <h5 class="text-xs sm:text-sm text-gray-700 font-medium">
                                                {{ $enrollmentRecord->start_year ?? '◯◯' }}年
                                                {{ $enrollmentRecord->entry_type ?? '未設定' }}（{{ $enrollmentRecord->status ?? '未設定' }}）
                                            </h5>

                                            <span class="text-2xs sm:text-xs leading-tight text-gray-500">
                                                {{ $enrollmentRecord->jobCategory->name ?? '職種未設定' }} >
                                                {{ $enrollmentRecord->jobSubcategory->name ?? '未設定' }}
                                            </span>
                                            <div class="flex justify-between items-center">
                                                <span class="text-2xs sm:text-xs leading-tight text-gray-500">
                                                    性格タイプ(MBTI) :
                                                    {{ $enrollmentRecord->personalityTypes->first()->type ?? '未設定' }}
                                                </span>
                                                <span class="text-2xs sm:text-xs text-gray-500">
                                                    投稿日:
                                                    {{ $enrollmentRecord->personalityTypes->first()->created_at->format('Y年m月d日') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </section>
            </div>

            {{-- 決め手タブコンテンツ --}}
            <div id="deciding-factors-content" class="tab-content">
                <section class="py-6 sm:py-6 md:py-6">
                    <div class="mx-auto max-w-full">
                        @foreach ($decidingFactorRecords as $enrollmentRecord)
                            @if ($enrollmentRecord->decidingFactor)
                                <div class="post-container group bg-white border border-solid border-gray-200 rounded-lg px-4 sm:px-6 md:px-8 py-4 mb-6 transition-all duration-300 hover:border-cyan-500 hover:shadow-lg relative flex flex-col cursor-pointer transform hover:-translate-y-1"
                                    data-post-id="{{ $enrollmentRecord->id }}">

                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-10 w-10 sm:h-12 sm:w-12 text-gray-500" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="grid flex-grow">
                                            <h5 class="text-xs sm:text-sm text-gray-700 font-medium">
                                                {{ $enrollmentRecord->start_year ?? '◯◯' }}年
                                                {{ $enrollmentRecord->entry_type ?? '未設定' }}（{{ $enrollmentRecord->status ?? '未設定' }}）
                                            </h5>

                                            <span class="text-2xs sm:text-xs leading-tight text-gray-500">
                                                {{ $enrollmentRecord->jobCategory->name ?? '職種未設定' }} >
                                                {{ $enrollmentRecord->jobSubcategory->name ?? '未設定' }}
                                            </span>
                                            <div class="flex justify-between items-center">
                                                <span class="text-2xs sm:text-xs leading-tight text-gray-500">
                                                    性格タイプ(MBTI) :
                                                    {{ $enrollmentRecord->personalityTypes->first()->type ?? '未設定' }}
                                                </span>
                                                <span class="text-2xs sm:text-xs text-gray-500">
                                                    投稿日:
                                                    {{ $enrollmentRecord->decidingFactor->created_at->format('Y年m月d日') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mt-2 mb-4 border-gray-200">

                                    <div class="flex-grow">
                                        <h2 class="text-xs sm:text-sm lg:text-xs text-gray-700 mt-1 mb-4">
                                            「<a href="{{ route('companies.show', ['corporate_number' => $enrollmentRecord->corporate_number]) }}"
                                                class="text-cyan-600 hover:text-cyan-700 hover:underline">{{ $enrollmentRecord->company_name }}</a>」への入社の決め手
                                        </h2>
                                        @for ($i = 1; $i <= 3; $i++)
                                            @if ($enrollmentRecord->decidingFactor->{"factor_$i"})
                                                <div class="mb-8">
                                                    <div class="flex items-center mb-4">
                                                        <p class="text-sm sm:text-base font-bold text-gray-700">
                                                            【{{ $i }}位】{{ $enrollmentRecord->decidingFactor->{"factor_$i"} }}
                                                        </p>
                                                        <div class="flex items-center ml-6">
                                                            @for ($j = 1; $j <= 5; $j++)
                                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 {{ $j <= $enrollmentRecord->decidingFactor->{"satisfaction_$i"} ? 'text-yellow-400' : 'text-gray-300' }}"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                    </path>
                                                                </svg>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <div class="ml-2">
                                                        <p
                                                            class="text-xs sm:text-sm text-gray-700 factor-summary mb-2 tracking-wide">
                                                            {{ Str::limit($enrollmentRecord->decidingFactor->{"detail_$i"}, 50) }}
                                                        </p>
                                                        <p
                                                            class="text-xs sm:text-sm text-gray-700 factor-full hidden mb-4 tracking-wide">
                                                            {{ $enrollmentRecord->decidingFactor->{"detail_$i"} }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="flex items-center justify-end toggle-details">
                                        <h2 class="text-sm font-bold text-cyan-500 toggle-text mr-1">もっと見る</h2>
                                        <svg class="w-5 h-5 text-cyan-500 arrow-down" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                        <svg class="w-5 h-5 text-cyan-500 arrow-up hidden" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 15l7-7 7 7"></path>
                                        </svg>
                                    </div>
                                    <div class="post-details hidden mt-4">
                                        <!-- 詳細情報がここに表示されます -->
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </section>
            </div>

            {{-- 社風タブコンテンツ --}}
            <div id="company-culture-content" class="tab-content hidden">
                <section class="py-6 sm:py-6 md:py-8">
                    <div class="mx-auto max-w-full">
                        @foreach ($companyCultureRecords as $enrollmentRecord)
                            <div
                                class="post-container group bg-white border border-solid border-gray-200 rounded-lg px-4 sm:px-6 md:px-8 py-4 mb-6 transition-all duration-300 hover:border-cyan-500 hover:shadow-lg relative flex flex-col cursor-pointer transform hover:-translate-y-1">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-10 w-10 sm:h-12 sm:w-12 text-gray-500" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div class="grid flex-grow">
                                        <h5 class="text-xs sm:text-sm text-gray-700 font-medium">
                                            {{ $enrollmentRecord->start_year ?? '◯◯' }}年
                                            {{ $enrollmentRecord->entry_type ?? '未設定' }}（{{ $enrollmentRecord->status ?? '未設定' }}）
                                        </h5>
                                        <span class="text-2xs sm:text-xs leading-tight text-gray-500">
                                            {{ $enrollmentRecord->jobCategory->name ?? '職種未設定' }} >
                                            {{ $enrollmentRecord->jobSubcategory->name ?? '未設定' }}
                                        </span>
                                        <div class="flex justify-between items-center">
                                            <span class="text-2xs sm:text-xs leading-tight text-gray-500">
                                                性格タイプ(MBTI):
                                                {{ $enrollmentRecord->personalityTypes->first()->type ?? '未設定' }}
                                            </span>
                                            <span class="text-2xs sm:text-xs text-gray-500">
                                                投稿日:
                                                {{ $enrollmentRecord->companyCultures->sortByDesc('created_at')->first()->created_at->format('Y年m月d日') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="mt-2 mb-4 border-gray-200">

                                <div class="flex-grow">
                                    <h2 class="text-xs sm:text-sm lg:text-xs text-gray-700 mt-1 mb-4">
                                        「<a href="{{ route('companies.show', ['corporate_number' => $enrollmentRecord->corporate_number]) }}"
                                            class="text-cyan-600 hover:text-cyan-700 hover:underline">{{ $enrollmentRecord->company_name }}</a>」の社風
                                    </h2>
                                    @php
                                        $cultureItems = App\Models\CompanyCulture::getCultureItems();
                                    @endphp

                                    @foreach ($enrollmentRecord->companyCultures as $companyCulture)
                                        @foreach ($cultureItems as $index => $item)
                                            <div class="mb-8 {{ $index > 0 ? 'hidden culture-detail' : '' }}">
                                                <div class="flex items-center mb-4">
                                                    <label
                                                        class="sm:mr-4 text-xs sm:text-base text-gray-700 font-bold whitespace-nowrap">
                                                        【{{ $item['name'] }}】
                                                    </label>
                                                    <span class="text-2xs sm:text-xs text-gray-600 whitespace-nowrap">
                                                        {{ $item['a'] }}
                                                    </span>
                                                    <span class="text-2xs sm:text-xs text-gray-600">← </span>
                                                    @php
                                                        $options = [
                                                            'A寄り',
                                                            'ややA寄り',
                                                            'どちらとも',
                                                            'ややB寄り',
                                                            'B寄り',
                                                        ];
                                                    @endphp
                                                    @foreach ($options as $value => $label)
                                                        <div class="w-2 sm:w-10 mx-1">
                                                            <div
                                                                class="w-3 h-1 sm:w-10 sm:h-1  text-center py-1 border {{ $value + 1 == $companyCulture->{"culture_$index"} ? 'bg-cyan-500 text-white border-cyan-500' : 'border-gray-300 text-gray-600' }} rounded transition-all duration-100 ease-in-out">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <span class="text-2xs sm:text-xs text-gray-600"> →</span>
                                                    <span class="text-2xs sm:text-xs text-gray-600 whitespace-nowrap">
                                                        {{ $item['b'] }}
                                                    </span>
                                                </div>
                                                <div class="ml-2">
                                                    <p
                                                        class="text-xs sm:text-sm text-gray-700 factor-summary mb-2 tracking-wide">
                                                        {{ Str::limit($companyCulture->{"culture_detail_$index"}, 50) }}
                                                    </p>
                                                    <p
                                                        class="text-xs sm:text-sm text-gray-700 factor-full hidden mb-4 tracking-wide">
                                                        {{ $companyCulture->{"culture_detail_$index"} }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                                <div class="flex items-center justify-end toggle-details">
                                    <h2 class="text-sm font-bold text-cyan-500 toggle-text mr-1">もっと見る</h2>
                                    <svg class="w-5 h-5 text-cyan-500 arrow-down" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                    <svg class="w-5 h-5 text-cyan-500 arrow-up hidden" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 15l7-7 7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>

        {{-- 企業データ（右側） --}}
        <div class="w-full lg:w-1/4">
            <div class="lg:pt-2"></div>
            <div class="lg:mt-16 lg:mb-3"></div>
            <section class="py-2 sm:py-2 md:py-4 lg:py-20">
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden sticky top-24">
                    <div class="px-4 py-3 bg-gray-100 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-gray-700">企業データ</h3>
                        <a href="{{ route('companies.edit', $company) }}"
                            class="inline-flex items-center text-xs text-cyan-500 hover:text-cyan-600 transition duration-150 ease-in-out">
                            <svg class="mr-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            追加・編集する
                        </a>
                    </div>
                    <div class="p-3 space-y-4">
                        {{-- @if ($company['company_mission']) --}}
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500">ミッション</p>
                                <p class="text-xs text-gray-700">{{ $company['company_mission'] }}</p>
                            </div>
                        </div>
                        {{-- @endif --}}

                        {{-- @if ($company['company_vision']) --}}
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500">ビジョン</p>
                                <p class="text-xs text-gray-700">{{ $company['company_vision'] }}</p>
                            </div>
                        </div>
                        {{-- @endif --}}

                        {{-- @if ($company['company_values']) --}}
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 mt-1">
                                <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500">バリュー</p>
                                <p class="text-xs text-gray-700">{{ $company['company_values'] }}</p>
                            </div>
                        </div>
                        {{-- @endif --}}

                        @if ($company['business_summary'])
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 mt-1">
                                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">事業概要</p>
                                    <p class="text-xs text-gray-700">
                                        {{ str_replace(["\r\n", "\r", "\n"], '　', e($company['business_summary'])) }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if ($company['company_url'])
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">ウェブサイト</p>
                                    <a href="{{ $company['company_url'] }}" target="_blank"
                                        rel="noopener noreferrer"
                                        class="text-xs text-cyan-600 hover:text-cyan-800 transition duration-150 ease-in-out">{{ $company['company_url'] }}</a>
                                </div>
                            </div>
                        @endif

                        @if ($company['location'])
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">所在地</p>
                                    <p class="text-xs text-gray-700">{{ $company['location'] }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($company['employee_number'])
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">従業員数</p>
                                    <p class="text-xs text-gray-700">
                                        {{ number_format($company['employee_number']) }} 人
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if ($company['date_of_establishment'])
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">設立年</p>
                                    <p class="text-xs text-gray-700">
                                        {{ \Carbon\Carbon::parse($company['date_of_establishment'])->format('Y') }} 年
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if ($company['capital_stock'])
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">資本金</p>
                                    <p class="text-xs text-gray-700">
                                        {{ number_format($company['capital_stock'] / 1000000) }}
                                        百万円</p>
                                </div>
                            </div>
                        @endif

                        @if ($company['representative_name'])
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">代表者</p>
                                    <p class="text-xs text-gray-700">{{ $company['representative_name'] }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($company['industry'])
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">業界</p>
                                    <p class="text-xs text-gray-700">{{ $company['industry'] }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($company['listing_status'])
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">上場区分</p>
                                    <p class="text-xs text-gray-700">{{ $company['listing_status'] }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
    @include('layouts.footer')

    {{-- モーダル --}}
    @if (session('showShareModal'))
    <div id="shareModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center">
        <div class="relative mx-auto p-8 border w-11/12 max-w-md shadow-lg rounded-lg bg-white text-center">
            <h3 class="text-xl font-bold text-cyan-600 mb-4">ご登録ありがとうございます</h3>
            <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                また一つ､働きがい転職につながりました！<br>
                お友達にもご紹介いただけると嬉しいです。
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <button id="closeModal"
                    class="w-full sm:w-auto bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-full transition duration-300 ease-in-out">
                    閉じる
                </button>
                <a href="https://twitter.com/intent/tweet?text={{ urlencode(session('companyName', '') . 'の企業カルチャーを登録しました！ #就活 #転職 #企業文化') }}&url={{ urlencode(route('home')) }}"
                    target="_blank"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-2 bg-cyan-500 hover:bg-cyan-600 text-white font-semibold rounded-full transition duration-300 ease-in-out">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z">
                        </path>
                    </svg>
                    シェアする
                </a>
            </div>
        </div>
    </div>
    @endif


    {{-- スクリプト --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script id="decidingFactorsData" type="application/json">{!! json_encode($decidingFactorsData) !!}</script>
    @vite(['resources/js/company-chart.js'])
    @vite(['resources/js/company-show.js'])
    @vite(['resources/js/after-post-modal.js'])