document.addEventListener('DOMContentLoaded', function () {
    console.log('DOMContentLoaded event fired'); // デバッグ用

    // サブカテゴリーのデータを取得
    const jobCategoriesElement = document.getElementById('job-categories');
    if (jobCategoriesElement) {
        const subCategories = JSON.parse(jobCategoriesElement.dataset.categories);
        console.log(subCategories); // デバッグ用

        // 職種選択に応じたサブカテゴリーの動的更新
        const jobCategoryElement = document.getElementById('job_category');
        console.log(jobCategoryElement); // デバッグ用
        if (jobCategoryElement) {
            jobCategoryElement.addEventListener('change', function () {
                const subCategorySelect = document.getElementById('job_subcategory');
                subCategorySelect.innerHTML = '<option value="">選択してください</option>';

                const selectedCategoryId = this.value;
                console.log(selectedCategoryId); // デバッグ用
                console.log(subCategories[selectedCategoryId]); // デバッグ用
                if (selectedCategoryId && subCategories[selectedCategoryId]) {
                    subCategories[selectedCategoryId].forEach(subCategory => {
                        const option = document.createElement('option');
                        option.value = subCategory.id;
                        option.textContent = subCategory.name;
                        subCategorySelect.appendChild(option);
                    });
                }
            });
        } else {
            console.error('job_category element not found'); // デバッグ用
        }
    } else {
        console.error('job-categories element not found'); // デバッグ用
    }

    // 2番目と3番の入社の決め手を任意にするためのJavaScript
    for (let i = 2; i <= 3; i++) {
        const factorInputs = document.querySelectorAll(`input[name="deciding_factor_${i}"]`);
        const detail = document.getElementById(`factor_${i}_detail`);
        const satisfaction = document.querySelectorAll(`input[name="factor_${i}_satisfaction"]`);
        const reason = document.getElementById(`factor_${i}_satisfaction_reason`);

        factorInputs.forEach(factor => {
            factor.addEventListener('change', function () {
                const isSelected = document.querySelector(`input[name="deciding_factor_${i}"]:checked`) !== null;
                console.log(`Factor ${i} selected: ${isSelected}`); // デバッグ用
                detail.required = isSelected;
                satisfaction.forEach(input => input.required = isSelected);
                reason.required = isSelected;
            });
        });
    }

    // 入社の決め手のラジオボタンのスタイルを変更するイベントリスナー
    const factorInputs = document.querySelectorAll('.deciding-factor');
    factorInputs.forEach(input => {
        input.addEventListener('change', function () {
            document.querySelectorAll(`[name="${this.name}"] + .factor-label`).forEach(
                label => {
                    label.classList.remove('bg-cyan-500', 'text-white', 'border-cyan-500');
                    label.classList.add('bg-white', 'hover:bg-gray-100', 'text-gray-700', 'border-gray-300');
                });

            if (this.checked) {
                const label = this.nextElementSibling;
                label.classList.remove('bg-white', 'hover:bg-gray-100', 'text-gray-700', 'border-gray-300');
                label.classList.add('bg-cyan-500', 'text-white', 'border-cyan-500');
            }
        });
    });

    // 満足度の星に色を付けるイベントリスナー
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
                const checkedInput = container.querySelector('input[type="radio"]:checked');
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

        const checkedInput = container.querySelector('input[type="radio"]:checked');
        if (checkedInput) {
            colorStars(Array.from(inputs).indexOf(checkedInput));
        }
    });

    // 入社の決め手を追加するボタンのイベントリスナー
    const addFactorButton = document.getElementById('add-factor-button');
    const factorContainers = document.querySelectorAll('#deciding-factors > div');
    let currentFactor = 1;

    addFactorButton.addEventListener('click', function () {
        if (currentFactor < 3) {
            currentFactor++;
            factorContainers[currentFactor - 1].classList.remove('hidden');

            if (currentFactor === 3) {
                addFactorButton.style.display = 'none';
            }
        }
    });

    // 次へボタンと戻るボタンのイベントリスナー
    const nextButton = document.getElementById('next-button');
    const backButton = document.getElementById('back-button');
    const submitButton = document.getElementById('submit-button');
    const section1 = document.getElementById('section-1');
    const section2 = document.getElementById('section-2');
    const progressBar = document.getElementById('progress-bar');
    const progressBar2 = document.getElementById('progress-bar-2');
    const step2 = document.getElementById('step-2');

    nextButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (validateSection1()) {
            section1.classList.add('hidden');
            section2.classList.remove('hidden');
            progressBar.style.width = '100%';
            progressBar2.style.width = '30%';
            step2.classList.remove('bg-white', 'border-2', 'border-gray-300');
            step2.classList.add('bg-cyan-500');
            step2.querySelector('span').classList.remove('text-gray-500');
            step2.querySelector('span').classList.add('text-white');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        } else {
            console.log('フォームのバリデーションに失敗しました');
        }
    });

    backButton.addEventListener('click', function () {
        section2.classList.add('hidden');
        section1.classList.remove('hidden');
        progressBar.style.width = '30%';
        progressBar2.style.width = '0%';
        step2.classList.add('bg-white', 'border-2', 'border-gray-300');
        step2.classList.remove('bg-cyan-500');
        step2.querySelector('span').classList.add('text-gray-500');
        step2.querySelector('span').classList.remove('text-white');
    });

    // セクション1のバリデーション関数
    function validateSection1() {
        const requiredFields = section1.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            let errorElement;
            if (field.type === 'radio') {
                errorElement = document.getElementById(`${field.name}-error`);
                const group = section1.querySelectorAll(`input[name="${field.name}"]`);
                const isChecked = Array.from(group).some(input => input.checked);
                if (!isChecked) {
                    isValid = false;
                    group.forEach(input => input.classList.add('error'));
                    if (errorElement) {
                        errorElement.textContent = 'このフィールドは必須です。';
                        errorElement.style.display = 'block';
                    }
                } else {
                    group.forEach(input => input.classList.remove('error'));
                    if (errorElement) {
                        errorElement.style.display = 'none';
                    }
                }
            } else if (field.type === 'select-one') {
                errorElement = document.getElementById(`${field.id}-error`);
                if (field.value === '') {
                    isValid = false;
                    field.classList.add('error');
                    if (errorElement) {
                        errorElement.textContent = 'このフィールドは必須です。';
                        errorElement.style.display = 'block';
                    }
                } else {
                    field.classList.remove('error');
                    if (errorElement) {
                        errorElement.style.display = 'none';
                    }
                }
            } else if (!field.value.trim()) {
                errorElement = document.getElementById(`${field.id}-error`);
                isValid = false;
                field.classList.add('error');
                if (errorElement) {
                    errorElement.textContent = 'このフィールドは必須です。';
                    errorElement.style.display = 'block';
                }
            } else {
                field.classList.remove('error');
                if (errorElement) {
                    errorElement.style.display = 'none';
                }
            }
        });

        return isValid;
    }

    // 在籍状況による退職年の表示/非表示の制御
    const statusRadios = document.querySelectorAll('input[name="status"]');

    function toggleEndYear() {
        const endYearSelect = document.getElementById('end_year');
        if (!endYearSelect) return;

        const isCurrentEmployee = document.querySelector('input[name="status"]:checked')?.value === '在籍中';
        endYearSelect.style.display = isCurrentEmployee ? 'none' : 'inline-block';
        endYearSelect.disabled = isCurrentEmployee;
        if (isCurrentEmployee) {
            endYearSelect.value = '';
        }
    }

    statusRadios.forEach(radio => {
        radio.addEventListener('change', toggleEndYear);
    });

    toggleEndYear();

    // 入社の決め手の重複選択を防ぐ
    const decidingFactors = document.querySelectorAll('.deciding-factor');
    const factorGroups = {};

    decidingFactors.forEach(factor => {
        const groupName = factor.getAttribute('name');
        if (!factorGroups[groupName]) {
            factorGroups[groupName] = [];
        }
        factorGroups[groupName].push(factor);
    });

    function updateAvailableOptions() {
        const selectedValues = new Set();

        Object.values(factorGroups).forEach(group => {
            group.forEach(factor => {
                if (factor.checked) {
                    selectedValues.add(factor.value);
                }
            });
        });

        Object.values(factorGroups).forEach(group => {
            group.forEach(factor => {
                const label = factor.nextElementSibling;
                if (selectedValues.has(factor.value) && !factor.checked) {
                    factor.disabled = true;
                    label.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    factor.disabled = false;
                    label.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            });
        });
    }

    decidingFactors.forEach(factor => {
        factor.addEventListener('change', updateAvailableOptions);
    });

    updateAvailableOptions();
});