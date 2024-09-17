document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('company-search');
    const searchResults = document.getElementById('search-results');
    const searchButton = document.getElementById('search-button');

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
        fetch(`${appUrl}/companies/search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
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
                    <div class="text-xs text-gray-500">${company.location}</div>
                `;
                li.addEventListener('click', () => {
                    window.location.href = `/companies/${company.corporate_number}`;
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