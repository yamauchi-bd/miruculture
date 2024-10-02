document.addEventListener('DOMContentLoaded', function () {
    const searchInputs = [
        document.getElementById('company-search'),
        document.getElementById('company-search-mobile')
    ];
    const searchResults = [
        document.getElementById('search-results'),
        document.getElementById('search-results-mobile')
    ];
    const searchButtons = [
        document.getElementById('search-button'),
        document.getElementById('search-button-mobile')
    ];

    let debounceTimer;
    let cachedResults = {};

    searchInputs.forEach((searchInput, index) => {
        if (!searchInput) return;

        searchInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const query = this.value.trim();
                if (query.length > 1) {
                    fetchCompanies(query, index);
                } else {
                    searchResults[index].innerHTML = '';
                    searchResults[index].classList.add('hidden');
                }
            }, 500);
        });

        // searchButtons[index].addEventListener('click', function (e) {
        //     e.preventDefault();
        //     const query = searchInput.value.trim();
        //     if (query.length > 1) {
        //         fetchCompanies(query, index);
        //     }
        // });
    });

    function fetchCompanies(query, index) {
        if (cachedResults[query]) {
            displayResults(cachedResults[query], index);
            return;
        }

        const url = `${window.appUrl}/companies/search?query=${encodeURIComponent(query)}`;
        showLoading(index);
    
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                cachedResults[query] = data;
                displayResults(data, index);
            })
            .catch(error => {
                console.error('Error:', error);
                searchResults[index].innerHTML = '<p class="p-2 text-red-500">検索中にエラーが発生しました。</p>';
                searchResults[index].classList.remove('hidden');
            })
            .finally(() => {
                hideLoading(index);
            });
    }

    function displayResults(companies, index) {
        searchResults[index].innerHTML = '';
        if (companies.length === 0) {
            searchResults[index].innerHTML = '<p class="p-2">検索結果がありません。</p>';
        } else {
            const resultsSummary = document.createElement('p');
            resultsSummary.className = 'p-2 text-sm text-gray-600';
            resultsSummary.textContent = `${companies.length}件の結果`;
            searchResults[index].appendChild(resultsSummary);

            const ul = document.createElement('ul');
            ul.className = 'divide-y divide-gray-200';
            companies.forEach(company => {
                const li = document.createElement('li');
                li.className = 'p-1 hover:bg-gray-100 cursor-pointer transition duration-150 ease-in-out';
                li.innerHTML = `
                    <div class="text-sm font-medium text-gray-800">${company.company_name}</div>
                    <div class="text-xs text-gray-500">${company.location}</div>
                `;
                li.addEventListener('click', () => {
                    window.location.href = `${window.appUrl}/companies/${company.corporate_number}`;
                });
                ul.appendChild(li);
            });
            searchResults[index].appendChild(ul);
        }
        searchResults[index].classList.remove('hidden');
    }

    function showLoading(index) {
        const loader = document.createElement('div');
        loader.id = `search-loader-${index}`;
        loader.className = 'text-center p-3';
        loader.innerHTML = '<div class="inline-block animate-spin rounded-full h-6 w-6 border-t-2 border-b-2 border-cyan-500"></div>';
        searchResults[index].innerHTML = '';
        searchResults[index].appendChild(loader);
        searchResults[index].classList.remove('hidden');
    }

    function hideLoading(index) {
        const loader = document.getElementById(`search-loader-${index}`);
        if (loader) {
            loader.remove();
        }
    }

    document.addEventListener('click', function (e) {
        searchResults.forEach((result, index) => {
            if (!result.contains(e.target) && e.target !== searchInputs[index]) {
                result.classList.add('hidden');
            }
        });
    });
});