{{-- @extends('layouts.app') --}}
<div class="container">
    <h1 class="mb-4">新しい投稿を作成</h1>

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
            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="corporate_number" class="form-label">法人番号</label>
            <input type="text" class="form-control" id="corporate_number" name="corporate_number" value="{{ old('corporate_number') }}" required>
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
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">退職日（退職している場合）</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
        </div>

        <div class="mb-3">
            <label for="job_category_id" class="form-label">職種</label>
            <select class="form-select" id="job_category_id" name="job_category_id" required>
                <option value="">選択してください</option>
                @foreach($jobCategories as $category)
                    <optgroup label="{{ $category->name }}">
                        @foreach($category->children as $subCategory)
                            <option value="{{ $subCategory->id }}" {{ old('job_category_id') == $subCategory->id ? 'selected' : '' }}>
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
                        <select class="form-select" id="factor_{{ $i }}" name="factor_{{ $i }}" {{ $i == 1 ? 'required' : '' }}>
                            <option value="">選択してください</option>
                            @foreach(['企業ビジョン', '事業内容', '仲間', '成長環境', '働き方', '給与', 'その他'] as $factor)
                                <option value="{{ $factor }}" {{ old("factor_$i") == $factor ? 'selected' : '' }}>{{ $factor }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="factor_{{ $i }}_detail" class="form-label">詳細</label>
                        <textarea class="form-control" id="factor_{{ $i }}_detail" name="factor_{{ $i }}_detail" rows="3" {{ $i == 1 ? 'required' : '' }}>{{ old("factor_{$i}_detail") }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="factor_{{ $i }}_satisfaction" class="form-label">満足度</label>
                        <select class="form-select" id="factor_{{ $i }}_satisfaction" name="factor_{{ $i }}_satisfaction" {{ $i == 1 ? 'required' : '' }}>
                            <option value="">選択してください</option>
                            @for ($j = 1; $j <= 5; $j++)
                                <option value="{{ $j }}" {{ old("factor_{$i}_satisfaction") == $j ? 'selected' : '' }}>{{ $j }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="factor_{{ $i }}_satisfaction_reason" class="form-label">満足度の理由</label>
                        <textarea class="form-control" id="factor_{{ $i }}_satisfaction_reason" name="factor_{{ $i }}_satisfaction_reason" rows="3" {{ $i == 1 ? 'required' : '' }}>{{ old("factor_{$i}_satisfaction_reason") }}</textarea>
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
