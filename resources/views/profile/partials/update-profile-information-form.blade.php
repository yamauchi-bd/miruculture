<section>
    <header>
        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
            {{ __('メールアドレス') }}
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="current_email" :value="__('現在のメールアドレス（ID）')" />
            <x-text-input id="current_email" name="current_email" type="email" class="mt-1 block w-full" :value="$user->email" disabled />
        </div>

        <div>
            <x-input-label for="email" :value="__('変更後のメールアドレス')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="mt-4">
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-sm text-gray-800 dark:text-gray-200">
                    {{ __('メールアドレスが確認できません') }}
                    <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('確認メールを再送信するにはここをクリックしてください。') }}
                    </button>
                </p>
            @endif

            @if (session('status') === 'verification-link-sent')
                <x-popup-notification :message="__('新しい確認リンクがあなたのメールアドレスに送信されました')" />
            @endif
        </div>

        <div class="flex items-center gap-4 justify-end">
            <x-primary-button>{{ __('変更する') }}</x-primary-button>
        </div>
    </form>
</section>
