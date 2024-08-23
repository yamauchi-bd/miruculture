<form method="POST" action="{{ route('career.update', $career->id) }}">
    @csrf
    @method('PUT')

    <div>
        <x-input-label for="last_name" :value="__('姓')" />
        <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $career->last_name)" required />
    </div>

    <div class="mt-4">
        <x-input-label for="first_name" :value="__('名')" />
        <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $career->first_name)" required />
    </div>

    <div class="mt-4">
        <x-input-label for="last_name_kana" :value="__('姓（カナ）')" />
        <x-text-input id="last_name_kana" name="last_name_kana" type="text" class="mt-1 block w-full" :value="old('last_name_kana', $career->last_name_kana)" required />
    </div>

    <div class="mt-4">
        <x-input-label for="first_name_kana" :value="__('名（カナ）')" />
        <x-text-input id="first_name_kana" name="first_name_kana" type="text" class="mt-1 block w-full" :value="old('first_name_kana', $career->first_name_kana)" required />
    </div>

    {{-- <div class="mt-4">
        <x-input-label for="birth_date" :value="__('生年月日')" />
        <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date', $career->birth_date)" required />
    </div>

    <div class="mt-4">
        <x-input-label for="gender_id" :value="__('性別')" />
        <x-select id="gender_id" name="gender_id" class="mt-1 block w-full" required>
            @foreach($genders as $gender)
                <option value="{{ $gender->id }}" {{ old('gender_id', $career->gender_id) == $gender->id ? 'selected' : '' }}>
                    {{ $gender->name }}
                </option>
            @endforeach
        </x-select>
    </div>

    <div class="mt-4">
        <x-input-label for="prefecture_id" :value="__('都道府県')" />
        <x-select id="prefecture_id" name="prefecture_id" class="mt-1 block w-full" required>
            @foreach($prefectures as $prefecture)
                <option value="{{ $prefecture->id }}" {{ old('prefecture_id', $career->prefecture_id) == $prefecture->id ? 'selected' : '' }}>
                    {{ $prefecture->name }}
                </option>
            @endforeach
        </x-select>
    </div>

    <div class="mt-4">
        <x-input-label for="career_status_id" :value="__('キャリアステータス')" />
        <x-select id="career_status_id" name="career_status_id" class="mt-1 block w-full" required>
            @foreach($careerStatuses as $status)
                <option value="{{ $status->id }}" {{ old('career_status_id', $career->career_status_id) == $status->id ? 'selected' : '' }}>
                    {{ $status->name }}
                </option>
            @endforeach
        </x-select>
    </div>

    <!-- 社会人または その他 の場合の追加フィールド -->
    <div id="working-fields" class="mt-4" style="display: none;">
        <!-- job_change_motivation_id, side_job_motivation_id, current_industry_id, 
             current_job_category_id, current_job_subcategory_id, current_job_years_id, 
             annual_income_id のフィールドをここに追加 -->
    </div>

    <!-- 学生の場合の追加フィールド -->
    <div id="student-fields" class="mt-4" style="display: none;">
        <!-- college_type_id, college_name, college_faculty, college_department, 
             graduation_years, graduation_month のフィールドをここに追加 -->
    </div> --}}

    <div class="mt-6">
        <x-primary-button>{{ __('更新') }}</x-primary-button>
    </div>
</form>

<script>
    // キャリアステータスに応じて表示するフィールドを切り替える
    document.getElementById('career_status_id').addEventListener('change', function() {
        var workingFields = document.getElementById('working-fields');
        var studentFields = document.getElementById('student-fields');
        
        if (this.value == '1' || this.value == '9') {  // 社会人または その他
            workingFields.style.display = 'block';
            studentFields.style.display = 'none';
        } else if (this.value == '2') {  // 学生
            workingFields.style.display = 'none';
            studentFields.style.display = 'block';
        } else {
            workingFields.style.display = 'none';
            studentFields.style.display = 'none';
        }
    });
</script>