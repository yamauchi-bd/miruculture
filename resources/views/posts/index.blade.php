@include('layouts.navigation')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <h1 class="text-3xl font-bold mb-10 text-center text-gray-800">投稿一覧</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
            <div class="group bg-white border border-solid border-gray-300 rounded-2xl p-6 transition-all duration-500 hover:border-cyan-600 shadow-md hover:shadow-lg relative pb-24">
                <h6 class="text-gray-900 font-medium mb-3">「社名」への入社の決め手</h6>
                @if($post->decidingFactors && $post->decidingFactors->isNotEmpty())
                    @foreach($post->decidingFactors->take(3) as $index => $factor)
                        <div class="mb-4 last:mb-0">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">{{ $index + 1 }}位: {{ $factor->factor ?? '未設定' }}</span>
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= ($factor->satisfaction ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}" viewBox="0 0 18 17" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"></path>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <button type="button" class="text-sm font-medium text-cyan-600 hover:text-cyan-500 mt-2 show-details" data-target="post-{{ $post->id }}-factor-{{ $index + 1 }}">
                                詳細を表示
                            </button>
                            <div id="post-{{ $post->id }}-factor-{{ $index + 1 }}" class="hidden mt-2 text-sm text-gray-700">
                                <p><strong>決め手の詳細:</strong> {{ $factor->detail ?? '詳細なし' }}</p>
                                <p><strong>満足度の理由:</strong> {{ $factor->satisfaction_reason ?? '理由なし' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-sm text-gray-500">入社の決め手が登録されていません。</p>
                @endif
                <div class="absolute bottom-6 left-6 right-6 flex items-center gap-5">
                    <div class="w-12 h-12 flex items-center justify-center bg-yellow-400 rounded-full">
                        <i class="fa-solid fa-otter fa-2x text-gray-600"></i>
                    </div>
                    <div class="grid">
                        <h5 class="text-gray-700 font-medium transition-all duration-500">{{ $post->start_year ?? '◯◯' }}年 {{ $post->entry_type ?? '未設定' }}（{{ $post->status ?? '未設定' }}）</h5>
                        <span class="text-sm leading-6 text-gray-500">
                            {{ $post->jobCategory->name ?? '職種未設定' }} ＞ 
                            {{ $post->jobSubcategory->name ?? '未設定' }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-10">
        {{ $posts->links() }}
    </div>
</div>

@include('layouts.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    const showButtons = document.querySelectorAll('.show-details');
    showButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const targetElement = document.getElementById(targetId);
            if (targetElement.classList.contains('hidden')) {
                targetElement.classList.remove('hidden');
                this.textContent = '詳細を隠す';
            } else {
                targetElement.classList.add('hidden');
                this.textContent = '詳細を表示';
            }
        });
    });
});
</script>