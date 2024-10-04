document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('company-input');
    const searchResults = document.getElementById('input-results');
    const corporateNumberInput = document.getElementById('corporate_number');
    const companyNameHiddenInput = document.getElementById('company_name');
    const searchButton = document.getElementById('input-button');

    let debounceTimer;
    let cachedResults = {};

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
        }, 500);
    });

    searchButton.addEventListener('click', function (e) {
        e.preventDefault();
        const query = searchInput.value.trim();
        if (query.length > 1) {
            fetchCompanies(query);
        }
    });

    function fetchCompanies(query) {
        if (cachedResults[query]) {
            displayResults(cachedResults[query]);
            return;
        }

        const url = `/api/company-search?query=${encodeURIComponent(query)}`;
        showLoading();

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(response => {
                console.log('Raw API Response:', response);  // デバッグ用

                if (response.errors) {
                    throw new Error(response.errors);
                }

                let companies = [];
                if (response['hojin-infos'] && Array.isArray(response['hojin-infos'])) {
                    companies = response['hojin-infos'].map(company => ({
                        company_name: company.name,
                        location: company.location,
                        corporate_number: company.corporate_number
                    }));
                }

                console.log('Processed companies:', companies);  // デバッグ用

                cachedResults[query] = companies;
                displayResults(companies);
            })
            .catch(error => {
                console.error('Error:', error);
                searchResults.innerHTML = '<p class="p-2 text-red-500">検索中にエラーが発生しました。: ' + error.message + '</p>';
                searchResults.classList.remove('hidden');
            })
            .finally(() => {
                hideLoading();
            });
    }

    function displayResults(companies) {
        searchResults.innerHTML = '';
        if (companies.length === 0) {
            searchResults.innerHTML = '<p class="p-2">検索結果がありません。</p>';
        } else {
            const resultsSummary = document.createElement('p');
            resultsSummary.className = 'p-2 text-sm text-gray-600';
            resultsSummary.textContent = `${companies.length}件の結果`;
            searchResults.appendChild(resultsSummary);

            const ul = document.createElement('ul');
            ul.className = 'divide-y divide-gray-200';
            companies.forEach(company => {
                const li = document.createElement('li');
                li.className = 'p-1 hover:bg-gray-100 cursor-pointer transition duration-150 ease-in-out';
                li.innerHTML = `
                    <div class="text-sm font-medium text-gray-800">${company.company_name}</div>
                    <div class="text-xs text-gray-500">${company.location || '所在地不明'}</div>
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
        console.log('Displayed results:', companies);  // デバッグ用
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

    document.addEventListener('click', function (e) {
        if (!searchResults.contains(e.target) && e.target !== searchInput) {
            searchResults.classList.add('hidden');
        }
    });

    // URLからcorporate_numberを取得
    const urlParams = new URLSearchParams(window.location.search);
    const corporateNumber = urlParams.get('corporate_number');

    if (corporateNumber) {
        fetch(`/api/companies/${corporateNumber}`)
            .then(response => response.json())
            .then(data => {
                searchInput.value = data.company_name;
                companyNameHiddenInput.value = data.company_name;
                corporateNumberInput.value = data.corporate_number;
            })
            .catch(error => console.error('Error:', error));
    }
});