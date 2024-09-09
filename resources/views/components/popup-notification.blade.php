@props(['message'])

<div x-data="{ show: false }" 
     x-show="show" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform scale-90"
     x-transition:enter-end="opacity-100 transform scale-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 transform scale-100"
     x-transition:leave-end="opacity-0 transform scale-90"
     x-init="
        show = true;
        setTimeout(() => { show = false }, 3000);
     "
     class="fixed inset-0 z-50 flex items-center justify-center" 
     style="display: none;">
    <div class="bg-white rounded-lg shadow-xl p-6 max-w-sm w-full mx-4 transform transition-all">
        <div class="flex items-center justify-center mb-4">
            <svg class="h-12 w-12 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-center text-gray-800 mb-2">{{ $message }}</h3>
    </div>
</div>