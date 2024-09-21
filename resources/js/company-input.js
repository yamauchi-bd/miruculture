document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('company-input');
    const searchResults = document.getElementById('input-results');
    const corporateNumberInput = document.getElementById('corporate_number');
    const companyNameHiddenInput = document.getElementById('company_name');
    const searchButton = document.getElementById('input-button');

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
    });

    searchButton.addEventListener('click', function (e) {
        e.preventDefault();
        const query = searchInput.value.trim();
        if (query.length > 1) {
            fetchCompanies(query);
        }
    });

    function fetchCompanies(query) {
        const url = `${window.appUrl}/companies/search?query=${encodeURIComponent(query)}`;
        
        showLoading();

        fetch(url)
            .then(response => response.json())
            .then(data => {
                displayResults(data);
            })
            .catch(error => {
                console.error('Error:', error);
                searchResults.innerHTML = '<p class="p-2 text-red-500">検索中にエラーが発生しました。</p>';
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
        if (companies.length === 0) {
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

    document.addEventListener('click', function (e) {
        if (!searchResults.contains(e.target) && e.target !== searchInput) {
            searchResults.classList.add('hidden');
        }
    });
});