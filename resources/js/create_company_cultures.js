document.addEventListener('DOMContentLoaded', function() {
    const textareas = document.querySelectorAll('textarea[id^="culture_detail_"]');
    const countSpans = document.querySelectorAll('span[id^="culture_detail_count_"]');
    
    function updateTotalCount() {
        let totalCount = 0;
        textareas.forEach(textarea => {
            totalCount += textarea.value.length;
        });
        
        // 各テキストエリアの下の文字数カウンターを更新
        countSpans.forEach(span => {
            span.textContent = totalCount;
        });
    }
    
    textareas.forEach(textarea => {
        textarea.addEventListener('input', updateTotalCount);
    });

    // 初期化時にも実行
    updateTotalCount();
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
            console.log('フォームのバリデーションに失敗しました');
        }
    });
}

function validateForm() {
    const sliders = document.querySelectorAll('input[type="range"]');
    let isValid = true;

    sliders.forEach(slider => {
        if (!slider.value) {
            isValid = false;
            showError(slider.name);
        } else {
            hideError(slider.name);
        }
    });

    return isValid;
}

function showError(name) {
    const errorElement = document.getElementById(`${name}-error`);
    if (!errorElement) {
        const sliderContainer = document.querySelector(`input[name="${name}"]`).closest('.mb-10');
        const error = document.createElement('p');
        error.id = `${name}-error`;
        error.className = 'text-red-500 text-xs mt-1';
        error.textContent = 'この項目は必須です';
        sliderContainer.appendChild(error);
    }
}

function hideError(name) {
    const errorElement = document.getElementById(`${name}-error`);
    if (errorElement) {
        errorElement.remove();
    }
}