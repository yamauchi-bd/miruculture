@php
    use Illuminate\Support\Str;
@endphp

@include('layouts.navigation')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-1 md:py-2 lg:py-16">
    <div
        class="lg:py-12 flex flex-col justify-center gap-x-16 gap-y-5 xl:gap-28 lg:flex-row lg:justify-between mx-auto max-w-full">
        <div class="w-full lg:w-3/4">
            <div class="w-full flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-900">
                    {{ $company->company_name }}
                </h2>
                <a href="{{ route('posts.create', ['corporate_number' => $company->corporate_number]) }}"
                    class='block w-1/4 py-3 px-4 text-sm bg-cyan-500 text-white rounded-lg border border-solid border-gray-700 shadow-md cursor-pointer font-semibold text-center transition-all duration-300 ease-in-out hover:bg-cyan-700'>
                    入社エントリ を投稿する
                </a>
            </div>

            <section class="py-12 mt-1">
                <div class="mx-auto max-w-7xl">
                    @foreach ($posts as $post)
                        <div class="post-container group bg-white border border-solid border-gray-200 rounded-lg px-8 py-4 mb-6 transition-all duration-300 hover:border-cyan-500 hover:shadow-lg relative flex flex-col cursor-pointer transform hover:-translate-y-1" data-post-id="{{ $post->id }}">

                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="grid flex-grow">
                                    <h5 class="text-sm text-gray-700 font-medium">
                                        {{ $post->start_year ?? '◯◯' }}年
                                        {{ $post->entry_type ?? '未設定' }}（{{ $post->status ?? '未設定' }}）</h5>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs leading-6 text-gray-500">
                                            {{ $post->jobCategory->name ?? '職種未設定' }} ＞
                                            {{ $post->jobSubcategory->name ?? '未設定' }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            投稿日: {{ $post->created_at->format('Y年m月d日') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <hr class="mt-2 mb-4 border-gray-200">

                    <div class="flex-grow">
                    <h2 class="text-sm text-gray-900 mb-4">「{{ $company->company_name }}」への入社の決め手</h2>
                    @if ($post->decidingFactors && $post->decidingFactors->isNotEmpty())
                        @foreach ($post->decidingFactors->take(3) as $index => $factor)
                            <div class="mb-6">
                                <div class="flex items-center mb-4">
                                    <p class="text-base font-bold text-gray-900">
                                        【{{ $index + 1 }}位】{{ $factor->factor ?? '未設定' }}</p>
                                    <div class="flex items-center ml-6">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= ($factor->satisfaction ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}"
                                                viewBox="0 0 20 20" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <div class="ml-2">
                                    <p class="text-sm font-semibold text-gray-900 tracking-wide">-詳細-</p>
                                    <p class="text-sm text-gray-900 factor-summary mb-2 tracking-wide">{{ Str::limit($factor->detail, 50) }}</p>
                                    <p class="text-sm text-gray-900 factor-full hidden mb-4 tracking-wide">{{ $factor->detail }}</p>
                                    
                                    <p class="text-sm font-semibold text-gray-900 satisfaction-reason hidden tracking-wide">-満足度-</p>
                                    <p class="text-sm text-gray-900 satisfaction-reason hidden tracking-wide">{{ $factor->satisfaction_reason }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-500">入社の決め手が登録されていません。</p>
                    @endif
                </div>
                <div class="flex items-center justify-end toggle-details">
                    <h2 class="text-sm font-bold text-cyan-500 toggle-text mr-1">もっと見る</h2>
                    <svg class="w-5 h-5 text-cyan-500 arrow-down" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <svg class="w-5 h-5 text-cyan-500 arrow-up hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </div>
                <div class="post-details hidden mt-4">
                    <!-- 詳細情報がここに表示されます -->
                </div>
            </div>
        @endforeach
    </div>
</section>
        </div>

        <div class="w-full lg:w-1/4">

            {{-- 企業データ --}}
            <section class="py-24">
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <div class="px-4 py-3 bg-gray-100 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-gray-800">企業データ</h3>
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
                        @if ($company->company_mission)
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
                                    <p class="text-xs text-gray-900">{{ $company->company_mission }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($company->company_vision)
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
                                    <p class="text-xs font-medium text-gray-500 pb-2">ビジョン</p>
                                    <p class="text-xs text-gray-900">{{ $company->company_vision }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($company->company_values)
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
                                    <p class="text-xs font-medium text-gray-500 pb-2">バリュー</p>
                                    <p class="text-xs text-gray-900">{{ $company->company_values }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($company->business_summary)
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
                                    <p class="text-xs font-medium text-gray-500 pb-2">事業概要</p>
                                    <p class="text-xs text-gray-900">
                                        {{ str_replace(["\r\n", "\r", "\n"], '　', e($company->business_summary)) }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($company->company_url)
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">ウェブサイト</p>
                                    <a href="{{ $company->company_url }}" target="_blank" rel="noopener noreferrer"
                                        class="text-xs text-cyan-600 hover:text-cyan-800 transition duration-150 ease-in-out">{{ $company->company_url }}</a>
                                </div>
                            </div>
                        @endif

                        @if ($company->location)
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
                                    <p class="text-xs text-gray-900">{{ $company->location }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($company->employee_number)
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
                                    <p class="text-xs text-gray-900">{{ number_format($company->employee_number) }} 人
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if ($company->date_of_establishment)
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
                                    <p class="text-xs text-gray-900">
                                        {{ \Carbon\Carbon::parse($company->date_of_establishment)->format('Y') }} 年</p>
                                </div>
                            </div>
                        @endif

                        @if ($company->capital_stock)
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
                                    <p class="text-xs text-gray-900">
                                        {{ number_format($company->capital_stock / 1000000) }}
                                        百万円</p>
                                </div>
                            </div>
                        @endif

                        @if ($company->representative_name)
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
                                    <p class="text-xs text-gray-900">{{ $company->representative_name }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($company->industry)
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
                                    <p class="text-xs text-gray-900">{{ $company->industry->name }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($company->listing_status)
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
                                    <p class="text-xs text-gray-900">{{ $company->listing_status }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>


    </div>
</div>

@include('layouts.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const postContainers = document.querySelectorAll('.post-container');
        
        postContainers.forEach(container => {
            const toggleButton = container.querySelector('.toggle-details');
            const detailsSection = container.querySelector('.post-details');
            const arrowDown = container.querySelector('.arrow-down');
            const arrowUp = container.querySelector('.arrow-up');
            const summaries = container.querySelectorAll('.factor-summary');
            const fulls = container.querySelectorAll('.factor-full');
            const satisfactionReasons = container.querySelectorAll('.satisfaction-reason');
            const toggleText = container.querySelector('.toggle-text');
            
            toggleButton.addEventListener('click', function(e) {
                e.stopPropagation();
                
                if (detailsSection.classList.contains('hidden')) {
                    // 詳細を表示
                    detailsSection.classList.remove('hidden');
                    arrowDown.classList.add('hidden');
                    arrowUp.classList.remove('hidden');
                    summaries.forEach(summary => summary.classList.add('hidden'));
                    fulls.forEach(full => full.classList.remove('hidden'));
                    satisfactionReasons.forEach(reason => reason.classList.remove('hidden'));
                    toggleText.textContent = '閉じる';
                } else {
                    // 詳細を非表示
                    detailsSection.classList.add('hidden');
                    arrowDown.classList.remove('hidden');
                    arrowUp.classList.add('hidden');
                    summaries.forEach(summary => summary.classList.remove('hidden'));
                    fulls.forEach(full => full.classList.add('hidden'));
                    satisfactionReasons.forEach(reason => reason.classList.add('hidden'));
                    toggleText.textContent = 'もっと見る';
                }
            });
            
            container.addEventListener('click', function() {
                toggleButton.click();
            });
        });
    });
    </script>
