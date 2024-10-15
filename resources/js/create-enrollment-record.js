document.addEventListener('DOMContentLoaded', function () {
    console.log('Step 1: DOMContentLoaded event fired');

    // 職種の設定
    setupJobCategories();

    // フォームナビゲーションの設定
    setupFormNavigation();

    // 在籍状況と年の選択の設定
    setupYearSelection();

});

function setupJobCategories() {
    const jobCategoriesElement = document.getElementById('job-categories');
    if (!jobCategoriesElement) {
        console.error('job-categories element not found');
        return;
    }

    // 職種カテゴリーの設定コード
    // 必要に応じて、サブカテゴリーの処理を追加
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

function setupFormNavigation() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (validateForm()) {
            this.submit();
        } else {
            console.log('フォームのバリデーションに失敗しました');
        }
    });
}

function validateForm() {
    const requiredFields = document.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        let errorElement;
        if (field.type === 'radio') {
            errorElement = document.getElementById(`${field.name}-error`);
            const group = document.querySelectorAll(`input[name="${field.name}"]`);
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

function setupYearSelection() {
    const statusRadios = document.querySelectorAll('input[name="status"]');
    const startYearSelect = document.getElementById('start_year');
    const endYearSelect = document.getElementById('end_year');

    startYearSelect.addEventListener('change', function () {
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