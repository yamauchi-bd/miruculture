@include('layouts.navigation')

<div
    class="min-h-screen flex flex-col justify-start sm:justify-center items-center px-4 sm:px-6 lg:px-8 pt-8 sm:pt-0 pb-8 sm:pb-0">
    <div class="text-center w-full max-w-md px-6 py-4 overflow-hidden">
        <h2 class="text-xl sm:text-2xl font-bold text-center text-gray-800 mb-8">認証コード入力</h2>

        <div class="bg-blue-50 text-cyan-700 p-3 sm:p-4 mb-6" role="alert">
            <p class="text-xs sm:text-sm">下記メールアドレス宛に認証コードを送信しました</p>
            <p class="font-bold text-xs sm:text-sm mt-1">{{ $email }}</p>
        </div>

        <form method="POST" action="{{ route('register.verify') }}">
            @csrf
            <input type="hidden" name="redirect_to" value="{{ session('redirect_to') }}">

            <div class="mt-8 mb-6">
                <label for="verification_code" class="block text-base font-semibold text-gray-700 mb-4 text-center">
                    メールに記載された認証コードを入力してください
                </label>
                <input id="verification_code" type="text" name="verification_code" required
                    class="w-full px-3 py-3 border border-gray-400 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 text-xs sm:text-sm">
                @error('verification_code')
                    <p class="mt-2 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <x-primary-button type="submit">
                    認証する
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')
