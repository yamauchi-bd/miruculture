@include('layouts.navigation')

<div class="min-h-screen bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden">
                <div class="p-4 sm:p-6">
                    @if($career)
                        @include('careers.edit', ['career' => $career])
                    @else
                        @include('careers.create')
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden">
                    <div class="p-4 sm:p-6">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center flex-wrap">
                            <span class="mr-2">Google認証</span>
                            <svg class="w-6 h-6" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <!-- SVGのパスは変更なし -->
                            </svg>
                        </h2>
                        <div class="mt-4 flex flex-col sm:flex-row sm:items-center">
                            @if(auth()->user()->google_id)
                                <span class="bg-cyan-100 text-cyan-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 mb-2 sm:mb-0 sm:mr-2">
                                    認証済み
                                </span>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Googleアカウントと連携しています！
                                </p>
                            @else
                                <span class="bg-cyan-100 text-cyan-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 mb-2 sm:mb-0 sm:mr-2">
                                    未設定
                                </span>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    設定するには一度ログアウトし、Googleログインしてください！
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden">
                    <div class="p-4 sm:p-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden">
                    <div class="p-4 sm:p-6">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')