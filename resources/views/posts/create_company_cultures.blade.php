@include('layouts.navigation')

<div class="max-w-xl mx-auto my-4 border-b-2 pb-4 sm:py-8 lg:pt-24">
    <div class="flex pb-2">
        <!-- ステップ1: 企業･在籍情報 -->
        <div class="flex-1 flex flex-col items-center">
            <div
                class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-gray-300 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
            </div>
        </div>

        <!-- ステップ2: 性格タイプ -->
        <div class="flex-1 flex flex-col items-center">
            <div id="step-2"
                class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-gray-300 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>

        <!-- ステップ3: 入社の決め手 -->
        <div class="flex-1 flex flex-col items-center">
            <div id="step-3"
                class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-gray-300 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>

        <!-- ステップ4: 社風･雰囲気 -->
        <div class="flex-1 flex flex-col items-center">
            <div id="step-4"
                class="w-10 h-10 bg-cyan-500 mx-auto rounded-full text-lg text-white flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
        </div>
    </div>

    <div class="flex text-xs sm:text-sm content-center text-center mt-2">
        <div class="w-1/4 text-gray-300 font-bold">
            企業･在籍情報
        </div>
        <div class="w-1/4 text-gray-300 font-bold">
            性格タイプ
        </div>
        <div class="w-1/4 text-gray-300 font-bold">
            入社の決め手
        </div>
        <div class="w-1/4 text-cyan-500 font-bold">
            社風･雰囲気
        </div>
    </div>
</div>

<div class="max-w-7xl mt-12 px-4 md:px-5 md:w-3/5 lg:w-2/5 lg:px-5 mx-auto">
    <form action="{{ route('company_cultures.store', $enrollmentRecord) }}" method="POST">
        @csrf

        <div id="section-3">
            <h2 class="mt-4 mb-6 text-cyan-500 font-bold">▼ 社風･雰囲気 を登録する</h2>

            @php
                $cultureItems = [
                    ['name' => '人間関係', 'a' => 'ドライ', 'b' => 'ウェット'],
                    ['name' => '業務スタイル', 'a' => 'ロジカル', 'b' => 'クリエイティブ'],
                    ['name' => '評価基準', 'a' => 'プロセス重視', 'b' => '結果重視'],
                    ['name' => '組織スタイル', 'a' => '個人プレー', 'b' => 'チームプレー'],
                    ['name' => '意思決定', 'a' => 'トップダウン', 'b' => 'ボトムアップ'],
                    ['name' => '行動スタイル', 'a' => '計画･確実性', 'b' => '実行･スピード'],
                    ['name' => '雰囲気', 'a' => 'モクモク･真面目', 'b' => 'ワイワイ･元気'],
                    ['name' => 'ワークライフ', 'a' => 'バランス重視', 'b' => 'ワーク重視'],
                ];
            @endphp

            <div class="space-y-14">
                @foreach ($cultureItems as $index => $item)
                    <div>
                        <div class="mb-6 flex items-center">
                            <label class="flex gap-1 mr-8 items-center text-gray-700 text-sm font-semibold">
                                {{ $item['name'] }}
                                <x-required-mark />
                            </label>
                            <span class="text-sm text-gray-700">
                                【A】{{ $item['a'] }}&nbsp;&nbsp;← →&nbsp;&nbsp;【B】{{ $item['b'] }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between space-x-2">
                            @php
                                $options = ['A寄り', 'ややA寄り', 'どちらとも', 'ややB寄り', 'B寄り'];
                            @endphp
                            @foreach ($options as $value => $label)
                                <label class="flex-1">
                                    <input type="radio" name="culture_{{ $index }}" value="{{ $value + 1 }}"
                                        class="sr-only peer" required
                                        {{ old("culture_$index", $formData["culture_$index"] ?? '') == $value + 1 ? 'checked' : '' }}>
                                    <div
                                        class="text-center py-1 border border-gray-300 rounded cursor-pointer transition-all duration-200 ease-in-out
                      peer-checked:bg-cyan-500 peer-checked:text-white peer-checked:border-cyan-500
                      hover:bg-gray-100">
                                        <span class="text-xs">{{ $label }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-20">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">自由記述 📝</h3>
                <p class="text-sm text-gray-600 mb-8">
                    社風について、具体的な例や説明があれば、ぜひとも回答お願いします！</p>
                @foreach ($cultureItems as $index => $item)
                    <div class="mb-6">
                        <label for="culture_detail_{{ $index }}"
                            class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ $item['name'] }}について
                        </label>
                        <textarea id="culture_detail_{{ $index }}" name="culture_detail_{{ $index }}" rows="3"
                            class="shadow-sm focus:ring-cyan-500 focus:border-cyan-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">{{ old("culture_detail_$index", $formData["culture_detail_$index"] ?? '') }}</textarea>
                        {{-- <div class="mt-2 text-right text-xs text-gray-500">
                            合計文字数: <span id="culture_detail_count_{{ $index }}">0</span>/200文字以上
                        </div> --}}
                    </div>
                @endforeach
            </div>

            <div class="flex justify-center mt-16 space-x-4">
                <a href="{{ route('company_cultures.skip', $enrollmentRecord) }}" id="skip-button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-3 px-8 rounded-full transform transition duration-300 ease-in-out hover:scale-105 flex items-center">
                    <span>スキップ</span>
                </a>
                <button type="submit" id="submit-button"
                    class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-3 px-8 rounded-full transform transition duration-300 ease-in-out hover:scale-105 flex items-center">
                    <span class="mr-1">{{ $isUpdate ? '更新する' : '登録する' }}</span>
                </button>
            </div>


    </form>
</div>



<div class="mt-20"></div>
@include('layouts.footer')
@vite(['resources/js/create-company-cultures.js'])
