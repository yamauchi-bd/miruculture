@include('layouts.navigation')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <h1 class="text-2xl font-semibold mb-6">投稿一覧</h1>

    @foreach($posts as $post)
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $post->jobCategory->name }} / {{ $post->jobSubcategory->name }}
                </h3>
            </div>

            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            雇用形態
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $post->employment_type }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            入社形態
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $post->entry_type }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            在籍状況
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $post->status }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            入社の決め手
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                @foreach($post->decidingFactors->take(3) as $index => $factor)
                                    <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                        <div class="w-0 flex-1 flex items-center">
                                            <span class="ml-2 flex-1 w-0 truncate">
                                                {{ $index + 1 }}位: {{ $factor->factor }}
                                            </span>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500 show-details" data-target="post-{{ $post->id }}-factor-{{ $index + 1 }}">
                                                詳細を表示
                                            </button>
                                        </div>
                                    </li>
                                    <div id="post-{{ $post->id }}-factor-{{ $index + 1 }}" class="hidden pl-3 pr-4 py-3 text-sm">
                                        <p><strong>詳細:</strong> {{ $factor->detail }}</p>
                                        <p><strong>満足度:</strong> 
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $factor->satisfaction)
                                                <span class="text-yellow-400">★</span>
                                            @else
                                                <span class="text-gray-300">★</span>
                                            @endif
                                        @endfor</p>
                                        <p><strong>理由:</strong> {{ $factor->satisfaction_reason }}</p>
                                    </div>
                                @endforeach
                            </ul>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    @endforeach

    {{ $posts->links() }}
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