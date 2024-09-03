@include('layouts.navigation')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 md:py-16 lg:py-24">
    <div
        class="py-10 lg:py-16 flex flex-col justify-center gap-x-16 gap-y-5 xl:gap-28 lg:flex-row lg:justify-between mx-auto max-w-full">
        <div class="w-full lg:w-3/4">
            <section class="relative">
                <div class="w-full lg:max-w-4xl max-md:px-3">
                    <h2 class="font-manrope font-semibold text-2xl leading-9 text-black mb-12">
                        {{ $company->company_name }}
                    </h2>

                    <p class="font-normal text-lg leading-8 text-gray-900 mb-8">
                        {{ $company->business_summary }}
                    </p>

                    <h3 class="font-manrope font-semibold text-xl leading-9 text-black mb-2">ミッション</h3>
                    <p class="font-normal text-lg leading-8 text-gray-900 mb-8">
                        {{ $company->company_mission }}
                    </p>

                    <h3 class="font-manrope font-semibold text-xl leading-9 text-black mb-2">ビジョン</h3>
                    <p class="font-normal text-lg leading-8 text-gray-900 mb-8">
                        {{ $company->company_vision }}
                    </p>

                    <h3 class="font-manrope font-semibold text-xl leading-9 text-black mb-2">バリュー</h3>
                    <p class="font-normal text-lg leading-8 text-gray-900 mb-8">
                        {{ $company->company_values }}
                    </p>
                </div>
            </section>


            <section class="py-12">
                <div class="mx-auto max-w-7xl">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($posts as $post)
                            <div
                                class="group bg-white border border-solid border-gray-300 rounded-2xl p-6 transition-all duration-500 hover:border-cyan-600 shadow-md hover:shadow-lg relative pb-24">
                                <h6 class="text-gray-900 text-sm font-medium mb-3">「社名」への入社の決め手</h6>
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

                    {{-- <div class="mt-10">
                            {{ $posts->links() }}
                        </div>

                    <!-- モーダル -->
                    {{-- <div id="detailModal" class="fixed z-10 inset-0 overflow-y-auto hidden"
                        aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div
                            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                aria-hidden="true"></div>
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
                </div> --}}
                </div>
            </section>



            <section class="py-12 lg:py-20 ">
                <div class="flex mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <a href="#"
                        class="border border-gray-300 shadow-sm rounded-full py-3.5 px-7 w-52 flex justify-center items-center text-gray-900 font-semibold mx-auto transition-all duration-300 hover:bg-gray-100">
                        企業名のトップへ</a>
                    <a href="{{ route('posts.create', ['company_id' => $company->id]) }}"
                        class="border border-gray-300 shadow-sm rounded-full py-3.5 px-7 w-52 flex justify-center items-center text-gray-900 font-semibold mx-auto transition-all duration-300 hover:bg-gray-100">
                        決め手を回答する</a>
                    <a href="#"
                        class="border border-gray-300 shadow-sm rounded-full py-3.5 px-7 w-52 flex justify-center items-center text-gray-900 font-semibold mx-auto transition-all duration-300 hover:bg-gray-100">
                        企業をフォローする</a>
                </div>
            </section>

        </div>




        <div class="w-full lg:w-1/4">
            <div>
                <a href="{{ route('posts.create', ['corporate_number' => $company->corporate_number]) }}"
                    class='block py-3 px-7 text-base bg-cyan-500 text-white rounded-xl cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 hover:bg-cyan-700'>決め手を回答する</a>
                <a href="#"
                    class='mt-4 block py-3 px-7 text-base border border-cyan-500 text-cyan-500 rounded-xl cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 hover:bg-cyan-100'>企業をフォローする</a>
            </div>

            <div class="mt-4 flex flex-col">
                <div class=" overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="img w-full mb-2">
                            <img src="https://pagedone.io/asset/uploads/1702355938.png" alt="Blog tailwind page">
                        </div>
                        <div class="overflow-hidden border border-gray-300">
                            <table class="min-w-full rounded-xl">
                                <tbody class="divide-y divide-gray-300">
                                    @if ($company->industry)
                                        <tr>
                                            <th
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                業界</th>
                                            <td
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                {{ $company->industry }}</td>
                                        </tr>
                                    @endif
                                    @if ($company->company_url)
                                        <tr>
                                            <th
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                URL</th>
                                            <td
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                <a href="{{ $company->company_url }}"
                                                    class="text-blue-500 hover:text-blue-700">{{ $company->company_url }}</a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($company->location)
                                        <tr>
                                            <th
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                所在地</th>
                                            <td
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                {{ $company->location }}</td>
                                        </tr>
                                    @endif
                                    @if ($company->employee_number)
                                        <tr>
                                            <th
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                従業員数</th>
                                            <td
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                {{ number_format($company->employee_number) }} 人</td>
                                        </tr>
                                    @endif
                                    @if ($company->date_of_establishment)
                                        <tr>
                                            <th
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                設立年</th>
                                            <td
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($company->date_of_establishment)->format('Y') }}
                                                年
                                            </td>
                                        </tr>
                                    @endif
                                    @if ($company->capital_stock)
                                        <tr>
                                            <th
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                資本金</th>
                                            <td
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                {{ number_format($company->capital_stock / 1000000) }} 百万円</td>
                                        </tr>
                                    @endif
                                    @if ($company->representative_name)
                                        <tr>
                                            <th
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                代表者</th>
                                            <td
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                {{ $company->representative_name }}</td>
                                        </tr>
                                    @endif
                                    @if ($company->listing_status)
                                        <tr>
                                            <th
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                上場区分</th>
                                            <td
                                                class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                {{ $company->listing_status }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@include('layouts.footer');

<script src="https://cdn.jsdelivr.net/npm/pagedone@1.1.2/src/js/pagedone.js"></script>
