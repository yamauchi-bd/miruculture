@include('layouts.navigation')

<div class="max-w-7xl mx-auto px-8 sm:px-8 md:px-8 lg:px-24 xl:px-32 pt-10 sm:pt-20 md:pt-14 lg:pt-28 pb-6 sm:pb-10 md:pb-8 lg:pb-16">
    <h1 class="text-2xl font-bold mb-8 text-gray-700">利用規約・プライバシーポリシー</h1>

    <div x-data="{ activeTab: '{{ request()->query('tab', 'rule') }}' }">
        <div class="mb-4 border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px">
                <li class="mr-2">
                    <a href="#" class="inline-block p-4" :class="{ 'text-blue-600 border-b-2 border-blue-600': activeTab === 'rule', 'text-gray-500 hover:text-gray-600': activeTab !== 'rule' }" @click.prevent="activeTab = 'rule'">利用規約</a>
                </li>
                <li class="mr-2">
                    <a href="#" class="inline-block p-4" :class="{ 'text-blue-600 border-b-2 border-blue-600': activeTab === 'policy', 'text-gray-500 hover:text-gray-600': activeTab !== 'policy' }" @click.prevent="activeTab = 'policy'">プライバシーポリシー</a>
                </li>
            </ul>
        </div>

        <div x-show="activeTab === 'rule'">
            @include('informations.rule_content')
        </div>
    
        <div x-show="activeTab === 'policy'">
            @include('informations.policy_content')
        </div>
    </div>
</div>

@include('layouts.footer')