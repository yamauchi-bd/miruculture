document.addEventListener('DOMContentLoaded', function () {
    console.log('DOMContentLoaded event fired');

    // 職種とサブカテゴリーの設定
    setupJobCategories();

    // 入社の決め手の設定
    setupDecidingFactors();

    // 満足度の星評価の設定
    setupStarRating();

    // フォームナビゲーションの設定
    setupFormNavigation();

    // 在籍状況と年の選択の設定
    setupYearSelection();

    // 企業名検索の設定
    setupCompanySearch();

    // その他のイベントリスナー
    setupMiscEventListeners();
});

function setupJobCategories() {
    const jobCategoriesElement = document.getElementById('job-categories');
    if (!jobCategoriesElement) {
        console.error('job-categories element not found');
        return;
    }

    const subCategories = JSON.parse(jobCategoriesElement.dataset.categories);
    const jobCategoryElement = document.getElementById('job_category');
    if (!jobCategoryElement) {
        console.error('job_category element not found');
        return;
    }

    jobCategoryElement.addEventListener('change', function () {
        updateSubCategories(this.value, subCategories);
    });
}

function updateSubCategories(selectedCategoryId, subCategories) {
    const subCategorySelect = document.getElementById('job_subcategory');
    subCategorySelect.innerHTML = '<option value="">選択してください</option>';

    if (selectedCategoryId && subCategories[selectedCategoryId]) {
        subCategories[selectedCategoryId].forEach(subCategory => {
            const option = document.createElement('option');
            option.value = subCategory.id;
            option.textContent = subCategory.name;
            subCategorySelect.appendChild(option);
        });
    }
}

function setupDecidingFactors() {
    // 2番目と3番の入社の決め手を任意にする
    for (let i = 2; i <= 3; i++) {
        setupOptionalFactor(i);
    }

    // 入社の決め手のラジオボタンのスタイル変更
    setupFactorStyleChange();

    // 入社の決め手を追加するボタン
    setupAddFactorButton();

    // 入社の決め手の重複選択を防ぐ
    setupUniqueFactorSelection();
}

function setupOptionalFactor(i) {
    const factorInputs = document.querySelectorAll(`input[name="deciding_factor_${i}"]`);
    const detail = document.getElementById(`factor_${i}_detail`);
    const satisfaction = document.querySelectorAll(`input[name="factor_${i}_satisfaction"]`);
    const reason = document.getElementById(`factor_${i}_satisfaction_reason`);

    factorInputs.forEach(factor => {
        factor.addEventListener('change', function () {
            const isSelected = document.querySelector(`input[name="deciding_factor_${i}"]:checked`) !== null;
            console.log(`Factor ${i} selected: ${isSelected}`);
            detail.required = isSelected;
            satisfaction.forEach(input => input.required = isSelected);
            reason.required = isSelected;
        });
    });
}

function setupFactorStyleChange() {
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
}

function setupAddFactorButton() {
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
}

function setupUniqueFactorSelection() {
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
}

function setupStarRating() {
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
}

function setupFormNavigation() {
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

        // 退職年のバリデーション
        const statusRadio = document.querySelector('input[name="status"]:checked');
        const endYearSelect = document.getElementById('end_year');
        const endYearError = document.getElementById('end_year-error');

        if (statusRadio && statusRadio.value === '退職済み' && (!endYearSelect.value || endYearSelect.value === '')) {
            isValid = false;
            endYearSelect.classList.add('error');
            if (endYearError) {
                endYearError.textContent = '退職年を選択してください。';
                endYearError.style.display = 'block';
            }
        } else {
            endYearSelect.classList.remove('error');
            if (endYearError) {
                endYearError.style.display = 'none';
            }
        }

        return isValid;
    }
}

function setupYearSelection() {
    const statusRadios = document.querySelectorAll('input[name="status"]');
    const startYearSelect = document.getElementById('start_year');
    const endYearSelect = document.getElementById('end_year');

    startYearSelect.addEventListener('change', function() {
        updateEndYearOptions();
    });

    function updateEndYearOptions() {
        const selectedStartYear = parseInt(startYearSelect.value);
        const currentYear = new Date().getFullYear();

        // 退職年の選択肢をリセット
        endYearSelect.innerHTML = '<option value="" selected disabled>退職年</option>';

        // 選択された入社年から現在の年までの選択肢を追加
        for (let year = selectedStartYear; year <= currentYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year + '年';
            endYearSelect.appendChild(option);
        }

        // 在籍状況に応じて退職年の表示/非表示を制御
        toggleEndYear();
    }

    function toggleEndYear() {
        const endYearSelect = document.getElementById('end_year');
        if (!endYearSelect) return;

        const isCurrentEmployee = document.querySelector('input[name="status"]:checked')?.value === '在籍中';
        endYearSelect.style.display = isCurrentEmployee ? 'none' : 'inline-block';
        endYearSelect.disabled = isCurrentEmployee;
        endYearSelect.required = !isCurrentEmployee; // 退職済みの場合は必須に設定
        if (isCurrentEmployee) {
            endYearSelect.value = '';
        }

        // エラーメッセージの表示/非表示を制御
        const errorElement = document.getElementById('end_year-error');
        if (errorElement) {
            errorElement.style.display = 'none';
        }
    }

    statusRadios.forEach(radio => {
        radio.addEventListener('change', toggleEndYear);
    });

    // 初期状態の設定
    updateEndYearOptions();
    toggleEndYear();
}

function setupCompanySearch() {
    const companyInput = document.getElementById('company-input');
    const inputResults = document.getElementById('input-results');
    const inputButton = document.getElementById('input-button');
    const companyNameInput = document.getElementById('company_name');
    const corporateNumberInput = document.getElementById('corporate_number');

    let debounceTimer;

    companyInput.addEventListener('input', debounceCompanySearch);
    inputButton.addEventListener('click', performCompanySearch);

    document.addEventListener('click', function(e) {
        if (!companyInput.contains(e.target) && !inputResults.contains(e.target)) {
            inputResults.classList.add('hidden');
        }
    });

    function debounceCompanySearch() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const searchTerm = this.value.trim();
            if (searchTerm.length >= 2) {
                performCompanySearch(searchTerm);
            } else {
                inputResults.classList.add('hidden');
            }
        }, 300);
    }

    function performCompanySearch(searchTerm) {
        if (typeof searchTerm !== 'string') {
            searchTerm = companyInput.value.trim();
        }
        if (searchTerm.length >= 2) {
            fetch(`/api/companies/search?term=${encodeURIComponent(searchTerm)}`)
                .then(response => response.json())
                .then(displayCompanyResults);
        }
    }

    function displayCompanyResults(data) {
        inputResults.innerHTML = '';
        data.forEach(company => {
            const div = document.createElement('div');
            div.textContent = company.company_name;
            div.classList.add('p-2', 'hover:bg-gray-100', 'cursor-pointer');
            div.addEventListener('click', () => selectCompany(company));
            inputResults.appendChild(div);
        });
        inputResults.classList.remove('hidden');
    }

    function selectCompany(company) {
        companyInput.value = company.company_name;
        companyNameInput.value = company.company_name;
        corporateNumberInput.value = company.corporate_number;
        inputResults.classList.add('hidden');
        companyInput.setAttribute('readonly', true);
        inputButton.setAttribute('disabled', true);
    }
}

function setupMiscEventListeners() {
    // その他のイベントリスナーの設定
}