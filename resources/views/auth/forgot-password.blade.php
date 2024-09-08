<x-guest-layout>
    <h1 class="text-xl font-bold lg:mt-20 sm:mt-8">パスワードの再発行</h1>
    <div class="my-10 text-base text-gray-700 dark:text-gray-400">
        {{ __('ご登録されたメールアドレスを入力して、「送信する」ボタンを押してください。パスワード再発行用のURLをメールでお送りします。') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 mb-20">
            <x-primary-button>
                {{ __('送信する') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>