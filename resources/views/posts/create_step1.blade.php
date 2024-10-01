@include('layouts.navigation')

<div class="max-w-xl mx-auto my-4 border-b-2 pb-4 sm:py-8 lg:pt-24">
    <div class="flex pb-2">
        <div class="flex-1 flex flex-col items-center">
            <div class="w-10 h-10 bg-cyan-500 mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-white text-center w-full">1</span>
            </div>
        </div>

        <div class="w-1/6 align-center items-center align-middle content-center flex">
            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                <div id="progress-bar" class="bg-cyan-500 text-xs leading-none py-1 text-center text-white rounded"
                    style="width: 30%"></div>
            </div>
        </div>

        <div class="flex-1 flex flex-col items-center">
            <div id="step-2"
                class="w-10 h-10 bg-white border-2 border-grey-light mx-auto rounded-full text-lg text-white flex items-center">
                <span class="text-gray-300 text-center w-full">2</span>
            </div>
        </div>

        <div class="w-1/6 align-center items-center align-middle content-center flex">
            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                <div id="progress-bar-2" class="bg-cyan-500 text-xs leading-none py-1 text-center text-white rounded"
                    style="width: 0%"></div>
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
    <div id="job-categories" data-categories="{{ json_encode($jobCategories->pluck('children', 'id')) }}" style="display: none;"></div>

    <form action="{{ route('posts.store.step1') }}" method="POST">
        @csrf

        <div id="section-1">
            <h2 class="mt-4 mb-6 text-gray-700 font-bold">在籍情報 👤</h2>
            <div class="mb-10">
                <label for="company_name"
                    class="flex gap-1 mb-2 items-center text-gray-700 text-sm font-bold leading-relaxed">
                    対象企業
                    <x-required-mark />
                    <p id="company_name-error" class="error-message text-red-500 text-xs" style="display: none;"></p>
                </label>
            
                <div class="flex relative">
                    <input type="text" id="company-input" required
                        class="block w-full px-4 py-2 pr-12 border border-gray-300 text-base font-normal text-gray-700 bg-white rounded-md placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent"
                        placeholder="投稿する企業を探す..."
                        value="{{ $company ? $company->company_name : '' }}">
                    <button type="button" id="input-button"
                        class="absolute right-0 top-0 h-full px-3 bg-cyan-500 text-white text-sm font-bold rounded-r-md transition-all hover:bg-cyan-700 flex items-center justify-center">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M17 17L21 21" stroke="#ffffff" stroke-width="3" stroke-linecap="round"
                                class="my-path">
                            </path>
                            <path
                                d="M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                stroke="#ffffff" stroke-width="3" class="my-path"></path>
                        </svg>
                    </button>
                    <div id="input-results" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg w-full left-0 top-full mt-1 text-sm hidden"></div>
                </div>
                <input type="hidden" id="company_name" name="company_name" value="{{ $company ? $company->company_name : '' }}">
                <input type="hidden" id="corporate_number" name="corporate_number" value="{{ $company ? $company->corporate_number : '' }}">
            </div>

            <div class="mb-10">
                <label class="flex gap-1 mb-2 items-center text-gray-700 text-sm font-bold leading-relaxed">
                    入社形態
                    <x-required-mark />
                    <p id="entry_type-error" class="error-message text-red-500 text-xs" style="display: none;"></p>
                </label>
                <div class="flex gap-8">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="entry_type" value="新卒入社" required>
                        <span class="ml-2">新卒入社</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="entry_type" value="中途入社">
                        <span class="ml-2">中途入社</span>
                    </label>
                </div>
            </div>

            <div class="mb-10">
                <label class="flex gap-1 mb-2 items-center text-gray-700 text-sm font-bold leading-relaxed">
                    在籍状況
                    <x-required-mark />
                    <p id="status-error" class="error-message text-red-500 text-xs" style="display: none;"></p>
                </label>
                <div class="flex gap-12">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="status" value="在籍中" required>
                        <span class="ml-2">在籍中</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="status" value="退職済み">
                        <span class="ml-2">退職済み</span>
                    </label>
                </div>
            </div>

            <div class="mb-10">
                <label class="flex gap-1 mb-2 items-center text-gray-700 text-sm font-bold leading-relaxed">
                    在籍期間
                    <x-required-mark />
                    <p id="start_year-error" class="error-message text-red-500 text-xs" style="display: none;"></p>
                </label>
                <div class="flex items-center">
                    <select id="start_year" name="start_year" required
                        class="h-10 w-1/3 px-4 border border-gray-300 text-base font-normal text-gray-700 bg-white rounded-md placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                        <option value="">入社年</option>
                        @for ($year = date('Y'); $year >= date('Y') - 50; $year--)
                            <option value="{{ $year }}">{{ $year }}年</option>
                        @endfor
                    </select>
                    <span class="mx-2">〜</span>
                    <select id="end_year" name="end_year"
                        class="h-10 w-1/3 px-4 border border-gray-300 text-base font-normal text-gray-700 bg-white rounded-md placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                        <option value="" selected disabled>退職年</option>
                        @for ($year = date('Y'); $year >= date('Y') - 50; $year--)
                            <option value="{{ $year }}">{{ $year }}年</option>
                        @endfor
                    </select>
                    <p id="end_year-error" class="error-message text-red-500 text-xs" style="display: none;"></p>
                </div>
            </div>

            <div class="mb-10">
                <label for="job_category" class="flex gap-1 mb-2 items-center text-gray-700 text-sm font-bold leading-relaxed">
                    職種
                    <x-required-mark />
                    <p id="job_category-error" class="error-message text-red-500 text-xs" style="display: none;"></p>
                </label>
                <select id="job_category" name="current_job_category_id" required
                    class="h-10 w-full px-4 border border-gray-300 text-base font-normal text-gray-700 bg-white rounded-md placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                    <option value="">選択してください</option>
                    @foreach ($jobCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-center mt-16">
                <button type="submit" id="next-button"
                    class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-3 px-8 rounded-full transform transition duration-300 ease-in-out hover:scale-105 flex items-center">
                    <span class="mr-1">次にすすむ</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" stroke="white"></path>
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>

<div class="mt-20"></div>
@include('layouts.footer')
@vite(['resources/js/company-input.js'])
@vite(['resources/js/posts-step1.js'])