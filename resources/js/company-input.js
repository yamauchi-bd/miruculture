document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('company-input');
    const searchResults = document.getElementById('input-results');
    const corporateNumberInput = document.getElementById('corporate_number');
    const companyNameHiddenInput = document.getElementById('company_name');
    const searchButton = document.getElementById('input-button');

    // 検索ボタンを有効化
    searchButton.disabled = false;

    let debounceTimer;

    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const query = this.value.trim();
            if (query.length > 1) {
                fetchCompanies(query);
            } else {
                searchResults.innerHTML = '';
                searchResults.classList.add('hidden');
            }
        }, 300);

        // 入力フィールドの値が変更されたときに隠しフィールドも更新する
        companyNameHiddenInput.value = this.value;
        // 企業が選択されていない場合、corporate_numberをクリアする
        if (!corporateNumberInput.value) {
            corporateNumberInput.value = '';
        }
    });

    searchButton.addEventListener('click', function (e) {
        e.preventDefault();
        const query = searchInput.value.trim();
        if (query.length > 1) {
            fetchCompanies(query);
        }
    });

    function fetchCompanies(query) {
        const url = `/api/company-search?query=${encodeURIComponent(query)}`;
        
        showLoading();

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('API Response:', data);  // レスポンスをコンソールに出力
                if (Array.isArray(data)) {
                    displayResults(data);
                } else if (data['hojin-infos'] && Array.isArray(data['hojin-infos'])) {
                    const companies = data['hojin-infos'].map(company => ({
                        corporate_number: company.corporate_number,
                        company_name: company.name,
                        location: company.location
                    }));
                    displayResults(companies);
                } else {
                    displayResults([]);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                searchResults.innerHTML = '<p class="p-2 text-red-500">検索中にエラーが発生しました。: ' + error.message + '</p>';
            })
            .finally(() => {
                hideLoading();
            });
    }

    function showLoading() {
        const loader = document.createElement('div');
        loader.id = 'search-loader';
        loader.className = 'text-center p-3';
        loader.innerHTML = '<div class="inline-block animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-cyan-500"></div>';
        searchResults.innerHTML = '';
        searchResults.appendChild(loader);
        searchResults.classList.remove('hidden');
    }

    function hideLoading() {
        const loader = document.getElementById('search-loader');
        if (loader) {
            loader.remove();
        }
    }

    function displayResults(companies) {
        searchResults.innerHTML = '';
        if (!Array.isArray(companies) || companies.length === 0) {
            searchResults.innerHTML = '<p class="p-2">検索結果がありません。</p>';
        } else {
            const ul = document.createElement('ul');
            ul.className = 'divide-y divide-gray-200';
            companies.forEach(company => {
                const li = document.createElement('li');
                li.className = 'p-2 hover:bg-gray-100 cursor-pointer';
                li.innerHTML = `
                    <div class="font-medium">${company.company_name}</div>
                    <div class="text-xs text-gray-500">${company.location}</div>
                `;
                li.addEventListener('click', () => {
                    searchInput.value = company.company_name;
                    corporateNumberInput.value = company.corporate_number;
                    companyNameHiddenInput.value = company.company_name;
                    searchResults.classList.add('hidden');
                });
                ul.appendChild(li);
            });
            searchResults.appendChild(ul);
        }
        searchResults.classList.remove('hidden');
    }

    // 入力フィールドがフォーカスを受けたときに全選択する
    searchInput.addEventListener('focus', function() {
        this.select();
    });

    document.addEventListener('click', function (e) {
        if (!searchResults.contains(e.target) && e.target !== searchInput) {
            searchResults.classList.add('hidden');
        }
    });
});