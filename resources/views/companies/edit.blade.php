@include('layouts.navigation')

<section class="py-16 bg-gray-50">
    <div class="max-w-5xl mt-24 mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-3xl overflow-hidden">
            <div class="px-6 py-8 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800">「{{ $company->company_name }}」の企業データを編集</h3>
            </div>
            <form action="{{ route('companies.update', $company->corporate_number) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="company_name" class="text-sm font-medium text-gray-700">会社名</label>
                        <input type="text" name="company_name" id="company_name" value="{{ $company->company_name }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div class="space-y-2 col-span-1 md:col-span-2">
                        <label for="business_summary" class="text-sm font-medium text-gray-700">事業概要</label>
                        <textarea name="business_summary" id="business_summary" rows="5" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">{{ old('business_summary', $company->business_summary) }}</textarea>
                    </div>

                    <div class="space-y-2">
                        <label for="company_url" class="text-sm font-medium text-gray-700">ウェブサイト</label>
                        <input type="url" name="company_url" id="company_url" value="{{ $company->company_url }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div class="space-y-2">
                        <label for="location" class="text-sm font-medium text-gray-700">所在地</label>
                        <input type="text" name="location" id="location" value="{{ $company->location }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div class="space-y-2">
                        <label for="employee_number" class="text-sm font-medium text-gray-700">従業員数（人）</label>
                        <input type="number" name="employee_number" id="employee_number" value="{{ $company->employee_number }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div class="space-y-2">
                        <label for="date_of_establishment" class="text-sm font-medium text-gray-700">設立日</label>
                        <input type="date" name="date_of_establishment" id="date_of_establishment" value="{{ $company->date_of_establishment }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div class="space-y-2">
                        <label for="capital_stock" class="text-sm font-medium text-gray-700">資本金（円）</label>
                        <div class="flex items-center">
                            <input type="number" name="capital_stock" id="capital_stock" 
                                   value="{{ old('capital_stock', $company->capital_stock) }}" 
                                   class="w-full h-10 px-3 py-2 text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="representative_name" class="text-sm font-medium text-gray-700">代表者名</label>
                        <input type="text" name="representative_name" id="representative_name" value="{{ $company->representative_name }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div class="space-y-2">
                        <label for="industry_id" class="text-sm font-medium text-gray-700">業界</label>
                        <select name="industry_id" id="industry_id" class="w-full h-10 px-3 py-2 text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                            <option value="">選択してください</option>
                            @foreach($industries as $industry)
                                <option value="{{ $industry->id }}" {{ old('industry_id', $company->industry_id) == $industry->id ? 'selected' : '' }}>
                                    {{ $industry->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="space-y-2">
                        <label for="listing_status" class="text-sm font-medium text-gray-700">上場状況</label>
                        <select name="listing_status" id="listing_status" class="w-full h-10 px-3 py-2 text-base border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-cyan-500 focus:border-cyan-500">
                            <option value="" {{ $company->listing_status == '' ? 'selected' : '' }}>未上場</option>
                            <option value="プライム" {{ $company->listing_status == 'プライム' ? 'selected' : '' }}>プライム</option>
                            <option value="スタンダード" {{ $company->listing_status == 'スタンダード' ? 'selected' : '' }}>スタンダード</option>
                            <option value="グロース" {{ $company->listing_status == 'グロース' ? 'selected' : '' }}>グロース</option>
                        </select>
                    </div>
            </form>
        </div>

        <div class="mt-8 mb-12 flex justify-center space-x-4">
            <a href="{{ route('companies.show', $company->corporate_number) }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 shadow-md">戻る</a>
            <button type="submit" form="edit-company-form" class="px-6 py-2 bg-cyan-500 text-white rounded-md hover:bg-cyan-600 transition-colors focus:outline-none focus:ring-2 focus:ring-cyan-500 shadow-md">更新</button>
        </div>
    </div>
</section>

@include('layouts.footer');