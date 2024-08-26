@include('layouts.navigation')

<div class="max-w-xl mx-auto my-4 border-b-2 pb-4 sm:py-8 lg:py-24">
    <div class="flex pb-3">
        <div class="flex-1 flex flex-col items-center">
            <div class="w-10 h-10 bg-cyan-500 mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-white text-center w-full"><i class="fa fa-check w-full fill-current white"></i>1</span>
            </div>
        </div>

        <div class="w-1/6 align-center items-center align-middle content-center flex">
            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                <div class="bg-cyan-500 text-xs leading-none py-1 text-center text-white rounded"
                    style="width: 20%"></div>
            </div>
        </div>

        <div class="flex-1 flex flex-col items-center">
            <div
                class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-grey-darker text-center w-full">2</span>
            </div>
        </div>

        <div class="w-1/6 align-center items-center align-middle content-center flex">
            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                <div class="bg-cyan-500 text-xs leading-none py-1 text-center text-white rounded"
                    style="width: 0%"></div>
            </div>
        </div>

        <div class="flex-1 flex flex-col items-center">
            <div
                class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-grey-darker text-center w-full">3</span>
            </div>
        </div>
    </div>

    <div class="flex text-xs content-center text-center mt-2">
        <div class="w-1/4">
            在籍情報の入力
        </div>
        <div class="w-1/2">
            決め手の投稿
        </div>
        <div class="w-1/4">
            投稿の完了
        </div>
    </div>
</div>

<div class="max-w-7xl px-4 md:px-5 lg:w-2/5 lg:px-5 mx-auto">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="company_name" class="form-label">会社名</label>
            <input type="text" class="form-control" id="company_name" name="company_name"
                value="{{ old('company_name') }}" required>
        </div>
        <div class="w-full flex items-center border border-gray-300 rounded-md">
            <input type="text"
                class="block w-full px-4 py-2 text-base font-normal text-gray-900 bg-white rounded-l-md placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="気になる企業を検索する..." required="">
            <button
                class="px-3 py-3 bg-cyan-500 text-white text-sm font-medium rounded-md transition-all hover:bg-indigo-700">
                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17 17L21 21" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="my-path"></path>
                    <path d="M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="#ffffff" stroke-width="3" class="my-path"></path>
                </svg>
            </button>
        </div>

        <div class="mb-3">
            <label for="corporate_number" class="form-label">法人番号</label>
            <input type="text" class="form-control" id="corporate_number" name="corporate_number"
                value="{{ old('corporate_number') }}" required>
        </div>

        <div class="mb-3">
            <label for="employment_type" class="form-label">雇用形態</label>
            <select class="form-select" id="employment_type" name="employment_type" required>
                <option value="">選択してください</option>
                <option value="正社員" {{ old('employment_type') == '正社員' ? 'selected' : '' }}>正社員</option>
                <option value="契約社員" {{ old('employment_type') == '契約社員' ? 'selected' : '' }}>契約社員</option>
                <option value="その他" {{ old('employment_type') == 'その他' ? 'selected' : '' }}>その他</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="entry_type" class="form-label">入社形態</label>
            <select class="form-select" id="entry_type" name="entry_type" required>
                <option value="">選択してください</option>
                <option value="新卒" {{ old('entry_type') == '新卒' ? 'selected' : '' }}>新卒</option>
                <option value="中途" {{ old('entry_type') == '中途' ? 'selected' : '' }}>中途</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">在籍状況</label>
            <select class="form-select" id="status" name="status" required>
                <option value="">選択してください</option>
                <option value="在籍" {{ old('status') == '在籍' ? 'selected' : '' }}>在籍</option>
                <option value="退職" {{ old('status') == '退職' ? 'selected' : '' }}>退職</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">入社日</label>
            <input type="date" class="form-control" id="start_date" name="start_date"
                value="{{ old('start_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">退職日（退職している場合）</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
        </div>

        <div class="mb-3">
            <label for="job_category_id" class="form-label">職種</label>
            <select class="form-select" id="job_category_id" name="job_category_id" required>
                <option value="">選択してください</option>
                @foreach ($jobCategories as $category)
                    <optgroup label="{{ $category->name }}">
                        @foreach ($category->children as $subCategory)
                            <option value="{{ $subCategory->id }}"
                                {{ old('job_category_id') == $subCategory->id ? 'selected' : '' }}>
                                {{ $subCategory->name }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>

        <h2 class="mt-4 mb-3">入社の決め手</h2>

        @for ($i = 1; $i <= 3; $i++)
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">決め手 {{ $i }}</h3>

                    <div class="mb-3">
                        <label for="factor_{{ $i }}" class="form-label">要因</label>
                        <select class="form-select" id="factor_{{ $i }}"
                            name="factor_{{ $i }}" {{ $i == 1 ? 'required' : '' }}>
                            <option value="">選択してください</option>
                            @foreach (['企業ビジョン', '事業内容', '仲間', '成長環境', '働き方', '給与', 'その他'] as $factor)
                                <option value="{{ $factor }}"
                                    {{ old("factor_$i") == $factor ? 'selected' : '' }}>{{ $factor }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="factor_{{ $i }}_detail" class="form-label">詳細</label>
                        <textarea class="form-control" id="factor_{{ $i }}_detail" name="factor_{{ $i }}_detail"
                            rows="3" {{ $i == 1 ? 'required' : '' }}>{{ old("factor_{$i}_detail") }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="factor_{{ $i }}_satisfaction" class="form-label">満足度</label>
                        <select class="form-select" id="factor_{{ $i }}_satisfaction"
                            name="factor_{{ $i }}_satisfaction" {{ $i == 1 ? 'required' : '' }}>
                            <option value="">選択してください</option>
                            @for ($j = 1; $j <= 5; $j++)
                                <option value="{{ $j }}"
                                    {{ old("factor_{$i}_satisfaction") == $j ? 'selected' : '' }}>{{ $j }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="factor_{{ $i }}_satisfaction_reason" class="form-label">満足度の理由</label>
                        <textarea class="form-control" id="factor_{{ $i }}_satisfaction_reason"
                            name="factor_{{ $i }}_satisfaction_reason" rows="3" {{ $i == 1 ? 'required' : '' }}>{{ old("factor_{$i}_satisfaction_reason") }}</textarea>
                    </div>
                </div>
            </div>
        @endfor

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">投稿する</button>
        </div>
    </form>
</div>

<script>
    // 2番目と3番目の入社の決め手を任意にするためのJavaScript
    document.addEventListener('DOMContentLoaded', function() {
        for (let i = 2; i <= 3; i++) {
            const factor = document.getElementById(`factor_${i}`);
            const detail = document.getElementById(`factor_${i}_detail`);
            const satisfaction = document.getElementById(`factor_${i}_satisfaction`);
            const reason = document.getElementById(`factor_${i}_satisfaction_reason`);

            factor.addEventListener('change', function() {
                const isSelected = this.value !== '';
                detail.required = isSelected;
                satisfaction.required = isSelected;
                reason.required = isSelected;
            });
        }
    });
</script>
