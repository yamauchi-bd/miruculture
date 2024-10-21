document.addEventListener('DOMContentLoaded', function() {
    setupSliders();
    setupFormValidation();
    updateTotalCount(); // 初期表示時にも文字数をカウント
});

function setupSliders() {
    const sliders = document.querySelectorAll('input[type="range"]');
    sliders.forEach(slider => {
        updateSliderBackground(slider);
        slider.addEventListener('input', function() {
            updateSliderBackground(this);
        });
    });
}

function updateSliderBackground(slider) {
    const min = slider.min || 1;
    const max = slider.max || 5;
    const value = slider.value;
    const percentage = ((value - min) / (max - min)) * 100;
    slider.style.background = `linear-gradient(to right, #0891b2 0%, #0891b2 ${percentage}%, #d1d5db ${percentage}%, #d1d5db 100%)`;
}

function setupFormValidation() {
    const form = document.querySelector('form');
    const submitButton = document.getElementById('submit-button');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (validateForm()) {
            this.submit();
        } else {
            alert('フォームのバリデーションに失敗しました。すべての項目を入力し、自由記述の合計が200文字以上であることを確認してください。');
        }
    });

    // リアルタイムでバリデーションを行う
    const textareas = document.querySelectorAll('textarea[id^="culture_detail_"]');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            updateTotalCount();
            validateForm();
        });
    });
}

function validateForm() {
    const sliders = document.querySelectorAll('input[type="range"]');
    const textareas = document.querySelectorAll('textarea[id^="culture_detail_"]');
    let isValid = true;
    let totalCharCount = 0;

    sliders.forEach(slider => {
        if (!slider.value) {
            isValid = false;
            showError(slider.name);
        } else {
            hideError(slider.name);
        }
    });

    textareas.forEach(textarea => {
        totalCharCount += textarea.value.length;
    });

    if (totalCharCount < 200) {
        isValid = false;
        showError('total_char_count');
    } else {
        hideError('total_char_count');
    }

    // 送信ボタンの有効/無効を切り替え
    const submitButton = document.getElementById('submit-button');
    submitButton.disabled = !isValid;
    submitButton.classList.toggle('opacity-50', !isValid);

    return isValid;
}

function showError(name) {
    const errorElement = document.getElementById(`${name}-error`);
    if (!errorElement) {
        const container = name === 'total_char_count' 
            ? document.querySelector('.mt-20') 
            : document.querySelector(`input[name="${name}"]`).closest('.mb-10');
        const error = document.createElement('p');
        error.id = `${name}-error`;
        error.className = 'text-red-500 text-xs mt-1';
        error.textContent = name === 'total_char_count' 
            ? '自由記述の合計文字数は200文字以上である必要があります。' 
            : 'この項目は必須です';
        container.appendChild(error);
    }
}

function hideError(name) {
    const errorElement = document.getElementById(`${name}-error`);
    if (errorElement) {
        errorElement.remove();
    }
}

function updateTotalCount() {
    const textareas = document.querySelectorAll('textarea[id^="culture_detail_"]');
    const countSpans = document.querySelectorAll('span[id^="culture_detail_count_"]');
    let totalCount = 0;
    
    textareas.forEach(textarea => {
        totalCount += textarea.value.length;
    });
    
    countSpans.forEach(span => {
        span.textContent = totalCount;
        span.classList.toggle('text-red-500', totalCount < 200);
    });
}
