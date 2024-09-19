@include('layouts.navigation')

<div class="container">
    <h1>「{{ $query }}」の検索結果</h1>

    <div class="row">
        @foreach ($companies as $company)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $company->company_name }}</h5>
                        <p class="card-text">
                            所在地: {{ $company->location }}<br>
                            従業員数: {{ $company->employee_number }}人<br>
                            業種: {{ $company->industry->name ?? '未設定' }}
                        </p>
                        <a href="{{ route('companies.show', $company->corporate_number) }}" class="btn btn-primary">詳細を見る</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $companies->links() }}
</div>

@include('layouts.footer')