document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('search-form');
    const input = document.getElementById('search-input');
    const results = document.getElementById('search-results');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const query = input.value;

        fetch(`/companies/search?query=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Parsed data:', data);
                console.log('Clearing results');
                results.innerHTML = '';
                if (data.length === 0) {
                    results.innerHTML = '<p>検索結果はありません。</p>';
                } else {
                    console.log('Creating new table');
                    const table = document.createElement('table');
                    table.className = 'table table-striped';
                    table.innerHTML = `
                        <thead>
                            <tr>
                                <th>会社名</th>
                                <th>所在地</th>
                                <th>法人番号</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    `;
                    const tbody = table.querySelector('tbody');
                    data.forEach(company => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${company.company_name}</td>
                            <td>${company.location}</td>
                            <td>${company.corporate_number}</td>
                        `;
                        tbody.appendChild(row);
                    });
                    results.appendChild(table);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                results.innerHTML = `<p>エラーが発生しました: ${error.message}</p>`;
            });
    });
});