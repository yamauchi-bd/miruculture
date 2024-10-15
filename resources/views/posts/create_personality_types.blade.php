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
    <h2>16タイプ性格診断(MBTI)の選択</h2>
    <form method="POST" action="{{ route('personality_types.store', $enrollmentRecord) }}">
        @csrf
        <div class="form-group">
            <label for="type">あなたの性格タイプを選択してください：</label>
            <select name="type" id="type" class="form-control" required>
                <option value="">選択してください</option>
                @foreach($sixteenTypes as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">次へ</button>
    </form>
</div>

<div class="mt-20"></div>
@include('layouts.footer')