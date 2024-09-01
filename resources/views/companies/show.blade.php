<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('企業詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">{{ $company->company_name }}</h1>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p><strong>法人番号:</strong> {{ $company->corporate_number }}</p>
                            <p><strong>所在地:</strong> {{ $company->location }}</p>
                            <p><strong>代表者名:</strong> {{ $company->representative_name }}</p>
                        </div>
                        <div>
                            <p><strong>設立日:</strong> {{ $company->established_date }}</p>
                            <p><strong>資本金:</strong> {{ number_format($company->capital) }} 円</p>
                            <p><strong>従業員数:</strong> {{ $company->employees_number }} 人</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h2 class="text-xl font-semibold mb-2">事業内容</h2>
                        <p>{{ $company->business_description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>