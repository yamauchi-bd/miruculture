<header>
    <h2 class="text-lg font-bold text-gray-900 mb-4 sm:mb-6">
        {{ __('キャリア情報') }}
    </h2>
</header>

<form method="POST" action="{{ route('careers.store') }}" class="mt-4 sm:mt-6 space-y-4 sm:space-y-6">
    @csrf
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    <!-- 基本情報 -->
    <div class="w-full flex flex-col sm:flex-row sm:gap-4">
        <div class="w-full mb-4 sm:mb-0">
            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                姓
                <x-required-mark />
            </label>
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full h-10 sm:h-11"
                :value="old('last_name')" required />
        </div>
        <div class="w-full">
            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                名
                <x-required-mark />
            </label>
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full h-10 sm:h-11"
                :value="old('first_name')" required />
        </div>
    </div>

    <div class="w-full flex flex-col sm:flex-row sm:gap-4">
        <div class="w-full mb-4 sm:mb-0">
            <label for="last_name_kana" class="block text-sm font-medium text-gray-700 mb-1">
                セイ
                <x-required-mark />
            </label>
            <x-text-input id="last_name_kana" name="last_name_kana" type="text"
                class="mt-1 block w-full h-10 sm:h-11" :value="old('last_name_kana')" required />
        </div>
        <div class="w-full">
            <label for="first_name_kana" class="block text-sm font-medium text-gray-700 mb-1">
                メイ
                <x-required-mark />
            </label>
            <x-text-input id="first_name_kana" name="first_name_kana" type="text"
                class="mt-1 block w-full h-10 sm:h-11" :value="old('first_name_kana')" required />
        </div>
    </div>

    <!-- 生年月日 -->
    <div class="w-full">
        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">
            生年月日
            <x-required-mark />
        </label>
        <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full h-10 sm:h-11"
            :value="old('birth_date')" required />
    </div>

    <!-- 性別 -->
    <div class="w-full">
        <label class="block text-sm font-medium text-gray-700 mb-1">
            性別
            <x-required-mark />
        </label>
        <div class="flex flex-wrap gap-4">
            @foreach ($genders as $gender)
                <label class="inline-flex items-center">
                    <input type="radio" name="gender_id" value="{{ $gender->id }}" class="form-radio h-4 w-4"
                        required>
                    <span class="ml-2">{{ $gender->name }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <!-- 都道府県 -->
    <div class="w-full">
        <label for="prefecture" class="block text-sm font-medium text-gray-700 mb-1">
            住所
            <x-required-mark />
        </label>
        <select id="prefecture" name="prefecture_id" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-10 sm:h-11">
            <option value="" selected disabled>選択してください</option>
            @foreach ($prefectures as $prefecture)
                <option value="{{ $prefecture->id }}" {{ old('prefecture_id') == $prefecture->id ? 'selected' : '' }}>
                    {{ $prefecture->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- 現在のキャリア -->
    <div class="w-full">
        <label class="block text-sm font-medium text-gray-700 mb-1">
            現在のキャリア
            <x-required-mark />
        </label>
        <div class="flex flex-wrap gap-4">
            @foreach ($careerStatuses as $status)
                <label class="inline-flex items-center">
                    <input type="radio" name="career_status_id" value="{{ $status->id }}" class="form-radio h-4 w-4"
                        required>
                    <span class="ml-2">{{ $status->name }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <!-- 社会人・その他の場合の追加フィールド -->
    <div id="working-fields" style="display: none;">
        <!-- 業種 -->
        <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
            <label for="industry" class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                現在の業界
                <x-required-mark />
            </label>
            <select id="industry" name="current_industry_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-10">
                <option value="" selected disabled>選択してください</option>
                @foreach ($industries as $industry)
                    <option value="{{ $industry->id }}"
                        {{ old('current_industry_id') == $industry->id ? 'selected' : '' }}>
                        {{ $industry->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- 職種（大カテゴリー） -->
        <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
            <label for="job_category" class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                現在の職種（大カテゴリー）
                <x-required-mark />
            </label>
            <select id="job_category" name="current_job_category_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-10">
                <option value="" selected disabled>選択してください</option>
                @foreach ($jobCategories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('current_job_category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- 職種（小カテゴリー） -->
        <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
            <label for="job_subcategory"
                class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                現在の職種（小カテゴリー）
                <x-required-mark />
            </label>
            <div class="w-full flex gap-4">
                <select id="job_subcategory" name="current_job_subcategory_id" required
                    class="w-2/3 mt-1 block rounded-md border-gray-300 shadow-sm h-10">
                    <option value="" selected disabled>選択してください</option>
                    <!-- 大カテゴリー選択後にJavaScriptで動的に追加 -->
                </select>
                <!-- 経験年数 -->
                <select id="job_years" name="current_job_years_id" required
                    class="w-1/3 mt-1 block rounded-md border-gray-300 shadow-sm h-10">
                    <option value="" selected disabled>経験年数</option>
                    @foreach ($jobYears as $jobYear)
                        <option value="{{ $jobYear->id }}"
                            {{ old('current_job_years_id') == $jobYear->id ? 'selected' : '' }}>
                            {{ $jobYear->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- 年収 -->
        <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
            <label for="annual_income"
                class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                現在の年収
                <x-required-mark />
            </label>
            <select id="annual_income" name="annual_income_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-10">
                <option value="" selected disabled>選択してください</option>
                @foreach ($annualIncomes as $income)
                    <option value="{{ $income->id }}"
                        {{ old('annual_income_id') == $income->id ? 'selected' : '' }}>
                        {{ $income->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- 転職の意欲 -->
        <div class="w-full justify-start items-start mb-6 gap-6 flex sm:flex-row flex-col">
            <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                <label for="job_change_motivation"
                    class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                    転職の意欲
                    <x-required-mark />
                </label>
                <select id="job_change_motivation" name="job_change_motivation_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-10">
                    <option value="" selected disabled>選択してください</option>
                    @foreach ($jobChangeMotivations as $motivation)
                        <option value="{{ $motivation->id }}"
                            {{ old('job_change_motivation_id') == $motivation->id ? 'selected' : '' }}>
                            {{ $motivation->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- 副業の意欲 -->
            <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                <label for="side_job_motivation"
                    class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                    副業の意欲
                    <x-required-mark />
                </label>
                <select id="side_job_motivation" name="side_job_motivation_id" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-10">
                    <option value="" selected disabled>選択してください</option>
                    @foreach ($sideJobMotivations as $motivation)
                        <option value="{{ $motivation->id }}"
                            {{ old('side_job_motivation_id') == $motivation->id ? 'selected' : '' }}>
                            {{ $motivation->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- 学生の場合の追加フィールド -->
    <div id="student-fields" style="display: none;">
        <!-- 学校タイプ -->
        <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
            <label for="college_type"
                class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                学校タイプ
                <x-required-mark />
            </label>
            <select id="college_type" name="college_type_id" required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-10">
                <option value="" selected disabled>選択してください</option>
                @foreach ($collegeTypes as $type)
                    <option value="{{ $type->id }}" {{ old('college_type_id') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- 学校名 -->
        <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
            <label for="college_name"
                class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                学校名
                <x-required-mark />
            </label>
            <x-text-input id="college_name" name="college_name" type="text"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-10" :value="old('college_name')" required />
        </div>

        <!-- 学部 -->
        <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
            <label for="college_faculty"
                class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                学部
            </label>
            <x-text-input id="college_faculty" name="college_faculty" type="text"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-10" :value="old('college_faculty')"
                :required="false" />
        </div>

        <!-- 学科 -->
        <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
            <label for="college_department"
                class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                学科
            </label>
            <x-text-input id="college_department" name="college_department" type="text"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm h-10" :value="old('college_department')"
                :required="false" />
        </div>

        <!-- 卒業予定日 -->
        <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
            <label for="graduation_schedule"
                class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                卒業予定
                <x-required-mark />
            </label>
            <div class="w-1/2 flex gap-2">
                <select id="graduation_year" name="graduation_year" required
                    class="w-3/5 mt-1 block rounded-md border-gray-300 shadow-sm h-10">
                    <option value="" selected disabled>年</option>
                    @for ($year = date('Y'); $year <= date('Y') + 6; $year++)
                        <option value="{{ $year }}" {{ old('graduation_year') == $year ? 'selected' : '' }}>
                            {{ $year }}年</option>
                    @endfor
                </select>
                <select id="graduation_month" name="graduation_month" required
                    class="w-2/5 mt-1 block rounded-md border-gray-300 shadow-sm h-10">
                    <option value="" selected disabled>月</option>
                    @for ($month = 1; $month <= 12; $month++)
                        <option value="{{ $month }}"
                            {{ old('graduation_month') == $month ? 'selected' : '' }}>{{ $month }}月</option>
                    @endfor
                </select>
            </div>
        </div>
    </div>

    <div class="flex justify-end mt-8">
        <x-primary-button class="justify-center py-3 text-lg">
            {{ __('登録する') }}
        </x-primary-button>
    </div>
</form>

<style>
    @media (max-width: 640px) {
        .space-y-4> :not([hidden])~ :not([hidden]) {
            --tw-space-y-reverse: 0;
            margin-top: calc(1rem * calc(1 - var(--tw-space-y-reverse)));
            margin-bottom: calc(1rem * var(--tw-space-y-reverse));
        }

        select,
        input[type="date"] {
            height: 2.5rem;
        }
    }
</style>

<script>
    // 現在のキャリア選択に応じてフィールドの表示/非表示を切り替える
    let currentModal = null;
    document.querySelectorAll('input[name="career_status_id"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const workingFields = document.getElementById('working-fields');
            const workingInputs = workingFields.querySelectorAll('input, select');
            const studentFields = document.getElementById('student-fields');
            const studentInputs = studentFields.querySelectorAll('input, select');

            if (this.value === '1' || this.value === '3') { // 社会人またはその他
                workingFields.style.display = 'block';
                studentFields.style.display = 'none';
                workingInputs.forEach(input => input.setAttribute('required', ''));
                studentInputs.forEach(input => input.removeAttribute('required'));
            } else if (this.value === '2') { // 学生
                workingFields.style.display = 'none';
                studentFields.style.display = 'block';
                workingInputs.forEach(input => input.removeAttribute('required'));
                studentInputs.forEach(input => {
                    if (input.id !== 'college_faculty' && input.id !== 'college_department') {
                        input.setAttribute('required', '');
                    }
                });
            } else {
                workingFields.style.display = 'none';
                studentFields.style.display = 'none';
                workingInputs.forEach(input => input.removeAttribute('required'));
                studentInputs.forEach(input => input.removeAttribute('required'));
            }
        });
    });

    // 職種大カテゴリー選択時に小カテゴリーを動的に更新
    document.getElementById('job_category').addEventListener('change', function() {
        const subCategorySelect = document.getElementById('job_subcategory');
        subCategorySelect.innerHTML = '<option value="">選択してください</option>';

        const selectedCategoryId = this.value;
        if (selectedCategoryId) {
            const subCategories = {!! $jobCategories->pluck('children', 'id') !!};
            subCategories[selectedCategoryId].forEach(subCategory => {
                const option = document.createElement('option');
                option.value = subCategory.id;
                option.textContent = subCategory.name;
                subCategorySelect.appendChild(option);
            });
        }
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        const careerStatus = document.querySelector('input[name="career_status_id"]:checked');
        if (careerStatus && careerStatus.value === '2') {
            const facultyInput = document.getElementById('college_faculty');
            const departmentInput = document.getElementById('college_department');
            facultyInput.removeAttribute('required');
            departmentInput.removeAttribute('required');
        }
    });
</script>
