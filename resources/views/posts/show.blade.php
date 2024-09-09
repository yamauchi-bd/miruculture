@include('layouts.navigation')


<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">投稿詳細</h1>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">企業情報</h2>
            <p><strong>企業名:</strong> {{ $post->company_name }}</p>
            <p><strong>法人番号:</strong> {{ $post->corporate_number }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">雇用情報</h2>
            <p><strong>雇用形態:</strong> {{ $post->employment_type }}</p>
            <p><strong>入社形態:</strong> {{ $post->entry_type }}</p>
            <p><strong>在籍状況:</strong> {{ $post->status }}</p>
            <p><strong>入社年:</strong> {{ $post->start_year }}</p>
            @if($post->end_year)
                <p><strong>退職年:</strong> {{ $post->end_year }}</p>
            @endif
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">職種情報</h2>
            <p><strong>職種カテゴリ:</strong> {{ $post->jobCategory->name ?? '不明' }}</p>
            <p><strong>職種サブカテゴリ:</strong> {{ $post->jobSubcategory->name ?? '不明' }}</p>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">入社の決め手</h2>
            @for($i = 1; $i <= 3; $i++)
                @if($post->{"deciding_factor_$i"})
                    <div class="mb-3">
                        <h3 class="text-lg font-medium">決め手 {{ $i }}</h3>
                        <p><strong>要因:</strong> {{ $post->{"deciding_factor_$i"} }}</p>
                        <p><strong>詳細:</strong> {{ $post->{"factor_{$i}_detail"} }}</p>
                        <p><strong>満足度:</strong> {{ $post->{"factor_{$i}_satisfaction"} }}</p>
                        <p><strong>理由:</strong> {{ $post->{"factor_{$i}_satisfaction_reason"} }}</p>
                    </div>
                @endif
            @endfor
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('posts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            戻る
        </a>
    </div>
</div>

@include('layouts.footer')