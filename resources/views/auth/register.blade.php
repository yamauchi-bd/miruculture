@include('layouts.navigation')

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4 lg:py-24 max-w-md">
    <form method="POST" action="{{ route('register.request') }}" class="mt-8 space-y-6">
        @csrf
        <input type="hidden" name="redirect_to" value="{{ request('redirect_to', url()->previous()) }}">

        <div class="text-center">
            <h2 class="text-xl sm:text-2xl font-bold mb-8 sm:mb-12">無料ユーザー登録（１分）</h2>
        </div>

        <a href="{{ route('login.google') }}"
            class="flex items-center justify-center w-full gap-2 rounded-lg border border-gray-300 bg-white px-3 sm:px-4 py-2 sm:py-3 text-sm sm:text-base font-semibold text-gray-700 outline-none ring-gray-300 transition duration-100 hover:bg-gray-100 focus-visible:ring active:bg-gray-200">
            <svg class="h-5 w-5 shrink-0" width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M23.7449 12.27C23.7449 11.48 23.6749 10.73 23.5549 10H12.2549V14.51H18.7249C18.4349 15.99 17.5849 17.24 16.3249 18.09V21.09H20.1849C22.4449 19 23.7449 15.92 23.7449 12.27Z"
                    fill="#4285F4" />
                <path
                    d="M12.2549 24C15.4949 24 18.2049 22.92 20.1849 21.09L16.3249 18.09C15.2449 18.81 13.8749 19.25 12.2549 19.25C9.12492 19.25 6.47492 17.14 5.52492 14.29H1.54492V17.38C3.51492 21.3 7.56492 24 12.2549 24Z"
                    fill="#34A853" />
                <path
                    d="M5.52488 14.29C5.27488 13.57 5.14488 12.8 5.14488 12C5.14488 11.2 5.28488 10.43 5.52488 9.71V6.62H1.54488C0.724882 8.24 0.254883 10.06 0.254883 12C0.254883 13.94 0.724882 15.76 1.54488 17.38L5.52488 14.29Z"
                    fill="#FBBC05" />
                <path
                    d="M12.2549 4.75C14.0249 4.75 15.6049 5.36 16.8549 6.55L20.2749 3.13C18.2049 1.19 15.4949 0 12.2549 0C7.56492 0 3.51492 2.7 1.54492 6.62L5.52492 9.71C6.47492 6.86 9.12492 4.75 12.2549 4.75Z"
                    fill="#EA4335" />
            </svg>
            <span>Googleで登録する</span>
        </a>

        <div class="relative flex items-center justify-center">
            <span class="absolute inset-x-0 h-px bg-gray-300"></span>
            <span class="relative bg-white px-4 text-sm text-gray-400">または</span>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('メールアドレス')" class="mb-1 text-sm sm:text-base" />
            <x-text-input id="email" class="block w-full text-sm sm:text-base" type="email" name="email" :value="old('email')"
                required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs sm:text-sm" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('パスワード（8文字以上の英数字）')" class="mb-1 text-sm sm:text-base" />
            <div class="relative">
                <x-text-input id="password" class="block w-full pr-10 text-sm sm:text-base" type="password" name="password" required
                    autocomplete="new-password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" />

                <button type="button" id="togglePassword"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs sm:text-sm" />
            <p class="mt-2 text-xs sm:text-sm text-gray-500">※<a href="{{ route('legal') }}"
                    class="text-cyan-500 transition duration-100 hover:text-cyan-600 active:text-cyan-700">利用規約･個人情報の取り扱い</a>に同意の上ご登録ください
            </p>
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-2 sm:py-3 text-sm sm:text-base">
                {{ __('メールアドレスで登録する') }}
            </x-primary-button>
        </div>

        <div class="text-center text-xs sm:text-sm text-gray-600 dark:text-gray-400">
            <p>
                登録がお済みの方は
                <a class="underline text-cyan-500 hover:text-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500"
                    href="{{ route('login') }}">{{ __('ログイン') }}</a>
            </p>
        </div>
    </form>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // アイコンの切り替え
        this.innerHTML = type === 'password' ?
            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>' :
            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>';
    });
</script>

@include('layouts.footer')
