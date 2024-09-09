@include('layouts.navigation')

<div class="container mx-auto px-4 sm:px-6 lg:px-8 lg:py-24 max-w-md">
    <form method="POST" action="{{ route('register.verify') }}" class="mt-8 space-y-6">
        @csrf

        <div class="text-center">
            <h2 class="text-2xl font-bold mb-12">メールアドレスの認証</h2>
        </div>

        <div>
            <x-input-label for="verification_code" :value="__('認証コード')" class="mb-1" />
            <x-text-input id="verification_code" class="block w-full" type="text" name="verification_code" required autofocus />
            <p class="mt-2 text-sm text-gray-500">メールアドレスに送信された4桁のコードを入力してください。</p>
            <x-input-error :messages="$errors->get('verification_code')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-3">
                {{ __('認証コードを確認') }}
            </x-primary-button>
        </div>

        <div class="text-center text-sm text-gray-600 dark:text-gray-400">
            <p>
                コードが届かない場合は
                <a class="underline text-cyan-500 hover:text-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                    href="{{ route('register.resend-code') }}">{{ __('再送信') }}</a>
                してください。
            </p>
        </div>
    </form>
</div>

@include('layouts.footer')