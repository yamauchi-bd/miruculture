document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('company-search');
    const searchResults = document.getElementById('search-results');
    const searchButton = document.getElementById('search-button');
    const searchForm = document.querySelector('form');

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
        if (searchInput.value.trim().length <= 1) {
            e.preventDefault();
        }
    });

    searchForm.addEventListener('submit', function (e) {
        if (searchInput.value.trim().length <= 1) {
            e.preventDefault();
        }
    });

    function fetchCompanies(query) {
        const url = `/companies/suggest?query=${encodeURIComponent(query)}`;
    
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                displayResults(data);
            })
            .catch(error => {
                console.error('Error:', error);
                searchResults.innerHTML = '<p class="p-2 text-red-500">検索中にエラーが発生しました。</p>';
                searchResults.classList.remove('hidden');
            });
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
                    <div class="text-xs text-gray-500">${company.location || ''}</div>
                `;
                li.addEventListener('click', () => {
                    searchInput.value = company.company_name;
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