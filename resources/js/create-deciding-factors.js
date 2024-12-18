document.addEventListener('DOMContentLoaded', function () {
    setupDecidingFactors();
    setupFactorStyleChange();
    setupAddFactorButton();
    setupUniqueFactorSelection();
    setupStarRating();
    setupFormNavigation();
    initializeExistingData(); // 新しく追加した関数
});

function setupDecidingFactors() {
    for (let i = 2; i <= 3; i++) {
        setupOptionalFactor(i);
    }
}

function setupOptionalFactor(i) {
    const factorInputs = document.querySelectorAll(`input[name="factor_${i}"]`);
    const detail = document.getElementById(`detail_${i}`);
    const satisfaction = document.querySelectorAll(`input[name="satisfaction_${i}"]`);

    factorInputs.forEach(factor => {
        factor.addEventListener('change', function () {
            const isSelected = document.querySelector(`input[name="factor_${i}"]:checked`) !== null;
            console.log(`Factor ${i} selected: ${isSelected}`);
            detail.required = isSelected;
            satisfaction.forEach(input => input.required = isSelected);
        });
    });
}

function setupAddFactorButton() {
    const addFactorButton = document.getElementById('add-factor-button');
    const factor2 = document.getElementById('factor-2');
    const factor3 = document.getElementById('factor-3');

    addFactorButton.addEventListener('click', function() {
        if (factor2.classList.contains('hidden')) {
            factor2.classList.remove('hidden');
        } else if (factor3.classList.contains('hidden')) {
            factor3.classList.remove('hidden');
            addFactorButton.style.display = 'none';
        }
    });
}

function setupFactorStyleChange() {
    const factorLabels = document.querySelectorAll('.factor-label');
    factorLabels.forEach(label => {
        label.addEventListener('click', function(event) {
            event.preventDefault(); // デフォルトの動作を防ぐ
            const radio = this.previousElementSibling;
            const name = radio.name;

            // クリックされたラジオボタンの状態を切り替え
            radio.checked = !radio.checked;

            // 同じ名前（順位）の他のラジオボタンの状態をリセット
            document.querySelectorAll(`input[name="${name}"]`).forEach(r => {
                if (r !== radio) {
                    r.checked = false;
                }
            });

            updateLabelStyles(name);
            updateAvailableOptions();
        });
    });
}

