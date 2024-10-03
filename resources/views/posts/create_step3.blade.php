@include('layouts.navigation')

<div class="max-w-xl mx-auto my-4 border-b-2 pb-4 sm:py-8 lg:pt-24">
    <div class="flex pb-2">
        <div class="flex-1 flex flex-col items-center">
            <div class="w-10 h-10 bg-cyan-500 mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-white text-center w-full">1</span>
            </div>
        </div>

        <div class="w-1/6 align-center items-center align-middle content-center flex">
            <div class="w-full bg-cyan-500 rounded items-center align-middle align-center flex-1">
                <div class="bg-cyan-500 text-xs leading-none py-1 text-center text-white rounded w-full"></div>
            </div>
        </div>

        <div class="flex-1 flex flex-col items-center">
            <div class="w-10 h-10 bg-cyan-500 mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-white text-center w-full">2</span>
            </div>
        </div>

        <div class="w-1/6 align-center items-center align-middle content-center flex">
            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                <div id="progress-bar-2" class="bg-cyan-500 text-xs leading-none py-1 text-center text-white rounded"
                    style="width: 100%"></div>
            </div>
        </div>

        <div class="flex-1 flex flex-col items-center">
            <div class="w-10 h-10 bg-cyan-500 mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-white text-center w-full">3</span>
            </div>
        </div>
    </div>

    <div class="flex text-xs sm:text-sm content-center text-center mt-2">
        <div class="w-1/4">
            企業･在籍情報&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="w-1/2">
            入社の決め手
        </div>
        <div class="w-1/4">
            &nbsp;&nbsp;&nbsp;&nbsp;社風･雰囲気
        </div>
    </div>
</div>

<div class="max-w-7xl mt-12 px-4 md:px-5 md:w-3/5 lg:w-2/5 lg:px-5 mx-auto">
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div id="section-3">
            <h2 class="mt-4 mb-6 text-gray-700 font-bold">社風・雰囲気 🏢</h2>

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
                            <label class="flex gap-1 mr-8 items-center text-gray-800 text-sm font-semibold">
                                {{ $item['name'] }}
                                <x-required-mark />
                            </label>
                            <span class="text-sm text-gray-600">
                                A：{{ $item['a'] }} &nbsp;&nbsp; ←→ &nbsp;&nbsp; B：{{ $item['b'] }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between space-x-2">
                            @php
                                $options = ['A寄り', 'ややA寄り', 'どちらとも', 'ややB寄り', 'B寄り'];
                            @endphp
                            @foreach ($options as $value => $label)
                                <label class="flex-1">
                                    <input type="radio" name="culture_{{ $index }}" value="{{ $value + 1 }}"
                                        class="sr-only peer" required>
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
                    社風について、具体的な例や詳細な説明があれば回答ください。<br>
                    すべてに回答しなくても構いませんが、合計で300文字以上の回答が必要です。
                </p>
                @foreach ($cultureItems as $index => $item)
                    <div class="mb-12">
                        <label for="culture_detail_{{ $index }}"
                            class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ $item['name'] }}について
                        </label>
                        <textarea id="culture_detail_{{ $index }}" name="culture_detail_{{ $index }}" rows="3"
                            class="shadow-sm focus:ring-cyan-500 focus:border-cyan-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                            {{-- placeholder="{{ $item['name'] }}について、具体的な例や詳細な説明を記入してください。" --}}></textarea>
                        <div class="mt-2 text-right text-xs text-gray-500">
                            合計文字数: <span id="culture_detail_count_{{ $index }}">0</span>/300文字以上
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-center mt-16 space-x-4">
                <a href="{{ route('posts.create.step2') }}" id="back-button"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-3 px-8 rounded-full transform transition duration-300 ease-in-out hover:scale-105 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke="gray"></path>
                    </svg>
                    <span>戻る</span>
                </a>
                <button type="submit" id="submit-button"
                    class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-3 px-8 rounded-full transform transition duration-300 ease-in-out hover:scale-105 flex items-center">
                    <span class="mr-1">投稿する</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" stroke="white"></path>
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>



<div class="mt-20"></div>
@include('layouts.footer')
@vite(['resources/js/posts-step3.js'])
