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
                    style="width: 30%"></div>
            </div>
        </div>

        <div class="flex-1 flex flex-col items-center">
            <div
                class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-gray-300 text-center w-full">3</span>
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
    <h2 class="mt-4 text-cyan-500 font-bold">▼ MBTI<span class="text-2xs">※</span>(16タイプ性格診断) を登録する</h2>
    <p class="text-2xs text-gray-500">※MBTIという表記を使用していますが、実際は16タイプ性格診断を指します。</p>
    <p class="mt-1 mb-10 text-sm text-gray-700 font-bold">
        無料で診断してみる 👉
        <a href="https://www.16personalities.com/ja/%E6%80%A7%E6%A0%BC%E8%A8%BA%E6%96%AD%E3%83%86%E3%82%B9%E3%83%88" target="_blank" rel="noopener noreferrer" class="text-blue-500 hover:text-blue-700 underline">
            https://16personalities.com
        </a>
    </p>

    <form method="POST" action="{{ route('personality_types.store', $enrollmentRecord) }}">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-emerald-100 p-4 rounded-lg">
                <h3 class="text-sm font-bold text-gray-700 mb-2">外交官</h3>
                @foreach(['INFP', 'INFJ', 'ENFP', 'ENFJ'] as $type)
                    <div class="mb-2 flex items-center">
                        <input type="radio" name="type" id="{{ $type }}" value="{{ $type }}" class="mr-2" required
                               {{ old('type', $formData['type'] ?? '') == $type ? 'checked' : '' }}>
                        <label for="{{ $type }}" class="flex-1 text-gray-700">{{ $sixteenTypes[$type] }}</label>
                    </div>
                @endforeach
            </div>
            <div class="bg-purple-100 p-4 rounded-lg">
                <h3 class="text-sm font-bold text-gray-700 mb-2">分析家</h3>
                @foreach(['INTP', 'INTJ', 'ENTP', 'ENTJ'] as $type)
                    <div class="mb-2 flex items-center">
                        <input type="radio" name="type" id="{{ $type }}" value="{{ $type }}" class="mr-2" required
                               {{ old('type', $formData['type'] ?? '') == $type ? 'checked' : '' }}>
                        <label for="{{ $type }}" class="flex-1 text-gray-700">{{ $sixteenTypes[$type] }}</label>
                    </div>
                @endforeach
            </div>
            <div class="bg-amber-100 p-4 rounded-lg">
                <h3 class="text-sm font-bold text-gray-700 mb-2">探検家</h3>
                @foreach(['ISTP', 'ISFP', 'ESTP', 'ESFP'] as $type)
                    <div class="mb-2 flex items-center">
                        <input type="radio" name="type" id="{{ $type }}" value="{{ $type }}" class="mr-2" required
                               {{ old('type', $formData['type'] ?? '') == $type ? 'checked' : '' }}>
                        <label for="{{ $type }}" class="flex-1 text-gray-700">{{ $sixteenTypes[$type] }}</label>
                    </div>
                @endforeach
            </div>
            <div class="bg-sky-100 p-4 rounded-lg">
                <h3 class="text-sm font-bold text-gray-700 mb-2">番人</h3>
                @foreach(['ISTJ', 'ISFJ', 'ESTJ', 'ESFJ'] as $type)
                    <div class="mb-2 flex items-center">
                        <input type="radio" name="type" id="{{ $type }}" value="{{ $type }}" class="mr-2" required
                               {{ old('type', $formData['type'] ?? '') == $type ? 'checked' : '' }}>
                        <label for="{{ $type }}" class="flex-1 text-gray-700">{{ $sixteenTypes[$type] }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex justify-center mt-16 space-x-4">
            <a href="{{ route('deciding_factors.create', ['enrollmentRecord' => $enrollmentRecord]) }}" id="skip-button"
                class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-3 px-8 rounded-full transform transition duration-300 ease-in-out hover:scale-105 flex items-center">
                <span>スキップ</span>
            </a>
            <button type="submit" id="next-button"
                class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-3 px-8 rounded-full transform transition duration-300 ease-in-out hover:scale-105 flex items-center">
                <span class="mr-1">{{ $isUpdate ? '更新する' : '登録する' }}</span>
            </button>
        </div>
    </form>
</div>

<div class="mt-20"></div>
@include('layouts.footer')