function updateLabelStyles(name) {
    // すべてのラベルのスタイルをリセット
    document.querySelectorAll(`input[name="${name}"] + .factor-label`).forEach(label => {
        const radio = label.previousElementSibling;
        if (radio.checked) {
            label.classList.add('bg-cyan-500', 'text-white');
            label.classList.remove('bg-white', 'text-gray-700');
        } else {
            label.classList.remove('bg-cyan-500', 'text-white');
            label.classList.add('bg-white', 'text-gray-700');
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

        // 選択された値を収集
        Object.values(factorGroups).forEach(group => {
            group.forEach(factor => {
                if (factor.checked) {
                    selectedValues.add(factor.value);
                }
            });
        });

        // 各オプションの状態を更新
        Object.values(factorGroups).forEach(group => {
            group.forEach(factor => {
                const label = factor.nextElementSibling;
                if (selectedValues.has(factor.value) && !factor.checked) {
                    // 選択済みで、現在のグループで選択されていない場合は無効化
                    factor.disabled = true;
                    label.classList.add('opacity-50', 'cursor-not-allowed');
                    label.style.pointerEvents = 'none';
                } else {
                    // それ以外の場合は有効化
                    factor.disabled = false;
                    label.classList.remove('opacity-50', 'cursor-not-allowed');
                    label.style.pointerEvents = 'auto';
                }

                // 選択状態に応じてスタイルを更新
                if (factor.checked) {
                    label.classList.add('bg-cyan-500', 'text-white');
                    label.classList.remove('bg-white', 'text-gray-700');
                } else {
                    label.classList.remove('bg-cyan-500', 'text-white');
                    label.classList.add('bg-white', 'text-gray-700');
                }
            });
        });
    }

    // 初期状態を設定
    updateAvailableOptions();

    // グローバルスコープで利用できるようにする
    window.updateAvailableOptions = updateAvailableOptions;
}

function setupStarRating() {
    const starContainers = document.querySelectorAll('.flex.items-center');
    starContainers.forEach(container => {
        const stars = container.querySelectorAll('svg');
        const radioInputs = container.querySelectorAll('input[type="radio"]');
        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                radioInputs[index].checked = true;
                stars.forEach((s, i) => {
                    if (i <= index) {
                        s.classList.add('text-cyan-500');
                        s.classList.remove('text-gray-300');
                    } else {
                        s.classList.add('text-gray-300');
                        s.classList.remove('text-cyan-500');
                    }
                });
            });
        });
    });
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
    let isValid = true;

    // 必須フィールドのバリデーション
    for (let i = 1; i <= 3; i++) {
        const factorInputs = document.querySelectorAll(`input[name="factor_${i}"]`);
        const detail = document.getElementById(`detail_${i}`);
        const satisfaction = document.querySelectorAll(`input[name="satisfaction_${i}"]`);

        const isFactorSelected = Array.from(factorInputs).some(input => input.checked);
        const isSatisfactionSelected = Array.from(satisfaction).some(input => input.checked);

        if (i === 1 || isFactorSelected) {
            if (!isFactorSelected) {
                isValid = false;
                showError(`factor_${i}-error`, '入社の決め手を選択してください。');
            } else {
                hideError(`factor_${i}-error`);
            }

            if (detail.value.length < 100) {
                isValid = false;
                showError(`detail_${i}-error`, '詳細は100文字以上入力してください。');
            } else {
                hideError(`detail_${i}-error`);
            }

            if (!isSatisfactionSelected) {
                isValid = false;
                showError(`satisfaction_${i}-error`, '満足度を選択してください。');
            } else {
                hideError(`satisfaction_${i}-error`);
            }
        }
    }

    return isValid;
}

function showError(id, message) {
    const errorElement = document.getElementById(id);
    if (errorElement) {
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }
}

function hideError(id) {
    const errorElement = document.getElementById(id);
    if (errorElement) {
        errorElement.style.display = 'none';
    }
}

// function setupCharacterCount() {
//     for (let i = 1; i <= 3; i++) {
//         const detailTextarea = document.getElementById(`detail_${i}`);
//         const detailCount = document.getElementById(`detail_${i}_count`);
     
//         if (detailTextarea && detailCount) {
//             detailTextarea.addEventListener('input', function() {
//                 detailCount.textContent = this.value.length;
//             });
//         }
//     }
// }

// 新しく追加する関数
function initializeExistingData() {
    for (let i = 1; i <= 3; i++) {
        const factorInputs = document.querySelectorAll(`input[name="factor_${i}"]`);
        factorInputs.forEach(input => {
            if (input.checked) {
                const label = input.nextElementSibling;
                label.classList.add('bg-cyan-500', 'text-white');
                label.classList.remove('bg-white', 'text-gray-700');

                // 2位と3位の場合、対応するカードを表示
                if (i > 1) {
                    const factorCard = document.getElementById(`factor-${i}`);
                    if (factorCard) {
                        factorCard.classList.remove('hidden');
                    }
                }
            }
        });

        // 満足度の星を更新
        const satisfactionInput = document.querySelector(`input[name="satisfaction_${i}"]:checked`);
        if (satisfactionInput) {
            const stars = satisfactionInput.closest('.flex.items-center').querySelectorAll('svg');
            const rating = parseInt(satisfactionInput.value);
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('text-cyan-500');
                    star.classList.remove('text-gray-300');
                } else {
                    star.classList.add('text-gray-300');
                    star.classList.remove('text-cyan-500');
                }
            });
        }
    }

    // 「他にも入社の決め手がある」ボタンの表示/非表示を更新
    const factor2 = document.getElementById('factor-2');
    const factor3 = document.getElementById('factor-3');
    const addFactorButton = document.getElementById('add-factor-button');

    if (!factor2.classList.contains('hidden') && !factor3.classList.contains('hidden')) {
        addFactorButton.style.display = 'none';
    }

    // 利用可能なオプションを更新
    updateAvailableOptions();
}
