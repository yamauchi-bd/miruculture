@include('layouts.navigation')

<div class="max-w-xl mx-auto my-4 border-b-2 pb-4 sm:py-8 lg:pt-24">
    <div class="flex pb-2">
        <div class="flex-1 flex flex-col items-center">
            <div class="w-10 h-10 bg-cyan-500 mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-white text-center w-full">1</span>
            </div>
        </div>

        <div class="w-1/6 align-center items-center align-middle content-center flex">
            <div class="w-full bg-cyan-500 rounded items-center align-middle align-center flex-1">
                <div class="bg-cyan-500 text-xs leading-none py-1 text-center text-white rounded w-full"></div>
            </div>
        </div>

        <div class="flex-1 flex flex-col items-center">
            <div class="w-10 h-10 bg-cyan-500 mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-white text-center w-full">2</span>
            </div>
        </div>

        <div class="w-1/6 align-center items-center align-middle content-center flex">
            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                <div id="progress-bar-2" class="bg-cyan-500 text-xs leading-none py-1 text-center text-white rounded"
                    style="width: 30%"></div>
            </div>
        </div>

        <div class="flex-1 flex flex-col items-center">
            <div
                class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-gray-300 text-center w-full">3</span>
            </div>
        </div>
    </div>

    <div class="flex text-xs sm:text-sm content-center text-center mt-2">
        <div class="w-1/4">
            企業･在籍情報&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="w-1/2">
            入社の決め手
        </div>
        <div class="w-1/4">
            &nbsp;&nbsp;&nbsp;&nbsp;社風･雰囲気
        </div>
    </div>
</div>

<div class="max-w-7xl mt-12 px-4 md:px-5 md:w-3/5 lg:w-2/5 lg:px-5 mx-auto">
    <form action="{{ route('deciding_factors.store', $enrollmentRecord) }}" method="POST">
        @csrf

        <div id="section-2">
            <h2 class="mt-4 mb-6 text-cyan-500 font-bold">▼ 入社の決め手 を登録する</h2>

            <div id="deciding-factors">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="card mb-3 {{ $i > 1 ? 'hidden' : '' }}" id="factor-{{ $i }}">
                        <div class="card-body mb-10">
                            <h3 class="flex gap-1 mb-3 items-center text-gray-700 text-sm font-bold leading-relaxed">
                                {{ $i }} 位
                                @if ($i == 1)
                                    <x-required-mark />
                                @endif
                            </h3>
                            <div class="justify-start mb-10 items-start gap-3 flex flex-wrap">
                                @foreach ($factors as $factor => $label)
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio hidden deciding-factor"
                                            name="factor_{{ $i }}" value="{{ $factor }}"
                                            {{ $i == 1 ? 'required' : '' }}
                                            {{ old("factor_$i", $formData["factor_$i"] ?? '') == $factor ? 'checked' : '' }}>
                                        <span
                                            class="factor-label sm:w-fit w-full px-2 py-1.5 transition-all rounded-full border cursor-pointer text-sm font-semibold bg-white hover:bg-gray-100 text-gray-700 border-gray-300">
                                            {{ $label }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
            
                            <div class="mb-10">
                                <label
                                    class="flex gap-1 mb-2 items-center text-gray-700 text-sm font-bold leading-relaxed">
                                    決め手についての満足度
                                    @if ($i == 1)
                                        <x-required-mark />
                                    @endif
                                </label>
                                <div class="flex items-center">
                                    <span class="text-sm text-gray-600">低い</span>
                                    <div class="flex items-center mx-4">
                                        @for ($j = 1; $j <= 5; $j++)
                                            <label class="mx-1">
                                                <input type="radio" name="satisfaction_{{ $i }}"
                                                    value="{{ $j }}" class="hidden peer"
                                                    {{ $i == 1 ? 'required' : '' }}
                                                    {{ old("satisfaction_$i", $formData["satisfaction_$i"] ?? '') == $j ? 'checked' : '' }}>
                                                <svg class="w-8 h-8 fill-current text-gray-300 peer-checked:text-cyan-500 cursor-pointer"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                </svg>
                                            </label>
                                        @endfor
                                    </div>
                                    <span class="text-sm text-gray-600">高い</span>
                                </div>
                            </div>
            
                            <div class="mb-10">
                                <label for="detail_{{ $i }}"
                                    class="flex gap-1 mb-2 items-center text-gray-700 text-sm font-bold leading-relaxed">
                                    自由記述
                                    <p class="text-xs">(決め手の詳細や満足度の理由)</p>
                                    @if ($i == 1)
                                        <x-required-mark />
                                    @endif
                                    <span class="text-xs text-gray-500 ml-2">(<span id="detail_{{ $i }}_count">0</span>/100文字以上)</span>
                                </label>
                                <textarea id="detail_{{ $i }}" name="detail_{{ $i }}"
                                    class="block w-full px-4 py-2 border border-gray-300 text-base font-normal text-gray-700 bg-white rounded-md placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                                    rows="3" {{ $i == 1 ? 'required' : '' }} minlength="100"
                                    placeholder="入社の決め手や満足度について、詳しく教えてください。">{{ old("detail_$i", $formData["detail_$i"] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            <div class="flex justify-center mt-8" id="add-factor-button-container">
                <button type="button" id="add-factor-button"
                    class="bg-gray-300 hover:bg-gray-400 text-sm text-gray-700 font-bold py-2 px-6 rounded inline-flex items-center">
                    <span>他にも入社の決め手がある</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"
                            stroke-width="2" />
                        <line x1="12" y1="7" x2="12" y2="17" stroke-width="2" />
                        <line x1="7" y1="12" x2="17" y2="12" stroke-width="2" />
                    </svg>
                </button>
            </div>

            <div class="flex justify-center mt-16 space-x-4">
                <a href="{{ route('company_cultures.create', $enrollmentRecord) }}" id="skip-button"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-3 px-8 rounded-full transform transition duration-300 ease-in-out hover:scale-105 flex items-center">
                    <span>スキップ</span>
                </a>
                <button type="submit" id="next-button"
                    class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-3 px-8 rounded-full transform transition duration-300 ease-in-out hover:scale-105 flex items-center">
                    <span class="mr-1">{{ $isUpdate ? '更新する' : '登録する' }}</span>
                </button>
            </div>
        </div>
    </form>
</div>

<div class="mt-20"></div>
@include('layouts.footer')
@vite(['resources/js/create_deciding_factors.js'])
