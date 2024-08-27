@include('layouts.navigation')

<div class="max-w-xl mx-auto my-4 border-b-2 pb-4 sm:py-8 lg:pt-24">
    <div class="flex pb-2">
        <div class="flex-1 flex flex-col items-center">
            <div class="w-10 h-10 bg-cyan-500 mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-white text-center w-full"><i class="fa fa-check w-full fill-current white"></i>1</span>
            </div>
        </div>

        <div class="w-1/6 align-center items-center align-middle content-center flex">
            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                <div class="bg-cyan-500 text-xs leading-none py-1 text-center text-white rounded" style="width: 20%">
                </div>
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
                <div class="bg-cyan-500 text-xs leading-none py-1 text-center text-white rounded" style="width: 0%">
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-col items-center">
            <div
                class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-grey-darker text-center w-full">3</span>
            </div>
        </div>
    </div>

    <div class="flex text-xs sm:text-sm content-center text-center mt-2">
        <div class="w-1/4">
            在籍情報の入力&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="w-1/2">
            決め手の投稿
        </div>
        <div class="w-1/4">
            &nbsp;&nbsp;&nbsp;&nbsp;投稿の完了
        </div>
    </div>
</div>

<div class="max-w-7xl mt-12 px-4 md:px-5 md:w-3/5 lg:w-2/5 lg:px-5 mx-auto">

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

        <div class="mb-10">
            <label for="company_name"
                class="flex gap-1 mb-2 items-center text-gray-600 text-sm font-bold leading-relaxed">
                対象企業
                <x-required-mark />
            </label>

            <div class="flex">
                <input type="text" id="company_name" name="company_name"
                    class="block w-full px-4 py-2 border border-gray-300 text-base font-normal text-gray-900 bg-white rounded-l-md placeholder-gray-400 focus:outline-none focus:border-2 focus:border-cyan-500"
                    placeholder="投稿する企業を探す..." required>
                <button type="button" id="search_company"
                    class="px-3 py-2 bg-cyan-500 text-white text-sm font-bold rounded-r-md transition-all hover:bg-cyan-700">
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 17L21 21" stroke="#ffffff" stroke-width="3" stroke-linecap="round" class="my-path">
                        </path>
                        <path
                            d="M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                            stroke="#ffffff" stroke-width="3" class="my-path"></path>
                    </svg>
                </button>
            </div>
            <input type="hidden" id="corporate_number" name="corporate_number" value="">
        </div>

        <div class="mb-10">
            <label class="flex gap-1 mb-2 items-center text-gray-600 text-sm font-bold leading-relaxed">
                雇用形態
                <x-required-mark />
            </label>

            <div class="flex gap-12">
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" name="employment_type" value="正社員"
                        {{ old('employment_type') == '正社員' ? 'checked' : '' }} required>
                    <span class="ml-2">正社員</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" name="employment_type" value="契約社員"
                        {{ old('employment_type') == '契約社員' ? 'checked' : '' }}>
                    <span class="ml-2">契約社員</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" name="employment_type" value="その他"
                        {{ old('employment_type') == 'その他' ? 'checked' : '' }}>
                    <span class="ml-2">その他</span>
                </label>
            </div>
        </div>

        <div class="mb-10">
            <label class="flex gap-1 mb-2 items-center text-gray-600 text-sm font-bold leading-relaxed">
                入社形態
                <x-required-mark />
            </label>
            <div class="flex gap-8">
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" name="entry_type" value="新卒"
                        {{ old('entry_type') == '新卒' ? 'checked' : '' }} required>
                    <span class="ml-2">新卒入社</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" name="entry_type" value="中途"
                        {{ old('entry_type') == '中途' ? 'checked' : '' }}>
                    <span class="ml-2">中途入社</span>
                </label>
            </div>
        </div>

        <div class="mb-10">
            <label class="flex gap-1 mb-2 items-center text-gray-600 text-sm font-bold leading-relaxed">
                在籍状況
                <x-required-mark />
            </label>
            <div class="flex gap-12">
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" name="status" value="在籍中"
                        {{ old('status') == '在籍中' ? 'checked' : '' }} required>
                    <span class="ml-2">在籍中</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio" name="status" value="退職済み"
                        {{ old('status') == '退職済み' ? 'checked' : '' }}>
                    <span class="ml-2">退職済み</span>
                </label>
            </div>
        </div>

        <div class="mb-10">
            <label class="flex gap-1 mb-2 items-center text-gray-600 text-sm font-bold leading-relaxed">
                在籍期間
                <x-required-mark />
            </label>
            <div class="flex items-center">
                <select id="start_year" name="start_year"
                    class="h-10 w-1/3 px-4 border border-gray-300 text-base font-normal text-gray-900 bg-white rounded-md placeholder-gray-400 focus:outline-none focus:border-2 focus:border-cyan-500"
                    required>
                    <option value="" selected disabled>入社年</option>
                    @for ($year = date('Y'); $year >= date('Y') - 50; $year--)
                        <option value="{{ $year }}" {{ old('start_year') == $year ? 'selected' : '' }}>
                            {{ $year }}年</option>
                    @endfor
                </select>
                <span class="mx-2">〜</span>
                <select id="end_year" name="end_year"
                    class="h-10 w-1/3 px-4 border border-gray-300 text-base font-normal text-gray-900 bg-white rounded-md placeholder-gray-400 focus:outline-none focus:border-2 focus:border-cyan-500">
                    <option value="" selected disabled>退職年</option>
                    @for ($year = date('Y'); $year >= date('Y') - 50; $year--)
                        <option value="{{ $year }}" {{ old('end_year') == $year ? 'selected' : '' }}>
                            {{ $year }}年</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="mb-10">
            <label for="job_category_id"
                class="flex gap-1 mb-2 items-center text-gray-600 text-sm font-bold leading-relaxed">
                入社時の職種
                <x-required-mark />
            </label>
            <select id="job_category" name="current_job_category_id" required
                class="h-10 w-full px-4 border border-gray-300 text-base font-normal text-gray-900 bg-white rounded-md placeholder-gray-400 focus:outline-none focus:border-2 focus:border-cyan-500">
                <option value="" selected disabled>選択してください</option>
                @foreach ($jobCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-full flex-col justify-start items-start mb-10 gap-1.5 flex">
            <label for="job_subcategory"
                class="flex gap-1 mb-2 items-center text-gray-600 text-sm font-bold leading-relaxed">
                職種の詳しい内容
                <x-required-mark />
            </label>
            <div class="w-full flex gap-4">
                <select id="job_subcategory" name="current_job_subcategory_id" required
                    class="h-10 w-full px-4 border border-gray-300 text-base font-normal text-gray-900 bg-white rounded-md placeholder-gray-400 focus:outline-none focus:border-2 focus:border-cyan-500">
                    <option value="" selected disabled>選択してください</option>
                    <!-- 大カテゴリー選択後にJavaScriptで動的に追加 -->
                </select>
            </div>
        </div>

        <h2 class="mt-4 mb-3">入社の決め手</h2>

        <div id="deciding-factors">
            @for ($i = 1; $i <= 3; $i++)
                <div class="card mb-3 {{ $i > 1 ? 'hidden' : '' }}" id="factor-{{ $i }}">
                    <div class="card-body mb-10">
                        <h3 class="flex gap-1 mb-3 items-center text-gray-600 text-sm font-bold leading-relaxed">
                            {{ $i }} 位
                            <x-required-mark />
                        </h3>
                        <div class="justify-start mb-10 items-start gap-3 flex flex-wrap">
                            @foreach (['企業ビジョンへの共感', '革新的なビジネスモデル', '優秀で熱意のある仲間', '成長できる環境･チャンス', '柔軟な働き方･場所', '給与･報酬など', 'その他'] as $factor)
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio hidden deciding-factor"
                                        name="deciding_factor_{{ $i }}" value="{{ $factor }}"
                                        {{ old("deciding_factor_$i") == $factor ? 'checked' : '' }}>
                                    <span
                                        class="factor-label sm:w-fit w-full px-3 py-1.5 transition-all duration-300 rounded-full border cursor-pointer text-sm font-bold bg-white hover:bg-gray-100 text-gray-700 border-gray-300">
                                        {{ $factor }}
                                    </span>
                                </label>
                            @endforeach
                        </div>

                        <div class="mb-10">
                            <label for="factor_{{ $i }}_detail"
                                class="flex gap-1 mb-2 items-center text-gray-600 text-sm font-bold leading-relaxed">決め手についての詳細</label>
                            <textarea id="factor_{{ $i }}_detail" name="factor_{{ $i }}_detail"
                                class="block w-full px-4 py-2 border border-gray-300 text-base font-normal text-gray-900 bg-white rounded-md placeholder-gray-400 focus:outline-none focus:border-2 focus:border-cyan-500"
                                rows="3" {{ $i == 1 ? 'required' : '' }}>{{ old("factor_{$i}_detail") }}</textarea>
                        </div>

                        <div class="mb-10">
                            <label
                                class="flex gap-1 mb-2 items-center text-gray-600 text-sm font-bold leading-relaxed">
                                決め手についての満足度
                                <x-required-mark />
                            </label>
                            <div class="flex items-center">
                                <span class="text-sm text-gray-500">低い</span>
                                <div class="flex items-center mx-4">
                                    @for ($j = 1; $j <= 5; $j++)
                                        <label class="mx-1">
                                            <input type="radio" name="factor_{{ $i }}_satisfaction"
                                                value="{{ $j }}" class="hidden peer"
                                                {{ old("factor_{$i}_satisfaction") == $j ? 'checked' : '' }}
                                                {{ $i == 1 ? 'required' : '' }}>
                                            <svg class="w-8 h-8 fill-current text-gray-300 peer-checked:text-cyan-500 cursor-pointer"
                                                viewBox="0 0 24 24">
                                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                            </svg>
                                        </label>
                                    @endfor
                                </div>
                                <span class="text-sm text-gray-500">高い</span>
                            </div>
                        </div>

                        <div class="mb-10">
                            <label for="factor_{{ $i }}_satisfaction_reason"
                                class="flex gap-1 mb-2 items-center text-gray-600 text-sm font-bold leading-relaxed">
                                満足度の理由
                            </label>
                            <textarea id="factor_{{ $i }}_satisfaction_reason"
                                class="block w-full px-4 py-2 border border-gray-300 text-base font-normal text-gray-900 bg-white rounded-md placeholder-gray-400 focus:outline-none focus:border-2 focus:border-cyan-500"
                                name="factor_{{ $i }}_satisfaction_reason" rows="3" {{ $i == 1 ? 'required' : '' }}>{{ old("factor_{$i}_satisfaction_reason") }}</textarea>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

        <div class="flex justify-center mt-8" id="add-factor-button-container">
            <button type="button" id="add-factor-button" class="bg-gray-300 hover:bg-gray-400 text-sm text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                <span>他にも入社の決め手がある</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke-width="2"/>
                    <line x1="12" y1="7" x2="12" y2="17" stroke-width="2"/>
                    <line x1="7" y1="12" x2="17" y2="12" stroke-width="2"/>
                </svg>
            </button>
        </div>

            <div class="flex justify-center mt-16">
                <x-primary-button class="justify-center py-3 text-lg">
                    {{ __('投稿する') }}
                </x-primary-button>
            </div>
    </form>
</div>

<div class="mt-20"></div>
@include('layouts.footer')

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

    document.addEventListener('DOMContentLoaded', function() {
        const factorInputs = document.querySelectorAll('.deciding-factor');
        factorInputs.forEach(input => {
            input.addEventListener('change', function() {
                // 同じ名前のラジオボタングループ内のすべてのラベルをリセット
                document.querySelectorAll(`[name="${this.name}"] + .factor-label`).forEach(
                    label => {
                        label.classList.remove('bg-cyan-500', 'text-white',
                            'border-cyan-500');
                        label.classList.add('bg-white', 'hover:bg-gray-100',
                            'text-gray-700', 'border-gray-300');
                    });

                // 選択されたラジオボタンのラベルにスタイルを適用
                if (this.checked) {
                    const label = this.nextElementSibling;
                    label.classList.remove('bg-white', 'hover:bg-gray-100', 'text-gray-700',
                        'border-gray-300');
                    label.classList.add('bg-cyan-500', 'text-white', 'border-cyan-500');
                }
            });
        });
    });

    //満足度の星に色付け
    document.addEventListener('DOMContentLoaded', function() {
        const starContainers = document.querySelectorAll('.flex.items-center');
        starContainers.forEach(container => {
            const stars = container.querySelectorAll('svg');
            const inputs = container.querySelectorAll('input[type="radio"]');

            function colorStars(index) {
                stars.forEach((star, i) => {
                    if (i <= index) {
                        star.classList.add('text-cyan-500');
                        star.classList.remove('text-gray-300');
                    } else {
                        star.classList.remove('text-cyan-500');
                        star.classList.add('text-gray-300');
                    }
                });
            }

            inputs.forEach((input, index) => {
                input.addEventListener('change', () => {
                    colorStars(index);
                });
            });

            stars.forEach((star, index) => {
                star.addEventListener('mouseover', () => {
                    colorStars(index);
                });

                star.addEventListener('mouseout', () => {
                    const checkedInput = container.querySelector(
                        'input[type="radio"]:checked');
                    if (checkedInput) {
                        colorStars(Array.from(inputs).indexOf(checkedInput));
                    } else {
                        colorStars(-1);
                    }
                });

                star.addEventListener('click', () => {
                    inputs[index].checked = true;
                    colorStars(index);
                });
            });

            // 初期表示時に選択済みの星に色をつける
            const checkedInput = container.querySelector('input[type="radio"]:checked');
            if (checkedInput) {
                colorStars(Array.from(inputs).indexOf(checkedInput));
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const addFactorButton = document.getElementById('add-factor-button');
        const factorContainers = document.querySelectorAll('#deciding-factors > div');
        let currentFactor = 1;

        addFactorButton.addEventListener('click', function() {
            if (currentFactor < 3) {
                currentFactor++;
                factorContainers[currentFactor - 1].classList.remove('hidden');
                
                if (currentFactor === 3) {
                    addFactorButton.style.display = 'none';
                }
            }
        });
    });
</script>

<script>
    //法人番号を取得
    document.addEventListener('DOMContentLoaded', function() {
        const searchButton = document.getElementById('search_company');
        const companyNameInput = document.getElementById('company_name');
        const corporateNumberInput = document.getElementById('corporate_number');

        searchButton.addEventListener('click', function() {
            const companyName = companyNameInput.value;
            if (companyName) {
                // APIリクエストを送信
                fetch(`/api/search-company?name=${encodeURIComponent(companyName)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.corporate_number) {
                            corporateNumberInput.value = data.corporate_number;
                            companyNameInput.value = data.company_name;
                            alert('企業情報が見つかりました。');
                        } else {
                            alert('企業情報が見つかりませんでした。');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('検索中にエラーが発生しました。');
                    });
            } else {
                alert('企業名を入力してください。');
            }
        });

        // 在籍状況による退職年の表示/非表示の制御
        const statusRadios = document.querySelectorAll('input[name="status"]');
        const endYearSelect = document.getElementById('end_year');

        function toggleEndYear() {
            const isCurrentEmployee = document.querySelector('input[name="status"]:checked').value === '在籍中';
            endYearSelect.style.display = isCurrentEmployee ? 'none' : 'inline-block';
            endYearSelect.disabled = isCurrentEmployee;
            if (isCurrentEmployee) {
                endYearSelect.value = '';
            }
        }

        statusRadios.forEach(radio => {
            radio.addEventListener('change', toggleEndYear);
        });

        // 初期表示時にも実行
        toggleEndYear();
    });
</script>

<script>
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
