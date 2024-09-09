<header>
    <h2 class="text-lg font-bold text-gray-900">
        {{ __('キャリア情報') }}
    </h2>
</header>

<form id="career-form" method="POST" action="{{ route('careers.update', $career->id) }}" class="mt-6 space-y-6">
    @csrf
    @method('PUT')

    <div class="flex space-x-4">
        <div class="flex-1">
            <x-input-label for="last_name" :value="__('姓')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $career->last_name)" required />
        </div>

        <div class="flex-1">
            <x-input-label for="first_name" :value="__('名')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $career->first_name)" required />
        </div>
    </div>

    <div class="flex space-x-4 mt-4">
        <div class="flex-1">
            <x-input-label for="last_name_kana" :value="__('セイ')" />
            <x-text-input id="last_name_kana" name="last_name_kana" type="text" class="mt-1 block w-full" :value="old('last_name_kana', $career->last_name_kana)" required pattern="^[ァ-ヶー]+$" title="カタカナで入力ください" />
        </div>
    
        <div class="flex-1">
            <x-input-label for="first_name_kana" :value="__('メイ')" />
            <x-text-input id="first_name_kana" name="first_name_kana" type="text" class="mt-1 block w-full" :value="old('first_name_kana', $career->first_name_kana)" required pattern="^[ァ-ヶー]+$" title="カタカナで入力ください" />
        </div>
    </div>

    <div class="flex space-x-4 mt-4">
        <div class="flex-1">
            <x-input-label for="birth_date" :value="__('生年月日')" />
            <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date', $career->birth_date->format('Y-m-d'))" required max="{{ date('Y-m-d') }}" />
        </div>

        <div class="flex-1">
            <x-input-label for="gender_id" :value="__('性別')" />
            <select id="gender_id" name="gender_id" class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm" required>
                @foreach ($genders as $gender)
                    <option value="{{ $gender->id }}" {{ old('gender_id', $career->gender_id) == $gender->id ? 'selected' : '' }}>
                        {{ $gender->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex space-x-4 mt-4">
        <div class="flex-1">
            <x-input-label for="prefecture_id" :value="__('都道府県')" />
            <select id="prefecture_id" name="prefecture_id" class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm" required>
                @foreach ($prefectures as $prefecture)
                    <option value="{{ $prefecture->id }}" {{ old('prefecture_id', $career->prefecture_id) == $prefecture->id ? 'selected' : '' }}>
                        {{ $prefecture->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex-1">
            <x-input-label for="career_status_id" :value="__('現在のキャリア')" />
            <select id="career_status_id" name="career_status_id" class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm" required>
                @foreach ($careerStatuses as $status)
                    <option value="{{ $status->id }}" {{ old('career_status_id', $career->career_status_id) == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="working-fields" class="mt-4" style="{{ in_array($career->career_status_id, [1, 9]) ? '' : 'display: none;' }}">
        
            <div class="flex-1">
                <x-input-label for="current_industry_id" :value="__('現在の業界')" />
                <select id="current_industry_id" name="current_industry_id" class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm">
                    @foreach ($industries as $industry)
                        <option value="{{ $industry->id }}" {{ old('current_industry_id', $career->current_industry_id) == $industry->id ? 'selected' : '' }}>
                            {{ $industry->name }}
                        </option>
                    @endforeach
                </select>
            </div>

        <div class="flex space-x-4 mt-4">
            <div class="flex-1">
                <x-input-label for="current_job_category_id" :value="__('現在の職種')" />
                <select id="current_job_category_id" name="current_job_category_id"
                    class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm">
                    @foreach ($jobCategories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('current_job_category_id', $career->current_job_category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1">
                <x-input-label for="current_job_subcategory_id" :value="__('現在の職種（小カテゴリー）')" />
                <select id="current_job_subcategory_id" name="current_job_subcategory_id"
                    class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm">
                    <!-- 小カテゴリーのオプションはJavaScriptで動的に更新されます -->
                </select>
            </div>
        </div>

        <div class="flex space-x-4 mt-4">
            <div class="flex-1">
                <x-input-label for="current_job_years_id" :value="__('経験年数')" />
                <select id="current_job_years_id" name="current_job_years_id" class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm">
                    @foreach ($jobYears as $jobYear)
                        <option value="{{ $jobYear->id }}" {{ old('current_job_years_id', $career->current_job_years_id) == $jobYear->id ? 'selected' : '' }}>
                            {{ $jobYear->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1">
                <x-input-label for="annual_income_id" :value="__('年収')" />
                <select id="annual_income_id" name="annual_income_id" class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm">
                    @foreach ($annualIncomes as $income)
                        <option value="{{ $income->id }}" {{ old('annual_income_id', $career->annual_income_id) == $income->id ? 'selected' : '' }}>
                            {{ $income->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex space-x-4 mt-4">
            <div class="flex-1">
                <x-input-label for="job_change_motivation_id" :value="__('転職の意欲')" />
                <select id="job_change_motivation_id" name="job_change_motivation_id"
                    class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm">
                    @foreach ($jobChangeMotivations as $motivation)
                        <option value="{{ $motivation->id }}"
                            {{ old('job_change_motivation_id', $career->job_change_motivation_id) == $motivation->id ? 'selected' : '' }}>
                            {{ $motivation->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1">
                <x-input-label for="side_job_motivation_id" :value="__('副業の意欲')" />
                <select id="side_job_motivation_id" name="side_job_motivation_id"
                    class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm">
                    @foreach ($sideJobMotivations as $motivation)
                        <option value="{{ $motivation->id }}"
                            {{ old('side_job_motivation_id', $career->side_job_motivation_id) == $motivation->id ? 'selected' : '' }}>
                            {{ $motivation->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div id="student-fields" class="mt-4" style="{{ $career->career_status_id == 2 ? '' : 'display: none;' }}">
        <div>
            <x-input-label for="college_type_id" :value="__('学校タイプ')" />
            <select id="college_type_id" name="college_type_id"
                class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm">
                @foreach ($collegeTypes as $type)
                    <option value="{{ $type->id }}"
                        {{ old('college_type_id', $career->college_type_id) == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <x-input-label for="college_name" :value="__('学校名')" />
            <x-text-input id="college_name" name="college_name" type="text" class="mt-1 block w-full"
                :value="old('college_name', $career->college_name)" />
        </div>

        <div class="mt-4">
            <x-input-label for="college_faculty" :value="__('学部')" />
            <x-text-input id="college_faculty" name="college_faculty" type="text" class="mt-1 block w-full"
                :value="old('college_faculty', $career->college_faculty)" />
        </div>
    
        <div class="mt-4">
            <x-input-label for="college_department" :value="__('学科')" />
            <x-text-input id="college_department" name="college_department" type="text" class="mt-1 block w-full"
                :value="old('college_department', $career->college_department)" />
        </div>

        <div class="flex space-x-4 mt-4">
            <div class="flex-1">
                <x-input-label for="graduation_year" :value="__('卒業予定年')" />
                <select id="graduation_year" name="graduation_year" class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm">
                    @for ($year = date('Y'); $year <= date('Y') + 10; $year++)
                        <option value="{{ $year }}" {{ old('graduation_year', $career->graduation_year) == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endfor
                </select>
            </div>
    
            <div class="flex-1">
                <x-input-label for="graduation_month" :value="__('卒業予定月')" />
                <select id="graduation_month" name="graduation_month" class="mt-1 block w-full border-gray-300 focus:border-cyan-500 focus:ring-cyan-500 rounded-md shadow-sm">
                    @for ($month = 1; $month <= 12; $month++)
                        <option value="{{ $month }}" {{ old('graduation_month', $career->graduation_month) == $month ? 'selected' : '' }}>
                            {{ $month }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>


    </div>

    <div class="mt-6 flex justify-end">
        <x-primary-button type="submit">{{ __('更新する') }}</x-primary-button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var careerStatusSelect = document.getElementById('career_status_id');
        var workingFields = document.getElementById('working-fields');
        var studentFields = document.getElementById('student-fields');

        function updateFields() {
            var selectedStatus = careerStatusSelect.value;
            console.log('Selected status:', selectedStatus);

            if (selectedStatus === '1' || selectedStatus === '9') {
                console.log('Showing working fields');
                workingFields.style.display = 'block';
                studentFields.style.display = 'none';
                enableFields(workingFields);
                disableFields(studentFields);
            } else if (selectedStatus === '2') {
                console.log('Showing student fields');
                workingFields.style.display = 'none';
                studentFields.style.display = 'block';
                disableFields(workingFields);
                enableFields(studentFields);
            } else {
                console.log('Hiding all fields');
                workingFields.style.display = 'none';
                studentFields.style.display = 'none';
                disableFields(workingFields);
                disableFields(studentFields);
            }

            console.log('Working fields display:', workingFields.style.display);
            console.log('Student fields display:', studentFields.style.display);
        }

        function enableFields(container) {
            var fields = container.querySelectorAll('input, select, textarea');
            fields.forEach(function(field) {
                field.disabled = false;
            });
        }

        function disableFields(container) {
            var fields = container.querySelectorAll('input, select, textarea');
            fields.forEach(function(field) {
                field.disabled = true;
            });
        }

        careerStatusSelect.addEventListener('change', function() {
            console.log('Career status changed');
            updateFields();
        });

        // 初期状態を設定
        console.log('Setting initial state');
        updateFields();

        var jobCategorySelect = document.getElementById('current_job_category_id');
        var jobSubcategorySelect = document.getElementById('current_job_subcategory_id');

        // 職種カテゴリーと小カテゴリーの関連データ
        var jobCategories = @json($jobCategories);

        function updateJobSubcategories() {
            var selectedCategoryId = jobCategorySelect.value;
            var selectedCategory = jobCategories.find(category => category.id == selectedCategoryId);

            // 小カテゴリーの選択肢をクリア
            jobSubcategorySelect.innerHTML = '';

            if (selectedCategory && selectedCategory.children) {
                selectedCategory.children.forEach(function(subcategory) {
                    var option = document.createElement('option');
                    option.value = subcategory.id;
                    option.textContent = subcategory.name;
                    jobSubcategorySelect.appendChild(option);
                });
            }

            // 現在選択されている小カテゴリーを設定
            var currentSubcategoryId = '{{ old('current_job_subcategory_id', $career->current_job_subcategory_id) }}';
            if (currentSubcategoryId) {
                jobSubcategorySelect.value = currentSubcategoryId;
            }
        }

        jobCategorySelect.addEventListener('change', updateJobSubcategories);

        // 初期状態を設定
        updateJobSubcategories();
    });
</script>

<script>
$(document).ready(function() {
    $('#career-form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    window.location.href = response.redirect;
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    // エラーメッセージを表示する処理
                } else {
                    alert('エラーが発生しました。もう一度お試しください。');
                }
            }
        });
    });
});
</script>
