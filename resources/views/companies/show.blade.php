@include('layouts.navigation')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 md:py-16 lg:py-24">
    <div
        class="py-10 lg:py-16 flex flex-col justify-center gap-x-16 gap-y-5 xl:gap-28 lg:flex-row lg:justify-between mx-auto max-w-full">
        <div class="w-full">
            <section class="relative">
                <div class="w-full">
                    <h2 class="font-manrope font-semibold text-2xl leading-9 text-black ml-6 mb-6">
                        {{ $company->company_name }}
                    <a href="{{ route('companies.edit', $company) }}" class="inline-flex items-center px-4 py-2 text-xs font-medium rounded-md text-gray-500">
                        <svg class="mr-2 -ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        企業データを追加・編集する
                    </a>
                </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
                        <div class="bg-white p-4 md:p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-1 h-8 bg-cyan-500 mr-3"></div>
                                <h3 class="text-xl font-semibold text-black">ミッション</h3>
                            </div>
                            <p class="text-gray-800">{{ $company->company_mission }}</p>
                        </div>
                        <div class="bg-white p-4 md:p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-1 h-8 bg-cyan-500 mr-3"></div>
                                <h3 class="text-xl font-semibold text-black">ビジョン</h3>
                            </div>
                            <p class="text-gray-800">{{ $company->company_vision }}</p>
                        </div>
                        <div class="bg-white p-4 md:p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-1 h-8 bg-cyan-500 mr-3"></div>
                                <h3 class="text-xl font-semibold text-black">バリュー</h3>
                            </div>
                            <p class="text-gray-800">{{ $company->company_values }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="flex justify-center mt-12 mb-8">
                <a href="{{ route('posts.create', ['corporate_number' => $company->corporate_number]) }}"
                    class='py-4 px-20 text-lg bg-cyan-500 text-white rounded-xl cursor-pointer font-semibold text-center shadow-lg transition-all duration-300 ease-in-out bg-gradient-to-tl hover:from-red-400 hover:to-cyan-500 hover:shadow-lg transform hover:scale-105'>
                    入社の決め手を投稿する
                    <i class="far fa-plus-square fa-lg ml-2"></i>
                </a>
            </div>


            <section class="py-12">
                <div class="mx-auto max-w-7xl">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($posts as $post)
                            <div
                                class="group bg-white border border-solid border-gray-300 rounded-2xl p-6 transition-all duration-500 hover:border-cyan-600 shadow-md hover:shadow-lg relative pb-24">
                                <h6 class="text-gray-900 text-sm font-medium mb-3">
                                    「{{ $company->company_name }}」への入社の決め手</h6>
                                @if ($post->decidingFactors && $post->decidingFactors->isNotEmpty())
                                    @foreach ($post->decidingFactors->take(3) as $index => $factor)
                                        <div class="mb-4 last:mb-0">
                                            <div class="flex items-center justify-between">
                                                <span
                                                    class="text-lg font-bold text-gray-700">{{ $index + 1 }}位：{{ $factor->factor ?? '未設定' }}</span>
                                                <div class="flex items-center">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= ($factor->satisfaction ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}"
                                                            viewBox="0 0 18 17" fill="currentColor"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z">
                                                            </path>
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                            <button type="button"
                                                class="text-sm font-medium text-cyan-600 hover:text-cyan-500 mt-2 show-details"
                                                data-target="post-{{ $post->id }}-factor-{{ $index + 1 }}">
                                                詳細を表示
                                            </button>
                                            <div id="post-{{ $post->id }}-factor-{{ $index + 1 }}"
                                                class="hidden mt-2 text-base text-gray-700 space-y-4">
                                                <p><strong>＜決め手の詳細＞</strong><br> {{ $factor->detail ?? '詳細なし' }}
                                                </p>
                                                <p><strong>＜満足度の理由＞</strong><br>
                                                    {{ $factor->satisfaction_reason ?? '理由なし' }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-sm text-gray-500">入社の決め手が登録されていません。</p>
                                @endif
                                <div class="absolute bottom-6 left-6 right-6 flex items-center gap-5">
                                    <div class="w-12 h-12 flex items-center justify-center bg-yellow-400 rounded-full">
                                        <i class="fa-solid fa-otter fa-2x text-gray-600"></i>
                                    </div>
                                    <div class="grid">
                                        <h5 class="text-gray-700 font-medium transition-all duration-500">
                                            {{ $post->start_year ?? '◯◯' }}年
                                            {{ $post->entry_type ?? '未設定' }}（{{ $post->status ?? '未設定' }}）</h5>
                                        <span class="text-sm leading-6 text-gray-500">
                                            {{ $post->jobCategory->name ?? '職種未設定' }} ＞
                                            {{ $post->jobSubcategory->name ?? '未設定' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- モーダル -->
                    <div id="detailModal" class="fixed z-10 inset-0 overflow-y-auto hidden"
                        aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div
                            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
                            </div>
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                aria-hidden="true">&#8203;</span>
                            <div
                                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                詳細情報
                                            </h3>
                                            <div class="mt-2">
                                                <p id="modalContent" class="text-sm text-gray-500"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="button"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                        id="closeModal">
                                        閉じる
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

{{-- 企業情報 --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-12 text-center">企業データ</h2>
        <div class="bg-white shadow-lg rounded-3xl overflow-hidden">
            <div class="px-6 py-8 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800">{{ $company->company_name }}
                    <a href="{{ route('companies.edit', $company) }}" class="inline-flex items-center px-4 py-2 text-xs font-medium rounded-md text-gray-500">
                        <svg class="mr-2 -ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        企業データを追加・編集する
                    </a>
                </h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                @if ($company->business_summary)
                    <div class="flex items-start space-x-4 col-span-full">
                        <div class="flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 pb-2">事業概要</p>
                            <p class="text-base text-gray-900">
                                {{ str_replace(["\r\n", "\r", "\n"], '　', e($company->business_summary)) }}</p>
                        </div>
                    </div>
                @endif
                @if ($company->company_url)
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">ウェブサイト</p>
                            <a href="{{ $company->company_url }}"
                                class="text-base text-cyan-600 hover:text-cyan-800 transition duration-150 ease-in-out">{{ $company->company_url }}</a>
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
                            <p class="text-sm font-medium text-gray-500">所在地</p>
                            <p class="text-base text-gray-900">{{ $company->location }}</p>
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
                            <p class="text-sm font-medium text-gray-500">従業員数</p>
                            <p class="text-base text-gray-900">{{ number_format($company->employee_number) }} 人</p>
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
                            <p class="text-sm font-medium text-gray-500">設立年</p>
                            <p class="text-base text-gray-900">
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
                            <p class="text-sm font-medium text-gray-500">資本金</p>
                            <p class="text-base text-gray-900">{{ number_format($company->capital_stock / 1000000) }}
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
                            <p class="text-sm font-medium text-gray-500">代表者</p>
                            <p class="text-base text-gray-900">{{ $company->representative_name }}</p>
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
                            <p class="text-sm font-medium text-gray-500">業界</p>
                            <p class="text-base text-gray-900">{{ $company->industry->name }}</p>
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
                            <p class="text-sm font-medium text-gray-500">上場区分</p>
                            <p class="text-base text-gray-900">{{ $company->listing_status }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/pagedone@1.1.2/src/js/pagedone.js"></script>
@vite(['resources/js/posts-modal.js'])
