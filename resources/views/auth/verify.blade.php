@include('layouts.navigation')

<div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-6">認証コード入力</h1>
        
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
                <p>下記メールアドレス宛に認証コードを送信しました</p>
                <p class="font-bold">takahito478@gmail.com</p>
            </div>

            <form method="POST" action="{{ route('register.verify') }}">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="verification_code">
                        メールに記載された認証コードを入力してください
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('verification_code') border-red-500 @enderror"
                           id="verification_code" type="text" name="verification_code" required>
                    @error('verification_code')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-center">
                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        同意して認証
                    </button>
                </div>
            </form>

            <div class="text-center mt-6">
                <a href="{{ route('register.resend-code') }}" class="text-blue-500 hover:text-blue-700 text-sm">
                    認証コードが届かない場合はこちら
                </a>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')