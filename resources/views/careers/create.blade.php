@include('layouts.header')

<section class="lg:py-24 md:py-12 sm:py-4 relative">
    <div class="max-w-3xl lg:w-1/2 px-4 md:px-5 lg:px-5 mx-auto">
        <div class="w-full flex-col justify-center items-center lg:gap-14 md:gap-10 gap-8 inline-flex">
            <div class="w-full flex-col justify-center items-center gap-6 flex">
                <h4 class="text-gray-900 text-xl font-semibold leading-loose self-start">基本情報の登録</h4>

                <div class="w-full justify-center items-center gap-8 flex sm:flex-row flex-col">
                    <form method="POST" action="{{ route('careers.store') }}" class="w-full">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <!-- 基本情報 -->
                        <div class="w-full justify-start items-start mb-6 gap-8 flex sm:flex-row flex-col">
                            <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                                <label for="last_name"
                                    class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                                    姓
                                    <x-required-mark />
                                </label>
                                <input type="text" id="last_name" name="last_name" required
                                    class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="山田">
                            </div>
                            <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                                <label for="first_name"
                                    class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                                    名
                                    <x-required-mark />
                                </label>
                                <input type="text" id="first_name" name="first_name" required
                                    class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="太郎">
                            </div>
                        </div>

                        <div class="w-full justify-start items-start mb-6 gap-8 flex sm:flex-row flex-col">
                            <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                                <label for="last_name_kana"
                                    class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                                    セイ
                                    <x-required-mark />
                                </label>
                                <input type="text" id="last_name_kana" name="last_name_kana" required
                                    class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="ヤマダ">
                            </div>
                            <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                                <label for="first_name_kana"
                                    class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                                    メイ
                                    <x-required-mark />
                                </label>
                                <input type="text" id="first_name_kana" name="first_name_kana" required
                                    class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="タロウ">
                            </div>
                        </div>

                        <!-- 生年月日 -->
                        <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
                            <label for="birth_date"
                                class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                                生年月日
                                <x-required-mark />
                            </label>
                            <input type="date" id="birth_date" name="birth_date" required
                                class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>


                        <!-- 性別 -->
                        <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
                            <label for="gender"
                                class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                                性別
                                <x-required-mark />
                            </label>
                            <div class="flex gap-4">
                                @foreach ($genders as $gender)
                                    <label>
                                        <input type="radio" name="gender_id" value="{{ $gender->id }}" required>
                                        {{ $gender->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- 都道府県 -->
                        <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
                            <label for="prefecture"
                                class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                                住所
                                <x-required-mark />
                            </label>
                            <select id="prefecture" name="prefecture_id" required
                                class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" selected disabled>選択してください</option>
                                @foreach ($prefectures as $prefecture)
                                    <option value="{{ $prefecture->id }}">{{ $prefecture->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- 現在のキャリア -->
                        <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
                            <label for="career_status"
                                class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                                現在のキャリア
                                <x-required-mark />
                            </label>
                            <div class="flex gap-4">
                                @foreach ($careerStatuses as $status)
                                    <label>
                                        <input type="radio" name="career_status_id" value="{{ $status->id }}"
                                            required>
                                        {{ $status->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- 社会人・その他の場合の追加フィールド -->
                        <div id="working-fields" style="display: none;">
                            <!-- 業種 -->
                            <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
                                <label for="industry"
                                    class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                                    現在の業界
                                    <x-required-mark />
                                </label>
                                <select id="industry" name="current_industry_id" required
                                    class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="" selected disabled>選択してください</option>
                                    @foreach ($industries as $industry)
                                        <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- 職種（大カテゴリー） -->
                            <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
                                <label for="job_category"
                                    class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                                    現在の職種（大カテゴリー）
                                    <x-required-mark />
                                </label>
                                <select id="job_category" name="current_job_category_id" required
                                    class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="" selected disabled>選択してください</option>
                                    @foreach ($jobCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        class="w-2/3 focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="" selected disabled>選択してください</option>
                                        <!-- 大カテゴリー選択後にJavaScriptで動的に追加 -->
                                    </select>
                                    <!-- 経験年数 -->
                                    <select id="job_years" name="current_job_years_id" required
                                        class="w-1/3 focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="" selected disabled>経験年数</option>
                                        @foreach ($jobYears as $jobYear)
                                            <option value="{{ $jobYear->id }}">{{ $jobYear->name }}</option>
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
                                    class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="" selected disabled>選択してください</option>
                                    @foreach ($annualIncomes as $income)
                                        <option value="{{ $income->id }}">{{ $income->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- 転職の意欲 -->
                            <div class="w-full justify-start items-start mb-6 gap-8 flex sm:flex-row flex-col">
                                <div class="w-full justify-start items-start gap-8 flex sm:flex-row flex-col">
                                    <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                                        <label for="job_change_motivation"
                                            class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                                            転職の意欲
                                            <x-required-mark />
                                        </label>
                                        <select id="job_change_motivation" name="job_change_motivation_id" required
                                            class="w-full focus:outline-none text-gray-900 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="" selected disabled>選択してください</option>
                                            @foreach ($jobChangeMotivations as $motivation)
                                                <option value="{{ $motivation->id }}">{{ $motivation->name }}
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
                                            class="w-full focus:outline-none text-gray-900 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                            <option value="" selected disabled>選択してください</option>
                                            @foreach ($sideJobMotivations as $motivation)
                                                <option value="{{ $motivation->id }}">{{ $motivation->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                    class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-sm font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="" selected disabled>選択してください</option>
                                    @foreach ($collegeTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
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
                                <input type="text" id="college_name" name="college_name" required
                                    class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-sm font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <!-- 学部 -->
                            <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
                                <label for="college_faculty"
                                    class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                                    学部
                                </label>
                                <input type="text" id="college_faculty" name="college_faculty"
                                    class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-sm font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <!-- 学科 -->
                            <div class="w-full flex-col justify-start items-start mb-6 gap-1.5 flex">
                                <label for="college_department"
                                    class="flex gap-1 items-center text-gray-600 text-sm font-medium leading-relaxed">
                                    学科
                                </label>
                                <input type="text" id="college_department" name="college_department"
                                    class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-sm font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
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
                                        class="w-3/5 focus:outline-none text-gray-900 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="" selected disabled>年</option>
                                        @for ($year = date('Y'); $year <= date('Y') + 6; $year++)
                                            <option value="{{ $year }}">{{ $year }}年</option>
                                        @endfor
                                    </select>
                                    <select id="graduation_month" name="graduation_month" required
                                        class="w-2/5 focus:outline-none text-gray-900 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="" selected disabled>月</option>
                                        @for ($month = 1; $month <= 12; $month++)
                                            <option value="{{ $month }}">{{ $month }}月</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center mt-8">
                            <x-primary-button class="justify-center py-3 text-lg">
                                {{ __('送信') }}
                            </x-primary-button>
                        </div>
                    </form>

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
                                    studentInputs.forEach(input => input.setAttribute('required', ''));
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
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
